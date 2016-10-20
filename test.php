<?php
include('var_dump_enter.php');
var_dump_enter($_POST);

		$xmlUrl = "https://api.ucloudbiz.olleh.com/nas/v1/client/api?apikey=_zbeka8OKky0V0mIRlzY9dn3Ph0ZmcmM6RZQI8vsUwE9Qgsb-puzVYyWvJ3aGnLfVxb5JTK2jjKXIbPzLmN0mg&command=listNass&signature=9GCqxcw5P6E%2F52lFx0hw2Y%2FohAc%3D";
        $str = file_get_contents($xmlUrl);
    //    var_dump_enter($str);
        if($str == FALSE) {
        //    var_dump_enter($str);
            echo "<br/>ERROR in API<br/>";
            return array("jobid"=>"ERROR");
        }
    //  echo "<pre>".htmlentities($str)."</pre>";
        $obj = simplexml_load_string($str);

        $arrXml = objectsIntoArray($obj);
        var_dump_enter($arrXml);
?>