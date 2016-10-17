
<!DOCTYPE>
<html>
<head>

<meta charset="utf-8"/>
</head><body>
<?php
include_once('api_constants.php');
include_once('./callAPI.php');
include_once('var_dump_enter.php');
//  var_dump_enter($_POST);

 $cmdArr = array (
    "command" => "updateVolume",
    "id" => $_POST['id'],
    "totalsize" => $_POST['totalsize'],
    "apikey" => API_KEY
 );
 var_dump_enter($cmdArr);
//exit;
$URL_NAS ="https://api.ucloudbiz.olleh.com/nas/v1/client/api?";
 set_time_limit(600);

 $result = callCommand($URL_NAS, $cmdArr, SECERET_KEY);
 var_dump_enter($result);
 if(isset($result['jobid'])) {
 	if($result['jobid']=="ERROR"){
 		echo "<script>alert('에러 발생');history.go(-1);</script>";
 		exit;
 	}
 }
 //exit;
 echo "<script>location.replace('listNas.php');</script>";

//exit;
?>


<?php
?>
</body>

</html>