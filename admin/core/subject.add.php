<?php

require_once(dirname(__FILE__)."/../include.php");
$db = DBSingleton::getInstance();
$spId = (int)$_SESSION["loginInfo"]["id"];


$title = $_REQUEST["title"];

notNull("title");
checkDuplicate("subjects", "title=".quote($title), "Subject already exsists!");

$query = "INSERT into subjects(title) VALUES(".quote($title).")";

if (!$db->query($query) ) {
    //$data["success"] = false;
}

print "OK!";


?>
