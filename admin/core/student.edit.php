<?php

require_once(dirname(__FILE__)."/../include.php");
$db = DBSingleton::getInstance();
$spId = (int)$_SESSION["loginInfo"]["id"];

$keys = array(
    "name",
    "email",
    "pass",
    "city",
    "area",
    "country",
    "address",
    "mobile",
    "roll_number",
    "enrol_number",
    "phone",
    "alt_phone",
    "parent_phone",
    "comments",
    "stdgroup"
);

$data = array();
$data["status"] = (int)$_REQUEST["status"];
#$data["date"] = "now()";
foreach($keys as $k){
    $data[$k] = quote($_REQUEST[$k]);
}
//var_dump($data);exit(0);

$db->dbUpdate("students", $data, "id=".(int)$_REQUEST["id"]);
?>
