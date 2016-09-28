
  <p>state : <span id="state"></span></p>
  <script src="asy.js">
  </script>
  <script>
    function test2(asd){
      alert(document.getElementById('state').value);
    }  
  //  test2('asdf');
 // 	setTimeout("test2('1ㅎㅁㄴㅇㄹ')", 5000);
  </script>

<?php
        session_start();
        var_dump($_SESSION['processID']);
//        $_SESSOION['protforwarding']='protForwarding now.';
        if(count($_SESSION['processID'])!=0){ 
          for($i=0; $i<count($_SESSION); $i++)
            ?>
            <script>
              var timeid = setInterval("test('<?=$_SESSION['processID']['1']?>')", 1000);
            </script>
<?php   } ?>