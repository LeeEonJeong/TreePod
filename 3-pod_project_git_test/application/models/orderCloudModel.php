<?php
class OrderCloudModel extends CI_Model {
	function __construct() {
		parent::__construct ();
		$this->load->model ( 'callApiModel' ); 
	}
	
	function checkVirtualMachineName($checkname){
		$cmdArr = array (
				"command" => "checkVirtualMachineName",
				"display_name" => $checkname,
				"apikey" => $_SESSION ['apikey']
		);
			
		$result = $this->callApiModel->callCommand( CallApiModel::URI, $cmdArr, $this->session->userdata ( 'secretkey' ) );
		return $result;
	}
	
	function orderVM(){
		$cmdArr = array (
				"command" => "deployVirtualMachine",
				"displayname" => $_POST['displayname'],
				"name" => $_POST['name'],
				"serviceofferingid" => $_POST['serviceofferingid'],
				"templateid" => $_POST['templateid'],
				"zoneid" => $_POST['zoneid'],
				"usageplantype" => $_POST['usageplantype'],
				"apikey" => $_SESSION ['apikey']
		);
		
		if($_POST['diskofferingid'] != ''){
			$cmdArr['diskofferingid'] = $_POST['diskofferingid'];
		}
		
// 		$cmdArr = array (
// 				"command" => "deployVirtualMachine",
// 				"displayname" => 'asdfzxcv',
// 				"name" =>'asdfzxcv',
// 				"serviceofferingid" => 'c504e367-20d6-47c6-a82c-183b12d357f2',
// 				"templateid" => 'a57d10ec-9588-436f-bbb5-8a68eadf2254',
// 				"zoneid" => 'eceb5d65-6571-4696-875f-5a17949f3317',
// 				"usageplantype" => 'hourly',
// 				"apikey" => $_SESSION ['apikey']
// 		);
		 
		$result = $this->callApiModel->callCommand(CallApiModel::URI, $cmdArr, $this->session->userdata ( 'secretkey' ) );

		return $result;  //file_get_contents에서 실패시 false return
	}
	
	function getlistAvailableProductTypesByZoneid($zoneid){
		$cmdArr = array (
				"command" => "listAvailableProductTypes",
				"zoneid" => $zoneid,
				"apikey" => $_SESSION ['apikey']
		);
			
		$listAvailableProductTypes = $this->callApiModel->callCommand( CallApiModel::URI, $cmdArr, $this->session->userdata ( 'secretkey' ) );
		
		return $listAvailableProductTypes;
	}

	function getPackagesByZoneid($zoneid){ //비효율적..?
		$availableProductTypes = $this->getlistAvailableProductTypesByZoneid($zoneid);
		$count = $availableProductTypes['count'];
		$productTypes = $availableProductTypes['producttypes'];
		 
		$index=0;
		
		if($count==0){
			return array();
		}
		$packages = $this->getUniqueValueList($productTypes, 'product');
		
		return $packages;			
	}
	
	function getOSlist($zoneid, $package){
		$productsArray = $this->getProductsByZoneidAndPackage($zoneid, $package);
		$oslist = $this->getUniqueValueForIdAndDesc($productsArray, 'template');
		return $oslist;
	}
	
	function getServiceOfferinglist($zoneid, $package, $osid){
		$productsArray = $this->getProductsByZoneidAndPackage($zoneid, $package);
		$osproducts = $this->getProducts($productsArray, 'templateid', $osid);
	 
		$serviceofferinglist = $this->getUniqueValueForIdAndDesc($osproducts, 'serviceoffering');
		
		return $serviceofferinglist;
	}
	
	function getDiskOfferinglist($zoneid, $package, $osid, $serviceid){
		$productsArray = $this->getProductsByZoneidAndPackage($zoneid, $package);
		$osproducts = $this->getProducts($productsArray, 'templateid', $osid);
		$serviceproducts = $this->getProducts($osproducts, 'serviceofferingid', $serviceid);
		$diskofferinglist = $this->getUniqueValueForIdAndDesc($serviceproducts, 'diskoffering');
		
		return $diskofferinglist;
	}
	
	function getUniqueValueList($array,$condition){
		$resultasrray = array();
	
		$old = '';
		foreach($array as $key=>$value){
			$new = $value[$condition];
			if($old != $new && $new != null){
				array_push($resultasrray, $new);
				$old = $new;
			}
		}	
		return $resultasrray;
	}
	
	function getUniqueValueForIdAndDesc($array,$condition){ //condition : serviceoffering,template,diskoffering
		$resultarray = array();
	 
		if(count($array) < 1){
		}else if(count($array) == 1){
			$temparray[$condition.'id'] = $value[$condition.'id'];
			$temparray[$condition.'desc'] = $value[$condition.'desc'];
		}else{
			//echo var_dump($array);
			foreach($array as $key=>$value){
				$new = $value[$condition.'desc'];
				if($new == null || $this->isExist($resultarray, $new)){
				}else{
					if(isset($value[$condition.'id'])){ //diskoffering때문에 rootonly는 id값없음
						$temparray[$condition.'id'] = $value[$condition.'id'];
					}else{
						$temparray[$condition.'id'] ='';
					}
					$temparray[$condition.'desc'] = $new;
					array_push($resultarray, $temparray);
				}
			}
		}
		return $resultarray;
	}
	
	private function isExist($array, $value){
		foreach($array as $arraykey => $arrayvalue){
			foreach($arrayvalue as $conditionkey => $conditionvalue){
				if($conditionvalue == $value)
					return true;
			}
		}
		return false;
	}
	
	function getProductsByZoneidAndPackage($zoneid, $package){
		$result = $this->getlistAvailableProductTypesByZoneid($zoneid);
		return $this->getProducts($result['producttypes'], 'product', $package);
	}
	
	function getProducts($productTypes, $condition, $substring){
		$products = array();

		foreach($productTypes as $key=>$value){
			$product = $value;
			$ishas = strpos($product[$condition], $substring);
			
			if(gettype($ishas) == 'integer' && $ishas >= 0){
				array_push($products, $product);
			}
		}
		return $products;
	}
	
	private function getAvailableProductTypes($zoneid, $condition, $value){
		$availableProductTypes = $this->getlistAvailableProductTypesByZoneid($zoneid);
		$count = $availableProductTypes['count'];
		 
		$productTypes = $availableProductTypes['producttypes'];
		$products = array();
		$index=0;
		
		for($i=0; $i<$count; $i++){
			$product = $productTypes[$i];
			 
			if($product[$condition] == $value){
				$products[$index++] = $product; 
			}
		}
		 
		return $products;
	}
	 
	  
}