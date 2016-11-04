<?php
$server_root_path = $_SERVER['DOCUMENT_ROOT']; // ini_set('include_path',$server_root_path);
include_once($server_root_path.'/includeFiles.php');
include_once($server_root_path.'/'.CLOUD_PATH.'pageInclude/ajaxCalledPageInclude.php');
/*
include_once($server_root_path.'/'.CLOUD_PATH.'include/api_constants.php');   // api_constnats.php  
include_once($server_root_path.'/'.CLOUD_PATH.'include/callAPI.php');     // callAPI.php  
*/
?>

<tr class="background_gray">
  <td style="text-align: left" colspan='3'><b><?=$_POST['displaytext']?></b> </td>
  <td style="text-align: right"><div id="serverStateClose" onclick="stateClose()">X </div></td>
</tr>
<?php
function isVMConnected($CIP_id, $vm_nic) {
 // $nas_network = $CIP_id;
  if(isset($vm_nic['id'])) return false;
  for($i=0; $i<count($vm_nic); $i++) {
    if($vm_nic[$i]['networkid'] == $CIP_id) { 
      $connected_nic = $vm_nic[$i]['id'];
      return $connected_nic;
    }
  }
  return false;
}

$URL = "https://api.ucloudbiz.olleh.com/server/v1/client/api?";
//$URL_NAS = "https://api.ucloudbiz.olleh.com/nas/v1/client/api?";
$VMCmdArr = array(
  "command" => "listVirtualMachines",
  "zoneid" => $_POST['zoneid'],
  "apikey" => API_KEY
);
$VMResult = callCommand($URL, $VMCmdArr, SECERET_KEY);
//var_dump_enter($VMResult);

if(isset($VMResult['count']) == false)
  exit;

?>



<?php
//var_dump_enter($zoneResult);
$vm_count = $VMResult['count'];
$VMResult = $VMResult['virtualmachine'];
$isNasConnectedValue=false;
for($i=0; $i < $vm_count; $i++) {
    if($vm_count==1){
      $vm_connected = $VMResult;
    } else {
      $vm_connected = $VMResult[$i];
    }
    $isNasConnectedValue = isVMConnected($_POST['networkid'],$vm_connected['nic']);
  //  var_dump_enter($isNasConnectedValue);
    if($isNasConnectedValue != false){ 
    //  break; ?>
    <tr>
      <td style="width:24%"><b>연결 VM</b></td>
      <td style="width:30%">
      <form id='NAS_connect_form' style="margin:0px;padding:0px;" method="post" >
        <input type='hidden' name='nicid' value='<?= $isNasConnectedValue ?>'/>
        <input type='hidden' name='virtualmachineid' value='<?= $vm_connected['id']?>'/>
      <b><?= $vm_connected['displayname']?></b> : <?= $vm_connected['state']?>
      </form>
      <td style="width:24%"><input type='button' class='button' value='연결끊기' onclick='NASDettachSubmit()'/></td>
      <td style="width:2%"></td>
    </tr>
    <?php
      
      //여기서... 
    } 
 }
 ?>


