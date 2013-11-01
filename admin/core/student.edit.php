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
    "enrol_number",
    "phone",
    "alt_phone",
    "parent_phone",
    "comments",
    //"stdgroup"
);

// Author: Zinat

if(!filter_var($_REQUEST["email"], FILTER_VALIDATE_EMAIL)){
    print "Please insert a valid email! ";
    exit(0);
}
if(count($_REQUEST["stdgroup"])==0){
    print "Please select at list one group";
    exit(0);
}

if(strlen($_REQUEST["phone"])!=10 or !ereg('^[0-9]+$',$_REQUEST["phone"]) ){
    print "Invalid phone. phone should be 10 digit number";
    exit(0);
}
if( !ereg('^[0-9]+$',$_REQUEST["enrol_number"]) ){
    print "Invalid enrol_number";
    exit(0);
}

//----- END -------


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
