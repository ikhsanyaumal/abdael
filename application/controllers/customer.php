<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Customer extends CI_Controller {

	function __construct(){
		parent::__construct();
	}

	public function index(){
		if ($this->session->userdata('project_id')) {
			$project_id = $this->session->userdata('project_id');
		}else{
			redirect('project');
		}

		$data=array(
			"customer" => $this->mymodel->getCustomer()->result_array(),
		);
		$comp=array(
			"content"=>$this->load->view('customer/customer',$data,true),
		);
		$this->load->view('main',$comp);
	}

	public function customer_add(){
		if ($this->session->userdata('project_id')) {
			$project_id = $this->session->userdata('project_id');
		}else{
			redirect('project');
		}

		$comp=array(
			"content"=>$this->load->view('customer/customer_add','0',true),
		);
		$this->load->view('main',$comp);
	}

	function add(){
		$name = $this->input->post('name');
		$ktp = $this->input->post('ktp');
		$address = $this->input->post('alamat_ktp');
		$mail_address = $this->input->post('alamat_ktp');
		$phone = $this->input->post('phone');
		$email = $this->input->post('email');
		$npwp = $this->input->post('npwp');

		$data = array(
			'name' => $name,
			'ktp' => $ktp,
			'address' => $address,
			'mail_address' => $mail_address,
			'phone' => $phone,
			'email' => $email,
			'npwp' => $npwp
			);
		$this->mymodel->insertData('customer',$data);
		redirect('customer');
	}

	function customer_update($id){
		if ($this->session->userdata('project_id')) {
			$project_id = $this->session->userdata('project_id');
		}else{
			redirect('project');
		}
		
		$where = "where customer_id = ".$id;
		$data=array(
			"customer" => $this->mymodel->getCustomer($where)->result_array(),
		);
		$comp=array(
			"content"=>$this->load->view('customer/customer_update',$data,true),
		);
		$this->load->view('main',$comp);
	}

	function update($id){
		$where = "customer_id = ".$id;
		$name = $this->input->post('name');
		$ktp = $this->input->post('ktp');
		$address = $this->input->post('alamat_ktp');
		$mail_address = $this->input->post('alamat_ktp');
		$phone = $this->input->post('phone');
		$email = $this->input->post('email');
		$npwp = $this->input->post('npwp');

		$data = array(
			'name' => $name,
			'ktp' => $ktp,
			'address' => $address,
			'mail_address' => $mail_address,
			'phone' => $phone,
			'email' => $email,
			'npwp' => $npwp
			);
		$this->mymodel->updateData('customer',$data,$where);
		redirect('customer');
	}

	function delete($id){
		$where = "customer_id = ".$id;
		$this->mymodel->deleteData('customer',$where);
		redirect('customer');
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */