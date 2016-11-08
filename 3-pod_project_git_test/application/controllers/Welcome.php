<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends MY_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
// 		$this->load->view('welcome_message');
		 
		$this->_head();
		$returnURI = '/'; // 일단임의로 나중에 returnURI 다시 처리하자
		$this->_require_login($returnURI);
		
		$this->load->model('accountModel');
		$accounts = $this->accountModel->getlistAccounts();
		$accountCount = $accounts['count'];
			
		$this->load->model('networksModel');
		$addIpCount =  $this->networksModel->getAddIpCount();
			
		$this->load->model('networksModel');
		$nasCIPCount = $this->networksModel->getNasCIPCount();
			
		$this->load->model('volumesModel');
		$addVolumeCount =  $this->volumesModel->getAddVolumeCount();
			
		$this->load->model('nasModel');
		$nasVolumeCount = $this->nasModel->getVolumes('status', 'online')['count'];
			
		$data = array(
				'account' => $accounts['account'],
				'accountCount' => $accountCount,
				'addIpCount' => $addIpCount,
				'nasCIPCount' => $nasCIPCount,
				'addVolumeCount' => $addVolumeCount,
				'nasVolumeCount' => $nasVolumeCount
		);
		
		$this->load->view('welcome',$data);
		
		$this->_footer(); 
	}
}
