<?php
 
class NasModel extends CI_Model {
	function __construct() {
		parent::__construct ();
		$this->load->model ( 'callApiModel' ); 
	} 
	
	function deleteVolume($volumeid) {
		$cmdArr = array (
				"command" => "deleteVolume",
				"id" => $volumeid,
				"apikey" => $_SESSION ['apikey']
		);
	
		$result = $this->callApiModel->callCommand( CallApiModel::NASURI, $cmdArr, $this->session->userdata ( 'secretkey' ) );
	
		return $result;
	}
	
	function addNicToVirtualMachine($networkid,$virtualmachineid ){ //비동기
		$cmdArr = array (
				"command" => "addNicToVirtualMachine",
				"networkid" => $networkid,
				"virtualmachineid" => $virtualmachineid,
				"apikey" => $_SESSION ['apikey']
		);
		
		$jobid = $this->callApiModel->callCommand( CallApiModel::URI, $cmdArr, $this->session->userdata ( 'secretkey' ) );
		
		return $jobid;
	}
	
	function removeNicFromVirtualMachine($nicid,$virtualmachineid ){ //비동기
		$cmdArr = array (
				"command" => "removeNicFromVirtualMachine",
				"nicid" => $nicid,
				"virtualmachineid" => $virtualmachineid,
				"apikey" => $_SESSION ['apikey']
		);
		
		$jobid = $this->callApiModel->callCommand( CallApiModel::URI, $cmdArr, $this->session->userdata ( 'secretkey' ) );
		
		return $jobid;
	} 
 	
	function getlistVolumes(){
		$cmdArr = array (
				"command" => "listVolumes", 
				"apikey" => $_SESSION ['apikey']
		);
		
		$result = $this->callApiModel->callCommand( CallApiModel::NASURI, $cmdArr, $this->session->userdata ( 'secretkey' ) );
		return $result;
	}
	
	function getVolumes($condition, $value){
		$cmdArr = array (
				"command" => "listVolumes",
				$condition => $value,
				"apikey" => $_SESSION ['apikey']
		); 
		$result = $this->callApiModel->callCommand( CallApiModel::NASURI, $cmdArr, $this->session->userdata ( 'secretkey' ) );
		return $result;
	}
	
	function getVolumesByZoneid($zoneid){
		$result = $this->getVolumes('status', 'online');
// 		echo '<pre>';
// 		echo var_dump($result);
// 		echo '</pre>';
		$resultArray = array();
		
		$volumes = $result['response'];
		
		$count = $result['count'];
		
		for($i=0; $i<$count; $i++){
			if($count == 1){
				$volume = $result['response'];
			}else{
				$volume = $volumes[$i];
			}
			
			if($volume['zoneid'] == $zoneid){
				array_push($resultArray, $volume);
			}
		} 
		
		$temp['count'] = count($resultArray);
		if(count($resultArray) == 1){
			 $temp['response'] = $resultArray[0];
		}else{
			$temp['response'] = $resultArray;
		}
		
		return $temp;
	}
	function getRunningVolumeZones(){
		$runningVolumes = $this->getVolumes('status', 'online')['response'];
		$zoneids = array();
		
		foreach($runningVolumes as $volume){
			array_push($zoneids, $volume['zoneid']);
		}
		return $zoneids;
	} 
}