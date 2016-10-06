<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8"/>
<link rel="stylesheet" type="text/css" href="design.css">
<link rel="stylesheet" type="text/css" href="menu_design.css">
<link rel="stylesheet" type="text/css" href="alert_bar_design.css">
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
<?php
//include('hover_session.php');
include('head2.php');
include('api_constants.php');
include ('./callAPI.php');
include('var_dump_enter.php');
?>
<br/>
<table class="noline">
<tr class="background_gray"><td>서버 명</td><td>상태</td><td>지역</td><td>Core X RAM</td><td>OS</td><td>생성 일자</td><td>실행</td></tr>
<?php

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
  echo "<tr><form method='post'><td class='view'>";
  echo $temp['displayname'];
  echo "</td> <td>";
  echo "<input type='hidden' name='id' value='".$temp['id']."'/>";
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
    <input type='button' class="button2" value='중지' onclick="stopVM('<?=$i?>')"/></td></tr></form>
<?php 
    } else { ?>
    <input type='button' class="button2" value='시작' onclick="startVM('<?=$i?>')"/>
    <input type='button' class="button2" value='삭제' onclick="destroyVM('<?=$i?>')"/></td></tr></form>
   
<?php
    }
  }
   echo  "<tr id='".$temp['displayname']."' class='lower_level'></tr>";
}

?>
</table>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
  $('.view').mouseover(function(event){
    var postVal = this.innerHTML;
   // alert(postVal);
    var xhr = new XMLHttpRequest();
    xhr.open('POST','view_password.php');
    xhr.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
    var data = 'displayname='+postVal;
    xhr.send(data);
    xhr.onreadystatechange = function(){
        if(xhr.readyState === 4 && xhr.status === 200) {
        //  document.querySelector('.password').innerHTML = xhr.responseText;
          document.getElementById(postVal).innerHTML = xhr.responseText; 
        }
      }
  }); 
  $(".view").mouseout(function(){
        var postVal = this.innerHTML;
        document.getElementById(postVal).innerHTML="";
    });

});
</script>

</body>


</html>
