<?php
$server_root_path = $_SERVER['DOCUMENT_ROOT']; //ini_set('include_path',$server_root_path);
include_once($server_root_path.'/includeFiles.php');
include_once($server_root_path.'/'.CLOUD_PATH.'pageInclude/popUpPageInclude.php');
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link rel="stylesheet" type="text/css" href="/<?=CLOUD_PATH?>include/design.css">
    <title>Display Name Check</title>
    <script>
    
    function checkDisplayClose(str){
        opener.sendform.name.value=str;
        opener.sendform.name.readOnly = true;
        window.close();
    }


    </script>
</head>


<body>
<?php
  
    $disk_name = $_GET['disk_name'];

   /* 
    include_once($server_root_path.'/'.CLOUD_PATH.'include/api_constants.php');       // api_constnats.php    
    include_once($server_root_path.'/'.CLOUD_PATH.'include/callAPI.php');         // callAPI.php  
 */
    $URL_NAS ="https://api.ucloudbiz.olleh.com/nas/v1/client/api?";

    $listProductcmdArr = array(
        "command" => "listVolumes",
        "apikey" => API_KEY
    );
   // $seceret_key = SECERET_KEY;
    $result = callCommand( $URL_NAS, $listProductcmdArr, SECERET_KEY);
 //   var_dump_enter($result);
    $nas_num = $result['count'];
    if($nas_num != 0) {
        $result = $result['response'];
    }
    $nas_temp;
    $isUsed = true;
    for($i=0;$i<$nas_num; $i++){
        if($nas_num!=1){
            $nas_temp = $result[$i];
        } else {
            $nas_temp = $result;
        }
        if($nas_temp['name']==$disk_name){
            $isUsed = false;
            break;
        }
    }
   
?>
<table class="noline">
    <tbody>
        <tr>
            <td><?= $disk_name;?></td>
        </tr>
            <td>
            <!--  -->
            <?php 
            if($isUsed==true){?>
                <input class='button' type='button' onclick="checkDisplayClose('<?=$disk_name?>')" value='사용하기'/>
                <input class='button' type='button' onclick='opener.sendform.name.readOnly = false;window.close();' value='사용하지 않기'/>
<?php       }else {
                echo "<input class='button' type='button' onclick='window.close();' value='되돌아가기'/>";
            }
            ?>
                
            </td>
        <tr></tr>
    </tbody>
</table>


</body>
</html>