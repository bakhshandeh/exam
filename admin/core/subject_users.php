<?php

require_once(dirname(__FILE__)."/../include.php");

$id = $_SESSION["loginInfo"]["id"];
$db = DBSingleton::getInstance();

$groups = $db->dbSelect("stdgroups");
$rets = array();
$chartGs = array();
foreach($groups as $g){
    $grp = array();
    $grp[] = $g["title"];
    $gid = $g["id"];
    
    $active = $db->dbSelect("std_stdgs join students on(students.id=std_id)", "g_id={$gid} and status=0");
    $active = count($active);
    
    $susp = $db->dbSelect("std_stdgs join students on(students.id=std_id)", "g_id={$gid} and status=2");
    $susp = count($susp);
    
    $pend = $db->dbSelect("std_stdgs join students on(students.id=std_id)", "g_id={$gid} and status=1");
    $pend = count($pend);
    
    $grp[] = $active+$susp;
    $grp[] = $active;
    $grp[] = $susp;
    
    $rets[] = $grp;
    
    $chartGs[$g["title"]] = array("active" => $active, "susp" => $susp, "pend" => $pend);
}


if(isset($_REQUEST["chart"])){
    $ret = array();
    $l = array();
    $names = array_keys($chartGs);
    $actives = array();
    $susps = array();
    $pends = array();
    foreach($names as $name){
        $actives[] = $chartGs[$name]["active"];
        $susps[] = $chartGs[$name]["pend"];
        $pends[] = $chartGs[$name]["susp"];
    }
    print json_encode(array("l" => array($actives, $pends, $susps), "names" => $names ));
    exit(0);
}

header('Content-Type: application/json');
$ret = arrayPHPToJS($rets);
echo '{"sEcho":"2","iTotalRecords":'.count($rets).',"iTotalDisplayRecords":'.count($rets).',"aaData":  '.$ret.'}';
