
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8"/>

</head>
<body>
<?php
include_once('api_constants.php');
include_once('./callAPI.php');
include_once('var_dump_enter.php');
include_once('sessionPush.php');
var_dump_enter($_POST);

$URL = "https://api.ucloudbiz.olleh.com/server/v1/client/api?";
$stopcmdArr = array(
    "command" => "resetPasswordForVirtualMachine",
    "id" => $_POST['id'],
    "apikey" => API_KEY
);
var_dump_enter($stopcmdArr);
$seceret_key = SECERET_KEY;
//exit;
$result = callCommand($URL, $stopcmdArr, $seceret_key);
set_time_limit(600);
$jobId = $result["jobid"];
echo $jobId;

if(!isset($result['jobid'])){
  alert("error");
  echo "<script>location.replace('myServer.php');</script>";
}
  session_push('processID',$result['jobid']);
 echo "<script>location.replace('myServer.php');</script>";
?>
</body>
</html>