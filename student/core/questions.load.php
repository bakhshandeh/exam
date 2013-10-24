<?php

require_once(dirname(__FILE__)."/../include.php");
$db = DBSingleton::getInstance();

$cond = "";
if($_REQUEST["exam"]){
    $eid = (int) $_REQUEST["exam"];
    $cond = "questions.id in (select qid from exam_qs where eid={$eid})";
}
$rets = $db->dbSelect("questions left join subjects on(subject=subjects.id)", $cond, "", 0, -1, array("questions.id as id", "questions.*", "subjects.title") );
foreach($rets as &$q){
    $ans = $db->dbSelect("qanswers", "qid=".($q["id"]) );
    foreach($ans as &$an){
        unset($an["is_true"]);
    }
    $q["answers"] = $ans;
}

print json_encode($rets);