<?php

require_once(dirname(__FILE__)."/../include.php");
$db = DBSingleton::getInstance();

#$conds = " start_date>=now() ";
$conds = " end_date <= now()";
$exams = $db->dbSelect("exams", $conds, "end_date desc");

foreach($exams as &$exam){
    $exam["dates"] = $exam["start_date"]."-".$exam["end_date"];
    
    $avgs = $db->dbSelect("exam_attempts", "eid=".(int)$exam["id"]." and is_passed=1", "", 0, -1,array("avg(score) as avg"));
    $exam["passed_avg"] = (int) $avgs[0]["avg"];
    
    $avgs = $db->dbSelect("exam_attempts", "eid=".(int)$exam["id"], "", 0, -1,array("avg(score) as avg"));
    $exam["avg"] = (int) $avgs[0]["avg"];
    
    $eid = $exam["id"];
    $exam["report"] = "<a href='exam_report.php?id={$eid}'> Details </a>";
}


$cols = array("name", "start_date", "end_date", "passed_avg", "avg", "report");
$exams = arraySelectKeys($exams, $cols);

header('Content-Type: application/json');
$ret = arrayPHPToJS($exams);
echo '{"sEcho":"2","iTotalRecords":'.count($exams).',"iTotalDisplayRecords":'.count($exams).',"aaData":  '.$ret.'}';

