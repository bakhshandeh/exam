<?php

require_once(dirname(__FILE__)."/../include.php");

$sponsorId = $_SESSION["loginInfo"]["id"];
$db = DBSingleton::getInstance();


if(isset($_REQUEST["id"])){
    //$rets = $db->dbSelect("exams", "id=".(int)$_REQUEST["id"]);
    
    //$rets2 = $db->dbSelect("qanswers", "qid=".($rets[0]["id"]) );
    //$rets[0]["ans"] = $rets2;
    
    $exam = loadExam($_REQUEST["id"]);
    print json_encode($exam);
    return;
}


$rets = $db->dbSelect("exams");

foreach($rets as &$ret){
    $ret["start_end_dates"] = $ret["start_date"]." -- ".$ret["end_date"];
    //$ret["type_text"] = $qTypes[$ret["type"]];
}

$rets = addRowNumbers($rets);
$rets = arraySelectKeys($rets, array("row", "name", "duration", "start_end_dates", "pass_p", "neg_mark","insts", "id"));

header('Content-Type: application/json');
$ret = arrayPHPToJS($rets);
echo '{"sEcho":"2","iTotalRecords":'.count($rets).',"iTotalDisplayRecords":'.count($rets).',"aaData":  '.$ret.'}';
