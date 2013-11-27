<?php

require_once(dirname(__FILE__)."/../include.php");
$db = DBSingleton::getInstance();
$std_id = $_SESSION["loginInfo"]["id"];
$att_id = (int)$_REQUEST["att_id"];

$cond = "";
if($_REQUEST["exam"]){
    $eid = (int) $_REQUEST["exam"];
    $cond = "questions.id in (select qid from exam_qs where eid={$eid})";
}

if($_REQUEST["sub_id"]){
    $sub_id = (int) $_REQUEST["sub_id"];
    if($cond != ""){
        $cond .= " and ";
    }
    $cond .= " subjects.id={$sub_id}";
}

$rets = $db->dbSelect("questions left join subjects on(subject=subjects.id)", $cond, "", 0, -1, array("questions.id as id", "questions.*", "subjects.title") );
foreach($rets as &$q){
    $ans = $db->dbSelect("qanswers", "qid=".($q["id"]) );
    foreach($ans as &$an){
        //unset($an["is_true"]);
    }
    $q["answers"] = $ans;
}
$ans = $db->dbSelect("attempt_qs join exam_attempts on(exam_attempts.id = attempt_id)", "eid={$eid} and std_id={$std_id} and attempt_id={$att_id}");
$std_ans = array();
foreach($ans as $an){
    $std_ans[$an["qid"]] = $an;
}

foreach($rets as &$q){
    $q["is_answered"] = isset($std_ans[$q["id"]]);
    $q["std_answer"] = isset($std_ans[$q["id"]]) ? $std_ans[$q["id"]] : array("answer" => -1);
}


print json_encode($rets);
