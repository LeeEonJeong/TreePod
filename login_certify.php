<?php
@session_start();
$server_root_path = $_SERVER['DOCUMENT_ROOT'];// ini_set('include_path',$server_root_path);

include_once($server_root_path.'/includeFiles.php');

include_once($server_root_path.'/'.CLOUD_PATH.'include/api_constants.php');

	if(!isset($_SESSION['ID'])) {
		 echo("<script>location.replace('login_notice.php');</script>");
		 exit;
	}
	if($_SESSION['ID']!=ID){
		 echo("<script>location.replace('sessionDestroy.php');</script>");
		 exit;
	}

?>