<?php

require_once(dirname(__FILE__)."/../include.php");
$db = DBSingleton::getInstance();

$u = quote($_REQUEST["usename"]);
$p = quote($_REQUEST["pass"]);

if($_REQUEST["username"] == "admin" && $_REQUEST["pass"] == "admin"){
    $_SESSION["loginInfo"]["username"] = "admin";
    print "OK!";
    exit(0);
}
print "Invalid login!";
?>
