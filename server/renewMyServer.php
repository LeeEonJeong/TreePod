<?php
$server_root_path = $_SERVER['DOCUMENT_ROOT']; //ini_set('include_path',$server_root_path);
include_once($server_root_path.'/includeFiles.php');
include_once($server_root_path.'/'.CLOUD_PATH.'pageInclude/ajaxCalledPageInclude.php');
?>
<?php
/*
include_once('/'.CLOUD_PATH.'include/api_constants.php');
include_once('/'.CLOUD_PATH.'include/callAPI.php'); 
*/
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