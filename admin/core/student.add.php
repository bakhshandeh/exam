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

checkDuplicate("students", "email=".quote($_REQUEST["email"]), "Duplicate email!");
notNull(array("name", "email", "pass", "phone", "enrol_number"));

$data = array();
$data["status"] = (int)$_REQUEST["status"];
$data["date"] = "now()";
foreach($keys as $k){
    $data[$k] = quote($_REQUEST[$k]);
}


$db->dbInsert("students", $data);

$ret = $db->dbSelect("students", "", "", 0, -1, array("max(id) as id"));
$maxId = $ret[0]["id"];

foreach($stdgroups as $g){
    $db->dbInsert("std_stdgs", array(
        "std_id" => $maxId,
        "g_id" => (int)$g
    ));
}
?>
