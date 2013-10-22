<?php

require_once(dirname(__FILE__)."/../include.php");
$db = DBSingleton::getInstance();

$u = quote($_REQUEST["username"]);
$p = quote($_REQUEST["pass"]);

print "email = {$u} and pass={$p}";
$ret = $db->dbSelect("students", "email = {$u} and pass={$p}");
var_dump($ret);
if(count($ret)){
    $student = $ret[0];
    $_SESSION["loginInfo"] = $student;
    print "OK!";
    exit(0);
}

print "Invalid login!";
?>
