<?php @session_start(); ?>
<?php
$server_root_path = $_SERVER['DOCUMENT_ROOT'];// ini_set('include_path',$server_root_path);
include_once($server_root_path.'/includeFiles.php');
include_once($server_root_path.'/'.CLOUD_PATH.'include/api_constants.php');
include_once($server_root_path.'/'.CLOUD_PATH.'customAlert/customAlert.html');
?>
<script>
	var loca = function(){
		location.replace('login_notice.php');
	}	
	
	Alert.render('Log In','잠시만 기다려 주세요...','');
</script>
<?php
//var_dump($_POST);
if($_POST['id']!=ID){
	echo "<script>Confirm.render('Log In','존재하지 않는 ID 입니다.',loca,'','no')</script>";
	exit;
}
if($_POST['pw']!=PW){
	echo "<script>Confirm.render('Log In','비밀번호를 다시 확인해 주세요.',loca,'','no')</script>";
	exit;
}
if($_POST['id']==ID && $_POST['pw']==PW){
	$_SESSION['ID'] = ID;
	echo "<script>location.replace('index.php')</script>";
}

?>