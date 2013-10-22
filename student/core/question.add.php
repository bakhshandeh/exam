<?php

require_once(dirname(__FILE__)."/../include.php");
$db = DBSingleton::getInstance();
$spId = (int)$_SESSION["loginInfo"]["id"];

$keys = array(
    "subject" => "int",
    "hint" => "",
    "diff_level" => "",
    "type" => "int",
    "mark" => "float",
    "neg_mark" => "float",
    "body" => "",
    "answer" => "int"
);

$data = array();
foreach($keys as $k => $v){
    if($v == "int"){
        $data[$k] = (int)$_REQUEST[$k];
    }elseif($v == "float"){
        $data[$k] = (float)$_REQUEST[$k];
    }else{
        $data[$k] = quote($_REQUEST[$k]);
    }
}

$isEdit = false;
if(isset($_REQUEST["id"]) && $_REQUEST["id"]){
    $isEdit = true;
}

if($isEdit){
    $db->dbUpdate("questions", $data, "id=".(int)$_REQUEST["id"]);
    $qid = (int)$_REQUEST["id"];
}else{
    $db->dbInsert("questions", $data);
    $ret = $db->dbSelect("questions", "", "", 0, -1, array("max(id) as id"));
    $qid = $ret[0]["id"];
}

$type = (int)$_REQUEST["type"];
$id = (int)$_REQUEST["id"];

if($type == 1 or $type==2){
    $answers = array($_REQUEST["answer1"],$_REQUEST["answer2"],$_REQUEST["answer3"],$_REQUEST["answer4"]);
    $true_answer = (int)$_REQUEST["true_answer"];
    $trues = $_REQUEST["trues"];
    
    $db->dbDelete("qanswers", "qid=".$qid);
    
    for($i=0; $i < count($answers); $i++){
        $data = array(
            "qid" => $qid,
            "body" => quote($answers[$i]),
            "is_true" => $true_answer=($i+1) ? "1" : "0"
        );
        if($type == 2){
            $data["is_true"] = isset($trues[$i+1]) ? "1" : "0";
        }
        if($answers[$i] != ""){
            $db->dbInsert("qanswers", $data);
        }
    }
}
?>
