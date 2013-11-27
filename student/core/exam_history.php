<?php

require_once(dirname(__FILE__)."/../include.php");
$std_id =(int)$_SESSION["loginInfo"]["id"];
$db = DBSingleton::getInstance();

$rets = $db->dbSelect("exam_attempts join exams on (eid=exams.id)", "std_id={$std_id}");
    
foreach($rets as &$ret){
        $r2 = $db->dbSelect("questions", "id in (select qid from exam_qs where eid={$ret['eid']})", "", 0, -1, array("sum(mark) as mark"));
        $total = $r2[0]["mark"];
        $score = $ret["score"];
        $ret["rank"] = 1;
        $ret["percentage"] = (float)($score*100.00/$total);
        
        $ret["state"] = $ret["is_passed"] == 1 ? "Passed" : "Failed";
        
        $id = $ret["id"];
        $ret["link"] = "<a href='correxam.php?att_id={$ret['id']}'>Rsults</a>";
}
$cols = array("name", "start_date", "state", "score", "duration", "percentage", "rank", "link");
$tody_exams = arraySelectKeys($rets, $cols);
    
header('Content-Type: application/json');
$ret = arrayPHPToJS($tody_exams);
echo '{"sEcho":"2","iTotalRecords":'.count($tody_exams).',"iTotalDisplayRecords":'.count($tody_exams).',"aaData":  '.$ret.'}';
exit(0);

