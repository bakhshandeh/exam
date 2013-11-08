<?php

require_once(dirname(__FILE__)."/../include.php");
$db = DBSingleton::getInstance();

$del = $_REQUEST["del"];

if($del){
    $ids = $_REQUEST["id"];
    //$ids = explode(",", $ids);
    foreach($ids as $id){
        $db->dbDelete("exam_stdgroups", "id=".(int)$id);
    }
    return;
}else{
    $id = (int)$_REQUEST["id"];
    $eid = (int)$_REQUEST["eid"];
                        
    $data = array(
        "gid" => (int)$id,
        "eid" => (int)$eid
    );
    $ret = $db->dbSelect("exam_stdgroups", "eid={$eid} and gid={$id}");
    if(!count($ret)){
        $db->dbInsert("exam_stdgroups", $data);
    }
}

print "OK!";
?>
