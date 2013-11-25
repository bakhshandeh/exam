<?php

require_once(dirname(__FILE__)."/../include.php");

$sponsorId = $_SESSION["loginInfo"]["id"];
$db = DBSingleton::getInstance();

if(isset($_REQUEST["id"])){
    $gs = $db->dbSelect("stdgroups", "id=".(int)$_REQUEST["id"]);
    $sub = $gs[0];
    print json_encode($sub);
    return;
}

$rets = $db->dbSelect("stdgroups");
$rets = addRowNumbers($rets);
$rets = arraySelectKeys($rets, array("row", "title", "id"));

header('Content-Type: application/json');
$ret = arrayPHPToJS($rets);

echo '{"sEcho":"2","iTotalRecords":'.count($rets).',"iTotalDisplayRecords":'.count($rets).',"aaData":  '.$ret.'}';

?>
