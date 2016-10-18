<?php 
include_once('api_constants.php');
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8"/>
<link rel="stylesheet" type="text/css" href="design.css">
<link rel="stylesheet" type="text/css" href="menu_design.css">
<link rel="stylesheet" type="text/css" href="alert_bar_design.css">
<script>
function makeByteToGB(byte){
  byte = Number(byte);
  return (byte/1024/1024/1024).toFixed(2) + " GB";
}

function resizeNASVolume(th){
  var td = document.getElementById('totalsize');
  var ori = td.innerHTML
  ori = ori.replace(/[^0-9]/g,'');
  ori = ori/100;
  td.innerHTML="";
//  alert(td.chlidNodes);
  var form = document.createElement('form');
  form.setAttribute('id','resize_form');
  form.setAttribute('method','post');
  form.setAttribute('action','test.php');
  var input_total_size = document.createElement('input');
  input_total_size.setAttribute('type','number');
  input_total_size.setAttribute('class','transparent');
  input_total_size.setAttribute('value',ori);
  input_total_size.setAttribute('name','totalsize');
  form.appendChild(input_total_size);

  var input_id = document.createElement('input');
  input_id.setAttribute('type','hidden');
  input_id.setAttribute('name','id');
  input_id.setAttribute('value',document.getElementById('NAS_state_form').id.value);
  form.appendChild(input_id);

  td.appendChild(form);
 // alert(th);
  th.style.display='none';
  document.getElementById('submit_resize').style.display='inline';
}

function resizeSubmit(){
	var form = document.getElementById('resize_form');
	form.action='updateNAS.php';
	form.method='post';
  Alert.render('NAS','크기 변경 진행중....','');
	form.submit();
}

function stateClose(){
  document.getElementById('NASState').style.display="none";
}

function NASAttachSubmit(){
  var form = document.getElementById('NAS_connect_form');
  form.action='NASAttach.php';
  form.method='post';
  Alert.render('NAS','서버 연결 진행중...','');
  form.submit();
}

function NASDettachSubmit(){
  var form = document.getElementById('NAS_connect_form');
  form.action='NASDettach.php';
//  form.action='test.php';
  form.method='post';
  Alert.render('NAS','서버 연결 진행중...','');
  form.submit();
}
  function showNASState(t){
    var postVal = t.innerHTML;
    var xhr = new XMLHttpRequest();
    xhr.open('POST','NASState.php');
    xhr.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
    var data = 'name='+postVal;
    xhr.send(data);
    xhr.onreadystatechange = function(){
        if(xhr.readyState === 4 && xhr.status === 200) {
        	var temp_text = xhr.responseText;
     //   	alert(temp_text);
          document.getElementById('NASState').innerHTML = xhr.responseText;
          var size_array = temp_text.split("<size>"); 
        //  alert(size_array[1]);
        	document.getElementById('usedsize').innerHTML = makeByteToGB(size_array[1]);
        	document.getElementById('totalsize').innerHTML = makeByteToGB(size_array[3]);
        //	alert(size_array.length);
        	if(size_array.length != 5) {
        		document.getElementById('autoresize').innerHTML = makeByteToGB(size_array[5]) + "/" + makeByteToGB(size_array[7]);
        	}
        }
      }
    document.getElementById('NASState').style.display = 'table';
  }

function showNasConnect(num){
    var postVal = document.forms[num].id.value;
    var xhr = new XMLHttpRequest();
    xhr.open('POST','NASConnectState.php');
    xhr.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
    var data = 'id='+postVal;
    xhr.send(data);
    xhr.onreadystatechange = function(){
        if(xhr.readyState === 4 && xhr.status === 200) {
          var temp_text = xhr.responseText;
     //     alert(temp_text);
          document.getElementById('NASState').innerHTML = xhr.responseText;
        }
      }
    document.getElementById('NASState').style.display = 'table';
}

</script>
<style>
table,tr,td{
    border: 1px solid black;
    border-collapse: collapse;
}
</style>
<?php
include_once('customAlert.html');
include_once('./callAPI.php');
include_once('var_dump_enter.php');
?>

</head>
<body>
<?php
include_once('head2.php');
?>
<br/>
<table  class="noline hoverOn">
<tbody id="myVM"><!-- onmouseover='renewMyServer()'>-->
<tr class="background_gray"><td>NAS 이름</td><td>타입</td><td>지역</td><td>생성일자</td><td>내 서버 연결 </td><td>-</td></tr>
<?php

$URL = "https://api.ucloudbiz.olleh.com/server/v1/client/api?";
$URL_NAS ="https://api.ucloudbiz.olleh.com/nas/v1/client/api?";
$listProductcmdArr = array(
    "command" => "listVolumes",
    "status" => "online",
    "apikey" => API_KEY
);
$zoneCmdArr = array(
	"command" => "listZones",
	"apikey" => API_KEY
);
$result = callCommand($URL_NAS, $listProductcmdArr, SECERET_KEY);
//var_dump_enter($result);

$result_num = $result['count'];
if($result_num != 0)
	$result = $result['response'];
//var_dump_enter($result['1']);

for($i=0; $i<$result_num; $i++){
  if($result_num != '1' ) {
    $temp = $result[$i];
  }else {
    $temp = $result;
  }

  if($temp['status']!='online') continue;
  $zoneCmdArr['id'] = $temp['zoneid'];
  $zoneResult = callCommand($URL, $zoneCmdArr, SECERET_KEY);
//  var_dump_enter($zoneResult);
  echo "<tr><td class='view' onclick='showNASState(this)'>";
  echo $temp['name'];
  echo "</td> <td>";
  echo $temp['volumetype'];
  echo "</td> <td>";
  echo  $zoneResult['zone']['name'];
  echo "</td> <td>";
  echo $temp['created'];
  echo "</td><td>";
  echo "<input type='button' class='button2' value='조회하기' onclick=\"showNasConnect('".$i."')\"/>";
  echo "</td> <td><form method='post' action='deleteNAS.php'><input type='hidden' name='id' value='".$temp['id']."'/><input type='submit' class='button' value='삭제'/></form>";
  echo "</td> </tr>";

}

?>
</tbody>
</table>

<table style="display: none" class="gray_line_top_bottom" id="NASState">
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
