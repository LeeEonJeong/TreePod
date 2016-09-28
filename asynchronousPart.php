
<?php

include('api_constants.php');
include ('./callAPI.php');
include('var_dump_enter.php');

//echo "???";
echo $_POST['jobid']."<br/>";

  $cmdArr2 = array(
    "command" => "queryAsyncJobResult",
    "jobid" => $_POST['jobid'],
    "apikey"  => API_KEY
  );
   $URL = "https://api.ucloudbiz.olleh.com/server/v1/client/api?";
  $result2 = callCommand($URL, $cmdArr2, SECERET_KEY);
//  var_dump_enter($result2);
  $jobStatus = $result2["jobstatus"];
  echo "<br/>";
  if ($jobStatus == 2) {
    echo $_POST['jobid']." : fail!<br/>";
    var_dump_enter($result2);
   //  printf($result2["jobresult"]);
  //    exit;
  }
  else if ($jobStatus == 1 ) {
    echo "done!";
    var_dump_enter($result2);
  }
  else {
    echo $_POST['jobid']." : working now...<img src='load.gif'>";
  }

?>
