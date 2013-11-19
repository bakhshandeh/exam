<?php

require_once(dirname(__FILE__)."/../include.php");

$sponsorId = $_SESSION["loginInfo"]["id"];
$db = DBSingleton::getInstance();


if(isset($_REQUEST["id"])){
    $rets = $db->dbSelect("students", "id=".(int)$_REQUEST["id"]);
    $groups = $db->dbSelect("std_stdgs", "std_id=".(int)$_REQUEST["id"]);
    $s = $rets[0];
    $s["gs"] = $groups;
    print json_encode($s);
    return;
}


$states = array("Active", "Pending", "Suspended");
$rets = $db->dbSelect("students");



foreach($rets as &$ret){

    $groups= $db->dbSelect("std_stdgs join stdgroups on(g_id=stdgroups.id) where std_id=".$ret["id"]);
    $gnames = array();
    foreach($groups as $g){
        $gnames[] = $g["title"];
    }
    $groupStr = implode(",", $gnames);
    $ret["address"] = $ret["country"]." ".$ret["city"]." ".$ret["area"]. " ".$ret["address"];
    $ret["status"] = $states[$ret["status"]];
    $ret["stdgroup"]=$groupStr;
}
$rets = addRowNumbers($rets);
$rets = arraySelectKeys($rets, array("row", "email", "name", "enrol_number", "phone", "address", "stdgroup", "date", "status",  "id"));

header('Content-Type: application/json');
$ret = arrayPHPToJS($rets);
echo '{"sEcho":"2","iTotalRecords":'.count($rets).',"iTotalDisplayRecords":'.count($rets).',"aaData":  '.$ret.'}';
