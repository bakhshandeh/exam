<?php

require_once(dirname(__FILE__)."/../include.php");
$db = DBSingleton::getInstance();

#$conds = " start_date>=now() ";
$conds = " end_date >=now() ";
$tody_exams= $db->dbSelect("exams", $conds);
foreach($tody_exams as $k => $ex){
    $ret = $db->dbSelect("questions", "id in (select qid from exam_qs where eid={$ex['id']})", "", 0, -1, array("sum(mark) as mark"));
    $tody_exams[$k]["marks"] = (int)$ret[0]["mark"];
    
    $ret = $db->dbSelect("exam_stdgroups join stdgroups on(gid=stdgroups.id)", "eid={$ex['id']}");
    $gs = array();
    foreach($ret as $g){
        $gs[] = $g["title"];
    }
    $tody_exams[$k]["groups"] = implode(" | ", $gs);
}

$cols = array("start_date","name", "groups", "marks", "duration");
$tody_exams = arraySelectKeys($tody_exams, $cols);


header('Content-Type: application/json');
$ret = arrayPHPToJS($tody_exams);
echo '{"sEcho":"2","iTotalRecords":'.count($tody_exams).',"iTotalDisplayRecords":'.count($tody_exams).',"aaData":  '.$ret.'}';
?>