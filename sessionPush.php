<?php
session_start();
function session_push($key, $value){
	 if(!isset($_SESSION[$key])){
        $_SESSION[$key] = array();
      }
     array_push($_SESSION[$key], $value);
}
?>