<?php

require_once(dirname(__FILE__)."/../include.php");
$std_id =(int)$_SESSION["loginInfo"]["id"];
$db = DBSingleton::getInstance();

$conds = " start_date<=now()  and end_date>= now() and id in (select eid from exam_stdgroups where gid in(select g_id from std_stdgs where std_id = {$std_id}))";
if($_REQUEST["up"] == 1){
    $conds = " start_date>=now() and id in (select eid from exam_stdgroups where gid in(select g_id from std_stdgs where std_id = {$std_id}))";
}
if($_REQUEST["pass"] == 1){
    //$conds = "id in (select eid from exam_attempts where std_id={$std_id} and is_passed=1)";
    $rets = $db->dbSelect("exam_attempts join exams on (eid=exams.id)", "std_id={$std_id} and is_passed=1", "", 0, -1, array("*", "exam_attempts.id as att_id",
        "(select count(distinct score) from exam_attempts t where t.eid=exam_attempts.eid and t.score > exam_attempts.score and score is not null)+1 as rank"
    ));
    
    foreach($rets as &$ret){
        $r2 = $db->dbSelect("questions", "id in (select qid from exam_qs where eid={$ret['eid']})", "", 0, -1, array("sum(mark) as mark"));
        $total = $r2[0]["mark"];
        $score = $ret["score"];
       // var_dump($total);var_dump($score);exit(0);
        //$ret["rank"] = 1;
        $ret["percentage"] = round($score*100.00/$total, 2);
        
        $id = $ret["att_id"];
        $ret["link"] = "<a href='correxam.php?att_id={$ret['att_id']}'>Rsults</a>";
    }
    $cols = array("name", "start_date", "score", "duration", "percentage", "rank", "link");
    $tody_exams = arraySelectKeys($rets, $cols);
    
    header('Content-Type: application/json');
    $ret = arrayPHPToJS($tody_exams);
    echo '{"sEcho":"2","iTotalRecords":'.count($tody_exams).',"iTotalDisplayRecords":'.count($tody_exams).',"aaData":  '.$ret.'}';
    exit(0);
}

$tody_exams= $db->dbSelect("exams", $conds);
#$tody_exams = addRowNumbers($tody_exams);
foreach($tody_exams as $k => $ex){
    $ret = $db->dbSelect("questions", "id in (select qid from exam_qs where eid={$ex['id']})", "", 0, -1, array("sum(mark) as mark"));
    $tody_exams[$k]["marks"] = (int)$ret[0]["mark"];
    
    //$ret = $db->dbSelect("exam_attempts", "eid=$k['id'] and ");
}

$cols = array("id","name", "duration", "marks");
if($_REQUEST["up"] == 1){
    $cols[0] = "start_date";
}
if($_REQUEST["pass"] == 1){
    $cols = array("name", "start_date", "score", "duration");
}
  //var_dump($cols);exit(0);

$tody_exams = arraySelectKeys($tody_exams, $cols);


header('Content-Type: application/json');
$ret = arrayPHPToJS($tody_exams);
echo '{"sEcho":"2","iTotalRecords":'.count($tody_exams).',"iTotalDisplayRecords":'.count($tody_exams).',"aaData":  '.$ret.'}';
?>