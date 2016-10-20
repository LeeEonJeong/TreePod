
<!DOCTYPE>
<html>
<head>

<meta charset="utf-8"/>
<script>
	var loca = function(){
		location.replace('listNas.php');
	}
	var err_info = function(){
		history.back();
	}
</script>
<meta charset="utf-8"/>
</head><body>
<?php
include_once('api_constants.php');
include_once('./callAPI.php');
include_once('var_dump_enter.php');
include_once('customAlert.html');
//  var_dump_enter($_POST);

 $cmdArr = array (
    "command" => "deleteVolume",
    "id" => $_POST['id'],
    "apikey" => API_KEY
 );
 var_dump_enter($cmdArr);
//exit;
$URL_NAS ="https://api.ucloudbiz.olleh.com/nas/v1/client/api?";
 set_time_limit(600);

 $result = callCommand($URL_NAS, $cmdArr, SECERET_KEY);
 var_dump_enter($result);
//exit;
 if(isset($result['jobid'])) {
 	if($result['jobid']=="ERROR"){
 		echo "<script>Confirm.render('NAS','오류가 발생했습니다!',err_info,'','no');</script>";
 		exit;
 	}
 }
 //exit;
echo "<script>Confirm.render('NAS','삭제 신청이 완료 되었습니다',loca,'','no')</script>";
// echo "<script>location.replace('listNas.php');</script>";

//exit;
//exit;
?>


<?php
?>
</body>

</html>