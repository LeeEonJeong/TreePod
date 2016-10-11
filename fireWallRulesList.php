<!DOCTYPE>
<html>
<head>
<meta charset="utf-8"/>

</head><body>
<?php
include_once('api_constants.php');
include_once('./callAPI.php');
include_once('var_dump_enter.php');
//  var_dump_enter($_POST);
 $cmdArr = array (
    "command" => "listFirewallRules",
    "ipaddressid" => $_POST['ipaddressid'],
    "apikey" => API_KEY
 );
// var_dump_enter($cmdArr);
 $URL = "https://api.ucloudbiz.olleh.com/server/v1/client/api?";
 $result = callCommand($URL, $cmdArr, SECERET_KEY);
// var_dump_enter($result);
//exit;
if(isset($result['count'])){
   $num = $result['count'];
   $result = $result['firewallrule'];
}else{
  $num = 0;
}
   ?>
 
 <tr class="background_gray"><td style="text-align: left" colspan="4"><b><?=$_POST['ipaddress']?></b></td>
  <td style="text-align: right"><div onclick="stateClose()">X</div></td></tr>
<tr  class="background_gray">
  <td style="width: 20%">프로토콜</td>
  <td style="width: 20%">시작번호</td>
  <td style="width: 20%">끝번호</td>
  <td style="width: 20%">허용 IP</td>
  <td style="width: 20%">-</td>
</tr>
 <?php
 for($i=0; $i<$num; $i++){
   if($num != '1' ) {
     $temp = $result[$i];
  }else {
     $temp = $result;
  }?>

    <tr>
    
 
  <td><?= $temp['protocol'];?></td>
  <td><?= $temp['startport'];?></td>
  <td><?= $temp['endport'];?></td>
  <td><?= $temp['cidrlist'];?></td>
  <td style="width:20%">
  <form  method="post"/>
   <input name="id" type="hidden" value="<?= $temp['id']?>"/>
   <input name="ipaddressid" type="hidden" value="<?=$temp['ipaddressid']?>"/>
   <input name="networkid" type="hidden" value="<?=$temp['networkid']?>"/>
  <!-- <input type="submit" class="button2" value="수정"/> -->
  <input type="button" onclick="deleteFireWallRules('<?=$i?>')" class="button2" value="삭제"/></td>
  </form>
 </tr>  
  <?php
 }
?>
</body>
</html>