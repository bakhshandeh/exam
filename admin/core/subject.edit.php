<?php

require_once(dirname(__FILE__)."/../include.php");
$db = DBSingleton::getInstance();
$spId = (int)$_SESSION["loginInfo"]["id"];


$title = quote($_REQUEST["title"]);
$id = (int)$_REQUEST["id"];

$query = "update subjects set title={$title} where id={$id}";

if (!$db->query($query) ) {
    //$data["success"] = false;
}

print "OK!";
?>
