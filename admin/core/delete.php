<?php

require_once(dirname(__FILE__)."/../include.php");

$sponsorId = $_SESSION["loginInfo"]["id"];
$db = DBSingleton::getInstance();

$table = $_REQUEST["table"];
$id = (int)$_REQUEST["id"];


$tables = array("subjects", "users", "stdgroups", "students", "questions", "exams");

if(!in_array($table, $tables)){
    return;
}

$db->dbDelete($table, "id={$id}");
