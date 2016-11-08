<script>
$(
	function(){ 
		$('#orderbtn').click(function(){  
			name = $('#nasvolumename').val();
			path = $('#mountPath').val();
			totalsize = parseInt($('#standardcapacity').text()) + parseInt($('#addcapacity').val());
			volumetype = $(':radio[name="protocol"]:checked').val();
			zoneid = $('#zonename option:selected').val();
			usageplantype = $(':radio[name="usageplantype"]:checked').val();
			
			orderdata = 
			{
				'name' : name,
				'path' : path,
				'totalsize' : totalsize,
				'volumetype' : volumetype,
				'usageplantype' : usageplantype,
				'zoneid' : 	zoneid
			}  
			
			showLoadingModal();
			 $.ajax({
					type : "POST",
					url: '/orderNas/addVolume',
					data : orderdata,
					dataType : 'json',
					success : function(data)
					{  
						if(data ==null){
							alert('nas생성실패');
							return;
						}
// 						showObj(data);
						if(data.errortext){ 
							setModalMsg(data.errortext).modal();
						}
						else if(data.status == 'success'){
							//oderNas 콘트롤러에서 처리
// 							 volume = data.response;
							 location.href='/naslist';
// 							 setModalMsg(volume.name+"("+volume.volumetype+")"+"생성 되었습니다.").modal(); 	  
						}
					},
					error : function(){  
						setModalMsg('NAS 생성 실패(error)').modal();
					},
					complete : function(){
// 						setTimeout(function(){},3000); //3초있다가
						$('#loadingModal').modal('hide'); 
					}
			});	
		}); 
});  
</script>
<div id='result'class="span12">
			<h3 style='text-align:center; color:#08c'>NAS볼륨생성</h3>
			<br>
			  	<table class='table ordertable' id='nasvolumeorder_table'>
			   		<tr>
			   			<td class='subtitle'>위치</td>
			   			<td>
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
			   		<tr>
			   			<td class='subtitle'>볼륨명</td>
			   			<td><input type="text" id="nasvolumename" /></td>
<!-- 			   			<td><input type="button" class='btn' value="중복확인"/></td> -->
			   		</tr> 
			   		<tr>
			   			<td class='subtitle'>요금제 선택</td>
				   		<td>
					   		<label class="radio-inline">
					   			<input type="radio" name="usageplantype" id="hourly" value="hourly" checked>&nbsp시간요금제
					   			&nbsp&nbsp&nbsp
								<input type="radio" name="usageplantype" id="montly"value="monthly">&nbsp월요금제
							</label>
				   		</td>
			   		</tr>
			   		<tr>
			   			<td class='subtitle'>기본용량</td>
			   			<td ><span id="standardcapacity" style='display: none'>1000</span> 1,000 GB </td>
			   		</tr> 
			   		<tr>
			   			<td class='subtitle'>추가용량</td>
				   		<td><input id="addcapacity"type="text" value="0"/></td>
			   		</tr>
			   		<tr> 
			   			<td class='subtitle'>프로토콜</td>
				   		<td>
				   			<label class="radio-inline">
					   			<input type="radio" name="protocol" id="NFS" value="nfs" checked >&nbspNFS
					   		 	&nbsp&nbsp&nbsp
					   			<input type="radio" name="protocol" id="CIFS" value="cifs" >&nbspCIFS
					   			&nbsp&nbsp&nbsp
					   			<input type="radio" name="protocol" id="iSCSI" value="iSCSI" >&nbspiSCSI (이거안됨)
					   	 	</label>
				   		</td>
			   		</tr>
			   		<tr>
			   			<td class='subtitle'>mount Path</td>
			   			<td>
				   			 <input type="text" id="mountPath"/>
				   		</td> 
			   		</tr>
			   		<tr >
			   			<td colspan="2" id='buttons'>
			   				<input style="width:45%;" onclick="window.location.replace('/naslist');" class="btn" value='취소'/>
			   				<input style="width:45%;"  type="button" id="orderbtn"class="btn" value="신청"/>
			   			</td>
			   		</tr>
			 	</table>  
</div>