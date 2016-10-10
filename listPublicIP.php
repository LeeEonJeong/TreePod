<!DOCTYPE>
<html>
<head>
<meta charset="utf-8"/>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script>
 var publicIp_length;
$(document).ready(function(){
   publicIp_length = document.forms.length;
//  alert(publicIp_length);
});
</script>
<script src="portForwarding.js">
</script>
</head><body>

<?php
include_once('head2.php');
include_once('api_constants.php');
include_once('./callAPI.php');
include_once('var_dump_enter.php');


$listProductcmdArr = array(
  "command" => "listZones",
  "available" => "true",
  "apikey" => API_KEY
); 

 $URL = "https://api.ucloudbiz.olleh.com/server/v1/client/api?";
$result = callCommand($URL, $listProductcmdArr, SECERET_KEY);

 ?>

<table class="noline hoverOn">
<tbody>
<tr id="newIP" style="display: none" class="background_gray" >
  <td style="width:33%">지역</td>
  <td style="width:33%">요금 약정 방법</td>
  <td style="width:33%">-</td>
</tr>
<tr id="newIPInput" style="display: none" class="noHover">
<form action="PublicIPAdd.php" method="post">
  <td style="width:40%">
     <select name="zoneid"> 
      <option value="">-</option>

     <?php 
     $result_num = $result['count'];
     for($i=0; $i<$result_num; $i++) {
      echo "<option value='".$result['zone'][$i]['id']."'>".$result['zone'][$i]['name']."</option>";
     }
     ?>
       
     </select>
  </td>
  <td style="width:40%">
    <select name="usageplantype"> 
    <option value="">-</option>
    <option value="hourly">시간제 요금</option> 
    <option value="monthly">월단위 요금</option> </select>
  </td>
  <td style="width:20%"><input type="submit" class="button2" value="등록"/></td>
</form>
</tr>
<tr class="noHover"><td style="border-top-style: hidden;" colspan="3"><a class="button" id="newIPButton" onclick="showNewIP()">새로운 공인 IP 등록</a>
</td></tr>
</tbody>
</table>


<?php

 $cmdArr = array (
    "command" => "listPublicIpAddresses",
    "apikey" => API_KEY
 );
// var_dump_enter($cmdArr);
 $URL = "https://api.ucloudbiz.olleh.com/server/v1/client/api?";
 $result = callCommand($URL, $cmdArr, SECERET_KEY);
 //var_dump_enter($result);
 $num = $result['count'];
 $result = $result['publicipaddress'];

?>
 <table class="noline hoverOn">



<tr><td></td></tr>
<tr class="background_gray"><td><b>ip번호</b></td><td><b>지역</b></td><td><b>포트포워딩 조회</b></td><td><b>포트포워딩 등록</b></td><td><b>삭제</b></td></tr>

<?php 
for($i=0; $i<$num; $i++){ 
   if($num != '1' ) {
     $temp = $result[$i];
  }else {
     $temp = $result;
  }?>
  <tr>
  <form action='PublicIPDelete.php' method='post'>
  <td style="width:25%" ><?= $temp['ipaddress'] ?>
  <input name='ipaddressid' type='hidden' value='<?= $temp['id']?>'/>
  <input name='ipaddress' type='hidden' value='<?= $temp['ipaddress']?>'/>
  </td>
  <td>
  <?=$temp['zonename']?>
  </td>
  <td style="width:20%"><input type='button' class='button2' value='조회' onclick="portForwarding('<?=$i?>')"/></td>
  <td style="width:20%"><input type='button' class='button2' value='등록' onclick="addPortForwarding('<?=$i?>')"/></td>
  <?php
    if($temp['issourcenat']=="true") {
      echo "<td><b>-</b></td>";
    } else {
    echo "<td><input type='submit' class='button' value='삭제'/></td>";
    }
  ?>
  </form>
  </tr>
 <?php  
 }
?>
</table>

<table  class="gray_line_top_bottom">
<tbody style="display: none" id = "viewer">
</tbody>
</table>

</body>
</html>