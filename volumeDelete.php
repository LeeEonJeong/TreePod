
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8"/>
<script>
	var loca = function(){
		location.replace('listVolume.php');
	}
	var err_info = function(){
		history.back();
	}
</script>
</head>
<body>
<?php
include_once('api_constants.php');
include_once('./callAPI.php');
include_once('var_dump_enter.php');
include_once('customAlert.html');
//include_once('sessionPush.php');
//var_dump_enter($_POST);

$URL = "https://api.ucloudbiz.olleh.com/server/v1/client/api?";
$cmdArr = array(
  "command" => "deleteVolume",
  "id" => $_POST['id'],
  "apikey" => API_KEY
);
//var_dump_enter($cmdArr);
//exit;
$result = callCommand($URL, $cmdArr, SECERET_KEY);
//var_dump_enter($result);

set_time_limit(6000);
if($result['success']=="true"){
	echo "<script>Confirm.render('Volume','삭제 신청이 완료 되었습니다',loca,'','no')</script>";
//	echo "<script>location.replace('listVolume.php');</script>";
} else {
	echo "<script>Confirm.render('Volume','오류가 발생했습니다!',err_info,'','no')</script>";
//	echo "<script>alert('오류가 발생했습니다.');location.replace('listVolume.php');</script>";
}
?>
</body>
</html>