<!DOCTYPE>
<html>
<head>
<meta charset="utf-8"/>
<script>
  function portForwarding(num){
  //  alert(document.forms[num]);
    document.forms[num].action = 'portForwardingList.php';
    document.forms[num].method = 'post';
    document.forms[num].submit();
  }
</script>
</head><body>

<?php
include('head.html');
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
 $vm_result = $vm_result['virtualmachine'];?>
 <table>
<tr><td>포트포워딩</td><td>ip번호</td><td>VM</td><td>공용 포트 번호</td><td>내부 포트 번호</td><td>-</td></tr>

<?php 
for($i=0; $i<$num; $i++){ 
   if($num != '1' ) {
     $temp = $result[$i];
  }else {
     $temp = $result;
  }?>
  <tr>
  <form action='portForwarding.php' method='post'>
  <td><input type='button' value='조회' onclick="portForwarding('<?=$i?>')"/></td>
  <td><?= $temp['ipaddress'] ?>
  <input name='ipaddressid' type='hidden' value='<?= $temp['id']?>'/>
  <input name='ipaddress' type='hidden' value='<?= $temp['ipaddress']?>'/>
  </td>
  <td>
  <select name='virtualmachineid'> 
  <?php
    for($j=0; $j<$vm_num; $j++){
       if($vm_num != '1' ) {
          $vm_temp = $vm_result[$j];
        }else {
          $vm_temp = $vm_result;
        }
      if($temp['zoneid'] == $vm_temp['zoneid'])
        echo "<option  value='".$vm_temp['id']."'>".$vm_temp['displayname']."</option>";
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