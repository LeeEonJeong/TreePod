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
<tr class="background_gray"><td>NAS 이름</td><td>타입</td><td>지역</td><td>생성일자</td><td>내 서버 연결 </td><td>-</td></tr>
<?php

$URL = "https://api.ucloudbiz.olleh.com/server/v1/client/api?";
$URL_NAS ="https://api.ucloudbiz.olleh.com/nas/v1/client/api?";
$listProductcmdArr = array(
    "command" => "listVolumes",
    "status" => "online",
    "apikey" => API_KEY
);
$zoneCmdArr = array(
	"command" => "listZones",
	"apikey" => API_KEY
);
$result = callCommand($URL_NAS, $listProductcmdArr, SECERET_KEY);
//var_dump_enter($result);

$result_num = $result['count'];
if($result_num != 0)
	$result = $result['response'];
//var_dump_enter($result['1']);

for($i=0; $i<$result_num; $i++){
  if($result_num != '1' ) {
    $temp = $result[$i];
  }else {
    $temp = $result;
  }

  if($temp['status']!='online') continue;
  $zoneCmdArr['id'] = $temp['zoneid'];
  $zoneResult = callCommand($URL, $zoneCmdArr, SECERET_KEY);
//  var_dump_enter($zoneResult);
  echo "<tr><td class='view' onclick='showNASState(this)'>";
  echo $temp['name'];
  echo "</td> <td>";
  echo $temp['volumetype'];
  echo "</td> <td>";
  echo  $zoneResult['zone']['name'];
  echo "</td> <td>";
  echo $temp['created'];
  echo "</td><td>";
  echo "<input type='button' class='button2' value='조회하기' onclick=\"showNasConnect('".$i."')\"/>";
  echo "</td> <td><form method='post' action='deleteNAS.php'><input type='hidden' name='id' value='".$temp['id']."'/><input type='submit' class='button' value='삭제'/></form>";
  echo "</td> </tr>";

}

?>
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
