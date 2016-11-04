<?php 

$url1 = $_SERVER['DOCUMENT_ROOT'];
$url2 = dirname($_SERVER['PHP_SELF']);
$url3 = basename($_SERVER['PHP_SELF']);
//$url4 = $_SERVER[HTTP_HOST];
echo $url1."<br>";
echo $url2;
//echo $url3;
//echo $url4;
?>