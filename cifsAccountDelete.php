
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8"/>
<script>

	var loca = function(){
  	location.replace('cifsAccount.php');
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
include_once('sessionPush.php');
include_once('customAlert.html');
//var_dump_enter($_POST);

//$URL = "https://api.ucloudbiz.olleh.com/server/v1/client/api?";
$URL_NAS = "https://api.ucloudbiz.olleh.com/nas/v1/client/api?";
$cmdArr = array(
  "command" => "deleteCifsAccount",
  "cifsId" => $_POST['cifsId'],
  "apikey" => API_KEY
);
//var_dump_enter($cmdArr);
//exit;
$result = callCommand($URL_NAS, $cmdArr, SECERET_KEY);
set_time_limit(600);
/*
sleep(30);
*/

if($result['status']=='error') {
  echo "<script>Confirm.render('CIFS Account','".$result['errortext']."',err_info,'','no')</script>";
  exit;
  //echo "<script>location.replace('listNas.php');</script>";
}

echo "<script>Confirm.render('CIFS Account','cifs 계정 삭제가 완료 되었습니다.',loca,'','no')</script>";


    
?>

</body>
</html>