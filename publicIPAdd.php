<!DOCTYPE>
<html>
<head>
<meta charset="utf-8"/>
</head><body>
<?php
include_once('sessionPush.php');
include_once('api_constants.php');
include_once('./callAPI.php');
include_once('var_dump_enter.php');
//  var_dump_enter($_POST);
//exit;
  if($_POST['zoneid']==""){
  	echo "<script>alert('지역을 다시 설정 해주세요.');history.go(-1); </script>";
  	exit;
  }
  if($_POST['usageplantype']==""){
  	echo "<script>alert('요금제 설정을 다시 설정 해주세요.');history.go(-1); </script>";
  	exit;
  }
 $cmdArr = array (
    "command" => "associateIpAddress",
    "zoneid" => $_POST['zoneid'],
    "usageplantype" => $_POST['usageplantype'],
    "apikey" => API_KEY
 );
// var_dump_enter($cmdArr);
 $URL = "https://api.ucloudbiz.olleh.com/server/v1/client/api?";
//exit;
 $result = callCommand($URL, $cmdArr, SECERET_KEY);
// var_dump_enter($result);
set_time_limit(600);
$jobId = $result["jobid"];
echo $jobId;

?>
<br/>
<script src="asy.js"></script>

<?php
  session_push('processID',$result['jobid']);
    echo "<script>alert('새로운 공인 아이피 신청이 완료 되었습니다.'); location.replace('listPublicIP.php');</script>";
?>
</body>
</html>