<?php

require_once(dirname(__FILE__)."/../include.php");
$db = DBSingleton::getInstance();

update_exams();

$att_id=(int)$_REQUEST["att_id"];
$attempts = $db->dbSelect("exam_attempts", "id={$att_id}");
if(!count($attempts) || $attempts["is_submitted"]==1){
    print "Exam finished before!";
    exit(0);
}

$id = (int)$_SESSION["loginInfo"]["id"];
$answer = $_REQUEST["answer"];

$db->dbUpdate("exam_attempts", array(
    "is_submitted" => 1
), "id={$att_id}");

exam_correction_by_id($att_id);

print "OK";
?>
