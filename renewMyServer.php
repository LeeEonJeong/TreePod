<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8"/>
<link rel="stylesheet" type="text/css" href="design.css">
<link rel="stylesheet" type="text/css" href="menu_design.css">
<link rel="stylesheet" type="text/css" href="alert_bar_design.css">

<?php
include_once('api_constants.php');
include_once('./callAPI.php');
include_once('var_dump_enter.php');
?>
</head>
<body>

<?php
// <tr><td colspan="5"><b>- 서버 삭제완료! -</b></td></tr> 
?>
<tr class="background_gray"><td>서버 명</td><td>지역</td><td>Core X RAM</td><td>OS</td><td>생성 일자</td></tr>
<?php

$URL = "https://api.ucloudbiz.olleh.com/server/v1/client/api?";
sleep(1);
$listProductcmdArr = array(
    "command" => "listVirtualMachines",
    "apikey" => API_KEY
);
$result = callCommand($URL, $listProductcmdArr, SECERET_KEY);
//var_dump_enter($result);

$result_num = $result['count'];
$result = $result['virtualmachine'];

for($i=0; $i<$result_num; $i++){
  if($result_num != '1' ) {
    $temp = $result[$i];
  }else {
    $temp = $result;
  }
  echo "<tr><td class='view' onmouseover = 'viewPassword(this)' onmouseout='hiddenPassword(this)' onclick='showVMState(this)'>";
  echo $temp['displayname'];
  echo "</td> <td>";
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

</body>


</html>
