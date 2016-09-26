<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8"/>

</head>
<body>
<?php
include('api_constants.php');
include ('./callAPI.php');
include('var_dump_enter.php');
var_dump_enter($_POST);

$URL = "https://api.ucloudbiz.olleh.com/server/v1/client/api?";
if ($_POST['diskofferingid']=="rootonly"){
  $listProductcmdArr = array(
    "command" => "deployVirtualMachine",
    "serviceofferingid" => $_POST['serviceofferingid'],
    "templateid" => $_POST['templateid'],
//    "diskofferingid" => $_POST['diskofferingid'], 
//    "productcode" => $_POST['productid'],
    "zoneid" => $_POST['zoneid'],
    "displayname" => "jjkserver2",
    "usageplantype" => "hourly",
    "apikey" => API_KEY
  );

} else {
  $listProductcmdArr = array(
    "command" => "deployVirtualMachine",
    "serviceofferingid" => $_POST['serviceofferingid'],
    "templateid" => $_POST['templateid'],
    "diskofferingid" => $_POST['diskofferingid'], 
//    "productcode" => $_POST['productid'],
    "zoneid" => $_POST['zoneid'],
    "displayname" => "jjkserver2",
    "usageplantype" => "hourly",
    "apikey" => API_KEY
  );
}
var_dump_enter($listProductcmdArr);
$result = callCommand($URL, $listProductcmdArr, SECERET_KEY);
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
  $jobStatus = $result2["jobstatus"];
  if ($jobStatus == 2) {
     printf($result2["jobresult"]);
      exit;
  }
} while ($jobStatus != 1);
*/
?>
</body>
</html>