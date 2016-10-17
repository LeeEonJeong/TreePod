<?php
@session_start();
include_once('api_constants.php');

if($_POST['id']==ID && $_POST['pw']==PW){
	$_SESSION['ID'] = ID;
	echo "<script>location.replace('index.php')</script>";
}

?>