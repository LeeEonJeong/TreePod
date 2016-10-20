<?php
include('sessionPush.php');
include('api_constants.php');
include ('./callAPI.php');
include('var_dump_enter.php');

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
