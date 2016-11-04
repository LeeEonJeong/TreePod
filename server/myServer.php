<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8"/>
<style>
table,tr,td{
    border: 1px solid black;
    border-collapse: collapse;
}
</style>

</head>
<body>
<?php
$server_root_path = $_SERVER['DOCUMENT_ROOT'];// ini_set('include_path',$server_root_path);
include_once($server_root_path.'/includeFiles.php');
include_once($server_root_path.'/'.CLOUD_PATH.'pageInclude/menuPageInclude.php');
?>
<script src='vm.js'></script>

<table  class="noline hoverOn">
<tbody id="myVM" onmouseover='renewMyServer()'>
<tr class="background_gray"><td>서버 명</td><td>지역</td><td>Core X RAM</td><td>OS</td><td>생성 일자</td></tr>
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

for($i=0; $i<$result_num; $i++){
  if($result_num != '1' ) {
    $temp = $result[$i];
  }else {
    $temp = $result;
  }
  echo "<tr><td class='view' onmouseover = 'viewPassword(this)' onmouseout='hiddenPassword(this)' onclick='showVMState(this)'>";
  echo $temp['displayname'];
  echo "</td> <td>";
  echo "<input id='".$temp['displayname']."_id' type='hidden' value='".$temp['id']."'/>";
  echo $temp['zonename'];
  echo "</td> <td>";
  echo $temp['serviceofferingname'];
  echo "</td> <td>";
  echo $temp['templatedisplaytext'];
  echo "</td> <td>"; 
  echo $temp['created'];
  echo "</td> </tr>";

  echo  "<tr id='".$temp['displayname']."' class='lower_level'></tr>";
}

?>
</tbody>
</table>

<table style="display: none" class="gray_line_top_bottom" id="serverState">
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
