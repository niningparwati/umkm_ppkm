<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LoginAU extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('M_login');
		$this->load->model('M_admin');
		$this->load->model('ModelUser');
		$this->load->model('UMKM_Model');
	}

	public function index()
	{
		$this->load->helper('url');
			$data['berita'] = "";
		$this->load->view('Login',$data);
	}

	public function login()
	{
		$user = $this->input->post('username');
		$pass = $this->input->post('password');
		$cek = $this->M_login->cekLogin($user,md5($pass));

		if ($cek) {
			if($cek->level == 'Admin'){
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
				$this->load->view('admin/Dashboard',$data);
			}else if($cek->level == 'UMKM'){

				$data_session = array(
						'username' => $cek->username,
						'level' => $cek->level,
						'nama' => $cek->nama_lengkap,
						'status' => 'login'
					);

				$this->session->set_userdata($data_session);

					if ($cek->status == 'tidak aktif') {
						$data['berita'] = 'Maaf akun anda tidak aktif silahkan hubungi admin';
						$this->load->view('Login',$data);
					}else{
					$username = $cek->username;
					$level = $cek->level;

					$umkm = $this->ModelUser->allUser($username, $level);
					$cekUser = $this->ModelUser->cekUser($umkm->username);
					$cekUMKM = $this->UMKM_Model->cekUMKM($cekUser->id_user);
					$id_user=$umkm->id_user;
					$id_umkm = $cekUMKM->id_umkm;

					$data = array(
							'username' => $umkm->username,
							'level' => $umkm->level,
							'nama' => $umkm->nama_lengkap,
							'email' => $umkm->email,
							'id_user' => $umkm->id_user,
							'foto' => $umkm->foto_user,
							'id_umkm' => $id_umkm,
							'jumlahProduk' => $this->UMKM_Model->ProdukByUMKM($id_user),
							'jumlahPortofolio' => $this->UMKM_Model->PortofolioByUMKM($id_user),
							'jumlahMarket' => $this->UMKM_Model->MarketByUMKM($id_user),
						);

							$this->load->view('Head');
						$this->load->view('Header', $data);
						$this->load->view('Sidebar', $data);
						$this->load->view('UMKM/Home', $data);
						$this->load->view('Footer');
					}
			}
		}else{
			$data['berita'] = 'Maaf username atau password anda salah, silahkan ulangi';
			$this->load->view('Login',$data);
		}
	}

	function logout(){
		$this->session->sess_destroy();
		redirect(base_url('LoginAU'));
	}
}
