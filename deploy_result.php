
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8"/>

<link rel="stylesheet" type="text/css" href="design.css">
<link rel="stylesheet" type="text/css" href="menu_design.css">
<link rel="stylesheet" type="text/css" href="alert_bar_design.css">
<script>
	var loca = function(){
		location.replace('myServer.php');
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

$URL = "https://api.ucloudbiz.olleh.com/server/v1/client/api?";
$cmdArr = array(
  "command" => "deployVirtualMachine",
  "serviceofferingid" => $_POST['serviceofferingid'],
  "templateid" => $_POST['templateid'],
  "zoneid" => $_POST['zoneid'],
  "displayname" => $_POST['displayname'],
  "usageplantype" =>  $_POST['usageplantype'],
  "apikey" => API_KEY
);
if ($_POST['diskofferingid'] != "rootonly"){
  $cmdArr["diskofferingid"] = $_POST['diskofferingid'];
}
//var_dump_enter($cmdArr);
//exit;
set_time_limit(60000);

$result = callCommand($URL, $cmdArr, SECERET_KEY);
/*
sleep(30);
*/
$jobId = $result["jobid"];
echo $jobId;
if(session_push('processID',$result['jobid'])==true){
	echo "<script>Confirm.render('Server','신청이 완료 되었습니다',loca,'','no')</script>";
//  echo "<script>location.replace('myServer.php');</script>";
} else {
	echo "<script>Confirm.render('Server','오류가 발생했습니다!',err_info,'','no')</script>";
}

?>
<script src="asy.js">
</script>
<?php
    
?>

</body>
</html>