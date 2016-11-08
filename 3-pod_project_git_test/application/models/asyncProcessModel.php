<?php
class AsyncProcessModel extends CI_Model {
	function __construct() {
		parent::__construct ();
		$this->load->model ( 'callApiModel' ); 
	}
	
	function queryAsyncJobResult($jobid) {
		$result;
		$count=0;
		do {
			$cmdArr = array(
					"command" => "queryAsyncJobResult",
					"jobid" => $jobid,
					"apikey" => $_SESSION ['apikey']
			);
			
			$result = $this->callApiModel->callCommand(CallApiModel::URI, $cmdArr, $_SESSION['secretkey']);
			
			if($result==null){
				return $result;
			}
// 			if($count>3){
// 				return $count.'error';
// 			}
			$jobStatus = $result["jobstatus"];
// 			echo $jobStatus;
// 			echo '<br><hr>';
			if ($jobStatus == 2) { //실패
				printf($result["jobresult"]);
				exit;
				return 'error';
			}
			sleep(2);
			//echo var_dump($result);
		} while ($jobStatus != 1);
		
		return $result;
	}
	
	function queryAsyncJobResult2($jobid) {
		$cmdArr = array(
				"command" => "queryAsyncJobResult",
				"jobid" => $jobid,
				"apikey" => $_SESSION ['apikey']
		);
			
		$result = $this->callApiModel->callCommand(CallApiModel::URI, $cmdArr, $_SESSION['secretkey']);
		 
		return $result;
	}
	 
}