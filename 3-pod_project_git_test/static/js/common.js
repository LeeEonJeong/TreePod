function showObj(obj){
			var str="";
			for(key in obj){
				str  += key+"="+obj[key]+"\n";
			}
			alert('showObj\n'+str);
			return;
}; 
		 
function setModalMsg(msg){ 
	 $('#msgModal #msg').empty();
	 $('#msgModal #msg').html(msg);
	 return $('#msgModal');
} 

function showLoadingModal(){
	$('#loadingModal').modal({backdrop:"static", keyboard:false}); 
}

function async(jobid, processname,reload=true){
		if(jobid==null){
			return 'error';
		}else{
		 showLoadingModal();
		 $.ajax({
			 type:'GET',
			 url:'/asyncProcess/queryAsyncJobResult/'+jobid,
			 dataType:'json',
			 success : function(data){ 
				 //showObj(data);
				 if(data==null){
					 return;
				 }
				 if(data.jobstatus==1){
				 	//showObj(data.jobresult);
				 	//alert(data.jobresult);
			 	 }
				 if(data === 'error'){ 
//					 setModalMsg(processname + '실행이 실패하였습니다..(aync)').modal();
				 }else{
					 return data;
				 }
			 },
			 error:function(){ 
//				 setModalMsg(processname + '실행이 실패하였습니다..(aync)').modal(); 
			 },
			 complete:function(){
				 $('#loadingModal').modal('hide');
				 if(reload){
					 setTimeout(
							  function() 
							  {
							    //do something special
							  }, 2000);
					 window.location.reload();
				 }
			 }
		 });
		}
}  
 