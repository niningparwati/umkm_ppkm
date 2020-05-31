<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('ModelLogin');
	}

	public function index()
	{
		$this->load->view('Head');
		$data = array(
			'action' => site_url('Login/actionLogin')
		);
		$this->load->view('Login', $data);
	}

	public function actionLogin()
	{
		$username = $this->input->post('username');
		$password = md5($this->input->post('password'));

		$cek_level = $this->ModelLogin->getUser($username, $password);

		if ($cek_level) {
			
			$data_session = array(
				'username' => $cek_level->username,
				'level' => $cek_level->level,
				'nama' => $cek_level->nama,
				'status' => 'login'
			);

			$this->session->set_userdata($data_session);
				
			redirect(base_url('Dashboard'));

		} else {
			$this->session->set_flashdata(
				'notif',
				'<div class="alert alert-danger text-center"style="width: 100%">
				<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				Pastikan akun sudah terdaftar dan tidak dinonaktifkan
				</div>'
			);
			redirect('Login','refresh');
		}
	}

	function logout(){
		$this->session->sess_destroy();
		redirect(base_url('Login'));
	}

}

?>