<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Order extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->library('cfpdf');
	}

	public function index(){
		if ($this->session->userdata('project_id')) {
			$project_id = $this->session->userdata('project_id');
		}else{
			redirect('project');
		}

		$where = "where order.status='1' and order.project_id=".$project_id;
		$data=array(
			"order" => $this->mymodel->getOrder($where)->result_array(),
		);
		$comp=array(
			"content"=>$this->load->view('order/spr',$data,true),
		);
		$this->load->view('main',$comp);
	}

	function order_payment($id){
		$where = "where order.spr_id = ".$id;

		if ($this->session->userdata('project_id')) {
			$project_id = $this->session->userdata('project_id');
		}else{
			redirect(base_url()."project");
		}

		$data=array(
			"order" => $this->mymodel->getOrder($where)->result_array(),
			"payment" => $this->mymodel->getPayment(" where payment.spr_id = ".$id." and payment.status = 1")->result_array(),
			"history_transaksi"	=> $this->mymodel->getHistoryTransaksi(" where payment.spr_id = ".$id." and payment.`status`=1")->result_array(),
			"history_inhouse"	=> $this->mymodel->getHistoryInhouse(" where payment.spr_id = ".$id." and payment.`status`=1")->result_array(),
		);

		$comp=array(
			"content"=>$this->load->view('order/spr_payment',$data,true),
		);
		$this->load->view('main',$comp);
	}

	function update_child($id){
		$kwitansi_payment = str_replace(".", "",$_POST['kwitansi_payment']);;
		$kwitansi_date = $_POST['kwitansi_date'];
		$periode = date_format(date_create($kwitansi_date),"Y-m");
		$cluster_id = $_POST['cluster_id'];

		$kwitansi = $this->mymodel->getLastKwitansi("where kwitansi.kwitansi_id = ".$id)->result_array();
		if ($periode == $kwitansi['periode']) {
			$name = $kwitansi['name'];
		}else{
			$last_kwitansi = $this->mymodel->getLastKwitansi("where kwitansi.periode = '".$periode."'")->result_array();
			if ($last_kwitansi) {
				foreach ($last_kwitansi as $last_kwitansi);
				$name = $last_kwitansi['name'];
				$no = substr( $name, 0, 4 );
				$no = ($no*1)+1;
				$no = sprintf("%04d", $no);
				$name = $no.'/'.date_format(date_create($kwitansi_date),"m/Y");
			}else{
				if ($cluster_id == 8) {
					$name = '0501/'.date_format(date_create($kwitansi_date),"m/Y");
				}else{
					$name = '0101/'.date_format(date_create($kwitansi_date),"m/Y");
				}
			}
		}

		// update kwitansi
		$where = "kwitansi_id = ".$id;
		$data = array(
			'name' => $name,
			'payment' => $kwitansi_payment,
			'date' => $kwitansi_date,
			'periode' => $periode,
			);
		$this->mymodel->updateData('`kwitansi`',$data,$where);
	}

	function save_kwitansi_dp(){
		$history_id = $_POST['history_id'];
		$kwitansi_payment = str_replace(".", "",$_POST['kwitansi_payment']);;
		$kwitansi_date = $_POST['kwitansi_date'];
		$periode = date_format(date_create($kwitansi_date),"Y-m");
		$cluster_id = $_POST['cluster_id'];

		// get kwitansi number
		$history_transaksi = $this->mymodel->getHistoryTransaksi(" where history_transaksi.history_id = ".$history_id)->result_array();
		foreach ($history_transaksi as $history_transaksi);
		if ($history_transaksi['kwitansi_id'] == '') {
			// kwitansi baru
			$last_kwitansi = $this->mymodel->getLastKwitansi("where kwitansi.periode = '".$periode."'")->result_array();
			if ($last_kwitansi) {
				foreach ($last_kwitansi as $last_kwitansi);
				$name = $last_kwitansi['name'];
				$no = substr( $name, 0, 4 );
				$no = ($no*1)+1;
				$no = sprintf("%04d", $no);
				$name = $no.'/'.date_format(date_create($kwitansi_date),"m/Y");
			}else{
				// if ($cluster_id == 8) {
					$name = '0501/'.date_format(date_create($kwitansi_date),"m/Y");
				// }else{
					// $name = '0101/'.date_format(date_create($kwitansi_date),"m/Y");
				// }
			}
			$data = array(
				'name' => $name,
				'payment' => $kwitansi_payment,
				'date' => $kwitansi_date,
				'periode' => $periode,
				);
			$this->mymodel->insertData('`kwitansi`',$data);
			$kwitansi_id = $this->db->insert_id();

			// update history_transaksi add kwitansi_id
			$where = "history_id = ".$history_id;
			$data = array(
				'kwitansi_id' => $kwitansi_id,
				);
			$this->mymodel->updateData('`history_transaksi`',$data,$where);

		}else{
			// update kwitansi
			if ($history_transaksi['periode'] == $periode) {
				// name tetap
				$name = $history_transaksi['name'];
			}else{
				// name baru
				$last_kwitansi = $this->mymodel->getLastKwitansi("where kwitansi.periode = '".$periode."'")->result_array();
				if ($last_kwitansi) {
					foreach ($last_kwitansi as $last_kwitansi);
					$name = $last_kwitansi['name'];
					$no = substr( $name, 0, 4 );
					$no = ($no*1)+1;
					$no = sprintf("%04d", $no);
					$name = $no.'/'.date_format(date_create($kwitansi_date),"m/Y");
				}else{
					// if ($cluster_id == 8) {
						$name = '0501/'.date_format(date_create($kwitansi_date),"m/Y");
					// }else{
						// $name = '0101/'.date_format(date_create($kwitansi_date),"m/Y");
					// }
				}
			}
			// update kwitansi
			$where = "kwitansi_id = ".$history_transaksi['kwitansi_id'];
			$data = array(
				'name' => $name,
				'payment' => $kwitansi_payment,
				'date' => $kwitansi_date,
				'periode' => $periode,
				);
			$this->mymodel->updateData('`kwitansi`',$data,$where);
		}

		
		echo $kwitansi_id;
		// redirect('order');
	}

	function save_kwitansi_dp_child(){
		$kwitansi_payment = str_replace(".", "",$_POST['child_payment']);;
		$kwitansi_date = $_POST['child_date'];
		$periode = date_format(date_create($kwitansi_date),"Y-m");
		$cluster_id = $_POST['cluster'];
		$kwitansi_id = $_POST['kwitansi_id'];
		$child_ket = $_POST['child_ket'];

		// get kwitansi number
		// kwitansi baru
		$last_kwitansi = $this->mymodel->getLastKwitansi("where kwitansi.periode = '".$periode."'")->result_array();
		if ($last_kwitansi) {
			foreach ($last_kwitansi as $last_kwitansi);
			$name = $last_kwitansi['name'];
			$no = substr( $name, 0, 4 );
			$no = ($no*1)+1;
			$no = sprintf("%04d", $no);
			$name = $no.'/'.date_format(date_create($kwitansi_date),"m/Y");
		}else{
			// if ($cluster_id == 8) {
				$name = '0501/'.date_format(date_create($kwitansi_date),"m/Y");
			// }else{
				// $name = '0101/'.date_format(date_create($kwitansi_date),"m/Y");
			// }
		}
		$data = array(
			'name' => $name,
			'payment' => $kwitansi_payment,
			'date' => $kwitansi_date,
			'periode' => $periode,
			'parent_id' => $kwitansi_id,
			'note' => $child_ket,
			);
		$this->mymodel->insertData('`kwitansi`',$data);
		$kwitansi_id = $this->db->insert_id();

		// echo $name;
		header('location:'.$_SERVER['HTTP_REFERER']);

	}

	function save_kwitansi_cicilan(){
		$history_id = $_POST['history_id'];
		$kwitansi_payment = str_replace(".", "",$_POST['kwitansi_payment']);;
		$kwitansi_date = $_POST['kwitansi_date'];
		$periode = date_format(date_create($kwitansi_date),"Y-m");
		$cluster_id = $_POST['cluster_id'];

		// get kwitansi number
		$history_inhouse = $this->mymodel->getHistoryInhouse(" where history_inhouse.history_id = ".$history_id)->result_array();
		foreach ($history_inhouse as $history_inhouse);
		if ($history_inhouse['kwitansi_id'] == '') {
			// kwitansi baru
			$last_kwitansi = $this->mymodel->getLastKwitansi("where kwitansi.periode = '".$periode."'")->result_array();
			if ($last_kwitansi) {
				foreach ($last_kwitansi as $last_kwitansi);
				$name = $last_kwitansi['name'];
				$no = substr( $name, 0, 4 );
				$no = ($no*1)+1;
				$no = sprintf("%04d", $no);
				$name = $no.'/'.date_format(date_create($kwitansi_date),"m/Y");
			}else{
				// if ($cluster_id == 8) {
					$name = '0501/'.date_format(date_create($kwitansi_date),"m/Y");
				// }else{
					// $name = '0101/'.date_format(date_create($kwitansi_date),"m/Y");
				// }
			}
			$data = array(
				'name' => $name,
				'payment' => $kwitansi_payment,
				'date' => $kwitansi_date,
				'periode' => $periode,
				);
			$this->mymodel->insertData('`kwitansi`',$data);
			$kwitansi_id = $this->db->insert_id();

			// update history_inhouse add kwitansi_id
			$where = "history_id = ".$history_id;
			$data = array(
				'kwitansi_id' => $kwitansi_id,
				);
			$this->mymodel->updateData('`history_inhouse`',$data,$where);

		}else{
			// update kwitansi
			if ($history_inhouse['periode'] == $periode) {
				// name tetap
				$name = $history_inhouse['name'];
			}else{
				// name baru
				$last_kwitansi = $this->mymodel->getLastKwitansi("where kwitansi.periode = '".$periode."'")->result_array();
				if ($last_kwitansi) {
					foreach ($last_kwitansi as $last_kwitansi);
					$name = $last_kwitansi['name'];
					$no = substr( $name, 0, 4 );
					$no = ($no*1)+1;
					$no = sprintf("%04d", $no);
					$name = $no.'/'.date_format(date_create($kwitansi_date),"m/Y");
				}else{
					// if ($cluster_id == 8) {
						$name = '0501/'.date_format(date_create($kwitansi_date),"m/Y");
					// }else{
						// $name = '0101/'.date_format(date_create($kwitansi_date),"m/Y");
					// }
				}
			}
			// update kwitansi
			$where = "kwitansi_id = ".$history_inhouse['kwitansi_id'];
			$data = array(
				'name' => $name,
				'payment' => $kwitansi_payment,
				'date' => $kwitansi_date,
				'periode' => $periode,
				);
			$this->mymodel->updateData('`kwitansi`',$data,$where);
		}
		echo $kwitansi_id;
		// redirect('order');
	}

	function save_kwitansi_cicilan_child(){
		$kwitansi_payment = str_replace(".", "",$_POST['inhouse_child_payment']);;
		$kwitansi_date = $_POST['inhouse_child_date'];
		$periode = date_format(date_create($kwitansi_date),"Y-m");
		$cluster_id = $_POST['inhouse_cluster'];
		$kwitansi_id = $_POST['inhouse_kwitansi_id'];
		$child_ket = $_POST['child_ket'];

		// get kwitansi number
		// kwitansi baru
		$last_kwitansi = $this->mymodel->getLastKwitansi("where kwitansi.periode = '".$periode."'")->result_array();
		if ($last_kwitansi) {
			foreach ($last_kwitansi as $last_kwitansi);
			$name = $last_kwitansi['name'];
			$no = substr( $name, 0, 4 );
			$no = ($no*1)+1;
			$no = sprintf("%04d", $no);
			$name = $no.'/'.date_format(date_create($kwitansi_date),"m/Y");
		}else{
			// if ($cluster_id == 8) {
				$name = '0501/'.date_format(date_create($kwitansi_date),"m/Y");
			// }else{
				// $name = '0101/'.date_format(date_create($kwitansi_date),"m/Y");
			// }
		}
		$data = array(
			'name' => $name,
			'payment' => $kwitansi_payment,
			'date' => $kwitansi_date,
			'periode' => $periode,
			'parent_id' => $kwitansi_id,
			'note' => $child_ket,
			);
		$this->mymodel->insertData('`kwitansi`',$data);
		$kwitansi_id = $this->db->insert_id();

		// echo $name;
		header('location:'.$_SERVER['HTTP_REFERER']);

	}

	function print_kwitansi_dp($history_id){
		$history_transaksi = $this->mymodel->getHistoryTransaksi(" where history_transaksi.history_id = ".$history_id)->result_array();
		foreach ($history_transaksi as $history_transaksi);
		$id = $history_transaksi['spr_id'];
		
		$where = "where order.spr_id = ".$id;

		if ($this->session->userdata('project_id')) {
			$project_id = $this->session->userdata('project_id');
		}else{
			redirect(base_url()."project");
		}

		$data=array(
			"project" => $this->mymodel->getProject(" where project.project_id=".$project_id)->result_array(),
			"order" => $this->mymodel->getOrder($where)->result_array(),
			"payment" => $this->mymodel->getPayment(" where payment.spr_id = ".$id." and payment.status = 1")->result_array(),
			"history_transaksi"	=> $this->mymodel->getHistoryTransaksi(" where history_transaksi.history_id = ".$history_id)->result_array(),
		);

		
		$view = 'order/kwitansi_dp';
		$this->load->view($view,$data);
	}

	function print_kwitansi_inhouse($history_id){
		$history_inhouse = $this->mymodel->getHistoryInhouse(" where history_inhouse.history_id = ".$history_id)->result_array();
		foreach ($history_inhouse as $history_inhouse);
		$id = $history_inhouse['spr_id'];
		
		$where = "where order.spr_id = ".$id;

		if ($this->session->userdata('project_id')) {
			$project_id = $this->session->userdata('project_id');
		}else{
			redirect(base_url()."project");
		}

		$data=array(
			"project" => $this->mymodel->getProject(" where project.project_id=".$project_id)->result_array(),
			"order" => $this->mymodel->getOrder($where)->result_array(),
			"payment" => $this->mymodel->getPayment(" where payment.spr_id = ".$id." and payment.status = 1")->result_array(),
			"history_inhouse" => $this->mymodel->getHistoryInhouse(" where history_inhouse.history_id = ".$history_id)->result_array(),
		);

		
		$view = 'order/kwitansi_inhouse';
		$this->load->view($view,$data);
	}

	function delete($id){
		// $where = "customer_id = ".$id;
		// $this->mymodel->deleteData('customer',$where);
		// redirect('customer');
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */