<!DOCTYPE>
<html>
<head>
</head><body>
<?php

include('api_constants.php');
include ('./callAPI.php');
include('var_dump_enter.php');
  var_dump_enter($_POST);
 $cmdArr = array (
    "command" => "createPortForwardingRule",
    "ipaddressid" => $_POST['ipaddressid'],
    "privateport" => $_POST['privateport'],
    "protocol" => 'TCP',
    "publicport" => $_POST['publicport'],
    "virtualmachineid" => $_POST['virtualmachineid'],
    "apikey" => API_KEY
 );
 var_dump_enter($cmdArr);
 $URL = "https://api.ucloudbiz.olleh.com/server/v1/client/api?";
 $result = callCommand($URL, $cmdArr, SECERET_KEY);
 var_dump_enter($result);
?>
<a href="index.php">홈으로 가기</a>
</body>
</html>