
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
        opener.sendform.displayname.value=str;
        opener.sendform.displayname.readOnly = true;
        window.close();
    }


    </script>
</head>


<body>
<?php
  
    $server_name = $_GET['server_name'];
   /*

include_once('/'.CLOUD_PATH.'include/api_constants.php');       // api_constnats.php    
include_once('/'.CLOUD_PATH.'include/callAPI.php');         // callAPI.php  
 */
    $URL = "https://api.ucloudbiz.olleh.com/server/v1/client/api?";

    $listProductcmdArr = array(
        "command" => "checkVirtualMachineName",
        "display_name" => $server_name,
        "apikey" => API_KEY
    );
   // $seceret_key = SECERET_KEY;
    $result = callCommand($URL, $listProductcmdArr, SECERET_KEY);
 //   var_dump_enter($result);

  
   
?>
<table class="noline">
    <tbody>
        <tr>
            <td><?= $server_name;?></td>
        </tr>
            <td>
            <!--  -->
            <?php 
            if($result['Success']=='true'){?>
                <input class='button' type='button' onclick="checkDisplayClose('<?=$server_name?>')" value='사용하기'/>
                <input class='button' type='button' onclick='opener.sendform.displayname.readOnly = false;window.close();' value='사용하지 않기'/>
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