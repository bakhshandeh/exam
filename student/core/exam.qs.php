<?php

require_once(dirname(__FILE__)."/../include.php");

$sponsorId = $_SESSION["loginInfo"]["id"];
$db = DBSingleton::getInstance();

$eid = (int)$_REQUEST["eid"];
$qs = $db->dbSelect("questions", "id in (select qid from exam_qs where eid={$eid})");

$ret = arrayPHPToJS($qs);
print json_encode($ret);