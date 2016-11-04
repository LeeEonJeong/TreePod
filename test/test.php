<?php
//include('var_dump_enter.php');
//include_once('api_constants.php');
//include_once('callAPIJson.php');
//var_dump_enter($_POST);
/*
$URL_NAS = "https://api.ucloudbiz.olleh.com/nas/v1/client/api?";
$cmdArr = array(
  "command" => "listCifsAccounts",
  "apikey" => API_KEY
);

$result = callCommandJSON($URL_NAS, $cmdArr, SECERET_KEY);
var_dump_enter($result);
*/
//echo get_include_path()."<br/>";
$server_root_path = $_SERVER['DOCUMENT_ROOT'];
//ini_set('include_path',$server_root_path);
//echo $server_root_path."<br/>";
include_once($server_root_path.'/includeFiles.php');
include_once($server_root_path.'/'.CLOUD_PATH.'pageInclude/asynCommandPageInclude.php');
$cmdArr2 = array(
    "command" => "queryAsyncJobResult",
    "jobid" => $_POST['jobid'],
    "apikey"  => API_KEY
  );
  $URL = "https://api.ucloudbiz.olleh.com/server/v1/client/api?";
$result = callCommand($URL, $cmdArr2, SECERET_KEY);

var_dump_enter($result);

//$relative_path = preg_replace("`\/[^/]*\.php$`i", "/", $_SERVER['PHP_SELF']);
//echo $relative_path;
 /*
    $xmlUrl = "https://api.ucloudbiz.olleh.com/nas/v1/client/api?apikey=_zbeka8OKky0V0mIRlzY9dn3Ph0ZmcmM6RZQI8vsUwE9Qgsb-puzVYyWvJ3aGnLfVxb5JTK2jjKXIbPzLmN0mg&command=listCifsAccounts&signature=FozEgCdeeOKVYh6lybkmIgbF%2BHw%3D";
	//	$xmlUrl = "https://api.ucloudbiz.olleh.com/nas/v1/client/api?apikey=_zbeka8OKky0V0mIRlzY9dn3Ph0ZmcmM6RZQI8vsUwE9Qgsb-puzVYyWvJ3aGnLfVxb5JTK2jjKXIbPzLmN0mg&command=listNass&signature=9GCqxcw5P6E%2F52lFx0hw2Y%2FohAc%3D";
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
        var_dump_enter($arrXml);*/
//        echo $_COOKIE['7216f159-2e6b-41c5-94ec-dbf8a4f9bc12'];
        var_dump($_COOKIE);
?>