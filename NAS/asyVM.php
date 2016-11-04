<?php
$server_root_path = $_SERVER['DOCUMENT_ROOT'];// ini_set('include_path',$server_root_path);
include_once($server_root_path.'/includeFiles.php');
include_once($server_root_path.'/'.CLOUD_PATH.'pageInclude/ajaxCalledPageInclude.php');
/*
//include_once('/'.CLOUD_PATH.'include/sessionPush.php');     // sessionPush.php
include_once('/'.CLOUD_PATH.'include/api_constants.php');   // api_constnats.php  
include_once('/'.CLOUD_PATH.'include/callAPI.php');     // callAPI.php  
*/

//var_dump_enter($_POST);
  $cmdArr2 = array(
    "command" => "listVirtualMachines",
    "zoneid" => $_POST['zoneid'],
    "apikey"  => API_KEY
  );
   $URL = "https://api.ucloudbiz.olleh.com/server/v1/client/api?";
 // var_dump_enter($cmdArr2);
  $result = callCommand($URL, $cmdArr2, SECERET_KEY);
  //var_dump($result);
  $type =array();
  if(isset($result['count']) != true) exit;
  $result_num = $result['count'];
  $result = $result['virtualmachine'];
//var_dump_enter($result['1']);

  for($i=0; $i<$result_num; $i++){
    if((int)$result_num == 1 ) {
      $temp = $result;
    }else {
      $temp = $result[$i];
    }
    if($temp['zoneid'] == $_POST['zoneid']) {
      array_push($type,$temp['displayname']);
      array_push($type,$temp['id']);
    }
  }
  for($i = 0; $i < count($type); $i++){
    echo $type[$i]."<option>";
  }
  
?>
