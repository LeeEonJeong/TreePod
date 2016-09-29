<?php session_start();?>
<!DOCTYPE>
<html>
<head>
<meta charset="utf-8"/>
</head><body>
<?php
include('head.html');
include('api_constants.php');
include ('./callAPI.php');
include('var_dump_enter.php');
//  var_dump_enter($_POST);
 $cmdArr = array (
    "command" => "deletePortForwardingRule",
    "id" => $_POST['id'],
    "apikey" => API_KEY
 );
// var_dump_enter($cmdArr);
 $URL = "https://api.ucloudbiz.olleh.com/server/v1/client/api?";
 $result = callCommand($URL, $cmdArr, SECERET_KEY);
 var_dump_enter($result);
sleep(1);
$jobId = $result["jobid"];
echo $jobId;
/*
do {
  $cmdArr2 = array(
    "command" => "queryAsyncJobResult",
    "jobid" => $jobId,
    "apikey"  => API_KEY
  );
  $result2 = callCommand($URL, $cmdArr2, SECERET_KEY);
  
  sleep(5);
  var_dump_enter($result2);
  $jobStatus = $result2["jobstatus"];
  if ($jobStatus == 2) {
     printf($result2["jobresult"]);
      exit;
  }
  set_time_limit(10);
} while ($jobStatus != 1);
*/
?>
<br/>
<!--<input type="button" id="execute" value="execute" onclick="stopInterval()"/> -->
<script src="asy.js"></script>
<script>
  test('<?= $result['jobid']?>');
  timeid = setInterval("test('<?= $result['jobid']?>')", 4000);
</script>
<?php
 //  echo "ㅅㅂ";var_dump($_SESSION['processID']);
   if(!isset($_SESSION['processID'])){
      $_SESSION['processID'] = array();
   }
    array_push($_SESSION['processID'], $result['jobid']);
    echo end($_SESSION['processID']);
?>
<a href="listPulbicIP.php">내 공인 IP 보기</a>
<a href="index.php">홈으로 가기</a>
</body>
</html>