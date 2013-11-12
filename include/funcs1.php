<?php
define("UPLOADS_PATH", dirname(__FILE__)."/../../../uploads/");

function update_exams(){
    $db = DBSingleton::getInstance();
    $exams = $db->dbSelect("exam_attempts", "is_submitted = 0 and end_date < now()"); 
    foreach($exams as $ex){
        exam_correction($ex["eid"], $ex["std_id"], $ex["attempt_num"]);
    }
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

function exam_correction_by_id($att_id){
    exam_correction(0,0,0, $att_id);
}

function exam_correction($eid, $st_id, $att_no, $att_id=-1){
    
    $db = DBSingleton::getInstance();
    $ret= $db->dbSelect("exam_attempts", $att_id != -1 ? "eid={$eid} and std_id={$std_id} and attempt_num={$att_no}" : "id={$att_id}");
    
    $exam = $db->dbSelect("exam", "id={$ret['eid']}");
    
    $rets= $db->dbSelect("attempt_qs" , "attempt_id={$ret['id']}");
    $score=0;
    foreach($rets as $e){
        $r=$db->dbSelect("questions" , "id={$e['qid']}");
        if($r['type']!=0){
            if ($r['answer']==$e['answer']){
                $score+=$r['mark'];
                $db->dbUpdate("attempt_qs", array("is_true"=>1 ) ,"attempt_id={$ret[id]} and $qid={$r[id]}");
            }else{
                $score-=$r['neg_mark'];
                $db->dbUpdate("attempt_qs", array("is_true"=>0 ), "attempt_id={$ret[id]}  and $qid={$r[id]}");
            }
        }
    }
    $passP = $exam["pass_p"];
    $marks = $db->dbSelect("questions", "id in (select qid from exam_qs where eid={$exam['id']})", "", 0, -1, array("sum(mark) as mark"));
    $totalMarks = $marks[0]["mark"];
    $p = ($score/$totalMarks);
    
    $pass = $p > $passP ? 1 : 0;
    
    $db->dbUpdate("exam_attempts", array( "score" => $score, "is_passed" => $pass), "eid={$eid} and std_id={$std_id} and attempt_num={$att_no}");
}


?>
