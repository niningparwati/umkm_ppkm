<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('ModelRegister');
		$this->load->model('M_admin');
	}

	//===================== SESSION NOMOR INVOICE ====================
	public function set_level_user()
	{
		$_SESSION['level_user'] = $this->input->post('level', TRUE);
		echo json_encode('ok');
	}
    //=================== END SESSION NOMOR INVOICE ====================

	public function index()
	{
		$this->load->view('Head');
		$data = array(
			'action' 		=> site_url('Register/createUser'),
			'level' 		=> set_value('level'),
			'idkategori'=> $this->M_admin->getkategoriUMKM()
		);
		$this->load->view('Register', $data);
	}

	public function createUser()
	{
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$email = $this->input->post('email');

		$cek = $this->ModelRegister->cekUser($username, $password, $email);
		$cekUMKM = $this->ModelRegister->cekUMKM();
		$cekAdmin = $this->ModelRegister->cekAdmin();
		$cekUser = $this->ModelRegister->cekUserr();

		if (!$cek) {
			if ($this->input->post('level') == 'Admin') {
				$User = $this->ModelRegister->idUser();
				$password=md5($this->input->post('password'));
				$data = array(
					'id_user'  		 => $User,
					'username' 		 => $this->input->post('username'),
					'password' 		 => $password,
					'nama_lengkap' => $this->input->post('nama'),
					'email' 			 => $this->input->post('email'),
					'tanggal_join' => $this->input->post('tgl'),
					'status' 			 => "verified",
					'level'				 => "Admin",
				);
				$Admin = $this->ModelRegister->idAdmin();
				$dataq = array(
					'id_user'  		     => $User,
					'nomor_telp_admin' => $this->input->post('nohp'),
					'alamat_admin'		 => $this->input->post('alamat'),
					'id_admin'				 => $Admin
				);
				$this->ModelRegister->create_user($data);
				$this->ModelRegister->create_admin($dataq);
				redirect('LoginAU','refresh');

			}elseif ($this->input->post('level') == 'UMKM') {
				$password=md5($this->input->post('password'));
				$User = $this->ModelRegister->idUser();
				$data = array(
					'id_user'  		 => $User,
					'username' 		 => $this->input->post('username'),
					'password' 		 => $password,
					'nama_lengkap' => $this->input->post('nama'),
					'email' 			 => $this->input->post('email'),
					'tanggal_join' => $this->input->post('tgl'),
					'status' 			 => 'pending',
					'level'				 => "UMKM",
				);
				$this->ModelRegister->create_user($data);
				$UMKM = $this->ModelRegister->idUMKM();
				$dataq = array(
					'id_umkm' => $UMKM,
					'nama_umkm' => $this->input->post('namaumkm'),
					'alamat_umkm' => $this->input->post('alamat'),
					'deskripsi_umkm' => $this->input->post('deskripsi'),
					'nomor_telp_umkm' => $this->input->post('nohp'),
					'id_kategori_umkm' => $this->input->post('idkategori'),
					'id_user' =>  $User,
				);
				$this->ModelRegister->create_umkm($dataq);
				redirect('LoginAU','refresh');
			}
		} else {
			redirect('Register','refresh');
		}

	}

	public function registerUMKM()
	{
			$this->load->view('Head');
			$data = array(
				'action' 		=> site_url('Register/createUser'),
				'idkategori'=> $this->M_admin->getkategoriUMKM()
			);
		$this->load->view('registUMKM',$data);
	}

	public function registAdmin()
	{
		$this->load->view('Head');
		$data = array(
			'action' 		=> site_url('Register/createUser'),
			'idkategori'=> $this->M_admin->getkategoriUMKM()
		);
	$this->load->view('registAdmin',$data);
	}

}
