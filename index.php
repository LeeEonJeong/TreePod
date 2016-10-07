<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8"/>

<style>

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
include_once('head2.php');
include_once('api_constants.php');
include_once('./callAPI.php');
include_once('var_dump_enter.php');
//include('alert.html');
?>
<br/>
<h1>화면 만들기 너무 귀찮다 세상에.......</h1>
<!--<button class="button" onclick="Alert.render('서버 신청','dfdfd')">Custom Alert</button>-->  
</body>


</html>
