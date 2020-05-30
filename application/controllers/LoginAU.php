<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LoginAU extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('M_login');
		$this->load->model('M_admin');
	}

	public function index()
	{
		$this->load->helper('url');

		$this->load->view('login');
	}

	public function login()
	{
		$user = $this->input->post('username');
		$pass = $this->input->post('password');
		$cek = $this->M_login->cekLogin($user,md5($pass));
		if($cek->level = 'Admin'){
			$this->session->username = $user;
			$data = array(
				'akun'						=> $this->M_admin->getAkun($user),
				'user'						=> $this->M_admin->getAkunUser(),
				'kategoriumkm' 		=> $this->M_admin->getjumKU(),
				'kategoriproduk'	=> $this->M_admin->getjumPU(),
				'produk'					=> $this->M_admin->getjumP(),
				'informasi'				=> $this->M_admin->getjumI(),
				'market'					=> $this->M_admin->getjumM(),
				'portofolio'			=> $this->M_admin->getjumPo(),
				'slide'						=> $this->M_admin->getjumS(),
			);
			$this->load->view('admin/dashboard',$data);
		}else if($cek->level = 'UMKM'){
			//ini yang UMKM yaa
		}
	}

	function logout(){
		$this->session->sess_destroy();
		redirect('LoginAU');
	}
}
