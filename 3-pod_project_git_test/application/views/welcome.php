<div class="hero-unit">
  <h1>EonJeong's cloud console</h1> <br> 
  <p>
  	This is eonjeong's cloud console. Welcome! 	<a class="btn btn-primary btn" href='/cloudlist'>START</a>
  </p>
  <br>
  <h4 style='color: #08c'>이용중인 상품 정보</h4> 
  <div class="container-fluid">
  	<div class="row-fluid">
  		<div class="span4">
			<h4>ucloud server</h4> 
			<table class='table-striped'  style="width:100%">
				<tr>
					<td style="width:90%">서버 대수</td>
					<td id='vmCount' style="width:10%"><?=$account['vmtotal']?></td>
				</tr>
				<tr>
					<td><span style='color:blue'>동작</span>중인 서버</td>
					<td><?=$account['vmrunning']?></td>
				</tr>
				<tr>
					<td><span style='color:red'>정지</span>된 서버</td>
					<td><?=$account['vmstopped']?></td>
				</tr> 
				<tr>
					<td  style="width:90%" >추가 디스크 개수</td>
					<td style="width:10%"><?=$account['iptotal']?></td>
				</tr> 
				<tr>
					<td>추가 IP 개수</td>
					<td><?=$addIpCount?></td>
				</tr>  
			</table>
		</div>
		<div class="span4 offset1">
			<h4>ucloud NAS</h4> 
			<table class='table-striped'  style="width:100%">
					<tr>
						<td style="width:90%">볼륨개수</td>
						<td id='vmCount' style="width:10%"><?=$nasVolumeCount?></td>
					</tr>
					<tr>
						<td>NAS CIP 개수</td>
						<td><?=$nasCIPCount?></td>
					</tr>
			</table>
		</div> 
	</div> 
  </div>  
</div>