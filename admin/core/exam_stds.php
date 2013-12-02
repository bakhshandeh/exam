<?php

require_once(dirname(__FILE__)."/../include.php");
$db = DBSingleton::getInstance();


$id = $_REQUEST["id"];
$attempts = $db->dbSelect("exam_attempts join exams on(eid=exams.id) join students on(students.id=std_id)", "eid={$id}", "", 0, -1, 
        array("*", "(select count(*) from attempt_qs where attempt_id=exam_attempts.id) as q_count", 
            "(select sum(mark) from exam_qs join questions on(qid=questions.id) where eid={$id}) as total_marks",
            "students.name as std_name", "exam_attempts.id as att_id",
            "(select count(distinct score) from exam_attempts t where t.eid=exam_attempts.eid and t.score > exam_attempts.score)+1 as rank"
            ));

foreach($attempts as &$at){
    $at["percentage"] = round($at["score"]*100.00 / $at["total_marks"], 2)."%";
    $at["link"] = "<a href='std_exam_details.php?att_id={$at['att_id']}'> View </a>";
}


$rets = arraySelectKeys($attempts, array("std_name", "score", "q_count", "duration", "percentage", "rank", "link"));

header('Content-Type: application/json');
$ret = arrayPHPToJS($rets);

echo '{"sEcho":"2","iTotalRecords":'.count($rets).',"iTotalDisplayRecords":'.count($rets).',"aaData":  '.$ret.'}';
