<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8"/>
<link rel="stylesheet" type="text/css" href="design.css">
<link rel="stylesheet" type="text/css" href="menu_design.css">
<link rel="stylesheet" type="text/css" href="alert_bar_design.css">
</head>
<body>



<?php
include('head2.php');
include('api_constants.php');
include ('./callAPI.php');
include('var_dump_enter.php');
 
$URL = "https://api.ucloudbiz.olleh.com/server/v1/client/api?";

$listProductcmdArr = array(
  "command" => "listZones",
  "available" => "true",
  "apikey" => API_KEY
);
$seceret_key = SECERET_KEY;
$result = callCommand($URL, $listProductcmdArr, $seceret_key);
var_dump_enter($result);
?>
</body>
</html>
