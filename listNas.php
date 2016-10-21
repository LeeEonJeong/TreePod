<?php 
include_once('api_constants.php');
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8"/>
<link rel="stylesheet" type="text/css" href="design.css">
<link rel="stylesheet" type="text/css" href="menu_design.css">
<link rel="stylesheet" type="text/css" href="alert_bar_design.css">
<script src='listNas.js'> </script>

<?php
include_once('customAlert.html');
include_once('./callAPI.php');
include_once('var_dump_enter.php');
?>

</head>
<body>
<?php
include_once('head2.php');
?>
<br/>
<table  class="noline hoverOn">
<tbody id="myVM"><!-- onmouseover='renewMyServer()'>-->
<tr class="background_gray">
  <td style='width: 25%'><b>CIP</b></td>
  <td style='width: 20%'><b>연결 NAS</b></td>
  <td style='width: 30%'><b>연결 VM</b></td>
  <td style='width: 25%'><b>zone</b></td>
</tr>
<?php

$URL = "https://api.ucloudbiz.olleh.com/server/v1/client/api?";
$URL_NAS ="https://api.ucloudbiz.olleh.com/nas/v1/client/api?";
$listNetworks = array (
  "command" => "listNetworks",
  "apikey" => API_KEY
  );

$result =callCommand($URL, $listNetworks, SECERET_KEY);
//var_dump_enter($result);
$result_num = $result['count'];
$result = $result['network'];
$NASCIP='';
for($i=0; $i<$result_num; $i++) {
  if($result_num==1){
    $NASCIP = $result;
  }else {
    $NASCIP = $result[$i];
  }
  if(strstr($NASCIP['name'],'NAS') == false){
    continue;
  }?>
  <tr>
  <td>
  <?=$NASCIP['displaytext'];?>
  
  </td>
  <td><button class='button2' onclick="showNASList('<?=$NASCIP['id']?>')">조회하기</button></td>
  <td style='width: 30%'>
    <form>
      <input type='hidden' name='networkid' value='<?=$NASCIP['id']?>'/>
      <input type='hidden' name='zoneid' value='<?=$NASCIP['zoneid']?>'/>
      <input type='hidden' name='displaytext' value='<?=$NASCIP['displaytext']?>'/>
    </form>
    <button class='button2' onclick="showNasConnectState('<?= $i?>')">조회하기</button> 
    <button class='button2' onclick="showNasConnect('<?=$i?>')">등록하기</button></td>
  <td><?=$NASCIP['zonename'];?></td>
  </tr>
  <?php
} ?>

</tbody>
</table>

<table class="gray_line_top_bottom hoverOn">
<tbody style='display:none' id="NASList"> <!--NAS 상태를 조회하는 부분.-->
</tbody>
</table>

<table style="display: none" class="gray_line_top_bottom" id="NASState">
<!--<tbody id="serverState">
<tr  class="background_gray">
  <td style="text-align: left" colspan='2'>(서버이름)</td>
  <td style="text-align: right"><div id="serverStateClose">X </div></td>
</tr>
<tr  ><td>상태</td><td>running?</td><td><form>실행 버튼들</form></td></tr>
</tbody> -->
</table>


</body>


</html>
