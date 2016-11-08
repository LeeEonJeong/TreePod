 <script>
$(
	function(){
		
		$("#zonename").change( 
			function(){ 
			    	zoneid = $('#zonename option:selected').val();
			    	$('#package').empty(); //내용비움
			    	$('#os').empty();
					$('#serviceoffering').empty();
					$('#producttype').text('');
					$('#diskofferingid').empty();
					$('#diskoffering').empty();
					$(':radio').prop('checked',false);
					
				    $.ajax({
						type : "GET",
						url: '/orderCloud/getPackagesByZoneid/'+zoneid,
						dataType : 'json',
						success : function(obj)
						{
							for(var i=0; i<obj.length; i++){ 
								$('#package ').append(
									$('<input/>').attr({
												type:'button',
												id:obj[i],
												value:obj[i],
												name:'packagebtn',
												class:'btn',			 
									})
								); 
								 
								$('#'+obj[i]).click(
									function(){
										$('#os').empty();
										$('#serviceoffering').empty();
										$('#diskofferingid').empty();
										$('#diskoffering').empty();
										$(':radio').prop('checked',false);
										//alert($(this).val());
										$('#producttype').text($(this).val());
								 
										$.ajax({
											type : "GET",
											url: '/orderCloud/getOSlist/'+zoneid+'/'+$(this).val(),
											dataType : 'json',
											success : function(oslist)
											{
// 												showObj(oslist);
												$('#os').append("<option>운영체제를 선택하세요. </option>");
												for(i=0; i<oslist.length; i++){
													$('#os').append("<option value='"+oslist[i]['templateid']+"'>"+oslist[i]['templatedesc']+"</option>");
												}
											},
											error : function( ){  
												alert('실행실패'); 
											}
										}); 				 
								});
							}//for문
						},
						error : function( ){  
							alert('실행실패');
							$('#package').empty(); //내용비움
						}
					});
			});//zonename change될때
				
		$("#os").change(
				function(){
					producttype = $('#producttype').text();
					osid = $('#os option:selected').val();
					zoneid = $('#zonename option:selected').val();
					 
					$.ajax({
						type : "GET",
						url: '/orderCloud/getServiceOfferinglist/'+zoneid+'/'+producttype+'/'+osid,
						dataType : 'json',
						success : function(serviceoffering)
						{
// 							alert(disklist);
							$('#serviceoffering').empty();
							$('#serviceoffering').append("<option>서버사양 선택하세요. </option>");
							for(i=0; i<serviceoffering.length; i++){
								$('#serviceoffering').append("<option value='"+serviceoffering[i]['serviceofferingid']+"'>"+serviceoffering[i]['serviceofferingdesc']+"</option>");
							}
						},
						error : function( ){  
							alert('실행실패'); 
						}
					});
				}
		);

		$("#serviceoffering").change(
				function(){
					producttype = $('#producttype').text();
					osid = $('#os option:selected').val();
					zoneid = $('#zonename option:selected').val();
					serviceofferingid = $('#serviceoffering option:selected').val();
					 
					$.ajax({
						type : "GET",
						url: '/orderCloud/getDiskOfferinglist/'+zoneid+'/'+producttype+'/'+osid+'/'+serviceofferingid,
						dataType : 'json',
						success : function(diskoffering)
						{
							for(i=0; i<diskoffering.length; i++){
								if(diskoffering[i]['diskofferingid']){
									$('#diskofferingid').html('('+diskoffering[i]['diskofferingdesc']+')');
									$('#diskofferingid').val(diskoffering[i]['diskofferingid']);
								}else{
									$('#diskoffering').html('('+diskoffering[i]['diskofferingdesc']+')');
								}
							}
						},
						error : function( ){  
							alert('실행실패'); 
						}
					});
				}
		);

		

			
	$('#servername :button').click(function(){
		checkname = $('#servername td input:text').val(); 
		$.ajax({
			type : 'GET',
			url : "/orderCloud/checkVirtualMachineName/"+ checkname,
			success : function(data){ 
				if(data.toLowerCase().trim() === 'true')
					result = true;
				else
					result = false; 
				
				resulttext = $('#servername span');//asdf
				if(result){
					resulttext.text('사용할 수 있는 서버명입니다.');
					resulttext.css('color','green');
				}else{
					resulttext.text('사용할 수 없는 서버명입니다.');
					resulttext.css('color','red');
				} 
			},
			error : function(){
				alert('실행실패');
			}
		});
	});

	$('#orderbtn').click(function(){
		servername = $('#servername td input:text').val();
		hostname = $('#hostname td input:text').val();
		zoneid = $('#zonename option:selected').val();
// 		producttype = getProductType($('#producttype').text());
		osid = $('#os option:selected').val();
		serviceofferingid = $('#serviceoffering option:selected').val();
	 	rootonly = $(':radio[name="rootonly"]:checked').val();
	 	usageplantype = $(':radio[name="usageplantype"]:checked').val();
 	
	 	if(rootonly.toLowerCase().trim() === 'true')
	 		rootonly = true;
		else
			rootonly = false;
 
		if(rootonly){
			diskofferingid='';
		}else{
			diskofferingid=$('#diskofferingid').val();
		}

// 		alert(productcode);
// 		alert(producttype);
// 	 	alert(servername);
// 	 	alert(hostname);
// 	 	alert(zoneid);
// 	 	alert(os);
// 	 	alert(datadisk);
// 	 	alert(servername);
// 	 	alert(rootonly);	
// 	 	alert(usageplantype);

		orderdata = 
		{
			'displayname' : servername,
			'name' : hostname,
			'serviceofferingid' : serviceofferingid,
			'templateid' : osid,
			'diskofferingid' : diskofferingid,
			'zoneid' : zoneid,
			'usageplantype' : 	usageplantype
		}

		showLoadingModal();
		 
	 	$.ajax({
			type : "POST",
			url: '/orderCloud/orderVM',
			data : orderdata,
			dataType : 'json',
			success : function(data){
// 					showObj(data);
					if(data==null){
						alert('서버신청실패');
					}else if(data.jobid){
						$.ajax({
							type:'GET',
							url:'/asyncProcess/setSessionJobid/'+data.jobid,
							success:function(){
// 								alert('jobid세션등록성공');
							},
							error:function(){
// 								alert('jobid세션등록실패');
							}
						}); 
					}
						
						 
// 						if(jobids==null){
// 							$.session.set('jobid',data.jobid);
// 						}
						
// 						 $.ajax({
// 							 type:'GET',
// 							 url:'/asyncProcess/queryAsyncJobResult/'+data.jobid,
// 							 dataType:'json',
// 							 success : function(data){ 
// 								 showObj(data);
// 								 showObJ(data.jobresult);
// 								 if(data === 'error'){ 
// 									 setModalMsg('서버신청 (asnc)').modal();
// 								 }else{
// 									 $('#loadingModal').modal('hide'); 
// 									 vm = data.jobresult.virtualmachine;
// 									 password = vm.password;
// 									 vmname = vm.displayname;
// 									 setModalMsg("클라우드 서버 생성완료<br><span style='color:blue'>"+vmname+"</span>의 비밀번호는 <span style='color:red'>"+password+'</span>입니다').modal();
// 								 }
// 							 },
// 							 error:function(){ 
// 								 setModalMsg('서버신청 실패(error,async)').modal();
// 							 },
// 							 complete:function(){
// 								 $('#loadingModal').modal('hide'); 
// 								 window.location.href='/cloudlist';
// 							 }
// 						 });
					else{
						setModalMsg('서버신청 실패').modal();
					}
			},
			error : function( ){  
				setModalMsg('서버신청 실패(error)').modal();
			},
			complete : function(){
				$('#loadingModal').modal('hide'); 
				window.location.href='/cloudlist';
			}
		}); 				 
	 	
	});  
});  
</script>
<div id='result'class="span12">
<div>
				<h3 style='text-align:center; color:#08c'>SERVER 신청</h3>
				<br>
			   	<table class='table ordertable'>
			   		<tr id="servername">
			   			<td class='subtitle' style='width:25%'>서버명</td>
			   			<td> 
			   				<input type="text" id="servername"/>
			   				<input type="button" class='btn' value="중복확인"/>
			   				<span></span>
			   			</td>
			   		</tr>
			   		<tr id="hostname">
			   			<td class='subtitle'>호스트명</td>
			   			<td ><input type="text"/></td>
			   		</tr>
			   		<tr>
			   			<td class='subtitle'>위치</td>
			   			<td >
			   				<select id='zonename'>
			   					<option>존을 선택하세요.</option>
								<option value="eceb5d65-6571-4696-875f-5a17949f3317">KOR-Central A</option>
								<option value="9845bd17-d438-4bde-816d-1b12f37d5080">KOR-Central B</option>
								<option value="dfd6f03d-dae5-458e-a2ea-cb6a55d0d994">KOR-HA</option>
								<option value="95e2f517-d64a-4866-8585-5177c256f7c7">KOR-Seoul M</option>
								<option value="3e8ce14a-09f1-416c-83b3-df95af9d6308">JPN</option>
								<option value="b7eb18c8-876d-4dc6-9215-3bd455bb05be">US-West</option>
							</select>
			   			</td>
			   		</tr>
			   		<tr>
			   			<td class='subtitle'>패키지 선택(상품 종류)</td>
				   		<td>
					   		<span id='package'></span>
					   		<span id='producttype'></span>
				   		</td>
				   		
			   		</tr>
			   		<tr>
			   			<td class='subtitle'>운영체제 선택</td>
				   		<td  >
				   		 	<select id='os'> 
				   		 	</select>
				   		</td>
			   		</tr>
			   		<tr>
			   			<td class='subtitle'>서버사양 선택</td>
				   		<td >
				   		 	<select id='serviceoffering'> 
				   		 	</select>
				   		</td>
			   		</tr>
			   		<tr>
			   			<td class='subtitle'>데이터디스크</td>
			   			<td>
				   			<label class="radio-inline">			
				   				<input type="radio" name="rootonly" value='false'>&nbsp제공 <span id='diskofferingid' ></span>&nbsp&nbsp&nbsp
								<input type="radio" name="rootonly"  value='true'>&nbsp미제공 <span id='diskoffering'></span>
							</label>
				   		</td>
			   		</tr>
			   		<tr>
			   			<td class='subtitle'>요금제 선택</td>
				   		<td>
					   		<label class="radio-inline">
					   		 	<input type="radio" name="usageplantype" id="hourly" value="hourly" >&nbsp시간요금제 &nbsp&nbsp&nbsp
								<input type="radio" name="usageplantype" id="montly"value="monthly">&nbsp월요금제
							</label>
				   		</td>
			   		</tr>
			   		<tr >
			   			<td colspan="2" id='buttons'>
			   				<input style="width:45%;" onclick="window.location.replace('/cloudlist');" class="btn" value='취소'/>
			   				<input style="width:45%;"  type="button" id="orderbtn"class="btn" value="신청"/>
			   			</td>
			   		</tr>
			 	</table>  
	</div>
</div>
	