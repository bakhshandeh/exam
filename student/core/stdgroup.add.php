<?php

require_once(dirname(__FILE__)."/../include.php");
$db = DBSingleton::getInstance();
$spId = (int)$_SESSION["loginInfo"]["id"];


$title = $_REQUEST["title"];

$query = "INSERT into stdgroups(title) VALUES(".quote($title).")";

if (!$db->query($query) ) {
    //$data["success"] = false;
}


?>
