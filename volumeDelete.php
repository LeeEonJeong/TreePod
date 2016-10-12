
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
include_once('sessionPush.php');
//var_dump_enter($_POST);

$URL = "https://api.ucloudbiz.olleh.com/server/v1/client/api?";
$cmdArr = array(
  "command" => "deleteVolume",
  "id" => $_POST['id'],
  "apikey" => API_KEY
);
var_dump_enter($cmdArr);
//exit;
$result = callCommand($URL, $cmdArr, SECERET_KEY);
//var_dump_enter($result);

set_time_limit(6000);
if($reulst['success']=="true"){
	echo "<script>location.replace('listVolume.php');</script>";
} else {
	echo "<script>alert('오류가 발생했습니다.');location.replace('listVolume.php');</script>";
}
?>
</body>
</html>