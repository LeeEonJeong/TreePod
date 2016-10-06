<?php
//session_start();
include('sessionPush.php');
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
    echo "work fail!<br/>";
   // var_dump_enter($result2);
   //  printf($result2["jobresult"]);
  //    exit;
  }
  else if ($jobStatus == 1 ) {
    echo "done!";
//    echo "<br/>".$jobRank."<br/>";
//    echo "<script>setCookie('".$_POST['jobid']."', 'done', 1); document.write('되니??');</script>";
//    echo $jobRank;
    if(isset($result2['jobresult']['virtualmachine']['password'])){
      echo "<br/>";
      $displayname = $result2['jobresult']['virtualmachine']['displayname'];
      $password = $result2['jobresult']['virtualmachine']['password'];
      echo $displayname."의 비밀 번호는 ".$password." 입니다.";
      $_SESSION[$displayname] = $password;
      var_dump($_SESSION);
//      session_push('displayname',$result2['jobresult']['virtualmachine']['displayname']);
//      if(!isset($_SESSION['virtualmachine'])){
//        $_SESSION['virtualmachine'] = array();
//      }
//      array_push($_SESSION['virtualmachine'], $result2['jobresult']['virtualmachine']['displayname']);
     // echo end($_SESSION['virtualmachine']);
//      session_push('password',$result2['jobresult']['virtualmachine']['password']);
//      if(!isset($_SESSION['password'])){
//        $_SESSION['password'] = array();
//      }
//      array_push($_SESSION['password'], $result2['jobresult']['virtualmachine']['password']);
     // echo end($_SESSION['virtualmachine']);
    
    }
    setcookie($_POST['jobid'], "DONE", time() + 1800); //set cookie 30min.
    unset($_SESSION['processID'][$jobRank]);
//    $_SESSION['done'][$jobRank];
//    var_dump($_SESSION['done']);
//    echo "<input type='hidden' value='done'/>";
//    var_dump_enter($result2);
  }
  else {
    echo "working now...<img height='17px' src='load.gif'>";
  }
?>