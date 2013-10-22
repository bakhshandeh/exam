<?php

require_once(dirname(__FILE__)."/include/include.php");
$db = DBSingleton::getInstance();
$spId = (int)$_SESSION["loginInfo"]["id"];

$data = array(
    "success" => true,
    "error" => false,
);

$f = $_FILES["qqfile"];
if(!$f or $f["error"]){
    $data["success"] = false;
}

$fileName = uploadFile($f);

$key = $_REQUEST["name"];
$query = "INSERT into sponsors_data VALUES(" . $spId . ", " . quote($key) . ", " . quote($fileName) . ") ON DUPLICATE KEY UPDATE value=" . quote($fileName) . "";

if (!$db->query($query) ) {
    $data["success"] = false;
}

$data["file_name"] = $fileName;
print json_encode($data);

?>
