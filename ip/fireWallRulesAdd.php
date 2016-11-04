
<?php
$server_root_path = $_SERVER['DOCUMENT_ROOT'];// ini_set('include_path',$server_root_path);
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
  <td style="width: 15%"><b>IP주소</b></td>
  <td style="width: 15%"><b>프로토콜</b></td>
  <td style="width: 15%"><b>시작 번호</b></td>
  <td style="width: 15%"><b>끝 번호</b></td>
  <td style="width: 20%"><b>허용  IP</b><br><sub>*미기입시, 모든 IP 허용</sub></td>
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
  <td ">
    <select id="protocol">
      <option value='TCP'>TCP</option>
      <option value='UDP'>UDP</option>
    </select>
  </td>
  <td ><input class="transparent" type='number' id='startport' value='' /></td>
  <td ><input class="transparent" type='number' id='endport' value='' /></td>
  <td ><input class="transparent" type='text' id='cidrlist' value='' /></td>
  <td >
   <form id='addFireWallForm' action='' method='post'>

  <input name='ipaddressid' type='hidden' value='<?= $temp['id']?>'/>
  <input name='ipaddress' type='hidden' value='<?= $temp['ipaddress']?>'/>
    <input type='hidden' name='protocol' value=''/>
    <input type='hidden' name='startport' value=''/>
    <input type='hidden' name='endport' value=''/>
    <input type='hidden' name='cidrlist' value=''/>
    <input type='button' class='button2' value='등록' onclick="addFireWallRules()"/>
  </form>
  </td>
  </tr>

