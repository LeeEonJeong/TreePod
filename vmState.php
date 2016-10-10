

<?php
include('api_constants.php');
include ('./callAPI.php');
include('var_dump_enter.php');
?>
<?php

$URL = "https://api.ucloudbiz.olleh.com/server/v1/client/api?";

$listProductcmdArr = array(
    "command" => "listVirtualMachines",
    "apikey" => API_KEY
);
$result = callCommand($URL, $listProductcmdArr, SECERET_KEY);
//var_dump_enter($result);

$result_num = $result['count'];
$result = $result['virtualmachine'];
//var_dump_enter($result['1']);
$temp;
for($i=0; $i<$result_num; $i++){
  if($result_num != '1' ) {
    $temp = $result[$i];
  }else {
    $temp = $result;
  }
  if($temp['displayname']==$_POST['displayname']){
    break;
  }
}
?>

<tr class="background_gray">
  <td style="text-align: left" colspan='2'><b><?=$_POST['displayname']?></b></td>
  <td style="text-align: right"><div id="serverStateClose" onclick="stateClose()">X </div></td>
</tr>
<tr>
  <td style='width: 20%;'><b>상태</b> </td><td style='width: 30%'><?= $temp['state']?></td>

<td>
<form method="post" id="server_state_form">
<input type='hidden' name='id' value='<?= $temp['id']?>'/>
<input type='hidden' name='zoneid' value='<?= $temp['zoneid']?>'/>
<input type='hidden' name='serviceofferingid' value='<?= $temp['serviceofferingid']?>'/>
<input type='hidden' name='templateid' value='<?= $temp['templateid']?>'/>
<?php
if($temp['displayname'] != "jjkserver") {
    if($temp['state']=="Running") {?>
    <input type='button' class="button2" value='중지' onclick="stopVM('0')"/>
<?php 
    } else if($temp['state']=="Stopped"){ ?>
    <input type='button' class="button2" value='시작' onclick="startVM('0')"/>
    <input type='button' class="button2" value='삭제' onclick="destroyVM('0')"/>
<?php
    } else {
      echo "-";
    }
  } else { echo "이 서버는 건드리지 마시오."; }
?>
</form>
</td>
</tr>
