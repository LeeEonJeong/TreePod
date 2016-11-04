<script src="asy.js"></script>
<?php
foreach($_COOKIE as $key=>$val){ 
 setCookie($key,"",time()-1800); 
// $temp = $_COOKIE[$key];
 echo $key;
 echo "<script>alert(getCookie('".$key."'));</script>";
}
?>