<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	class AsyncProcess extends MY_Controller{
		function __construct()
		{
			parent::__construct();
			$this->load->model('asyncProcessModel');
		}
		
		function index(){
			echo '비동기처리 controller의 index 함수입니다.';
		}
		
		function queryAsyncJobResult($jobid){
			$this->_require_login('/');
			$result = $this->asyncProcessModel->queryAsyncJobResult($jobid); 
			print(json_encode($result));
		}
		
		function queryAsyncJobResult2($jobid){
			$this->_require_login('/');
			$result = $this->asyncProcessModel->queryAsyncJobResult2($jobid);
			print(json_encode($result));
		}
		
		function setSessionJobid($jobid){
			$_SESSION['jobid'] = $jobid;
		}
		
		function getSessionJobid(){
			if(isset($_SESSION['jobid']))
				echo $_SESSION['jobid'];
			else
				echo 'noexist';
		}
		
		function unsetSessionJobid(){
			if(isset($_SESSION['jobid'])){
				unset($_SESSION["jobid"]);
			}
		} 
		
		function unsetSessionValue($key){
			if(isset($_SESSION[$key])){
				unset($_SESSION[$key]);
			}
		}
		
		function setSessionValue($key, $value){
			$_SESSION[$key] = $value;
		}
		
		function getSessionValue($key){
			if(isset($_SESSION[$key]))
				echo $_SESSION[$key];
			else
				echo 'false';
		}
	}