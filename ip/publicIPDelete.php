<?php
@session_start();
$server_root_path = $_SERVER['DOCUMENT_ROOT']; //ini_set('include_path',$server_root_path);
include_once($server_root_path.'/includeFiles.php');
include_once($server_root_path.'/'.CLOUD_PATH.'pageInclude/asynCommandPageInclude.php');
?>
<!DOCTYPE>
<html>
<head>
<meta charset="utf-8"/>
<script>
	var loca = function(){
		location.replace('listPublicIP.php');
	}
	var err_info = function(){
		history.back();
	}
</script>
</head><body>
<?php
/*
include_once('/'.CLOUD_PATH.'include/sessionPush.php');			// sessionPush.php
include_once('/'.CLOUD_PATH.'include/api_constants.php');		// api_constnats.php	
include_once('/'.CLOUD_PATH.'include/callAPI.php');			// callAPI.php	
include_once('/'.CLOUD_PATH.'customAlert/customAlert.html');	// customAlert.html
*/ // var_dump_enter($_POST);


 $cmdArr = array (
    "command" => "disassociateIpAddress",
    "id" => $_POST['ipaddressid'],
    "apikey" => API_KEY
 );
// var_dump_enter($cmdArr);
 $URL = "https://api.ucloudbiz.olleh.com/server/v1/client/api?";
//exit;
 $result = callCommand($URL, $cmdArr, SECERET_KEY);
// var_dump_enter($result);
set_time_limit(600);
$jobId = $result["jobid"];
//echo $jobId;

?>
<br/>
<script src="asy.js"></script>

<?php
if(session_push('processID',$result['jobid'])){
	echo "<script>Confirm.render('IP','해지 신청이 완료 되었습니다',loca,'','no')</script>";
//	echo "<script>alert('방화벽 삭제 신청이 완료 되었습니다.')</script>";
//	echo "<script></script>";
} else {
	echo "<script>Confirm.render('IP','오류가 발생했습니다!',err_info,'','no')</script>";
//		echo "<script>history.back(); </script>";
}
/*
  session_push('processID',$result['jobid']);
    echo "<script>alert('공인 아이피 해지 신청이 완료 되었습니다.'); location.replace('listPublicIP.php');</script>";
*/
?>
</body>
</html>