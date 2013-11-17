<?php

require_once(dirname(__FILE__)."/../include.php");

$id = $_SESSION["loginInfo"]["id"];
$db = DBSingleton::getInstance();

$ret = $db->dbSelect("subjects", "", "", 0, -1, array(
    "*",
    "(select count(*) from questions where subject=subjects.id) as all_count",
    "(select count(*) from questions where subject=subjects.id and diff_level='Normal') as normal_count",
    "(select count(*) from questions where subject=subjects.id and diff_level='Medium') as med_count",
    "(select count(*) from questions where subject=subjects.id and diff_level='Difficult') as diff_count",
));

if(isset($_REQUEST["chart1"])){
    $ar = array();
    foreach($ret as $row){
        $ar[] = array($row["title"], (int)$row["all_count"]);
    }
    print json_encode(array("l" => array($ar)));
    exit(0);
}

header('Content-Type: application/json');
$rets = arraySelectKeys($ret, array("title", "all_count", "normal_count", "med_count", "diff_count"));
$ret = arrayPHPToJS($rets);
echo '{"sEcho":"2","iTotalRecords":'.count($rets).',"iTotalDisplayRecords":'.count($rets).',"aaData":  '.$ret.'}';
