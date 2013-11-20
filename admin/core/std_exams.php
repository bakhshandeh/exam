<?php

require_once(dirname(__FILE__)."/../include.php");
$db = DBSingleton::getInstance();


$id = $_REQUEST["id"];
$attempts = $db->dbSelect("exam_attempts join exams on(eid=exams.id)", "std_id={$id}", "", 0, -1, 
        array("*", "(select count(*) from attempt_qs where attempt_id=exam_attempts.id) as q_count"));


$rets = arraySelectKeys($attempts, array("start_date", "name", "score", "q_count", "duration"));

header('Content-Type: application/json');
$ret = arrayPHPToJS($rets);

echo '{"sEcho":"2","iTotalRecords":'.count($rets).',"iTotalDisplayRecords":'.count($rets).',"aaData":  '.$ret.'}';
