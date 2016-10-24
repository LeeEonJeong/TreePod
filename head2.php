<?php 
include_once('api_constants.php');
include_once('login_certify.php');
?>


<!--  <p>state : <span id="state"></span></p> -->
<link rel="stylesheet" type="text/css" href="design.css">
<link rel="stylesheet" type="text/css" href="menu_design.css">
<link rel="stylesheet" type="text/css" href="alert_bar_design.css">

<div class="ultimatedropdown">
<ul>
<li><a href="index.php">HOME</a></li>
<li><a href="javascript:vold(0)">Server</a>
  <ul>
    <li><a href="availableList.php">New Server</a></li>
    <li><a href="myServer.php">My Server</a></li>
  </ul>
</li>
<li><a href="javascript:vold(0)">IP</a>
  <ul>
    <li><a href="newPublicIP.php">New Public IP</a></li>
    <li><a href="listPublicIP.php">My Public IP</a></li>
    <li><a href="listFireWallRules.php">Firewall Rules</a></li>
  </ul>
</li>
<li><a href="javascript:vold(0)">Volume</a>
  <ul>
    <li><a href="newVolume.php">New Volume</a></li>
    <li><a href="listVolume.php">My Volume</a></li>

  </ul>
</li>

<li><a href="javascript:vold(0)">NAS</a>
  <ul>
    <li><a href="newNas.php">New NAS</a></li>
    <li><a href="listNAS.php">My NAS</a></li>
    <li><a href="cifsAccount.php">CIFS Account</a></li>
  </ul>
</li>

<?php
  if(isset($_SESSION['ID'])){
    echo "<li><a href='sessionDestroy.php'>Log Out</a></li>";
  } else {
    echo "<li><a href='#'>Log In</a></li>"; 
  }
?>
</ul>
<br style="clear: left" />
</div>

<div class="css3droppanel">
<input type="checkbox" id="paneltoggle" />
<label for="paneltoggle" title="Click to open Panel"></label>
<div class="content">

<!--panel content goes here-->
  <script src="asy.js">
  </script>
  <script>

    var span_start=2;
    var span_end=1;
  </script>

<?php
        @session_start();
        if(!isset($_SESSION['processID'])){
           echo "<p><span>요청 하신 작업이 없습니다.</span></p>";
        }
        else if(count($_SESSION['processID'])==0){
            echo "<p>요청 하신 작업이 없습니다.</p>"; 
        }
        else if(count($_SESSION['processID'])!=0){ 
          $timeID=0; 
          foreach($_SESSION['processID'] as $key => $value ) {
            $timeID++;
            ?>
            <p><?=$_SESSION['processID'][$key]?> :<span id="state<?= $key ?>"></span></p>
            <script>
      <?php if($timeID==1) { ?>
              span_start = <?= $key?>;
      <?php } ?>
            span_end =  <?= $key?>  ;
              var timeid = setInterval("testSeparate2('<?= $_SESSION['processID'][$key] ?>','<?= $key ?>', '<?= $timeID?>')", 3000);
            </script>
<?php 
        //    $_SESSION['timeID'][$i] = "<script>document.write (timeid[$i]);</script>";

          }
          
    //      var_dump($_SESSION['timeID']);
        } 
?>

</div>

</div>