
<!--  <p>state : <span id="state"></span></p> -->
<link rel="stylesheet" type="text/css" href="design.css">
<link rel="stylesheet" type="text/css" href="menu_design.css">
<link rel="stylesheet" type="text/css" href="alert_bar_design.css">

<div class="ultimatedropdown">
<ul>
<li><a href="index.php">HOME</a></li>
<li><a href="javascript:vold(0)">Server</a>
  <ul>
    <li><a href="myServer.php">My Server</a></li>
    <li><a href="availableList.php">New Server</a></li>
  </ul>
</li>
<li><a href="javascript:vold(0)">IP</a>
  <ul>
    <li><a href="#">My Public IP</a></li>
    <li><a href="#">Firewall Rules</a></li>

  </ul>
</li>
<li><a href="javascript:vold(0)">Volume</a>
  <ul>
    <li><a href="#">My Volume</a></li>
    <li><a href="#">New Volume</a></li>

  </ul>
</li>

<li><a href="javascript:vold(0)">NAS</a>
  <ul>
    <li><a href="#">???</a></li>
    <li><a href="#">???</a></li>
  </ul>
</li>


<li><a href="sessionDestroy.php">Log Out</a></li> 
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
    function test2(asd){
      alert(document.getElementById('state').value);
    }  
  </script>

<?php
        @session_start();
     //   echo "SESSION[processID] : ";  var_dump($_SESSION['processID']);
//var_dump($SESSION);
//        $_SESSOION['protforwarding']='protForwarding now.';
      //  echo "<p>tttttt</p>";
        if(!isset($_SESSION['processID'])){
           echo "<p><span>요청 하신 작업이 없습니다.</span></p>";
        }
        else if(count($_SESSION['processID'])==0){
            echo "<p>요청 하신 작업이 없습니다.</p>"; 
        }
        else if(count($_SESSION['processID'])!=0){ 
        //  for($i=0; $i<count($_SESSION['processID']); $i++) {
          $timeID=0; 
          foreach($_SESSION['processID'] as $key => $value ) {
            $timeID++;
            ?>
            <p><?=$_SESSION['processID'][$key]?> : <span id="state<?= $key ?>"></span></p>
            <script>
              
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