	<?php if(! defined('BASEPATH')) exit('Akses langsung tidak diperbolehkan');

class Simple_login {
	// SET SUPER GLOBAL
	var $CI = NULL;
	public function __construct() {
		$this->CI =& get_instance();
	}
	// Fungsi login
	public function login($username, $password) {
		$datetime = date('Y-m-d H:i:s');
		$password = md5($password);
		// echo $password;
		$query = $this->CI->db->query("select * from user where username = '$username' and password_hash = '$password'");

		if($query->num_rows() == 1) {
			$row = $this->CI->db->query('SELECT id FROM user where username = "'.$username.'" and password_hash = "'.$password.'"');
			$admin = $row->row();
			$id = $admin->id;
			echo $id;

			$log = $this->CI->db->query("insert into log_login (user_id,apps,action,time) values (".$id.",'finance','log in','".$datetime."')");
			if ($log) {
				$this->CI->session->set_userdata('finance_username', $username);
				// $this->CI->session->set_userdata('id_login', uniqid(rand()));
				$this->CI->session->set_userdata('finance_user_id', $id);

				redirect('project');
			}else{
				$this->CI->session->set_flashdata('Gagal','Username/password salah...');
				redirect('login');
			}
		}else{
			$this->CI->session->set_flashdata('sukses','Username/password salah...');
			redirect('login');
		}
		return false;
	}

	// Proteksi halaman
	public function cek_login() {
		if($this->CI->session->userdata('finance_username') == '') {
			$this->CI->session->set_flashdata('sukses','Anda belum login');
			redirect(base_url('login'));
		}
		
		// if($this->CI->session->userdata('project_id') == '' || $this->CI->session->userdata('project_id')) {
		// 	redirect(base_url('project'));
		// }
	}

	// Fungsi logout
	public function logout() {
		$datetime = date('Y-m-d H:i:s');
		$id = $this->CI->session->userdata('finance_user_id');
		$log = $this->CI->db->query("insert into log_login (user_id,apps,action,time) values (".$id.",'finance','log out','".$datetime."')");

		$this->CI->session->unset_userdata('finance_username');
		// $this->CI->session->unset_userdata('id_login');
		$this->CI->session->unset_userdata('finance_user_id');
		$this->CI->session->unset_userdata('project_id');
		$this->CI->session->set_flashdata('sukses','Anda berhasil logout');
		redirect('login');
	}
}