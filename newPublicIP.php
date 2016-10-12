<!DOCTYPE>
<html>
<head>
<meta charset="utf-8"/>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script>
 var publicIp_length;
$(document).ready(function(){
   publicIp_length = document.forms.length;
 // alert(publicIp_length);
});
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

<table class="gray_line hoverOn">
<tbody>

<!--<form action="test.php" method="post"> -->
<form action="PublicIPAdd.php" method="post">
<tr id="newIP"  >
<!--  <td style="width:33%">지역</td>
  <td style="width:33%">요금 약정 방법</td>
  <td style="width:33%">-</td> -->
</tr>
<tr id="newIPInput"  class="noHover">
<td style="width:25%">지역</td>
  <td >
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
  </tr>
  <tr>
  <td >요금 약정 방법 </td>
  <td >
    <select name="usageplantype"> 
    <option value="">-</option>
    <option value="hourly">시간제 요금</option> 
    <option value="monthly">월단위 요금</option> </select>
  </td>
 

</tr>
<tr class="noHover"><td colspan="3"><input type="submit" class="button" id="newIPButton" onclick="" value="새로운 공인 IP 신청"/>
</td></tr>
</form>
</tbody>
</table>

</body>
</html>