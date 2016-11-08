<?php
 
class OrderNasModel extends CI_Model {
	function __construct() {
		parent::__construct ();
		$this->load->model ( 'callApiModel' ); 
	}
	 
	function addVolume() {
		$cmdArr = array (
						"command" => "addVolume",
						"name" => $_POST['name'],
						"usageplantype" =>$_POST['usageplantype'],
						"path" =>$_POST['path'],
						"totalsize" => $_POST['totalsize'],
						"volumetype" => $_POST['volumetype'],
						"zoneid" => $_POST['zoneid'],
						"apikey" => $_SESSION ['apikey']
				);//autoresize=false&usageplantype=monthly

// 		$cmdArr = array (
// 								"command" => "addVolume",
// 								"name" => 'test2',
// 								"usageplantype" => 'hourly',
// 								"path" => 'test',
// 								"totalsize" => 1000,
// 								"volumetype" => 'cifs',
// 								"zoneid" => 'eceb5d65-6571-4696-875f-5a17949f3317',
// 								"apikey" => $_SESSION ['apikey']
// 						);//autoresize=false&usageplantype=monthly
		 
		if($_POST['volumetype'] == 'cifs'){
			$this->load->model('cifsAccountModel');
			$cifsModel = new CifsAccountModel();
			//$this->cifsAccountModel->checkCreateCIFSAccountForFirst();
			$cifsModel->checkCreateCIFSAccountForFirst();
		} 
		
		$result = $this->callApiModel->callCommand( CallApiModel::NASURI, $cmdArr, $this->session->userdata ( 'secretkey' ) );
		
		return $result;
	} 
	 
}