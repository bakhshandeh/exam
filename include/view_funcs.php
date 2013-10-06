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

function QTypes(){
    return array(
        "Subjective",
        "Objective",
        "Multiple Choice",
        "True/False"
    );
}
?>
