<?php @session_start(); ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8"/>

<link rel="stylesheet" type="text/css" href="design.css">
<link rel="stylesheet" type="text/css" href="menu_design.css">
<link rel="stylesheet" type="text/css" href="alert_bar_design.css">
<script>
	var loca = function(){
		location.replace('listNas.php');
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
//exit;
$URL = "https://api.ucloudbiz.olleh.com/server/v1/client/api?";
//$URL_NAS = "https://api.ucloudbiz.olleh.com/nas/v1/client/api?";
$cmdArr = array(
  "command" => "removeNicFromVirtualMachine",
  "nicid" => $_POST['nicid'],
  "virtualmachineid" => $_POST['virtualmachineid'],
  "apikey" => API_KEY
);
//var_dump_enter($cmdArr);

//exit;

$result = callCommand($URL, $cmdArr, SECERET_KEY);
set_time_limit(6000);
//var_dump_enter($result);

if(session_push('processID',$result['jobid'])){
	echo "<script>Confirm.render('NAS','서버와의 연결 끊기 신청이 완료되었습니다.',loca,'','no')</script>";

} else {
	echo "<script>Confirm.render('NAS','오류가 발생했습니다!',err_info,'','no')</script>";
//		echo "<script>history.back(); </script>";
}

// session_push('processID',$result['jobid']);
// echo "<script>location.replace('listNas.php');</script>";

?>
<script src="asy.js">
</script>
<?php
    
?>

</body>
</html>