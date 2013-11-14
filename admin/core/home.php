<?php

require_once(dirname(__FILE__)."/../include.php");
$std_id =(int)$_SESSION["loginInfo"]["id"];
$db = DBSingleton::getInstance();

$conds = " start_date<=now()  and end_date>= now() and id in (select eid from exam_stdgroups where gid in(select g_id from std_stdgs where std_id = {$std_id}))";
if($_REQUEST["up"] == 1){
    $conds = " start_date>=now() and id in (select eid from exam_stdgroups where gid in(select g_id from std_stdgs where std_id = {$std_id}))";
}
if($_REQUEST["pass"] == 1){
    $conds = "id in (select eid from exam_attempts where std_id={$std_id} and is_passed=1)";
}

$tody_exams= $db->dbSelect("exams", $conds);
#$tody_exams = addRowNumbers($tody_exams);
foreach($tody_exams as $k => $ex){
    $ret = $db->dbSelect("questions", "id in (select qid from exam_qs where eid={$ex['id']})", "", 0, -1, array("sum(mark) as mark"));
    $tody_exams[$k]["marks"] = (int)$ret[0]["mark"];
}

$cols = array("id","name", "duration", "marks");
if($_REQUEST["up"] == 1){
    $cols[0] = "start_date";
}
$tody_exams = arraySelectKeys($tody_exams, $cols);


header('Content-Type: application/json');
$ret = arrayPHPToJS($tody_exams);
echo '{"sEcho":"2","iTotalRecords":'.count($tody_exams).',"iTotalDisplayRecords":'.count($tody_exams).',"aaData":  '.$ret.'}';
?>