
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8"/>
<script src='cifs.js'>

</script>
<style>

</style>

</head>
<body>
<<?php
$server_root_path = $_SERVER['DOCUMENT_ROOT']; //ini_set('include_path',$server_root_path);
include_once($server_root_path.'/includeFiles.php');
include_once($server_root_path.'/'.CLOUD_PATH.'pageInclude/nonAsynCommandPageInclude.php');

/*
include_once('/'.CLOUD_PATH.'include/head2.php');     // head2.php  
include_once('/'.CLOUD_PATH.'include/callAPI.php');     // callAPI.php  
*/
$URL = "https://api.ucloudbiz.olleh.com/server/v1/client/api?";
$URL_NAS = "https://api.ucloudbiz.olleh.com/nas/v1/client/api?";
$cmdArr = array(
  "command" => "listAccounts",
  "apikey" => API_KEY
);

//var_dump_enter($result);
$result = callCommand($URL, $cmdArr, SECERET_KEY);
$result_count;
if(isset($result['count']) == false){
  $result_count = 0;
}else {
  $result_count = $result['count'];
}

$account_id='';
$temp;
for( $i=0; $i<$result_count; $i++){
  if($result['count']==1){
    $temp = $result['account'];
  } else {
    $temp = $result['account'][$i];
  }
  if($temp['user']['apikey']==API_KEY){
    $account_id = $temp['user']['accountid'];
    break;
  }
}



$cmdArr = array(
  "command" => "addAccountForNas",
  "accountid" => $account_id,
  "cifsworkgroup" => "WORKGROUP",
  "apikey" => API_KEY
);

//var_dump_enter($cmdArr);
//exit;
$result = callCommandJSON($URL_NAS, $cmdArr, SECERET_KEY);

//var_dump_enter($result);
echo "<script>location.replace('cifsAccount.php');</script>"

?>


</body>


</html>
