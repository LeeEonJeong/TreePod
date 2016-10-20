<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8"/>
<script>
  function displayFrom(id,dis){
    var distable = document.getElementById(dis);
    distable.style.display='none';
    var table = document.getElementById(id);
    table.style.display='table';
  }
</script>
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

//$URL = "https://api.ucloudbiz.olleh.com/server/v1/client/api?";
$URL_NAS = "https://api.ucloudbiz.olleh.com/nas/v1/client/api?";
$cmdArr = array(
  "command" => "listCifsAccounts",
  "apikey" => API_KEY
);

$result = callCommand($URL_NAS, $cmdArr, SECERET_KEY);

//var_dump_enter($result);
//exit;

if($result['totalcount']==0){
  // 계정 하나 만드는 페이지로 넘어가도록 하셈.
  exit;
}



$cmdArr = array(
  "command" => "listAccountForNas",
  "apikey" => API_KEY
);

$result = callCommand($URL_NAS, $cmdArr, SECERET_KEY);
//var_dump_enter($result);

?>
<table class="fifty_left gray_line">
<tbody>
<tr class="background_gray"><td colspan="2"><b>CIFS Account</b></td></tr>
<tr>
<td style="width:50%">CIFS 계정 이름</td> <td style="width:50%"><?=$result['response']['cifsid']?></td>
</tr>
<tr>
  <td colspan='2'><button class='button' onclick="displayFrom('cifsAccount','cifsGroup')">ID / PW Change</button></td>
</tr>
</tbody>
</table>



<table class="fifty_left gray_line">
<tbody>
<tr class="background_gray"><td colspan="2"><b>그룹</b></td></tr>
<tr>
<td style="width:50%">작업 그룹 이름</td> <td style="width:50%"><?=$result['response']['cifsworkgroup']?></td>
</tr>
<tr>
  <td colspan='2'><button class='button' onclick="displayFrom('cifsGroup','cifsAccount')">Group name Change</button></td>
</tr>
</tbody>
</table>
<table id='cifsAccount' style='display:none;' class="noHover gray_line">
<tr>
  <td>ID</td>
  <td><input class='transparent' type='text' index=1/></td>
  <td style='width:20%' rowspan="2"><button class='button'>제출</button></td>
</tr>
<tr>
  <td>PW</td>
  <td><input class='transparent'  type='password' index=2/></td>
</tr>
</table>

<table id='cifsGroup'  style='display:none;' class="gray_line ">
<tr>
  <td>Group name</td>
  <td><input class='transparent' type='text' index=1/></td>
  <td style='width:20%'><button class='button'>제출</button></td>
</tr>

<tbody>


</body>


</html>
