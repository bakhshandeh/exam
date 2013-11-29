<?php

require_once(dirname(__FILE__)."/../include.php");

$sponsorId = $_SESSION["loginInfo"]["id"];
$db = DBSingleton::getInstance();


if(isset($_REQUEST["id"])){
    $rets = $db->dbSelect("questions", "id=".(int)$_REQUEST["id"]);
    
    $rets2 = $db->dbSelect("qanswers", "qid=".($rets[0]["id"]) );
    $rets[0]["ans"] = $rets2;
    print json_encode($rets[0]);
    return;
}


$cond = "";
if(strlen($_REQUEST["type"])){
    $cond = "type=".(int)$_REQUEST["type"];
}
if($_REQUEST["exam"]){
    $eid = (int) $_REQUEST["exam"];
    $not = isset($_REQUEST["no_exam"]) ? "not" : "";
    $cond = "questions.id {$not} in (select qid from exam_qs where eid={$eid})";
}
$rets = $db->dbSelect("questions left join subjects on(subject=subjects.id)", $cond, "", 0, -1, array("questions.id as id", "questions.*", "subjects.title") );

$qTypes = QTypes();
foreach($rets as &$ret){
    $ret["marks"] = $ret["mark"]."(".$ret["neg_mark"].")";
    $ret["type_text"] = $qTypes[$ret["type"]];
}

$rets = addRowNumbers($rets);
$rets = arraySelectKeys($rets, array("row", "title", "type_text", "body", "diff_level", "marks", "hint", "id"));

header('Content-Type: application/json');
$ret = arrayPHPToJS($rets);
echo '{"sEcho":"2","iTotalRecords":'.count($rets).',"iTotalDisplayRecords":'.count($rets).',"aaData":  '.$ret.'}';
