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
    //"stdgroup"
);

$stdgroups = $_REQUEST["stdgroup"];
if(!is_array($stdgroups)){
    $stdgroups = array();
}

$data = array();
$data["status"] = (int)$_REQUEST["status"];
#$data["date"] = "now()";
foreach($keys as $k){
    $data[$k] = quote($_REQUEST[$k]);
}
//var_dump($data);exit(0);

$db->dbUpdate("students", $data, "id=".(int)$_REQUEST["id"]);

$maxId = (int)$_REQUEST["id"];

$db->dbDelete("std_stdgs", "std_id={$maxId}");

foreach($stdgroups as $g){
    $db->dbInsert("std_stdgs", array(
        "std_id" => $maxId,
        "g_id" => (int)$g
    ));
}

?>
