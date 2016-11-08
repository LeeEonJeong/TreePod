 <?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	class OrderCloud extends MY_Controller{
		function __construct()
		{
			parent::__construct();
			$this->load->model('orderCloudModel');
		}
	 
		
		function index(){
			$this->_head();
			$returnURI = '/cloudlist'; // 일단임의로 나중에 returnURI 다시 처리하자
			$this->_require_login($returnURI);
			 
			$this->load->view ('orderCloud');
			$this->_footer ();
		} 
		
		function checkVirtualMachineName($checkname){
			$result = $this->orderCloudModel->checkVirtualMachineName($checkname);
			
			echo $result['Success'];
// 			if($result['Success'] == 'true'){
// 				echo "사용할 수 있는 서버명입니다.";
// 			}else if($result['Success'] == 'false'){
// 				echo "사용할 수 없는 서버명입니다.";
// 			}
		}
		
		function getlistAvailableProductTypesByZoneid(){
			$listAvailableProductTypes = $this->orderCloudModel->getlistAvailableProductTypesByZoneid();
			
			echo json_encode($listAvailableProductTypes);
		}
		
		function getPackagesByZoneid($zoneid){
			$packages =  $this->orderCloudModel->getPackagesByZoneid($zoneid);
			echo json_encode($packages);
		}
		 
		function getOSlist($zoneid, $package){
			$oslist = $this->orderCloudModel->getOSlist($zoneid, $package);
			echo json_encode($oslist);
		}
		
// 		function getDatadisklistForProductId($zoneid, $package, $os){
// 			$productdisklist = $this->orderCloudModel->getDatadisklist($zoneid, $package, $os);
// 			echo json_encode($productdisklist);
// 		}
		
		function getServiceOfferinglist($zoneid, $package, $osid){
			$serviceofferinglist = $this->orderCloudModel->getServiceOfferinglist($zoneid, $package, $osid);
			echo json_encode($serviceofferinglist);
		}
		
		function getDiskOfferinglist($zoneid, $package, $osid, $serviceid){
			$diskofferinglist = $this->orderCloudModel->getDiskOfferinglist($zoneid, $package, $osid, $serviceid);
			echo json_encode($diskofferinglist);
		}
		 
		function orderVM(){  
			$result = $this->orderCloudModel->orderVM();
			echo json_encode($result);
		}
		
		//모델에서만 사용할 가(test용)
		function getProductsByZoneidAndPackage($zoneid, $package){
			$result = $this->orderCloudModel->getProductsByZoneidAndPackage($zoneid, $package);
			echo var_dump($result);
		}
	}