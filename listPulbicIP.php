<!DOCTYPE>
<html>
<head>
<meta charset="utf-8"/>
</head><body>
<table>
<tr><td>ip번호</td><td>VM</td><td>공용 포트 번호</td><td>내부 포트 번호</td><td>-</td></tr>
<?php

include('api_constants.php');
include ('./callAPI.php');
include('var_dump_enter.php');
 $cmdArr = array (
    "command" => "listPublicIpAddresses",
    "apikey" => API_KEY
 );
// var_dump_enter($cmdArr);
 $URL = "https://api.ucloudbiz.olleh.com/server/v1/client/api?";
 $result = callCommand($URL, $cmdArr, SECERET_KEY);
 //var_dump_enter($result);
 $num = $result['count'];
 $result = $result['publicipaddress'];
 
 $listProductcmdArr = array(
    "command" => "listVirtualMachines",
    "apikey" => API_KEY
);
// var_dump_enter($listProductcmdArr);
 $vm_result = callCommand($URL, $listProductcmdArr, SECERET_KEY);
// var_dump_enter($vm_result);
 $vm_num = $vm_result['count'];
 $vm_result = $vm_result['virtualmachine'];
 
 for($i=0; $i<$num; $i++){ ?>
  <tr>
  <form action='portForwarding.php' method='post'>
  <td><?= $result[$i]['ipaddress'] ?>
  <input name='ipaddressid' type='hidden' value='<?= $result[$i]['id']?>'/>
  </td>
  <td>
  <select name='virtualmachineid'> 
  <?php
    for($j=0; $j<$vm_num; $j++){
      if($result[$i]['zoneid'] == $vm_result[$j]['zoneid'])
        echo "<option  value='".$vm_result[$j]['id']."'>".$vm_result[$j]['displayname']."</option>";
      }
  ?>
  </select>
  </td>
  <td><input type='number' name='publicport'/></td>
  <td><input type='number' name='privateport'/></td>
  <td><input type='submit' value='등록'/></td>
  </form>
  </tr>
 <?php  
 }
?>
</table>
<a href="index.php">홈으로 가기</a>
</body>
</html>