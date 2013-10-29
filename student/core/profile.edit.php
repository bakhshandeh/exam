<?php

require_once(dirname(__FILE__)."/../include.php");
$db = DBSingleton::getInstance();
$id = (int)$_SESSION["loginInfo"]["id"];

$keys = array(
    "pass",
    "address",
    "enrol_number",
    "phone"
);

$data = array();
foreach($keys as $k){
    $data[$k] = quote($_REQUEST[$k]);
}

$db->dbUpdate("students", $data, "id=".(int)$_REQUEST["id"]);
print "Profile updated successfully!";
?>
