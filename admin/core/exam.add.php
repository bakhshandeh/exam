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
    "no_attempt"=>"int",
    "insts" => "",
    "declare_results" => "checkbox",
    "details" => "checkbox"
);

// Author:Zinat

if(!strlen($_REQUEST['name'])){
    print "Invaild Name!";
    exit(0);

}

$bits = explode(':', $_REQUEST["duration"]);
if(count($bits) != 2 || $bits[1] > 60) {
    print "Invaild duration";
    exit(0);
}

$start_date=strtotime($_REQUEST["start_date"]);
if($start_date === false){
   print "Invaild Start Date!";
   exit(0);
}


$end_date=strtotime($_REQUEST["end_date"]);
if($end_date === false){
   print "Invaild End Date!";
   exit(0);
}
if ( !is_numeric($_REQUEST["pass_p"]) || $_REQUEST["pass_p"]<1|| $_REQUEST["pass_p"]>100){
    print "Invalid Pass Percent!";
    exit(0);
}

if ( !is_numeric($_REQUEST["neg_mark"]) ){
    print "Invalid Negative Marks!";
    exit(0);
}

if ( !is_numeric($_REQUEST["no_attempt"]) ){
    print "Invalid No. of Attempts!";
    exit(0);
}

if(!strlen($_REQUEST['insts'])){
    print "Invaild Instructions!";
    exit(0);

}


//--END--




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
