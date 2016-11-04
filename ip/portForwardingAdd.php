<?php
$server_root_path = $_SERVER['DOCUMENT_ROOT']; //ini_set('include_path',$server_root_path);
include_once($server_root_path.'/includeFiles.php');
include_once($server_root_path.'/'.CLOUD_PATH.'pageInclude/ajaxCalledPageInclude.php');
/*
include_once('/'.CLOUD_PATH.'include/api_constants.php');   // api_constnats.php  
include_once('/'.CLOUD_PATH.'include/callAPI.php');     // callAPI.php  
*/
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


<tr class="background_gray">
  <td style="width: 13%"><b>IP주소</b></td>
  <td style="width: 13%"><b>VM</b></td>
  <td style="width: 10%"><b>프로토콜</b></td>
  <td style="width: 18%"><b>공용 포트 번호<br></b>시작/끝</td>
  <td style="width: 18%"><b>내부 포트 번호<br></b>시작/끝</td>
  <td style="width: 18%"><b>방화벽 여부</b></td>
  <td style="width: 10%"><b>추가하기</b></td></tr>

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
 
  <td ><?= $_POST['ipaddress']?>
  </td>
  <td >
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
  <td >
    <select id="protocol">
      <option value='TCP'>TCP</option>
      <option value='UDP'>UDP</option>
    </select>
  </td>
  <td ><input class="transparent_half" type='number' id='publicport' value='' />/<input class="transparent_half" type='number' id='publicendport' value='' /></td>
  <td ><input class="transparent_half" type='number' id='privateport' value='' />/<input class="transparent_half" type='number' id='privateendport' value='' /></td>
  <td><select id='openfirewall'> 
    <option value="true">모든 IP 허용</option><option value="false">모든 IP 불허용</option></select>
  </td>
  <td>
   <form id='addPortForm' action='portForwarding.php' method='post'>

  <input name='ipaddressid' type='hidden' value='<?= $temp['id']?>'/>
  <input name='ipaddress' type='hidden' value='<?= $temp['ipaddress']?>'/>
  <input name='virtualmachineid' type='hidden' value=''/>
    <input type='hidden' name='protocol' value=''/>
    <input type='hidden' name='publicport' value=''/>
    <input type='hidden' name='privateport' value=''/>
    <input type='hidden' name='publicendport' value=''/>
    <input type='hidden' name='privateendport' value=''/>
    <input type='hidden' name='openfirewall' value=''/> 
    <input type='button' class='button2' value='등록' onclick="addPorForwardingRules()"/>
  </form>
  </td>
  </tr>

