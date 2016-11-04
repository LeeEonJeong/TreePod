
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8"/>

<script type="text/javascript" src="newNas.js">

</script>

</head>
<body>
<?php
$server_root_path = $_SERVER['DOCUMENT_ROOT'];// ini_set('include_path',$server_root_path);
include_once($server_root_path.'/includeFiles.php');
include_once($server_root_path.'/'.CLOUD_PATH.'pageInclude/menuPageInclude.php');
?>
<?php
/*
include_once($server_root_path.'/'.CLOUD_PATH.'include/head2.php');     // head2.php  
include_once($server_root_path.'/'.CLOUD_PATH.'include/callAPI.php');     // callAPI.php  
*/
$URL = "https://api.ucloudbiz.olleh.com/server/v1/client/api?";
$URL_NAS ="https://api.ucloudbiz.olleh.com/nas/v1/client/api?";

$listProductcmdArr = array(
  "command" => "listZones",
  "available" => "true",
    "apikey" => API_KEY
);
$seceret_key = SECERET_KEY;
$result = callCommand($URL, $listProductcmdArr, $seceret_key);
//var_dump_enter($result);
?>

<table class="gray_line hoverOn">
<tbody>
<form name ="sendform" id ="sendform" method="post">
<tr>

    <td class="tweenty_width">volume 이름</td>
    <td><input class="transparent" type="text" name="name" id="name" value=""/></td>
    <td style="width: 20%"><input type="button" class="button2" value="중복 검사" onclick="checkDisplayName()"/></td>
</tr>
<tr>
    <td class="tweenty_width">기본 용량</td>
    <td colspan="2" >1,000GB</td>
</tr>
<tr>
    <td class="tweenty_width">추가 용량<br><small>*100GB 단위로 추가 가능</small></td>
    <td colspan="2" >
        <input type="number" name="totalsize" class="transparent" value=''/> GB
    </td>
</tr>
<tr>
    <td class="tweenty_width">위치</td>
    <td colspan="2"><select name="zoneid" id="zoneid" onchange="display('zoneid','virtualmachineid')">
    <option value="">-</option>
<?php
    for($i=0; $i<(int)$result['count']; $i++){
        echo "<option value='".$result['zone'][$i]['id']."'>".$result['zone'][$i]['name']."</option>";
    }
?>
    </select></td>
</tr>
<tr>
    <td class="tweenty_width">연결 서버 선택</td>
    <td colspan="2"><select name="virtualmachineid" id="virtualmachineid">
    <option value="">-</option>

    </select></td>
</tr>
<tr>
  <td >요금 약정 방법 </td>
  <td colspan="2">
    <select name="usageplantype"> 
    <option value="hourly">시간제 요금</option> 
    <option value="monthly">월단위 요금</option> </select>
  </td>
</tr>
<tr>
  <td >사용 프로토콜 </td>
  <td colspan="2">
    <select name="volumetype"> 
    <option value="nfs">NFS</option> 
    <option value="cifs">CIFS</option> </select>
  </td>
</tr>
<tr>

    <td class="tweenty_width">mount 경로</td>
    <td><input class="transparent" type="text" name="path" id="path" value="" /></td>
    <td><input type="button" class="button2" value="중복 검사" onclick="checkPathName()"/></td>
</tr>
<tr><td colspan="3">
    <input type='button' value='신청' class='button' onclick="submitForm()"/>
</td></tr>
</form>
</tbody>
</table>

</body>
</html>
