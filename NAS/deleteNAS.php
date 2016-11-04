<?php
$server_root_path = $_SERVER['DOCUMENT_ROOT'];// ini_set('include_path',$server_root_path);
include_once($server_root_path.'/includeFiles.php');
include_once($server_root_path.'/'.CLOUD_PATH.'pageInclude/nonAsynCommandPageInclude.php');
?>

<!DOCTYPE>
<html>
<head>

<meta charset="utf-8"/>
<script>
	var loca = function(){
		location.replace('listNAS.php');
	}
	var err_info = function(){
		history.back();
	}
</script>
<meta charset="utf-8"/>
</head><body>
<?php
/*
include_once('/'.CLOUD_PATH.'include/api_constants.php');		// api_constnats.php	
include_once('/'.CLOUD_PATH.'include/callAPI.php');			// callAPI.php	
include_once('/'.CLOUD_PATH.'customAlert/customAlert.html');	// customAlert.html
*/
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
 //var_dump_enter($result);
//exit;

if($result['status']=='error') {
  echo "<script>Confirm.render('NAS','".$result['errortext']."',err_info,'','no')</script>";
  exit;
  //echo "<script>location.replace('listNas.php');</script>";
}

echo "<script>Confirm.render('NAS','삭제 신청이 완료 되었습니다.',loca,'','no')</script>";


 /*
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
*/
?>


<?php
?>
</body>

</html>