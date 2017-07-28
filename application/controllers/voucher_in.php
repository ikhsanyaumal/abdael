<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Voucher_in extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('m_voucherin');
		$this->load->model('m_company');
		$this->load->library('cfpdf');
	}

	public function cek_company_id(){
		if ($this->session->userdata('project_company_id') == NULL) {
			redirect('company');
		}
	}

	public function index(){
		$this->cek_company_id();

		$project_company_id = $this->session->userdata('project_company_id');
		$where = "where voucher_in.project_company_id=".$project_company_id;
		$data=array(
			"voucher_in" => $this->m_voucherin->getVoucherin($where)->result_array(),
		);
		$comp=array(
			"content"=>$this->load->view('voucher_in/v_voucher_in',$data,true),
		);
		$this->load->view('main',$comp);
	}

	public function voucher_in_add(){
		$this->cek_company_id();

		$data=array(
			"coa" => $this->m_voucherin->getCoa()->result_array(),
			"department" => $this->m_voucherin->getDepartment()->result_array(),
			"partner" => $this->m_voucherin->getPartner()->result_array(),
		);
		$comp=array(
			"content"=>$this->load->view('voucher_in/v_voucher_in_add',$data,true),
		);
		$this->load->view('main',$comp);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */