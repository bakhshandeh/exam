<?php

require_once(dirname(__FILE__)."/../include.php");
$std_id =(int)$_SESSION["loginInfo"]["id"];
$db = DBSingleton::getInstance();

$name = uploadFile($_FILES["file"]);

$db->dbUpdate("students", array("profile_img" => quote($name)), "id=".(int)$std_id);

redirect("../profile.php");