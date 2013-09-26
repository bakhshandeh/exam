<?php

require_once(dirname(__FILE__)."/../include.php");

$sponsorId = $_SESSION["loginInfo"]["id"];
$db = DBSingleton::getInstance();


if(isset($_REQUEST["id"])){
    $rets = $db->dbSelect("students", "id=".(int)$_REQUEST["id"]);
    print json_encode($rets[0]);
    return;
}


$states = array("Active", "Pending", "Suspended");

$rets = $db->dbSelect("students");
foreach($rets as &$ret){
    $ret["address"] = $row["country"]." ".$row["city"]." ".$row["area"]. " ".$row["address"];
    $ret["status"] = $states[$ret["status"]];
}
$rets = addRowNumbers($rets);
$rets = arraySelectKeys($rets, array("row", "email", "name", "roll_number", "enrol_number", "phone", "address", "parent_phone", "date", "status", "comments", "id"));

header('Content-Type: application/json');
$ret = arrayPHPToJS($rets);
echo '{"sEcho":"2","iTotalRecords":'.count($rets).',"iTotalDisplayRecords":'.count($rets).',"aaData":  '.$ret.'}';
