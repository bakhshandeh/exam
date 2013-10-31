<?php

define("UPLOADS_PATH", dirname(__FILE__)."/../../../uploads/");

function quote($var){

    if(is_array($var))
	return array_map("quote", $var);


    return "'{$var}'";
}

function redirect($url){
    header("Location: {$url}");
    exit(0);
}

function checkLogin(){
    if(isset($_SESSION["loginInfo"])){
	return true;
    }
    header("Location: index.php");
    exit(0);
}

function isLoggedIn(){
    if(isset($_SESSION["loginInfo"])){
	return true;
    }
    
    return false;
}

function uploadFile($f){
    $fileName = rand(0, 1000000000)."_".$f["name"];
    $tmpName = $f["tmp_name"];
    if(!move_uploaded_file($tmpName, UPLOADS_PATH."/".$fileName)){
	throw new Exception("Can not upload the file!");
    }
    return $fileName;
}

function is_assoc($array) {
        foreach ( array_keys ( $array ) as $k => $v ) {
            if ($k !== $v)
                return true;
        }
        return false;
} 

function arrayPHPToJS($phpArray) { 
    if (is_null($phpArray)) return 'null'; 
    if (is_string($phpArray)) return "\"" . $phpArray . "\""; 
    if (is_assoc($phpArray)) { 
        $a=array(); 
        foreach ($phpArray as $key => $val ) 
            $a[]=arrayPHPtoJS($val); 
        return "[" . implode ( ', ', $a ) . "]"; 
    } 
    if (is_array($phpArray)) { 
        $a=array(); 
        foreach ($phpArray as $val ) 
            $a[]=arrayPHPtoJS($val); 
        return "[" . implode ( ', ', $a ) . "]"; 
    } 
    return json_encode($phpArray); 
}

function addRowNumbers($rows){
    $i = 1;
    foreach($rows as &$row){
        $row["row"] = $i;
        $i+=1;
    }
    return $rows;
}

function arraySelectKeys($arr, $keys){
    $ret = array();
    foreach($arr as $e){
        $tmp = array();
        foreach($keys as $k){
            $tmp[$k] = $e[$k];
        }
        $ret[] = $tmp;
    }
    return $ret;
}

function loadStudent($id){
    $db = DBSingleton::getInstance();
    $ret = $db->dbSelect("students", "id={$id}");
    return $ret[0];
}

function notNull($fields){
    if(!is_array($fields)){
        $fields = array($fields);
    }
    
    foreach($fields as $f){
        $val = trim($_REQUEST[$f]);
        if(!strlen($val)){
            print "Empty Field: please insert the '{$f}'";
            exit(0);
        }
    }
}

function checkDuplicates($fs){
    $db = DBSingleton::getInstance();
    foreach($fs as $k => $v){
        list($tableName, $col) = explode(".", $k);
        $ret = $db->dbSelect($tableName, "{$col}=".quote($_REQUEST[$col]));
        if(count($ret)){
            print $v;exit(0);
        }
    }
}

function checkDuplicate($tableName, $cond, $msg){
    $db = DBSingleton::getInstance();
    $ret = $db->dbSelect($tableName, $cond);
    if(count($ret)){
        print $msg;exit(0);
    }
}
?>
