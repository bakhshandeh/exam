<?php

require_once(dirname(__FILE__)."/../include.php");
$db = DBSingleton::getInstance();
$spId = (int)$_SESSION["loginInfo"]["id"];

$keys = array(
    "name" => "",
    "duration" => "",
    "start_date" => "date",
    "end_date" => "date",
    "neg_mark" => "float",
    "pass_p" => "float",
    "insts" => "",
    "declare_results" => "checkbox",
    "details" => "checkbox"
);

$data = array();
foreach($keys as $k => $v){
    if($v == "int"){
        $data[$k] = (int)$_REQUEST[$k];
    }elseif($v == "float"){
        $data[$k] = (float)$_REQUEST[$k];
    }elseif($v == "date"){
        if($_REQUEST[$k] != "")
            $data[$k] = quote($_REQUEST[$k]);
    }elseif($v == "checkbox"){
        $val = 0;
        if(isset($_REQUEST[$k])){
            $val = 1;
        }
        $data[$k] = $val;
    }else{
        $data[$k] = quote($_REQUEST[$k]);
    }
}

$isEdit = false;
if(isset($_REQUEST["id"]) && $_REQUEST["id"]){
    $isEdit = true;
}

if($isEdit){
    $db->dbUpdate("exams", $data, "id=".(int)$_REQUEST["id"]);
}else{
    $db->dbInsert("exams", $data);
    $data=$db->dbSelect("exams", "", "", 0, -1, array("max(id) as max"));
    
    print $data[0]["max"];
}

?>
