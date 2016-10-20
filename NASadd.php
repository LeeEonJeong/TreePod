
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8"/>

<link rel="stylesheet" type="text/css" href="design.css">
<link rel="stylesheet" type="text/css" href="menu_design.css">
<link rel="stylesheet" type="text/css" href="alert_bar_design.css">
</head>
<body>
<?php
include_once('api_constants.php');
include_once('./callAPI.php');
include_once('var_dump_enter.php');
include_once('customAlert.html');
//var_dump_enter($_POST);

//$URL = "https://api.ucloudbiz.olleh.com/server/v1/client/api?";
$URL_NAS = "https://api.ucloudbiz.olleh.com/nas/v1/client/api?";
if($_POST['totalsize']==""){
	$_POST['totalsize'] = '1000';
} else {
	$_POST['totalsize'] = (int)$_POST['totalsize'] + 1000;
}
$cmdArr = array(
  "command" => "addVolume",
  "name" => $_POST['name'],
  "path" => $_POST['path'],
  "zoneid" => $_POST['zoneid'],
  "totalsize" => $_POST['totalsize'], 
  "volumetype" => $_POST['volumetype'],
  "usageplantype" =>  $_POST['usageplantype'],
  "apikey" => API_KEY
);
//var_dump_enter($cmdArr);

//exit;

$result = callCommand($URL_NAS, $cmdArr, SECERET_KEY);
set_time_limit(6000);
//var_dump_enter($result);
//exit;

  //echo "<script>location.replace('listNas.php');</script>";

?>
<form id='attach_form' action='NASAttach.php' method='post'>
  <input type='hidden' name='virtualmachineid' value='<?=$_POST['virtualmachineid']?>'/>
  <input type='hidden' name='networkid' value='<?=$result['response']['networkid']?>'/>
</form>
<script>
Alert.render('NAS 서버 연결','서버와의 연결을 진행중 입니다.<br> 잠시만 기다려 주십시요....','');
document.getElementById('attach_form').submit();
</script>


</body>
</html>