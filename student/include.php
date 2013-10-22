<?php
ob_start();
session_name("student");
session_start();

require_once(dirname(__FILE__)."/../include/include.php");

if(isset($_SESSION["loginInfo"])){
    $_SESSION["loginInfo"] = loadStudent($_SESSION["loginInfo"]["id"]);
}
?>
