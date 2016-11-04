<?php
session_start();
echo "<pre>";
var_dump($_SESSION);
echo "</pre><pre>";
//echo count($_SESSION['processID']);

//setcookie("79905678-1fdf-49d6-a129-d2cb6ffbf5c8", "DONE", time() + 1800);
var_dump($_COOKIE);
?>
