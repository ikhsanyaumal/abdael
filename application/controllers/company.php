<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Company extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('m_company');
	}

	public function index(){
		$project_company_id = $this->session->userdata('project_company_id');
		$where = 'where project_company_id = '.$project_company_id;
		if ($this->session->userdata('project_company_id') == '') {
			$where = 'where project_company_id = 0';
		}
		$data=array(
			"company" => $this->m_company->getCompany()->result_array(),
			"project" => $this->m_company->getProject($where)->result_array(),
		);
		$comp=array(
			"content"=>$this->load->view('v_company',$data,true),
		);
		$this->load->view('main',$comp);
	}

	public function set_project_company(){
		if ($this->input->post('project_company_id')!=='NULL') {
			$project_company_id = $this->input->post('project_company_id');
			$project_id = $this->input->post('project_id');
			$this->session->set_userdata('project_company_id', $project_company_id);
			$this->session->set_userdata('project_id', $project_id);
			redirect('voucher_in');
		}else{
			$this->session->unset_userdata('project_company_id');
			$this->session->unset_userdata('project_id');
			redirect('voucher_in');
		}
	}

	public function load_project() {
		$project_company_id = $this->input->post('project_company_id');
		$project = $this->m_company->getProject('where project_company_id = '.$project_company_id)->result_array();
		echo "<option value='0'>INVENTARIS KANTOR</option>";
		foreach ($project as $project) {
			$selected = '';
			if($this->session->userdata('project_id') == $project['project_id']) {
				$selected = 'selected';
			}
			echo "<option value=".$project['project_id']." ".$selected.">".$project['name']."</option>";
		}
	}

}