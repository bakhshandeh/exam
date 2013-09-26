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
?>
