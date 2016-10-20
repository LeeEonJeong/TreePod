<?php
@session_start();
function session_push($key, $value){
	if($value == "ERROR"){
	//	echo "<script>alert('오류가 발생하였습니다.');</script>";
	//	echo "<script>history.back();</script>"; //디버깅 할때만 주석 달아놓음 
		return false;
	}
	if(!isset($_SESSION[$key])){
       $_SESSION[$key] = array();
    }
    array_push($_SESSION[$key], $value);
    return true;
}
//아래는 test용/
function session_push2($key, $value){
//	echo "<script>alert('".$value."');</script>";
	if($value == "ERROR"){
		echo"<script>alert('오류가 발생하였습니다.');</script>";
		return false;
	}/*
	 if(!isset($_SESSION[$key])){
        $_SESSION[$key] = array();
      }
     array_push($_SESSION[$key], $value);
     return true; */
}
?>