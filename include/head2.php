<?php @session_start(); ?>
<?php 
//include_once('/includeFiles.php');
include_once($server_root_path.'/'.CLOUD_PATH.'include/api_constants.php');
include_once($server_root_path.'/'.CLOUD_PATH.'login_certify.php');
include_once($server_root_path.'/'.CLOUD_PATH.'customAlert/customAlert.html');


?>
  <script>
  </script>

<!--  <p>state : <span id="state"></span></p> -->
<link rel="stylesheet" type="text/css" href="/<?=CLOUD_PATH?>include/design.css">
<link rel="stylesheet" type="text/css" href="/<?=CLOUD_PATH?>include/menu_design.css">
<link rel="stylesheet" type="text/css" href="/<?=CLOUD_PATH?>alertBar/alert_bar_design.css">

<div class="ultimatedropdown">
<ul>
<li><a href="/<?=CLOUD_PATH?>index.php">HOME</a></li>
<li><a href="javascript:vold(0)">Server</a>
  <ul>
    <li><a href="/<?=CLOUD_PATH?>server/newServer.php">New Server</a></li>
    <li><a href="/<?=CLOUD_PATH?>server/myServer.php">My Server</a></li>
  </ul>
</li>
<li><a href="javascript:vold(0)">IP</a>
  <ul>
    <li><a href="/<?=CLOUD_PATH?>ip/newPublicIP.php">New Public IP</a></li>
    <li><a href="/<?=CLOUD_PATH?>ip/listPublicIP.php">My Public IP</a></li>
    <li><a href="/<?=CLOUD_PATH?>ip/listFireWallRules.php">Firewall Rules</a></li>
  </ul>
</li>
<li><a href="javascript:vold(0)">Volume</a>
  <ul>
    <li><a href="/<?=CLOUD_PATH?>volume/newVolume.php">New Volume</a></li>
    <li><a href="/<?=CLOUD_PATH?>volume/listVolume.php">My Volume</a></li>

  </ul>
</li>

<li><a href="javascript:vold(0)">NAS</a>
  <ul>
    <li><a href="/<?=CLOUD_PATH?>NAS/newNas.php">New NAS</a></li>
    <li><a href="/<?=CLOUD_PATH?>NAS/listNAS.php">My NAS</a></li>
    <li><a href="/<?=CLOUD_PATH?>NAS/cifsAccount.php">CIFS Account</a></li>
  </ul>
</li>

<?php
  if(isset($_SESSION['ID'])){
    echo "<li><a href='/".CLOUD_PATH."sessionDestroy.php'>Log Out</a></li>";
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
    <script src="/<?=CLOUD_PATH?>include/asy.js">
  </script>
  <script>

    var span_start=2;
    var span_end=1;
  </script>

<?php
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
            //var timeid = setInterval("testSeparate3()")
              var timeid = setInterval("testSeparate3('<?= $_SESSION['processID'][$key] ?>','/<?=CLOUD_PATH?>include/asynchronousPart.php','<?= $key ?>', '<?= $timeID?>')", 3000);
            //  alert("현재 작업 : "+timeid+" / 실제 매겨지는 timeID : <?=$timeID?>");
            </script>
<?php 
        //    $_SESSION['timeID'][$i] = "<script>document.write (timeid[$i]);</script>";

          }
          
    //      var_dump($_SESSION['timeID']);
        } 
?>

</div>

</div>