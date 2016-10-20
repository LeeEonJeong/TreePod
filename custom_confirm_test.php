<!DOCTYPE html>
<html>
<head>
<script> //익명함수 스크립트 추가.
	myFunc = function(){
		alert('햐랴랴');
	}	
</script>
</head>
<body>
<?php 

include_once('customAlert.html');

?> // 이부분만 추가
<button onclick="Confirm.render('Delete Post?','짜짜루?',myFunc,'','no')">Delete</button>
</body>
</html>


<script>
	var loca = function(){
		location.replace('listFireWallRules.php');
	}
	var err_info = function(){
		history.back();
	}
</script>
<?php

if(session_push('processID',$result['jobid'])){
	echo "<script>Confirm.render('???','삭제 신청이 완료 되었습니다',loca,'','no')</script>";
//	echo "<script>alert('방화벽 삭제 신청이 완료 되었습니다.')</script>";
//	echo "<script></script>";
} else {
	echo "<script>Confirm.render('???','오류가 발생했습니다!',err_info,'','no')</script>";
//		echo "<script>history.back(); </script>";
}

?>