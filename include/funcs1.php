<?php
define("UPLOADS_PATH", dirname(__FILE__)."/../../../uploads/");

function update_exams(){
    $db = DBSingleton::getInstance();
    $db->dbUpdate("exam_attempts", array("is_submitted" => 1), "end_date < now()");
}

function get_current_attempt($eid, $std_id){
    update_exams();
    $db = DBSingleton::getInstance();
    $rets = $db->dbSelect("exam_attempts", "eid={$eid} and std_id={$std_id}");
    $exam=$db->dbSelect("exams", "id={$eid}");
    if (count($rets)==0){
        return 1;
    }
    foreach($rets as $e){
        if($e["is_submitted"]==0){
            return $e["attempt_num"];
        }
    }
    
    $max = -1;
    foreach($rets as $e){
        if($e["attempt_num"] > $max){
            $max = $e["attempt_num"];
        }
    }
    if($max >= $exam[0]["no_attempt"]){
        return -1;
    }
    return $max+1;
}
?>







