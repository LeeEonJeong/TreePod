
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
  "command" => "createVolume",
  "zoneid" => $_POST['zoneid'],
  "diskofferingid" => $_POST['diskofferingid'],
  "name" => $_POST['name'],
  "usageplantype" =>  $_POST['usageplantype'],
  "apikey" => API_KEY
);
var_dump_enter($cmdArr);
//exit;
$result = callCommand($URL, $cmdArr, SECERET_KEY);
set_time_limit(600);
/*
sleep(30);
*/
$jobId = $result["jobid"];
echo $jobId;
if(session_push('processID',$result['jobid'])==true)
  echo "<script>location.replace('listVolume.php');</script>";
/*
do {
  $cmdArr2 = array(
    "command" => "queryAsyncJobResult",
    "jobid" => $jobId,
    "apikey"  => API_KEY
  );
  $result2 = callCommand($URL, $cmdArr2, SECERET_KEY);
  sleep(5);
  $jobStatus = $result2["jobstatus"];
  if ($jobStatus == 2) {
     printf($result2["jobresult"]);
      exit;
  }
} while ($jobStatus != 1);
*/
?>
<!--<a href="index.php">홈으로 가기</a><br/> -->
<script src="asy.js">
</script>
<?php
    
?>

</body>
</html>