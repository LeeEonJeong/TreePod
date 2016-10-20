
<?php
include('api_constants.php');
include ('./callAPI.php');
include('var_dump_enter.php');
?>
<?php
function isNASConnected($nas, $vm_nic) {
  $nas_network = $nas['networkid'];
  if(isset($vm_nic['id'])) return false;
  for($i=0; $i<count($vm_nic); $i++) {
    if($vm_nic[$i]['networkid']==$nas['networkid']) { 
      $connected_nic = $vm_nic[$i]['id'];
      return $connected_nic;
    }
  }
  return false;
}
$URL = "https://api.ucloudbiz.olleh.com/server/v1/client/api?";
$URL_NAS = "https://api.ucloudbiz.olleh.com/nas/v1/client/api?";
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

$zoneCmdArr = array(
  "command" => "listVirtualMachines",
  "apikey" => API_KEY
);
$zoneCmdArr['zoneid'] = $temp['zoneid'];
$zoneResult = callCommand($URL, $zoneCmdArr, SECERET_KEY);

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
    $isNasConnectedValue = isNasConnected($temp,$vm_connected['nic']);
    if($isNasConnectedValue!=false){ break;}
}
?>

<tr class="background_gray">
  <td style="text-align: left" colspan='2'><b><?=$temp['name']?></b> </td>
  <td style="text-align: right"><div id="serverStateClose" onclick="stateClose()">X </div></td>
</tr>
<tr>
<?php 
if($isNasConnectedValue==false) {
?>
  <td style="width:25%"><b>연결 VM</b></td>
  <td style="width:50%">
  <form id='NAS_connect_form' style="margin:0px;padding:0px;" method="post" >
  <input type='hidden' name='networkid' value='<?= $temp['networkid'] ?>'/>
  <select name="virtualmachineid">
  <option>-</option>
  <?php
  for($i=0; $i < $vm_count; $i++) {
    if($vm_count==1){
      $vm_temp = $zoneResult;
    } else {
      $vm_temp = $zoneResult[$i];
    }
?>

  <option value="<?=$vm_temp['id']?>"><?=$vm_temp['displayname']?></option>

<?php
  }
?>
</select>
  </form>
  </td>
  <td style="width:25%"><input type='button' class='button' value='연결하기' onclick='NASAttachSubmit()'/></td>

<?php 
} else {
?>
  <td style="width:25%"><b>연결 VM</b></td>
  <td style="width:30%">
  <form id='NAS_connect_form' style="margin:0px;padding:0px;" method="post" >
  <input type='hidden' name='nicid' value='<?= $isNasConnectedValue ?>'/>
  <input type='hidden' name='virtualmachineid' value='<?= $vm_connected['id']?>'/>
  <b><?= $vm_connected['displayname']?></b> : <?= $vm_connected['state']?>
  </form>
  
 <td style="width:25%"><input type='button' class='button' value='연결끊기' onclick='NASDettachSubmit()'/></td>
<?php
}
?>
</tr>
