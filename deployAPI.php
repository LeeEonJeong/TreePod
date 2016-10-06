<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8"/>
<link rel="stylesheet" type="text/css" href="design.css">
<link rel="stylesheet" type="text/css" href="menu_design.css">
<link rel="stylesheet" type="text/css" href="alert_bar_design.css">
</head>
<body>

<table>
<tr><td>-</td><td>하드 용량</td><td>코어</td><td>OS</td><td>지역</td><td>호스트 명</td><td>신청하기</td></tr>
<?php
include('head2.php');
include('api_constants.php');
include ('./callAPI.php');
include('var_dump_enter.php');
 
$URL = "https://api.ucloudbiz.olleh.com/server/v1/client/api?";

$listProductcmdArr = array(
//    "command" => "listAvailableProductType", //잘못된 명령어 .
  "command" => "listAvailableProductTypes",
   // "wntjr" => "najong_e_jusuk_",
    "apikey" => API_KEY
);
$seceret_key = SECERET_KEY;
$result = callCommand($URL, $listProductcmdArr, $seceret_key);
//var_dump_enter($result);
$result_num = $result['count'];
$result = $result['producttypes'];
for($i=0; $i<$result_num; $i++){
   if($result[$i]['productstate']=="available") { 
     if(isset($result[$i]['diskofferingid'])){
       $diskofferingid = $result[$i]['diskofferingid'];
     }else {
       $diskofferingid = "rootonly";
     }

 // 처음 만든 테이블
    echo "<tr><form action='deploy_result.php' method='post'><td>";
   
    echo $result[$i]['product'];
    echo "<br/>".$result[$i]['productid'];
    echo "<input type='hidden' name='productid' value='".$result[$i]['productid']."'/>";
    echo "</td> <td>";
    echo $result[$i]['diskofferingdesc'];
    echo "<br/>".$diskofferingid;
    echo "<input type='hidden' name='diskofferingid' value='".$diskofferingid."'/>";
    echo "</td> <td>";
    echo $result[$i]['serviceofferingdesc'];
    echo "<br/>".$result[$i]['serviceofferingid'];
    echo "<input type='hidden' name='serviceofferingid' value='".$result[$i]['serviceofferingid']."'/>";
    echo "</td> <td>";
    echo $result[$i]['templatedesc'];
    echo "<br/>".$result[$i]['templateid'];
    echo "<input type='hidden' name='templateid' value='".$result[$i]['templateid']."'/>";
    echo "</td> <td>";
    echo $result[$i]['zonedesc'];
    echo "<input type='hidden' name='zoneid' value='".$result[$i]['zoneid']."'/>";
    echo"</td><td>";
    echo "<input type='text' name='displayname'/>";
    echo "</td><td><input class='button' type='submit' value='신청'/></td></tr></form>";
    
  }
}

?>
</table>
</body>
</html>
