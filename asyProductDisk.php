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
    if($result2['producttypes'][$i]['templateid'] != $_POST['templateid']){
      continue;
    }
    if($result2['producttypes'][$i]['serviceofferingid'] != $_POST['serviceofferingid']){
      continue;
    }
    if(!isset($result2['producttypes'][$i]['diskofferingid'])){
      continue;
    }
    if(in_array($result2['producttypes'][$i]['diskofferingid'],$type)){
      continue;
    }else if(is_string($result2['producttypes'][$i]['diskofferingid'])){
      array_push($type,$result2['producttypes'][$i]['diskofferingdesc']);
      array_push($type,$result2['producttypes'][$i]['diskofferingid']);
    }
  }
  for($i = 0; $i < count($type); $i++){
    echo $type[$i]."<option>";
  }
  
?>
