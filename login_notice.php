<?php
$server_root_path = $_SERVER['DOCUMENT_ROOT'];// ini_set('include_path',$server_root_path);
include_once($server_root_path.'/includeFiles.php');
include_once($server_root_path.'/'.CLOUD_PATH.'customAlert/customAlert.html');
?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="/<?=CLOUD_PATH?>include/design.css">
<link rel="stylesheet" type="text/css" href="/<?=CLOUD_PATH?>include/menu_design.css">
<link rel="stylesheet" type="text/css" href="/<?=CLOUD_PATH?>alertBar/alert_bar_design.css">
	<meta charset="utf-8"/>
	<title></title>
	<script src="//code.jquery.com/jquery.min.js"></script>
	<script type="text/javascript">
		$(window).load(function(){
			var height_size = window.outerHeight;
			height_size = (height_size-100)/2-80;
			//alert(height_size);
			$('.login_box').css('margin-top',height_size+'px');
		});
		$(window).resize(function(){
			var height_size = window.outerHeight;
			height_size = (height_size-100)/2-80;
			//alert(height_size);
			$('.login_box').css('margin-top',height_size+'px');
		});
		function login_submit(){
			var login=document.getElementById('login_form');
		//	alert(login.id.value);
			if(login.id.value==""){
				Alert.render('Log In','아이디를 입력해주세요.','default');
				return false;
			}
			if(login.pw.value==""){
				Alert.render('Log In','비밀 번호를 입력해주세요.','default');
				return false;
			}
			login.action='login_submit.php';
			login.submit();
		}
	</script>

</head>
<body>

<div  class="login_container">
<table class="login_box noline noHover" >
<tbody>
<form id='login_form' method='post'>
<tr>
	<td><b>ID</b></td>
	<td><input type='text' name="id" class='transparent' tabindex='1'/></td>
	<td rowspan="2">
		<input type="button" class="button" value="Log In" tabindex='3' onclick="login_submit()"/></td>
</tr>
<tr>
	<td><b>PW</b></td>
	<td><input type='password' name="pw" class='transparent' tabindex='2'/></td>
</tr>
</form>
</tbody>
</table>
</div>
</body>
</html>