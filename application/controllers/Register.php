<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('ModelRegister');
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
			'action' => site_url('Register/createUser'),
			'level' => set_value('level'),
			'paguyuban' => $this->ModelRegister->dataPaguyuban(),
		);
		$this->load->view('Register', $data);     
	}

	public function createUser() 
	{
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$email = $this->input->post('email');

		$cek = $this->ModelRegister->cekUser($username, $password, $email);

		if (!$cek) {
			
			if ($this->input->post('level') == 'Admin') {
				$password=md5($this->input->post('password'));
				$data = array(
					'id_user' => $this->ModelRegister->idUser(),
					'username' => $this->input->post('username'),
					'password' => $password,
					'nama' => $this->input->post('nama'),
					'email' => $this->input->post('email'),
					'status' => "verified",
					'level'=> "Admin",
				);
				$this->ModelRegister->createUser($data);
				redirect('Login','refresh');

			}elseif ($this->input->post('level') == 'Paguyuban') {
				$password=md5($this->input->post('password'));
				$idUser = $this->ModelRegister->idUser();
				$tabelUser = array(
					'id_user' => $idUser,
					'username' => $this->input->post('username'),
					'password' => $password,
					'nama' => $this->input->post('nama'),
					'email' => $this->input->post('email'),
					'status' => "verified",
					'level'=> "Paguyuban",
				);

				$tabelPaguyuban = array(
					'id_paguyuban' => $this->ModelRegister->idPaguyuban(),
					'nama_paguyuban' => $this->input->post('nama_paguyuban'),
					'keterangan' => $this->input->post('keterangan'),
					'lokasi' => $this->input->post('lokasi'),
					'id_user' => $this->ModelRegister->idUser(),
				);

				$this->ModelRegister->createUser($tabelUser);
				$this->ModelRegister->createPaguyuban($tabelPaguyuban);
				
				redirect('Login','refresh');

			}elseif ($this->input->post('level') == 'UMKM') {
				$password=md5($this->input->post('password'));
				$tabelUser = array(
					'id_user' => $this->ModelRegister->idUser(),
					'username' => $this->input->post('username'),
					'password' => $password,
					'nama' => $this->input->post('nama'),
					'email' => $this->input->post('email'),
					'status' => "pending",
					'level'=> "UMKM",
				);

				$tabelUMKM = array(
					'id_umkm' => $this->ModelRegister->idUMKM(),
					'nama_umkm' => $this->input->post('nama_umkm'),
					'alamat' => $this->input->post('alamat'),
					'id_paguyuban' => $this->input->post('id_paguyuban'),
					'id_user' => $this->ModelRegister->idUser(),
				);

				$userUMKM = array(
					'id_user' => $this->ModelRegister->idUser(),
					'id_umkm' => $this->ModelRegister->idUMKM(),
				);


				$this->ModelRegister->createUser($tabelUser);
				$this->ModelRegister->createUMKM($tabelUMKM);
				$this->ModelRegister->createUserUMKM($userUMKM);

				redirect('Login','refresh');
			}

		} else {
			redirect('Register','refresh');
		}

	}

}                  