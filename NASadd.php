
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
  "totalsize" => $_POST['totalsize'], // 고쳐야함!!
  "volumetype" => $_POST['volumetype'],
  "usageplantype" =>  $_POST['usageplantype'],
  "networkid" => $_POST['networkid'],//"75852ff8-ab87-4652-8128-afd3b9bdbc58",
  "apikey" => API_KEY
);
var_dump_enter($cmdArr);
//exit;
$result = callCommand($URL_NAS, $cmdArr, SECERET_KEY);
set_time_limit(6000);
var_dump_enter($result);
exit;
/*
sleep(30);

$jobId = $result["jobid"];
echo $jobId;
if(session_push('processID',$result['jobid'])==true)*/

  echo "<script>location.replace('listNas.php');</script>";

?>
<script src="asy.js">
</script>
<?php
    
?>

</body>
</html>