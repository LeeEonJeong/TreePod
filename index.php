<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8"/>

<style>

</style>

</head>
<body>
<?php
include_once('head2.php');
include_once('api_constants.php');
include_once('./callAPI.php');
include_once('var_dump_enter.php');
//include('alert.html');

$URL = "https://api.ucloudbiz.olleh.com/server/v1/client/api?";
$URL_NAS = "https://api.ucloudbiz.olleh.com/nas/v1/client/api?";
$cmdArr = array(
  "command" => "listAccounts",
  "apikey" => API_KEY
);

//var_dump_enter($cmdArr);
//exit;
$result = callCommand($URL, $cmdArr, SECERET_KEY);
$result = $result['account'];
//var_dump_enter($result);

$cmdArr = array(
  "command" => "listVolumes",
  "apikey" => API_KEY
);
$result2 = callCommand($URL_NAS, $cmdArr, SECERET_KEY);
$result2_num = $result2['count'];
$online_num = 0;
$result2 = $result2['response'];
for($i=0; $i<$result2_num; $i++){
  if($result2_num == 1){
    $temp2 = $result2;
  } else {
    $temp2 = $result2[$i];
  }
  if($temp2['status']=='online')
    $online_num++;
}
//$result2 = $result2[]
//var_dump_enter($result2);
?>
<table class="fifty_left gray_line">
<tr class="background_gray"><td colspan="2"><b>Server</b></td></tr>
<tr>
<td style="width:50%">서버 갯수</td> <td style="width:50%"><?=$result['vmtotal']?></td>
</tr>

<tr>
<td>공인 IP 갯수</td> <td><?=$result['iptotal']?></td>
</tr>

<tr>
<td>Disk 갯수</td> <td><?=$result['volumetotal']?></td>
</tr>

</table>

<table class="fifty_left gray_line">
<tr class="background_gray"><td colspan="2"><b>NAS</b></td></tr>
<tr>
<td style="width:50%">NAS 갯수</td> <td style="width:50%"><?=$online_num?></td>
</tr>

</tr>
</table>
<!--<button class="button" onclick="Alert.render('서버 신청','dfdfd')">Custom Alert</button>-->  
</body>


</html>
