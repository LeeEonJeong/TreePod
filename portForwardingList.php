<!DOCTYPE>
<html>
<head>
<meta charset="utf-8"/>
<style>
table,tr,td {
  border: 1px solid black;
  border-collapse: collapse;
}
</style>
</head><body>
<?php
include('head2.php');
include('api_constants.php');
include ('./callAPI.php');
include('var_dump_enter.php');
//  var_dump_enter($_POST);
 $cmdArr = array (
    "command" => "listPortForwardingRules",
    "ipaddressid" => $_POST['ipaddressid'],
    "apikey" => API_KEY
 );
// var_dump_enter($cmdArr);
 $URL = "https://api.ucloudbiz.olleh.com/server/v1/client/api?";
 $result = callCommand($URL, $cmdArr, SECERET_KEY);
 //var_dump_enter($result);
if(count($result)!=0){
   $num = $result['count'];
   $result = $result['portforwardingrule'];
}else{
  $num = 0;
}
   ?>
 
 <table>
 <tr><td colspan="4"><?=$_POST['ipaddress']?></td></tr>
 <tr><td>서버</td><td>공용번호</td><td>내부번호</td><td>-</td></tr>
 <?php
 for($i=0; $i<$num; $i++){
   if($num != '1' ) {
     $temp = $result[$i];
  }else {
     $temp = $result;
  }?>
  <tr><form action="deletePortForwarding.php" method="post"/>
  <input name="id" type="hidden" value="<?= $temp['id']?>"/>
  <td><?= $temp['virtualmachinedisplayname'];?></td>
  <td><?= $temp['privateport'];?>-<?= $temp['privateendport'];?></td>
  <td><?= $temp['publicport'];?>-<?= $temp['publicendport'];?></td>
  <td><input type="submit" value="삭제"/></td>
  </form></tr>
  <?php
 }
?>
</table>
<a href="listPulbicIP.php">내 공인 IP 보기</a>
<a href="index.php">홈으로 가기</a>
</body>
</html>