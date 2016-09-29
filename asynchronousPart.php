<?php
session_start();
include('api_constants.php');
include ('./callAPI.php');
include('var_dump_enter.php');
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
//  var_dump_enter($result2);
  $jobStatus = $result2["jobstatus"];
//  echo "<br/>";
  if ($jobStatus == 2) {
    echo $_POST['jobid']." : fail!<br/>";
    var_dump_enter($result2);
   //  printf($result2["jobresult"]);
  //    exit;
  }
  else if ($jobStatus == 1 ) {
    echo "done!";
//    echo "<script>setCookie('".$_POST['jobid']."', 'done', 1); document.write('되니??');</script>";
//    echo $jobRank;
    unset($_SESSION['processID'][$jobRank]);
//    $_SESSION['done'][$jobRank];
//    var_dump($_SESSION['done']);
//    echo "<input type='hidden' value='done'/>";
//    var_dump_enter($result2);
  }
  else {
    echo $_POST['jobid']." : working now...<img src='load.gif'>";
  }
?>