<?php
@session_start();
$server_root_path = $_SERVER['DOCUMENT_ROOT']; //ini_set('include_path',$server_root_path);
include_once($server_root_path.'/includeFiles.php');
include_once($server_root_path.'/'.CLOUD_PATH.'pageInclude/asynCommandPageInclude.php');
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8"/>

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
include_once('/'.CLOUD_PATH.'include/sessionPush.php');
include_once('/'.CLOUD_PATH.'include/api_constants.php');
include_once('/'.CLOUD_PATH.'include/callAPI.php'); 
include_once('/'.CLOUD_PATH.'customAlert/customAlert.html');	// customAlert.html	

//var_dump_enter($_POST);

$URL = "https://api.ucloudbiz.olleh.com/server/v1/client/api?";
$stopcmdArr = array(
    "command" => "rebootVirtualMachine",
    "id" => $_POST['id'],
    "apikey" => API_KEY
);
//var_dump_enter($stopcmdArr);
$seceret_key = SECERET_KEY;
//exit;
$result = callCommand($URL, $stopcmdArr, $seceret_key);
set_time_limit(600);
$jobId = $result["jobid"];
//echo $jobId;



if(session_push('processID',$result['jobid'])){
	echo "<script>Confirm.render('VM','재시작 신청이 완료 되었습니다',loca,'','no')</script>";
} else {
	echo "<script>Confirm.render(VM,'오류가 발생했습니다!',err_info,'','no')</script>";
}

/*
if(!isset($result['jobid'])){
  alert("error");
  echo "<script>location.replace('myServer.php');</script>";
}
  session_push('processID',$result['jobid']);
 echo "<script>location.replace('myServer.php');</script>";
*/
 ?>
</body>
</html>