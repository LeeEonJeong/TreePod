<?php @session_start();
$server_root_path = $_SERVER['DOCUMENT_ROOT'];// ini_set('include_path',$server_root_path);
include_once($server_root_path.'/includeFiles.php');
?>
<?php
//

include_once($server_root_path.'/'.CLOUD_PATH.'include/sessionPush.php');
include_once($server_root_path.'/'.CLOUD_PATH.'include/api_constants.php');
include_once($server_root_path.'/'.CLOUD_PATH.'include/callAPI.php'); 
//echo "???";
//echo $_POST['jobid']."<br/>";
//$jobRank;
//var_dump_enter($_SESSION);
/*foreach($_SESSION['processID'] as $key => $value ){
  echo "key : ".$key." value : ";
  echo $_SESSION['processID'][$key]."<br>";
}*/
/*
for($i=0; $i<count($_SESSION['processID']); $i++){
  if($_SESSION['processID'][$i]==$_POST['jobid']){
    $jobRank = $i;
    break;
  }
}*/

$jobRank=$_POST['jobRank'];
//echo $jobRank."<br/>";
  $cmdArr2 = array(
    "command" => "queryAsyncJobResult",
    "jobid" => $_POST['jobid'],
    "apikey"  => API_KEY
  );
  $URL = "https://api.ucloudbiz.olleh.com/server/v1/client/api?";
  
  $result2 = callCommand($URL, $cmdArr2, SECERET_KEY);
  //var_dump_enter($result2);
  if(isset($result2['jobid'])){
    if($result2['jobid']=="ERROR"){
      echo "done : ERROR <br/>";
      unset($_SESSION['processID'][$jobRank]);
      exit;
    }
  }

  
  $jobStatus = $result2["jobstatus"];
//  echo "<br/>";
  if ($jobStatus == 2) {
    echo "done : work fail!<br/>";
  //  setcookie($_POST['jobid'], "DONE", time() + 1800); //set cookie 30min.
    unset($_SESSION['processID'][$jobRank]);
   // var_dump_enter($result2);
   //  printf($result2["jobresult"]);
  //    exit;
  }
  else if ($jobStatus == 1 ) {    
  //  echo "'".$_POST['jobid']."'";
  //  setcookie($_POST['jobid'], "DONE", time() + 1800); //set cookie 30min.
//    echo $_POST['jobid']." : ".$_COOKIE[$_POST['jobid']]."<br/>";
//    echo "<br/>".$jobRank."<br/>";
//    echo "<script>setCookie('".$_POST['jobid']."', 'done', 1); document.write('되니??');</script>";
//    echo $jobRank;
    if(isset($result2['jobresult']['virtualmachine']['password'])) {
      $id = $result2['jobresult']['virtualmachine']['id'];
      $password = $result2['jobresult']['virtualmachine']['password'];
      $_SESSION[$id] = $password;
      echo "password produce";
    }

    if(isset($result2['jobresult']['virtualmachine']['state'])){
      if($result2['jobresult']['virtualmachine']['state'] == "Destroyed") {
        echo VM_DESTROY;//"VM Destroy ";
      //  setcookie("VM_destroy", "DONE", time() + 1800);
      }
    }
    unset($_SESSION['processID'][$jobRank]);
//    $_SESSION['done'][$jobRank];
//    var_dump($_SESSION['done']);
//    echo "<input type='hidden' value='done'/>";
//    var_dump_enter($result2);
    echo " done!";
  }
  else {
    echo "working now...<img height='17px' src='/".CLOUD_PATH."include/load.gif'>";
  }
?>