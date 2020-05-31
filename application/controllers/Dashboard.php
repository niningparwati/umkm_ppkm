<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('ModelAdmin');
		$this->load->model('UMKM_Model');
		$this->load->model('ModelUser');
		require 'session.php';
	}
	
	public function index()
	{	
		if ($this->session->userdata('status')=='login') 
		{
			$username = $this->session->userdata('username');
			$level = $this->session->userdata('level');
			if ($level == 'Admin') 
			{
				$admin = $this->ModelUser->allUser($username, $level);
				$cekUser = $this->ModelUser->cekUser($admin->username);
				$id_user = $cekUser->id_user;

				if ($admin) {
					$data = array(
						'username' => $cekUser->username,
						'level' => $cekUser->level,
						'nama' => $cekUser->nama,
						'email' => $cekUser->email,
						'id_user' => $cekUser->id_user,
						'foto' => $cekUser->foto,
						'id_umkm' => $cekUser,
						'produk' => $this->UMKM_Model->countProduk(),
						'umkm' => $this->UMKM_Model->countUMKM(),
						'portofolio' => $this->UMKM_Model->countPortofolio(),
					);

					$this->load->view('Head');
					$this->load->view('Header', $data);
					$this->load->view('Sidebar', $data);
					$this->load->view('Admin/Home', $data);
					$this->load->view('Footer');
				}
			}elseif ($level == 'UMKM') 
			{
				$umkm = $this->ModelUser->allUser($username, $level);
				$cekUser = $this->ModelUser->cekUser($umkm->username);
				$cekUMKM = $this->UMKM_Model->cekUMKM($cekUser->id_user);
				$id_user=$umkm->id_user;

				$id_umkm = $cekUMKM->id_umkm;
				if ($umkm) {
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

		}else {
			echo "gagal";
		}

	}
}
?>