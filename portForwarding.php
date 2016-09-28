
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
    "command" => "createPortForwardingRule",
    "ipaddressid" => $_POST['ipaddressid'],
    "privateport" => $_POST['privateport'],
    "protocol" => 'TCP',
    "publicport" => $_POST['publicport'],
    "virtualmachineid" => $_POST['virtualmachineid'],
    "apikey" => API_KEY
 );
// var_dump_enter($cmdArr);
 $URL = "https://api.ucloudbiz.olleh.com/server/v1/client/api?";
 $result = callCommand($URL, $cmdArr, SECERET_KEY);
// var_dump_enter($result);

//비동기화 하는 부분.
// sleep(1);
// $result["jobid"];
//echo "<br/>";
//echo $result["jobid"];
?>


<input type="button" id="execute" value="execute" onclick="test('<?=$result['jobid']?>')"/>
<script src="asy.js"></script>
<a href="listPulbicIP.php">내 공인 IP 보기</a>
<a href="index.php">홈으로 가기</a>
</body>

</html>