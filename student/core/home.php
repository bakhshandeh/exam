<?php

require_once(dirname(__FILE__)."/../include.php");
$std_id =(int)$_SESSION["loginInfo"]["id"];
$db = DBSingleton::getInstance();
$tody_exams= $db->dbSelect("exams", " start_date<=now()  and end_date>= now() and id in (select eid from exam_stdgroups where gid in(select g_id from std_stdgs where std_id = {$std_id}))");

#$tody_exams = addRowNumbers($tody_exams);
foreach($today_exams as $k => $ex){
    $ret = $db->dbSelect("questions", "id in (select qid from exam_qs where eid={$ex['id']})", "", 0, -1, array("sum(mark) as mark"));
    $ex[$k]["marks"] = $ret["mark"];
}
$tody_exams = arraySelectKeys($tody_exams, array("id","name", "duration", "marks"));


header('Content-Type: application/json');
$ret = arrayPHPToJS($tody_exams);
echo '{"sEcho":"2","iTotalRecords":'.count($tody_exams).',"iTotalDisplayRecords":'.count($tody_exams).',"aaData":  '.$ret.'}';
?>