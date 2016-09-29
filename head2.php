
<!--  <p>state : <span id="state"></span></p> -->
  <script src="asy.js">
  </script>
  <script>
    function test2(asd){
      alert(document.getElementById('state').value);
    }  
 //   var timeid = new Array()
  //  test2('asdf');
 // 	setTimeout("test2('1ㅎㅁㄴㅇㄹ')", 5000);
  </script>

<?php
        session_start();
        echo "SESSION[processID] : ";
        var_dump($_SESSION['processID']);

//        $_SESSOION['protforwarding']='protForwarding now.';
        if(count($_SESSION['processID'])!=0){ 
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
        } ?>