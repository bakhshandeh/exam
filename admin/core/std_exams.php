<?php

require_once(dirname(__FILE__)."/../include.php");
$db = DBSingleton::getInstance();


$id = $_REQUEST["id"];
$attempts = $db->dbSelect("exam_attempts join exams on(eid=exams.id)", "std_id={$id}", "", 0, -1, 
        array("*", "exam_attempts.id as att_id", "(select count(*) from attempt_qs where attempt_id=exam_attempts.id) as q_count",
            "timediff(exam_attempts.end_date, exam_attempts.start_date) as std_dur"
        ));

foreach($attempts as &$at){
    $at["link"] = "<a href='std_exam_details.php?att_id={$at['id']}'> View </a>";
}


$rets = arraySelectKeys($attempts, array("start_date", "name", "score", "q_count", "std_dur", "link"));

header('Content-Type: application/json');
$ret = arrayPHPToJS($rets);

echo '{"sEcho":"2","iTotalRecords":'.count($rets).',"iTotalDisplayRecords":'.count($rets).',"aaData":  '.$ret.'}';
