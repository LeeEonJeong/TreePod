<?php
  $d1 = new DateTime;
 // var_dump($_POST);
  $d1->setTimeZone(new DateTimezone($_POST['timezone']));
  echo $d1->format($_POST['format']);
//  echo "???";
?>