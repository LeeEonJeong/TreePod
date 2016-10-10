
<?php
include_once('api_constants.php');
include_once('./callAPI.php');
include_once('var_dump_enter.php');
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


<tr class="background_gray"><td><b>IP주소</b></td><td><b>VM</b></td><td><b>공용 포트 번호 시작/끝</b></td><td><b>내부 포트 번호 시작/끝</b></td><td><b>추가하기</b></td></tr>

<?php 
$temp;
for($i=0; $i<$num; $i++){ 
   if($num != '1' ) {
     $temp = $result[$i];
  }else {
     $temp = $result;
  }
  if($temp['ipaddress']==$_POST['ipaddress']){
    break;
  }
}?>
  <tr>
 
  <td style="width: 25%"><?= $_POST['ipaddress']?>
  </td>
  <td style="width: 15%">
  <select id='virtualmachineid'> 
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
  <td style="width: 25%"><input class="transparent_half" type='number' id='publicport' value='' />/<input class="transparent_half" type='number' id='publicendport' value='' /></td>
  <td style="width: 25%"><input class="transparent_half" type='number' id='privateport' value='' />/<input class="transparent_half" type='number' id='privateendport' value='' /></td>
  <td style="width: 10%">
   <form id='addPortForm' action='portForwarding.php' method='post'>

  <input name='ipaddressid' type='hidden' value='<?= $temp['id']?>'/>
  <input name='ipaddress' type='hidden' value='<?= $temp['ipaddress']?>'/>
  <input name='virtualmachineid' type='hidden' value=''/>
    <input type='hidden' name='publicport' value=''/>
    <input type='hidden' name='privateport' value=''/>
    <input type='hidden' name='publicendport' value=''/>
    <input type='hidden' name='privateendport' value=''/>
    <input type='button' class='button2' value='등록' onclick="addPorForwardingRules()"/>
  </form>
  </td>
  </tr>

