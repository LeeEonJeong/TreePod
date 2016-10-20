
<!DOCTYPE>
<html>
<head>

<meta charset="utf-8"/>

<script>
	var loca = function(){
		location.replace('listFireWallRules.php');
	}
	var err_info = function(){
		history.back();
	}
</script>
</head><body>
<?php
include_once('sessionPush.php');
include_once('api_constants.php');
include_once('./callAPI.php');
include_once('var_dump_enter.php');
include_once('customAlert.html');
//  var_dump_enter($_POST);

 $cmdArr = array (
    "command" => "createFirewallRule",
    "ipaddressid" => $_POST['ipaddressid'],
    "startport" => $_POST['startport'],
    "protocol" =>  $_POST['protocol'],
    "apikey" => API_KEY
 );
 if($_POST['endport'] == "") {
 	$cmdArr['endport'] = $_POST['startport'];
 }
 if($_POST['cidrlist'] != "") {
 	$cmdArr['cidrlist'] = $_POST['cidrlist'];
 }

// var_dump_enter($cmdArr);

 $URL = "https://api.ucloudbiz.olleh.com/server/v1/client/api?";
 set_time_limit(600);

 $result = callCommand($URL, $cmdArr, SECERET_KEY);
// var_dump_enter($result);

?>



<script src="asy.js"></script>
<?php
if(session_push('processID',$result['jobid'])){
	echo "<script>Confirm.render('FireWalls','신청이 완료 되었습니다',loca,'','no')</script>";
//	echo "<script>alert('방화벽 삭제 신청이 완료 되었습니다.')</script>";
//	echo "<script></script>";
} else {
	echo "<script>Confirm.render('FireWalls','오류가 발생했습니다!',err_info,'','no')</script>";
//		echo "<script>history.back(); </script>";
}
?>
</body>
</html>