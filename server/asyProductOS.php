<?php
$server_root_path = $_SERVER['DOCUMENT_ROOT'];// ini_set('include_path',$server_root_path);
include_once($server_root_path.'/includeFiles.php');
include_once($server_root_path.'/'.CLOUD_PATH.'pageInclude/ajaxCalledPageInclude.php');
?>
<?php
/*
include('/'.CLOUD_PATH.'include/sessionPush.php');
include_once('/'.CLOUD_PATH.'include/api_constants.php');
include_once('/'.CLOUD_PATH.'include/callAPI.php'); 
include_once('/'.CLOUD_PATH.'include/var_dump_enter.php');
*/
//var_dump_enter($_POST);
  $cmdArr2 = array(
    "command" => "listAvailableProductTypes",
    "zoneid" => $_POST['zoneid'],
    "apikey"  => API_KEY
  );
   $URL = "https://api.ucloudbiz.olleh.com/server/v1/client/api?";
  $result2 = callCommand($URL, $cmdArr2, SECERET_KEY);
  $type =array();
//  var_dump_enter($result2);
  for($i=0; $i<(int)$result2['count']; $i++){
    if($result2['producttypes'][$i]['product'] != $_POST['product']){
      continue;
    }
    if(in_array($result2['producttypes'][$i]['templatedesc'],$type)){
      continue;
    }else if(is_string($result2['producttypes'][$i]['templatedesc'])){
      array_push($type,$result2['producttypes'][$i]['templatedesc']);
      array_push($type,$result2['producttypes'][$i]['templateid']);
    }
  }
  for($i = 0; $i < count($type); $i++){
    echo "<option>".$type[$i];
  }
?>
