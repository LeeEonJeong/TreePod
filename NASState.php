

<?php
include('api_constants.php');
include ('./callAPI.php');
include('var_dump_enter.php');
?>
<?php

$URL = "https://api.ucloudbiz.olleh.com/server/v1/client/api?";
$URL_NAS = "https://api.ucloudbiz.olleh.com/nas/v1/client/api?";
$listProductcmdArr = array(
    "command" => "listVirtualMachines",
    "apikey" => API_KEY
);
$result = callCommand($URL, $listProductcmdArr, SECERET_KEY);
//var_dump_enter($result);

$result_num = $result['count'];
$result = $result['virtualmachine'];
//var_dump_enter($result['1']);
$temp;
for($i=0; $i<$result_num; $i++){
  if($result_num != '1' ) {
    $temp = $result[$i];
  }else {
    $temp = $result;
  }
  if($temp['displayname']==$_POST['displayname']){
    break;
  }
}
?>

<tr class="background_gray">
  <td style="text-align: left" colspan='2'><b><?=$_POST['displayname']?></b></td>
  <td style="text-align: right"><div id="serverStateClose" onclick="stateClose()">X </div></td>
</tr>
<tr>
  <td><b>IP</b></td><td>사용량</td><td>전체크기</td><td>autosize</td>
</tr>
<tr>
  <td><?=$temp['ip']?></td>
  <td><?=$temp['usedsize']?></td>
  <td><?=$temp['totalsize']?></td>
  <?php
  if($temp['autoresize']=='false'){ ?>
    <td>지원 안함</td>
  <?php
  } else{  ?>
    <td><script>makeByteToGB('<?=$temp['incrementsize']?>')</script> / <script type="text/javascript">makeByteToGB('<?=$temp['maxsize']?>')</script></td>
  <?php
  }
  ?>
</tr>
<tr>

<td>
<form method="post" id="server_state_form">
<input type='hidden' name='id' value='<?= $temp['id']?>'/>
<input type='hidden' name='network_id' value='<?= $temp['network_id']?>'/>
<input type='button' class='button' value='변경 요청'/>
<input type='button' class='button' value='삭제'/>
</form>
</td>
</tr>