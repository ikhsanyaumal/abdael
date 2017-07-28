<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Project extends CI_Controller {

	function __construct(){
		parent::__construct();
	}

	public function index(){
		$data=array(
			"project" => $this->mymodel->getProject()->result_array(),
		);
		$comp=array(
			"content"=>$this->load->view('project',$data,true),
		);
		$this->load->view('main',$comp);
	}

	public function set_project(){
		if ($this->input->post('project')!=='NULL') {
			$project = $this->input->post('project');
			$this->session->set_userdata('project_id', $project);
			redirect('order');
		}else{
			$this->session->unset_userdata('project_id');
			redirect('project');
		}
	}

	public function cek_project() {
		if($this->session->userdata('project_id') == '' ) {
			redirect(base_url('project'));
		}
	}
}