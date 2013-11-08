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

if(strlen($_REQUEST["phone"])!=10 or !ereg('^[0-9]+$',$_REQUEST["phone"]) ){
    print "Invalid phone. Phone should be 10 digit number";
    exit(0);
}


if(!is_numeric($_REQUEST["enrol_number"]) ){
    print "Invaild Enrollment Number!";
    exit(0);

}


$db->dbUpdate("students", $data, "id=".(int)$_REQUEST["id"]);
print "Profile updated successfully!";
?>
