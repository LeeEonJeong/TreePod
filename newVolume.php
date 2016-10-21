<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8"/>
<link rel="stylesheet" type="text/css" href="design.css">
<link rel="stylesheet" type="text/css" href="menu_design.css">
<link rel="stylesheet" type="text/css" href="alert_bar_design.css">


<script type="text/javascript">
function isEnglihOrNum(){
    var form = document.getElementById('sendform');
    var str = form.name.value;
    var err = 0; 
  
    for (var i=0; i<str.length; i++)  { 
       var chk = str.substring(i,i+1); 
        if(!chk.match(/[0-9]|[a-z]|[A-Z]|[-]|[_]/)) { 
            err = err + 1; 
        } 
    }    

    if (err > 0) { 
    //    Alert.render('DISK 명','영어와 숫자만 입력해 주세요. ','default');
    //    alert('영어와 숫자만 입력해 주세요.');
        form.name.value = "";
        form.name.focus();
        return false;
    }
    return true; 
}

function submitForm(){
    var form = document.getElementById('sendform');
    if(form.name.value=="") {
        Alert.render('DISK 명','이름을 입력해 주세요. ','default');
//        alert('Disk 이름을 입력해 주세요.');
        return false;
    }
    if( isEnglihOrNum() == false){
        Alert.render('DISK 명','영어와 숫자만 입력해 주세요. ','default');
//        alert('영어와 숫자만 입력해 주세요.');
        return false;
    }

    form.method="post";
    form.action="volumeCreate.php";
    form.submit();
    Alert.render('DISK 신청','화면이 바뀔 때 까지<br>잠시만 기다려 주십시요.... ','');
}
</script>

</head>
<body>

<?php
include_once('head2.php');
include_once('api_constants.php');
include_once('./callAPI.php');
include_once('var_dump_enter.php');
include_once('customAlert.html');
 
$URL = "https://api.ucloudbiz.olleh.com/server/v1/client/api?";

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

    <td class="tweenty_width">Disk 이름</td>
    <td><input class="transparent" type="text" name="name" id="name" value="" onblur="isEnglihOrNum()"/></td>

</tr>

<tr>
    <td class="tweenty_width">위치</td>
    <td colspan="2"><select name="zoneid" id="zoneid">
        <option value="">-</option>
<?php
    for($i=0; $i<(int)$result['count']; $i++){
        echo "<option value='".$result['zone'][$i]['id']."'>".$result['zone'][$i]['name']."</option>";
    }
?>
    </select></td>
</tr>
<tr>
    <td class="tweenty_width">Disk 크기</td>
    <td colspan="2" ><select name="diskofferingid">
        <option>-</option>
        <option value="1539f7a2-93bd-45fb-af6d-13d4d428286d">10GB</option>
        <option value="64ba2191-b22a-42a2-aaab-075b0235ac18">20GB</option>
        <option value="d4fc0ff3-91ee-40af-a2f3-9ec0eb4773f8">30GB</option>
        <option value="a7bbe834-c195-45ed-a668-2e4aadf0adb7">40GB</option>
        <option value="277d1cea-d51a-4570-af16-0b271795d2a0">50GB</option>
        <option value="2791cad6-b68a-4412-8867-ca07e5d64ae4">60GB</option>
        <option value="698adf24-7ae2-4100-af56-a35ecd7bd67c">70GB</option>
        <option value="78fe5777-8903-4193-bada-ee8686bc543a">80GB</option>
        <option value="4df2364f-1548-4d42-9d66-25fc3a195c5c">90GB</option>
        <option value="ef334e6f-f197-4988-9781-86c985e82591">100GB</option>
        <option value="e91d8b54-28c3-43a7-b3a4-439ced6fe282">110GB</option>
        <option value="b67fea21-0360-4072-8877-815e9254ab73">120GB</option>
        <option value="b825b79c-7f31-47f8-b886-ed355253c9e9">130GB</option>
        <option value="40f5cd46-ec3e-4ca3-9df5-f55d590149a1">140GB</option>
        <option value="dc4ec8a0-c0f6-46af-a475-9fcec21bc2fa">150GB</option>
        <option value="227ad57a-336f-48dd-8338-68094e6bdef9">160GB</option>
        <option value="2b034310-4309-4f43-8e78-c94445c70783">170GB</option>
        <option value="d02fc827-2c52-423d-9a6c-d324e0fbb021">180GB</option>
        <option value="ec59a93f-36bd-43d0-abe7-af70d97d8b1b">190GB</option>
        <option value="cbe4ccad-be3a-43f6-9abd-d2b6d7097e40">200GB</option>
        <option value="dc467090-6649-43b2-abd0-4d8ea52d5f49">210GB</option>
        <option value="2527cce9-1b7a-4b4e-b6df-568c4a67678c">220GB</option>
        <option value="95da4d30-f215-47ad-b7b8-11ae3a055e03">230GB</option>
        <option value="a70e745c-ef31-4fbb-a62b-ff5af031f8a1">240GB</option>
        <option value="e3782b90-3780-4c2c-85a1-48ccf304590e">250GB</option>
        <option value="600a22dc-8955-4fc6-a9d6-516c8db1ac5a">260GB</option>
        <option value="bb0227cf-9ef6-4005-bd27-666f49481003">270GB</option>
        <option value="c96b005c-81a3-46ca-ad63-96cd271faf6b">280GB</option>
        <option value="1c7521b1-8753-427b-874b-a740e6e0184d">290GB</option>
        <option value="03ee7edf-a91f-4910-9e1c-551222bc6e94">300GB</option>

    </select></td>
</tr>
  <td >요금 약정 방법 </td>
  <td colspan="2">
    <select name="usageplantype"> 
    <option value="">-</option>
    <option value="hourly">시간제 요금</option> 
    <option value="monthly">월단위 요금</option> </select>
  </td>

<tr><td colspan="3">
    <input type='button' value='신청' class='button' onclick="submitForm()"/>
<!--    <input type='text' name='templateid' value='' />
<input type='text' name="serviceofferingid" value='' /> -->
</td></tr>
</form>
</tbody>
</table>
<script>
//var send_form = document.getElementById('sendform');
//alert(send_form.templateid);
</script>
</body>
</html>
