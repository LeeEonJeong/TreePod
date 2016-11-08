 <script>
$(
		function(){ 
			$('#addIPbtn').click(
					function(){
						selectzoneid = $("#zonename option:selected").val();
						usageplantype = $(':radio[name="usageplantype"]:checked').val(); 

						$('#addIPModal').modal('hide');
						if(selectzoneid == 'all'){ 
							setModalMsg('존을 선택하세요.').modal(); 
						}else{
							$.ajax({
								type:'GET',
								url:'/networklist/associateIpAddress/'+selectzoneid+'/'+usageplantype,
								dataType: 'json',
								success : function(data){
									 if(data.jobid){
									 	async(data.jobid,'ADD IP');
									 }else{
										setModalMsg('ADD IP 실패').modal();
									 } 
								},
								error : function( ){  
									 setModalMsg('ADD IP 실패(error)').modal();
								}
							});  
						}
					}
			); 
});  
</script>

<!-- disconnect cip modal  -->
<div class="modal fade" id='addIPModal' role="dialog">
  <div class="modal-dialog">
	  <div class="modal-content">
	      <div class="modal-header"> 
	        <h4 class="modal-title">IP 추가신청</h4>
	      </div>
	      <div class="modal-body">
	     	<h5>IP Zone 선택</h5>
	     	<p>
		      	<select id='zonename'>
				   					<option value='all'>존을 선택하세요.</option>
									<option value="eceb5d65-6571-4696-875f-5a17949f3317">KOR-Central A</option>
									<option value="9845bd17-d438-4bde-816d-1b12f37d5080">KOR-Central B</option>
									<option value="dfd6f03d-dae5-458e-a2ea-cb6a55d0d994">KOR-HA</option>
									<option value="95e2f517-d64a-4866-8585-5177c256f7c7">KOR-Seoul M</option>
									<option value="3e8ce14a-09f1-416c-83b3-df95af9d6308">JPN</option>
									<option value="b7eb18c8-876d-4dc6-9215-3bd455bb05be">US-West</option>
				</select>
			</p>
			<h5>IP 요금제 선택</h5>
			<p>
				<label class="radio-inline">
					<input type="radio" name="usageplantype" value="hourly" checked >시간요금제
				</label>
				<label class="radio-inline">
					<input type="radio" name="usageplantype" value="monthly">월요금제
				</label>
	      	</p>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	         <input type="button" class="btn btn-primary" id="addIPbtn"class="btn" value="신청"/>
	      </div>
	    </div> 
	</div>
</div>