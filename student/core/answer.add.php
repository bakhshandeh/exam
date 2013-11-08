<?php

require_once(dirname(__FILE__)."/../include.php");
$db = DBSingleton::getInstance();

update_exams();

$att_id=(int)$_REQUEST["att_id"];
$attempts = $db->dbSelect("exam_attempts", "id={$att_id}");
if(!count($attempts) || $attempts["is_submitted"]==1){
    print "Exam finished!";
    exit(0);
}

$id = (int)$_SESSION["loginInfo"]["id"];
$answer = $_REQUEST["answer"];

if(is_array($answer)){
    $answer = implode(",", $answer);
}

$qid = (int)$_REQUEST["qid"];

$data = array(
    "answer" => quote($answer),
    "qid" => $qid,
    "attempt_id" => $att_id,
);

if (strlen($_REQUEST["answer"])==0 && !isset($_REQUEST["reset"])){
    print "Please select an answer";
    exit(0);

}

$db->dbDelete("attempt_qs", "qid={$qid} and attempt_id={$att_id}");
if(!isset($_REQUEST["reset"]) ){
    $db->dbInsert("attempt_qs", $data);
}
print "OK";
?>
