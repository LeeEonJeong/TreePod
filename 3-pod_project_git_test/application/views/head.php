<!DOCTYPE html>
<html>
<head>
<!-- http://fontawesome.io/3.2.1/icons/ -->
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="/static/lib/bootstrap/css/bootstrap.min.css"	rel="stylesheet" media="screen">
<link href="/static/lib/bootstrap/css/bootstrap-responsive.css" rel="stylesheet">
<link href="/static/css/style.css"	rel="stylesheet"> 
<script src="//code.jquery.com/jquery.min.js"></script>
<script src='/static/lib/bootstrap/js/bootstrap.min.js'></script>
<script src='/static/js/common.js'></script> 
</head>

<body>
<?php 
	
?>
<script>
$(
		//asdf
	function(){	
		 var action; 

// 		 $('#alertmsg').append($('<li></li>').css('background-color','#fff2e6').html("클라우드 서버 생성완료<br>"));
// 		 $('#alertmsglink').css('background-color','#ffcccc');
		 
		 function checkAlarm(){
			  if(<?php if(isset($_SESSION['alarmcheck'])){echo 1;}else{echo 0;}?>){
				vmname = "<?php if(isset($_SESSION['vmname'])){echo $_SESSION['vmname'];} ?>";
				vmpwd = "<?php if(isset($_SESSION['vmpwd'])){echo $_SESSION['vmpwd'];} ?>";

				$('#alertmsglink').css('background-color','#ffcccc');
				$('#alertmsg').append($('<li></li>').css('background-color','#fff2e6').html("<a href='/cloudlist'>클라우드 서버 생성완료<br><span style='color:blue'>"+vmname+"</span>의 비밀번호는 <span style='color:red'>"+vmpwd+"</span>입니다</a>"));
			  }
		 }
		 
		 function checkJobid(){
			 $.ajax({
					type:'GET',
					url:'/asyncProcess/getSessionJobid',
					success : function(data){
						if(data=='noexist'){
						}else{
							queryAsyncProcess(data);
						}
					},
					error : function(){ 
					}
			 }); 
		 }
		 checkAlarm();//reload될때
		 
		 function start(){
			 action = setInterval(checkJobid,5000);
		 } 
	
		 function queryAsyncProcess(jobid){
			 $.ajax({
					type:'GET',
					url:'/asyncProcess/queryAsyncJobResult2/'+jobid,
					dataType: 'json', 
					success : function(data){
// 						 showObj(data); 
						 if(data==null)
							 return;
						 if(data.jobstatus == 1){
							 $.ajax({
									type:'GET',
									url:'/asyncProcess/unsetSessionJobid',
									success : function(){
// 										 alert('jobid세션삭제');
									},
									error : function(){
									}
							 }); 
							 for(key in data.jobresult){
								 if(key == 'virtualmachine')
								 {
									 vm = data.jobresult.virtualmachine;
									 password = vm.password;
									 vmname = vm.displayname; 
									 setModalMsg("클라우드 서버 생성완료<br>상태알림에서 비밀번호 확인<br><h5 style='color:red'>상태확인 링크를 누르면 다시보기 불가</h5>").modal();
									 $('#alertmsg').append($('<li></li>').css('background-color','#fff2e6').html("<a href='/cloudlist'>클라우드 서버 생성완료<br><span style='color:blue'>"+vmname+"</span>의 비밀번호는 <span style='color:red'>"+password+'</span>입니다</a>'));
									 $('#alertmsglink').css('background-color','#ffcccc');
									 setSessionValue('alarmcheck','false');
									 setSessionValue('vmname',vmname);
									 setSessionValue('vmpwd',password);
								 }
							 } 
						 }else{
// 							 alert('setinterval query Async 결과');
// 							 showObj(data);
						 }
					},
					error : function(){
					}
			}); 
		 }

		 start(); 

		 function setSessionValue($key, $value){
			 $.ajax({
					type:'GET',
					url:'/asyncProcess/setSessionValue/'+$key+'/'+$value,
					success : function(){
					},
					error : function(){ 
					}
			 }); 
		 } 
		 function unsetSessionValue($key){
			 $.ajax({
					type:'GET',
					url:'/asyncProcess/unsetSessionValue/'+$key,
					success : function(){
					},
					error : function(){ 
					}
			 }); 
		 } 

		 $('#alertmsglink').click(
				 function(){
					 $('#alertmsglink').css('background-color','');
// 					 $.each($('#alertmsg').children(), function(){ 
// // 						 $(this).css('background-color','');
// 					 });
					unsetSessionValue('alarmcheck');
					unsetSessionValue('vmname');
					unsetSessionValue('vmpwd');
				 }
		 );
// 		 function stop(){
// 		  setTimeout(function() {
// 		   clearInterval(action); // interval 함수 타이머 종료
// 		  }, 3000);
// 		 } 
});
</script>



<?php if($this->session->flashdata('message')) { 
	//echo "message : ".$this->session->flashdata('message');?>
		<script>
			alert("<?= $this->session->flashdata('message')?>");
		</script>
<?php }?>
 <div class="navbar">
		<div class="navbar-inner navbar-fixed-top">
			<div class="container-fluid">
				<!-- .btn-navbar is used as the toggle for collapsed navbar content -->
				<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
				        <span class="icon-bar"></span>
				        <span class="icon-bar"></span>
				        <span class="icon-bar"></span>
				</a>
				 
				<!-- Be sure to leave the brand out there if you want it shown -->
      			<a class="brand" href="/">Cloud Console</a>
      			
      			<!-- Everything you want hidden at 940px or less, place within here -->
      			<div class="collapse nav-collapse"> 
      			  <ul class="nav pull-right">
		        	<?php
		        		if($this->session->userdata('is_login')){
		        	?>
		        	  <li class="dropdown"> 
						  	<a id = 'alertmsglink' class="dropdown-toggle" href='#' data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
						    	<i class="icon-bell" ></i>상태알림
						  	</a>
							<ul class="dropdown-menu" id='alertmsg'>
							</ul>
					  </li> 
					  <li class="dropdown"> 
						  	<a class="dropdown-toggle" href='#' data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
						    	<i class="icon-user"></i><?=$_SESSION['nickname']?><span class="caret"></span>
						  	</a>
							 <ul class="dropdown-menu">
							 	<li><a href="/auth/logout">로그아웃</a></li>
								   <li role="separator" class="divider"></li>
								<li><a href="/cloudlist">클라우드리스트</a></li>
								<li><a href="/volumelist">디스크볼륨</a></li>
								<li><a href="/networklist">네트워크</a></li>
								<li><a href="/naslist">NAS볼륨</a></li>
							 </ul>
					  </li> 
		        	<?php
		        	} else {
		        	?>
			        		<li><a href="/auth/register"><i class="icon-user"></i> SIGN UP</a></li>
			        		<li><a href="/auth/login"><i class="icon-hand-right"></i> LOGIN</a></li>
			        	 
		        	<?php
		        	}
		        	?>   
		      	 </ul>
				</div>
		 </div>
	</div>
</div>

<script>
	$(
		function(){
			where = $('#where').text();
			if(where=='cloudlist'){ 
				$('.nav-tabs #cloudlist').css('background-color',' #f4f4f4');
			}else if(where=='network'){
				$('.nav-tabs #network').css('background-color',' #f4f4f4');
			}else if(where=='diskvolume'){
				$('.nav-tabs #diskvolume').css('background-color',' #f4f4f4');
			}else if(where=='nasvolume'){
				$('.nav-tabs #nasvolume').css('background-color',' #f4f4f4');
			}  
		} 
 	);
</script> 

<br><br>
		<ul class="nav nav-tabs" id='menuTab'  role="tablist" >
		  <li id='cloudlist'> <a href="/cloudlist">클라우드리스트</a></li>
		  <li id="diskvolume" ><a href="/volumelist">디스크볼륨</a></li>
		  <li id='network'  ><a href="/networklist">네트워크</a></li>
		  <li id="nasvolume"><a href="/naslist">NAS 볼륨</a></li>
   		</ul> 
   		 
 <!-- 로딩중 띄워주는 모달 -->
<div class="modal fade" id='loadingModal'role="dialog">
    <div class="modal-dialog">  
        <div class="modal-body">
        	<div class='modal-center'>
        	 <img src='/images/circleloading.gif' alt='잠시만..' />
        	 <br><br>
        	 	<h5>잠시만 기다려 주세요</h5>
        	 	<span id='result'></span>
        	</div>
        </div> 
    </div>  
</div>

 <!-- 경고 띄워주는 모달 -->
<div class="modal fade" id='msgModal' role="dialog">
    <div class="modal-dialog">   
        <div class="modal-body">
       		<button type="button" class="close" data-dismiss="modal">&times;</button> 
        	<h3 class='modal-center' id="msg">
        	</h3>
        </div> 
    </div>  
</div>  

<div class="container-fluid">
	<div class="row-fluid"> 