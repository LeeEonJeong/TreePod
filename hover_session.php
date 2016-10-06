<?php session_start();?>

<div class='view'>계정 비밀번호 보기</div>
<div id="password">
</div>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
	$(".view").mouseover(function(event){
		var xhr = new XMLHttpRequest();
  		xhr.open('GET','view_password.php');
 		xhr.onreadystatechange = function(){
    		if(xhr.readyState === 4 && xhr.status === 200) {
    		//	document.querySelector('.password').innerHTML = xhr.responseText;
	    		document.getElementById("password").innerHTML = xhr.responseText;	
    		}
  		}
	  	xhr.send();
	//	$(".view").css("background-color", "yellow");
	//	document.getElementById("password").innerHTML="aaa";
	});	
	$(".view").mouseout(function(){
        document.getElementById("password").innerHTML="";
    });
});
</script>
