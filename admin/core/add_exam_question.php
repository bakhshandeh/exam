<?php

require_once(dirname(__FILE__)."/../include.php");
$db = DBSingleton::getInstance();
$spId = (int)$_SESSION["loginInfo"]["id"];


$q = (int)$_REQUEST["q"];
$exam = (int)$_REQUEST["exam"];

$del = (int)$_REQUEST["del"];
if($del){
    $db->dbDelete("exam_qs", "qid={$q} and eid={$exam}");
    return 0;
}


$ret = $db->dbSelect("exam_qs", "qid={$q} and eid={$exam}");
if(count($ret)){
    return ;
}

$db->dbInsert("exam_qs", array(
    "qid" => $q,
    "eid" => $exam
));
print "OK!";

?>
