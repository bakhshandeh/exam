<?php

require_once(dirname(__FILE__)."/../include.php");
$db = DBSingleton::getInstance();
$id = (int)$_SESSION["loginInfo"]["id"];
$answer = $_REQUEST["answer"];

if(is_array($answer)){
    $answer = implode(",", $answer);
}

$eid = (int)$_REQUEST["eid"];
$qid = (int)$_REQUEST["qid"];

$data = array(
    "answer" => quote($answer),
    "qid" => $qid,
    "eid" => $eid,
    "std_id" => $id
);

$db->dbDelete("stdexam_qs", "qid={$qid} and eid={$eid} and std_id={$id}");
$db->dbInsert("stdexam_qs", $data);
print "OK";
?>
