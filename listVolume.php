<!DOCTYPE>
<html>
<head>
<meta charset="utf-8"/>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script>
function makeByteToGB(byte){
  byte = Number(byte);
  document.write( byte/1024/1024/1024 +"GB" );
}

 var publicIp_length;

$(document).ready(function(){
   publicIp_length = document.forms.length;

});

</script>
<script src="">

</script>
</head><body>

<?php
include_once('head2.php');
include_once('api_constants.php');
include_once('./callAPI.php');
include_once('var_dump_enter.php');

 $cmdArr = array (
    "command" => "listVolumes",
    "apikey" => API_KEY
 );
// var_dump_enter($cmdArr);
 $URL = "https://api.ucloudbiz.olleh.com/server/v1/client/api?";
 $result = callCommand($URL, $cmdArr, SECERET_KEY);
 //var_dump_enter($result);
 $num = $result['count'];
 $result = $result['volume'];

?>
 <table class="noline hoverOn">



<tr><td></td></tr>
<tr class="background_gray">
  <td style="width:20%"><b>이름</b></td>
  <td style="width:15%"><b>지역</b></td>
  <td style="width:15%"><b>타입</b></td>
  <td style="width:15%"><b>용량</b></td>
  <td ><b>생성일</b></td>
</tr>

<?php 
for($i=0; $i<$num; $i++){ 
   if($num != '1' ) {
     $temp = $result[$i];
  }else {
     $temp = $result;
  }?>
  <tr>
  <form method='post'>
  <td ><?= $temp['name'] ?>
  <input name='ipaddressid' type='hidden' value='<?= $temp['id']?>'/>
  <input name='ipaddress' type='hidden' value='<?= $temp['ipaddress']?>'/>
  </td>
  <td>
  <?=$temp['zonename']?>
  </td>
  <td ><?= $temp['type']?></td>
  <td > <script>makeByteToGB('<?=$temp['size']?>');</script>  </td>
  <td><?=$temp['created']?></td>
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