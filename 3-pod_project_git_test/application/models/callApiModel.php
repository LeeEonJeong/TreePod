<?php
class CallApiModel extends CI_Model {
	const URI = 'https://api.ucloudbiz.olleh.com/server/v1/client/api?';
	const NASURI = 'https://api.ucloudbiz.olleh.com/nas/v1/client/api?';
	
	function objectsIntoArray($arrObjData, $arrSkipIndices = array()) {
		if (is_object ( $arrObjData )) {
			$arrObjData = get_object_vars ( $arrObjData );
		}
		if (is_array ( $arrObjData )) {
			foreach ( $arrObjData as $index => $value ) {
				if (is_object ( $value ) || is_array ( $value )) {
					$value = $this->objectsIntoArray ( $value, $arrSkipIndices );
				}
				if (in_array ( $index, $arrSkipIndices )) {
					continue;
				}
				
				$arrData [$index] = $value;
			}
		}
		return $arrData;
	}
	
	function callCommandResponseJson($URL, $cmdArr, $SECRET) {
		$cmdArr ['response'] = 'json';
		
		$xmlUrl = $this->makeXmlUrl ( $URL, $cmdArr, $SECRET );
		
// 		echo $xmlUrl;
// 		echo '<br>';
		$jsonResult = $this->curl ( $xmlUrl );
		 
		return $jsonResult; 
	}
	
	//안씀(TEST용도)
	function callCommandResponseXML($URL, $cmdArr, $SECRET) {
		$cmdArr ['response'] = 'xml'; //없어도 됨 (디폴트 : xml)
	
		$xmlUrl = $this->makeXmlUrl ( $URL, $cmdArr, $SECRET );
		
		$orig_error_reporting = error_reporting ();
		error_reporting ( 0 );
		$temp1 = $this->curl ( $xmlUrl );
		echo var_dump($temp1); //curl로 불러오게되면 errortext, errorcode, jobid jobstatus 모두 그냥 string형태로 구별안되게 날아옴
		//예로, string(233) "bd3e3b2a-898b-4eda-8337-422ed0533fc23d519909-24a5-4e2f-9d3c-bee87e76d3d0"
		echo '<hr>';
		$temp2 = simplexml_load_string();
		$xmlResult = $this->objectsIntoArray ($temp2); // xml파일을 stirng으로 가져옴
		error_reporting ( $orig_error_reporting );
	
		return $xmlResult;
	}
	
	
	
	function callCommand($URL, $cmdArr, $SECRET) {
		$xmlUrl = $this->makeXmlUrl ( $URL, $cmdArr, $SECRET );
		
// 		echo $xmlUrl;
// 		echo '<hr>';
		
		$orig_error_reporting = error_reporting ();
		error_reporting ( 0 );
		
// 		echo  var_dump(file_get_contents ( $xmlUrl ));
// 		echo '<hr>';
// 		echo var_dump(simplexml_load_string ( file_get_contents ( $xmlUrl ) ));
// 		echo'<hr>';
		
		$arrXml = $this->objectsIntoArray ( simplexml_load_string ( file_get_contents ( $xmlUrl ) ) );
		error_reporting ( $orig_error_reporting ); 
		
		return $arrXml;
	}
	
	function curl($url) {
		$ch = curl_init();
		//    echo $ch;
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1');
		//    curl_setopt($ch, CURLOPT_HEADER,true);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		//    curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_GSSNEGOTIATE);
		/*
		 // echo $ch;
		 echo CURLAUTH_GSSNEGOTIATE."<br>";
		 echo "curl 호출 정보 <pre>";
		 var_dump(curl_getinfo($ch));
		 echo "</pre>";
	
		 echo "ch값 보기 <pre>";
		 var_dump(curl_getinfo($ch, CURLINFO_SSL_ENGINES));
		 echo "<pre>";
		 */
		$data = curl_exec($ch);
		if($data == false){
			echo "Error 발생 <br/>";
			echo curl_error($ch);
			echo "<br/>";
		}
		curl_close($ch);
		return $data;
	}
	 
	 
	function makeXmlUrl($URL, $cmdArr, $SECRET) {
		$fArray = array_keys ( $cmdArr );
		$vArray = array_values ( $cmdArr );
		
		$f = array ();
		$v = array ();
		$cmd = array (); //cmd는 signature만들때 사용
		$cmd1 = array (); //cmd1은 signature제외 query 만들 떄 사용
		
		for($i = 0; $i < count ( $cmdArr ); $i ++) {
			$vArray [$i] = strtok ( $vArray [$i], "&" );
			$f [$i] = strtolower ( urlencode ( $fArray [$i] ) );
			
			$v [$i] = strtolower (urlencode($vArray [$i]));
			if($fArray[$i] == 'productcode'){// urlencode안함 (productid, 스페이스 -> + 로 변환됨)
				$v [$i] = str_replace('+', '%20', $v [$i]);
			}
			array_push ( $cmd, $f [$i] . "=" . $v [$i] );
		}
		
		sort ( $cmd );
		
		for($i = 0; $i < count ( $cmdArr ); $i ++)
			array_push ( $cmd1, $fArray [$i] . "=" . $vArray [$i] );
		
		sort ( $cmd1 );
		
		$cmdStr = "";
		
		for($i = 0; $i < count ( $cmd ); $i ++) {
			if ($i == count ( $cmd ) - 1)
				$cmdStr = $cmdStr . $cmd [$i];
			else
				$cmdStr = $cmdStr . $cmd [$i] . "&";
		} 
		$signature = urlencode ( base64_encode ( hash_hmac ( "sha1", $cmdStr, $SECRET, true ) ) );
		 
		$url = $URL;
		
		for($i = 0; $i < count ( $cmd1 ); $i ++){
			$url = $url . $cmd1 [$i] . "&";
		}
		
		$xmlUrl = $url . "signature=" . $signature;
		
// 		echo $xmlUrl;
		return $xmlUrl;
	} 
}