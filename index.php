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

<script>

function destroyVM(num){
//  alert(document.forms[num]);
  document.forms[num].action = 'destroyVM.php';
  document.forms[num].method = 'post';
  document.forms[num].submit();
}
function startVM(num){
//  alert(document.forms[num]);
  document.forms[num].action = 'startVM.php';
  document.forms[num].method = 'post';
  document.forms[num].submit();
}
function stopVM(num){
//  alert(document.forms[num]);
  document.forms[num].action = 'stopVM.php';
  document.forms[num].method = 'post';
  document.forms[num].submit();
}
</script>
</head>
<body>
<a href="deployAPI.php">새로운 서버 신청하기</a><br/>
<table>
<?php
include('api_constants.php');
include ('./callAPI.php');
include('var_dump_enter.php');
 
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
    echo "<tr><form method='post'><td>";
    
    echo $temp['displayname'];
    echo "<input type='hidden' name='id' value='".$temp['id']."'/>";
    echo "</td> <td>";
    echo $temp['state'];
    echo "</td> <td>";
    echo $temp['zonename'];
    echo "<input type='hidden' name='zoneid' value='".$temp['zoneid']."'/>";
    echo "</td> <td>";
    echo $temp['serviceofferingname'];
    echo "<input type='hidden' name='serviceofferingid' value='".$temp['serviceofferingid']."'/>";
    echo "</td> <td>";
    echo $temp['templatedisplaytext'];
    echo "<input type='hidden' name='templateid' value='".$temp['templateid']."'/>";
    echo "</td> <td>"; 
    echo $temp['created'];
    echo "</td> <td>";
    
    if($temp['displayname'] != "jjkserver") {
      if($temp['state']=="Running") {?>
    <input type='button' value='중지' onclick="stopVM('<?=$i?>')"/></td></tr></form>
    <?php 
    } else { ?>
    <input type='button' value='시작' onclick="startVM('<?=$i?>')"/>
    <input type='button' value='삭제' onclick="destroyVM('<?=$i?>')"/></td></tr></form>
    
<?php
    }
  }
}

?>
</table>
</body>
</html>
