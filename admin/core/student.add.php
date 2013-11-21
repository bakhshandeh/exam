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


if(strlen($_REQUEST["alt_phone"])!=10 or !ereg('^[0-9]+$',$_REQUEST["alt_phone"]) ){
    print "Invalid alternate phone. Alternate phone should be 10 digit number";
    exit(0);
}

if(strlen($_REQUEST["parent_phone"])!=10 or !ereg('^[0-9]+$',$_REQUEST["parent_phone"]) ){
    print "Invalid guardian phone. Guardian phone should be 10 digit number";
    exit(0);
}

if( !ereg('^[0-9]+$',$_REQUEST["enrol_number"]) ){
    print "Invalid enrol_number";
    exit(0);
}


//----- END -------


$stdgroups =$_REQUEST["stdgroup"];
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

print "OK!";

?>
