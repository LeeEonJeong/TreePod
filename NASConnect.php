
<?php
include('api_constants.php');
include ('./callAPI.php');
include('var_dump_enter.php');
?>

<?php
function isNASConnected($CIP_id, $vm_nic) {
//  $nas_network = $nas;
  if(isset($vm_nic['id'])) return false;
  for($i=0; $i<count($vm_nic); $i++) {
    if($vm_nic[$i]['networkid']==$CIP_id) { 
      $connected_nic = $vm_nic[$i]['id'];
      return $connected_nic;
    }
  }
  return false;
}
$URL = "https://api.ucloudbiz.olleh.com/server/v1/client/api?";
$URL_NAS = "https://api.ucloudbiz.olleh.com/nas/v1/client/api?";
/*
$listProductcmdArr = array(
    "command" => "listVolumes",
    "id" => $_POST['id'],
    "apikey" => API_KEY
);
$result = callCommand($URL_NAS, $listProductcmdArr, SECERET_KEY);
//var_dump_enter($result);

//var_dump_enter($_POST);
$result_num = $result['count'];
$temp = $result['response'];
*/
$zoneCmdArr = array(
  "command" => "listVirtualMachines",
  "zoneid" => $_POST['zoneid'],
  "apikey" => API_KEY
);
$zoneResult = callCommand($URL, $zoneCmdArr, SECERET_KEY);

if(isset($zoneResult['count'])==false){ ?>
<tr class="background_gray">
  <td style='width:98%'><b><?=$_POST['displaytext']?></b> 과 동일한 zone 의 VM이 없습니다.</td>
  <td style='width:2%'><div id="serverStateClose" onclick="listClose()">X </div></td>
</tr>

<?php
  exit;
}
//var_dump_enter($zoneResult);
?>
<tr class="background_gray">
  <td style='width:28%'><b>CIP</b></td>
  <td style='width:40%'><b>VM</b><br>*VM이 켜져 있어야 합니다.</td>
  <td style='width:28%'>-</td>
  <td style='width:2%'> <div id="serverStateClose" onclick="listClose()">X</div></td>
</tr>
<tr>
   <td><b><?=$_POST['displaytext']?></b></td>
   <td>
    <form id='NAS_connect_form' style="margin:0px;padding:0px;" method="post" >
    <input type='hidden' name='networkid' value='<?=$_POST['networkid']?>'/>
      <select name='virtualmachineid'>
      <option value='-'>-</option>

<?php
//var_dump_enter($zoneResult);

$vm_count = $zoneResult['count'];
$zoneResult = $zoneResult['virtualmachine'];
$isNasConnectedValue=false;
for($i=0; $i < $vm_count; $i++) {
    if($vm_count==1){
      $vm_connected = $zoneResult;
    } else {
      $vm_connected = $zoneResult[$i];
    }
    $isNasConnectedValue = isNasConnected($_POST['networkid'],$vm_connected['nic']);
    if($isNasConnectedValue==false && $vm_connected['state']=='Running'){ 
    //  break; ?>
      <option value='<?=$vm_connected['id']?>'><?= $vm_connected['displayname']?></option>
      </form>
      
    <?php
      //여기서... 
    } 
 }
 ?>

<td><input type='button' class='button' value='연결하기' onclick='NASAttachSubmit()'/></td>
<td></td>
    </tr>