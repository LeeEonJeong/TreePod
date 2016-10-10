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
<?php
include_once('customAlert.html');
include_once('api_constants.php');
include_once('./callAPI.php');
include_once('var_dump_enter.php');
?>
<script>

function destroyVM(num){
//  alert(document.forms[num]);
  var server = document.getElementById('server_state_form');
  server.action = 'destroyVM.php';
  server.method = 'post';
  server.submit();
}
function startVM(num){

  var server = document.getElementById('server_state_form');
  server.action = 'startVM.php';
  server.method = 'post';
  server.submit();
}
function stopVM(num){
  var server = document.getElementById('server_state_form');
  server.action = 'stopVM.php';
  server.method = 'post';
  server.submit();
}

function stateClose(){
  document.getElementById('serverState').style.display="none";
}

 function isVMdeleted(processStart,processEnd){
    //  alert((processStart));
    //  alert((processEnd));
     var findStr = "<?=VM_DESTROY?>";
      for(i=processStart; i<=processEnd ; i++) {
        var message = document.getElementById('state'+i).innerHTML;
        if (message.indexOf(findStr) != -1) {
        //  Alert.render('서버삭제 ','서버 삭제가 완료 되었습니다. ','default');
          alert('서버 삭제가 완료 되었습니다.');
          return true; //원래는 여기가 true;
        }else {

          
   //       
          return false; //원래는 여기가 flase;
        }
    }
}

function viewPassword(t){
    var postVal = t.innerHTML;
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
  }

  function hiddenPassword(t){
    var postVal = t.innerHTML;
        document.getElementById(postVal).innerHTML="";
  }

  function showVMState(t){
    var postVal = t.innerHTML;
    var xhr = new XMLHttpRequest();
    xhr.open('POST','vmState.php');
    xhr.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
    var data = 'displayname='+postVal;
    xhr.send(data);
    xhr.onreadystatechange = function(){
        if(xhr.readyState === 4 && xhr.status === 200) {
        //  document.querySelector('.password').innerHTML = xhr.responseText;
          document.getElementById('serverState').innerHTML = xhr.responseText; 
        //  alert(xhr.responseText);
        }
      }
    document.getElementById('serverState').style.display = 'table';
  }



  function renewMyServer(){
//    alert('renewMyServer');

    if(isVMdeleted(span_start,span_end) == true){
        span_start = 2;
        span_end = 1;
        var xhr = new XMLHttpRequest();
        xhr.open('GET','renewMyServer.php');
        xhr.onreadystatechange = function(){
        //  alert(xhr.responseText);
          if(xhr.readyState === 4 && xhr.status === 200) {
            document.querySelector('#myVM').innerHTML = xhr.responseText;
          //  alert(xhr.responseText);
          }
        }
        xhr.send();
        // alert("ajax use");
        stateClose();
     }

  }
</script>
</head>
<body>
<?php
include_once('head2.php');
?>
<br/>
<table  class="noline hoverOn">
<tbody id="myVM" onmouseover='renewMyServer()'>
<tr class="background_gray"><td>서버 명</td><td>지역</td><td>Core X RAM</td><td>OS</td><td>생성 일자</td></tr>
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
</tbody>
</table>

<table style="display: none" class="gray_line_top_bottom" id="serverState">
<!--<tbody id="serverState">
<tr  class="background_gray">
  <td style="text-align: left" colspan='2'>(서버이름)</td>
  <td style="text-align: right"><div id="serverStateClose">X </div></td>
</tr>
<tr  ><td>상태</td><td>running?</td><td><form>실행 버튼들</form></td></tr>
</tbody> -->
</table>


</body>


</html>
