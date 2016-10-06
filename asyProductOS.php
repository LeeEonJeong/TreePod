<?php
include('sessionPush.php');
include('api_constants.php');
include ('./callAPI.php');
include('var_dump_enter.php');

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
    echo $type[$i]."<option>";
  }
?>
