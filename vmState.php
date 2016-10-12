

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
  <td><b>네트워크 정보</b></td><td>사설 IP<br><?= $temp['nic']['ipaddress']?></td><td>gate way<br><?= $temp['nic']['gateway']?></td>
</tr>
<tr>
  <td style='width: 20%;'><b>실행상태</b> </td><td style='width: 40%'><?= $temp['state']?></td>

<td>
<form method="post" id="server_state_form">
<input type='hidden' name='id' value='<?= $temp['id']?>'/>
<input type='hidden' name='zoneid' value='<?= $temp['zoneid']?>'/>
<input type='hidden' name='serviceofferingid' value='<?= $temp['serviceofferingid']?>'/>
<input type='hidden' name='templateid' value='<?= $temp['templateid']?>'/>
</form>

<?php
if($temp['displayname'] != "jjkserver") {
    if($temp['state']=="Running") {?>
    <input type='button' class="button2" value='중지' onclick="stopVM()"/>
    <input type='button' class="button2" value='재부팅' onclick="restartVM()"/>
<?php 
    } else if($temp['state']=="Stopped"){ ?>
    <input type='button' class="button2" value='시작' onclick="startVM()"/>
<?php
    } else {
      echo "-";
    }
  } else { echo "이 서버는 건드리지 마시오."; }
?>
</td>
</tr>
<tr>
  <td colspan="3">
<?php
if($temp['displayname'] != "jjkserver") {
  if($temp['state']=="Stopped"){ ?>
    <input type='button' class="button" value='VM 삭제' onclick="destroyVM()"/>
<?php
  }
  if($temp['state']=="Stopped" || $temp['state']=="Running") {?> 
  <input type='button' class='button' value='비밀번호 초기화' onclick="resetPassword()"/>
<?php 
  } else { echo "-"; }
}else { echo "-";}?>
  </td>
</tr>