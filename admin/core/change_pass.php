<?php

require_once(dirname(__FILE__)."/include/include.php");
$db = DBSingleton::getInstance();

$spId = (int)$_SESSION["loginInfo"]["id"];
$data = array(
    "sponsors.password" => quote($_REQUEST["p"]),
);

$db->dbUpdate("sponsors",  $data, "id=".$spId);

print "OK!";
?>
