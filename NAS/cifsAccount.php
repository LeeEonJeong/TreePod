
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8"/>
<script src='cifs.js'>
</script>
<script>
  var deleteCIFS = function(t){
    t.method='post';
    t.action='cifsAccountDelete.php';
    t.submit();
  }
  function checkDeleteCIFS(t){
  //  alert(t);
    Confirm.render('CIFS Account',t.cifsId.value+'를 정말 삭제 하시겠습니까?',deleteCIFS,t,'use');

  }
  function changeCIFS(t, pw){

    if(pw.length < 8 || pw.length > 14){      
      Alert.render('CIFS ACCOUNT PW','  8자리 이상 14자리 이하로 입력해 주세요.','default');
      return false;
    }
    if(!isEnglihOrNumOrSpecailLetters(pw)){
      Alert.render('CIFS ACCOUNT PW','영문 대 소문자, 숫자, 특수문자 ()-_.의 조합으로 구성해 주세요.','default');
      return false;
    }

    t.cifsPw.value = pw;
    t.method='post';
//    t.action='test.php';
    t.action='cifsAccountUpdate.php';
    t.submit();
  }
</script>

</head>

<body>
<?php
$server_root_path = $_SERVER['DOCUMENT_ROOT'];// ini_set('include_path',$server_root_path);
include_once($server_root_path.'/includeFiles.php');
include_once($server_root_path.'/'.CLOUD_PATH.'pageInclude/menuPageInclude.php');

/*
include_once('/'.CLOUD_PATH.'include/head2.php');      // head2.php  
include_once('/'.CLOUD_PATH.'include/callAPI.php');     // callAPI.php
*/
//$URL = "https://api.ucloudbiz.olleh.com/server/v1/client/api?";
$URL_NAS = "https://api.ucloudbiz.olleh.com/nas/v1/client/api?";
$cmdArr = array(
  "command" => "listCifsAccounts",
  "apikey" => API_KEY
);

$result = callCommandJSON($URL_NAS, $cmdArr, SECERET_KEY);

//var_dump_enter($result);
$result = $result['listcifsaccountsresponse'];
//exit;

$cmdArr = array(
  "command" => "listAccountForNas",
  "apikey" => API_KEY
);

$result2 = callCommand($URL_NAS, $cmdArr, SECERET_KEY);

//var_dump_enter($result2);
//var_dump_enter(isset($result2['response']['cifsworkgroup']));
/*


if($result['totalcount']==0){
  echo "<script>location.replace('cifsAccountCreate.php')</script>";
  exit;
}*/
//var_dump_enter($result);
if(!isset($result2['response']['cifsworkgroup'])) {
  $workGroup_name = 'none';
}
else if(!is_array($result2['response']['cifsworkgroup'])){
  $workGroup_name = $result2['response']['cifsworkgroup'];
} else {
  $workGroup_name = '';
}

?>
<table class="noline">
<tbody>
<tr class="background_gray">
  <td style="width: 50%; text-align: left;" ><b>Group</b></td>
  <td style="width: 50%; text-align: right;">
  <?php
  if(!isset($result2['response']['cifsworkgroup'])) { ?>
    <button class='button2' onclick="location.replace('cifsAccountCreate.php');">Work Group 생성하기</button>
<?php
  } else{ ?>
    <button class='button2' onclick="displayFrom('cifsGroup','cifsGroupNow')">그룹명 변경</button>
<?php
  }
?>
  </td>
</tr>
<tr id='cifsGroupNow'>
<td colspan="2">
<?php
if(!isset($result2['response']['cifsworkgroup'])) {
  echo "Work Group을 먼저 추가해 주세요.";
} else {
  echo $workGroup_name; 
}
?>
</td>
</tr>
<tr id='cifsGroup' style='display: none'>
<form method='post' action='cifsGroupUpdate.php'>
  <td  style="width: 80%;"><input class='transparent' name='cifsworkgroup' type='text' index=1 value='<?=$workGroup_name?>'/></td>
  <td style='width:20%'><button class='button2'>제출</button></td>
</form>
</tr>
</tbody>
</table>
<?php
//var_dump_enter($result2['response']['cifsworkgroup']);
if(isset($result2['response']['cifsworkgroup'])) { 
?>
<table class="noline">
<tbody>
<tr class="background_gray">
  <td style="width: 50%; text-align: left;" ><b>CIFS Account</b></td>
  <td style="width: 50%; text-align: right;" colspan='2'><button class='button2' onclick="newCIFS()">계정 추가</button></td>
</tr>
<?php
  for($i=0; $i<$result['totalcount']; $i++){?>
<tr>  
<form action='test.php' >
  <td style="width: 50%; text-align: left;" ><?= $result['response'][$i]?></td>
  <td style="width: 50%; text-align: right;">
    <input type='hidden' name='cifsId' value='<?= $result['response'][$i]?>'/>
    <input type='hidden' name='cifsPw' value=''/>
    <input type='button' class='button2' onclick="Prompt.render('CIFS PW','<?= $result['response'][$i]?> 계정의 새 비밀 번호를 입력해 주세요.<br/><br/>','password','changeCIFS',this.form);" value='비밀번호 변경'/>    
    <input type='button' class='button2' onclick='checkDeleteCIFS(this.form)' value='삭제'/>
  </td>
</form>
</tr>
<?php
  }?>
</tbody>
</table>

<table id='cifsAccount' style='display:none;' class="noHover gray_line">
<form id='cifsAccountForm' method='post' action='test.php'>
<tr>
  <td>ID</td>
  <td><input class='transparent' type='text' name='cifsId' index=1/></td>
  <td style='width:20%' rowspan="2"><input type='button' index=3 class='button' onclick="formSubmit('cifsAccountForm')" value='제출'/></td>
</tr>
<tr>
  <td>PW</td>
  <td><input class='transparent'  type='password' name='cifsPw' index=2/>
</td>
</form>
</table>
<?php
}
?>








</body>


</html>
