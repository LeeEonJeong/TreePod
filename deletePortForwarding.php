
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
 // var_dump_enter($_POST);
 $cmdArr = array (
    "command" => "deletePortForwardingRule",
    "id" => $_POST['id'],
    "apikey" => API_KEY
 );
// var_dump_enter($cmdArr);
 $URL = "https://api.ucloudbiz.olleh.com/server/v1/client/api?";
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
    echo "<script>alert('포트포워딩 삭제 신청이 완료 되었습니다.'); location.replace('listPublicIP.php');</script>";
?>
</body>
</html>