<?php


function subjectOptions(){
    $db = DBSingleton::getInstance();
    $ret = $db->dbSelect("subjects");
    $s = "";
    foreach ($ret as $row){
        $id = $row["id"];
        $title = $row["title"];
        $s = $s."<option value='{$id}'>{$title}</option>";
    }
    return $s;
}

function stdgroupOptions(){
    $db = DBSingleton::getInstance();
    $ret = $db->dbSelect("stdgroups");
    $s = "";
    foreach ($ret as $row){
        $id = $row["id"];
        $title = $row["title"];
        $s = $s."<option value='{$id}'>{$title}</option>";
    }
    return $s;
}

function examStdgroupOptions($id){
    $db = DBSingleton::getInstance();
    $ret = $db->dbSelect("exam_stdgroups left join stdgroups on(gid=stdgroups.id)", "eid=".(int)$id, "", 0, -1, array("exam_stdgroups.id as eg_id", "stdgroups.*"));
    $s = "";
    foreach ($ret as $row){
        $id = $row["eg_id"];
        $title = $row["title"];
        $s = $s."<option value='{$id}'>{$title}</option>";
    }
    //print $s;exit(0);
    return $s;
}

function QTypes(){
    return array(
        "Subjective",
        "Objective",
        "Multiple Choice",
        "True/False"
    );
}

function loadExam($id){
    $db = DBSingleton::getInstance();
    $rets = $db->dbSelect("exams", "id=".(int)$id);
    
    if(!count($rets)){
        return array();
    }
    
    $ret = $rets[0];
    $qs = $db->dbSelect("exam_qs left join questions on(qid=questions.id)", "eid=".(int)$id, "", 0, -1, array("questions.*", "exam_qs.id as eq_id"));
    $ret["qs"] = $qs;
    
    $stdgroups = $db->dbSelect("exam_stdgroups left join stdgroups on(gid=stdgroups.id)", "eid=".(int)$id, "", 0, -1, array("stdgroups.*", "exam_stdgroups.id eg_id"));
    
    $ret["stdgroups"] = $stdgroups;
    return $ret;
}
?>
