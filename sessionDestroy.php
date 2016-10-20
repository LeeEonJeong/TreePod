<?php 
include('customAlert.html');
	session_start();
	session_destroy();
	foreach($_COOKIE as $key=>$val){ 
	 setCookie($key,"",time()-1800); 
// $temp = $_COOKIE[$key];
// 	echo $key;
 //	echo "<script>alert(getCookie('".$key."'));</script>";
}
?>

<!--<button class="button" onclick="Alert.render('Logout','로그아웃 하셨습니다.')">Custom Alert</button> -->

<script>
//if(Alert.render('Logout','로그아웃 하셨습니다.')==true){
	
var loca = function(){
	location.replace('login_notice.php');
}
	Confirm.render('LOG OUT','정상적으로 로그아웃 하셨습니다.',loca,'','no');
//	alert("Log out!");
//}
</script>