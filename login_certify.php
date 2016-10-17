<?php
@session_start();
include_once('api_constants.php');

	if(!isset($_SESSION['ID'])) {
		 echo("<script>location.replace('login_notice.php');</script>");
	}
	if($_SESSION['ID']!=ID){
		 echo("<script>location.replace('sessionDestroy.php');</script>");
	}

?>