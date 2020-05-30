<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class UMKM extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('ModelUser');
		$this->load->model('UMKM_Model');
		require 'session.php';

	}

	public function user_umkm()
	{
		$username = $this->session->userdata('username');
		$cekUser = $this->ModelUser->cekUser($username);
		$cekUMKM = $this->UMKM_Model->cekUMKM($cekUser->id_user);
		$id_umkm = $cekUMKM->id_umkm;

		$data = array(
			'username' => $cekUser->username,
			'level' => $cekUser->level,
			'nama' => $cekUser->nama_lengkap,
			'email' => $cekUser->email,
			'id_user' => $cekUser->id_user,
			'foto' => $cekUser->foto_user,
			'id_umkm' => $id_umkm,
		);

		return $data;
	}


	////////////UMKM////////////


	public function Profil()
	{
		$user = $this->user_umkm();

		$data = array(
			'tampil' => $this->UMKM_Model->seluruhProduk($user['id_umkm']),
			'profil' => $this->UMKM_Model->Profil($user['id_umkm'])
		);

		$this->load->view('Head', $user);
		$this->load->view('Header', $user);
		$this->load->view('Sidebar', $user);
		$this->load->view('UMKM/Profil', $data);
		$this->load->view('Footer');
	}

	public function EditProfil()
	{
		$user = $this->user_umkm();

		$data = array(
			'action' => site_url('UMKM/UpdateProfil'),
			'profil' => $this->UMKM_Model->Profil($user['id_umkm']),
			'kategori' => $this->UMKM_Model->kategoriUMKM()
		);

		$this->load->view('Head', $user);
		$this->load->view('Header', $user);
		$this->load->view('Sidebar', $user);
		$this->load->view('UMKM/Edit_Profil', $data);
		$this->load->view('Footer');
	}

	public function UpdateProfil($id_umkm){
		$user = $this->user_umkm();

		if (!empty($_FILES['foto_user']['name'])) {
			$config['upload_path']      = './assets/foto_user/';
			$config['allowed_types']    = 'pdf|jpg|jpeg|png|gif';

			$this->load->library('upload', $config);
			$this->upload->initialize($config);

			$path= './assets/foto_umkm/';
			$file = $this->input->post('foto_old',TRUE);
			if (!empty($file)) {
				@unlink($path.$file);
			}

			if ($this->upload->do_upload('foto_user')) {
				$uploadData = $this->upload->data();

				$dataUser = array(
					'nama_lengkap' => $this->input->post('nama'),
					'foto_user' => $uploadData['file_name'],
					'email' => $this->input->post('email'),
					'username' => $this->input->post('username'),
				);
				$dataUMKM = array(
					'nama_umkm' => $this->input->post('nama_umkm'),
					'nomor_telp_umkm' => $this->input->post('nomor_telp_umkm'),
					'alamat_umkm' => $this->input->post('alamat_umkm'),
					'id_kategori_umkm' => $this->input->post('id_kategori_umkm')
				);

				$this->ModelUser->updateProfil($dataUser, $user['id_user']);
				$this->UMKM_Model->updateProfil($dataUMKM, $id_umkm);

				// $this->session->set_flashdata('success', 'Berhasil Update Foto');
				if($user['username'] != $this->input->post('username')){
					redirect('Login/logout/');
				}else{
					redirect('UMKM/Profil/','refresh');
				}
				
			} else {
				// $this->session->set_flashdata('error', 'Gagal Upload Foto');
				redirect('UMKM/EditProfil/','refresh');
			}
		}else{
			$dataUser = array(
					'nama_lengkap' => $this->input->post('nama'),
					'email' => $this->input->post('email'),
					'username' => $this->input->post('username'),
				);
				$dataUMKM = array(
					'nama_umkm' => $this->input->post('nama_umkm'),
					'nomor_telp_umkm' => $this->input->post('nomor_telp_umkm'),
					'alamat_umkm' => $this->input->post('alamat_umkm'),
					'id_kategori_umkm' => $this->input->post('id_kategori_umkm')
				);

			$this->ModelUser->updateProfil($dataUser, $user['id_user']);
			$this->UMKM_Model->updateProfil($dataUMKM, $id_umkm);
			
			
			if($user['username'] != $this->input->post('username')){
					redirect('Login/logout/');
				}else{
					redirect('UMKM/Profil/','refresh');
				}
				
			
		}
	}


	////////////PRODUK////////////

	public function Produk()
	{
		$user = $this->user_umkm();

		$data = array(
			'tampil' => $this->UMKM_Model->seluruhProduk($user['id_umkm'])
		);

		$this->load->view('Head', $user);
		$this->load->view('Header', $user);
		$this->load->view('Sidebar', $user);
		$this->load->view('UMKM/Tampil_Produk', $data);
		$this->load->view('Footer');
	}

	
	public function TambahProduk()
	{
		$user = $this->user_umkm();

		$cek = $this->ModelUser->cekUser($user['username']);
		$data = array(
			'action' => site_url('UMKM/CreateProduk'),
			'kategori' => $this->UMKM_Model->kategoriProdukUMKM()
		);

		$this->load->view('Head', $user);
		$this->load->view('Header', $user);
		$this->load->view('Sidebar', $user);
		$this->load->view('UMKM/Tambah_Produk', $data);
		$this->load->view('Footer');
	}

		
	public function CreateProduk()
	{
		$user = $this->user_umkm();

		$harga = $this->input->post('harga');
		$pric = substr($harga,4);
		$hrg = str_replace(".", "", $pric);

		if (!empty($_FILES['foto_produk']['name'])) {
			$config['upload_path']      = './assets/foto_produk/';
			$config['allowed_types']    = 'pdf|jpg|jpeg|png|gif';

			$this->load->library('upload', $config);
			$this->upload->initialize($config);

			if ($this->upload->do_upload('foto_produk')) {
				$uploadData = $this->upload->data();

				$data = array(
					'nama_produk' => $this->input->post('nama_produk'),
					'foto_produk' => $uploadData['file_name'],
					'deskripsi_produk' => $this->input->post('deskripsi_produk'),
					'harga_produk' => $hrg,
					'id_umkm' => $user['id_umkm'],
					'id_kategori_produk' => $this->input->post('id_kategori')
				);
				$this->UMKM_Model->createProduk($data);
				$this->session->set_flashdata(
					'notif',
					'<div class="alert alert-success text-center"style="width: 100%">
					<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					Berhasil tambah produk UMKM
					</div>'
				);
				redirect('UMKM/Produk/'.$user['id_umkm'],'refresh');
			} else {
				$this->session->set_flashdata(
					'notif',
					'<div class="alert alert-danger text-center"style="width: 100%">
					<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					Gagal tambah produk UMKM
					</div>'
				);
				redirect('UMKM/TambahProduk/'.$user['id_umkm'],'refresh');
			}
		}else{
			$data = array(
				'nama_produk' => $this->input->post('nama_produk'),
				'deskripsi_produk' => $this->input->post('deskripsi_produk'),
				'harga_produk' => $hrg,
				'id_umkm' => $user['id_umkm'],
				'id_kategori_produk' => $this->input->post('id_kategori')
			);
			$this->UMKM_Model->createProduk($data);
			$this->session->set_flashdata(
				'notif',
				'<div class="alert alert-success text-center"style="width: 100%">
				<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				Berhasil tambah produk UMKM tanpa gambar
				</div>'
			);
			redirect('UMKM/Produk/'.$user['id_umkm'],'refresh');
		}

	}

	// public function DetailProduk($id_produk)
	// {
	// 	$user = $this->user_umkm();

	// 	$data = array(
	// 		'tampil' => $this->UMKM_Model->cekProduk($id_produk)
	// 	);

	// 	$this->load->view('Head', $user);
	// 	$this->load->view('Header', $user);
	// 	$this->load->view('Sidebar', $user);
	// 	$this->load->view('UMKM/Detail_Produk', $data);
	// 	$this->load->view('Footer');
	// }

		
	public function EditProduk($id)
	{
		$user = $this->user_umkm();

		$data = array(
			'action' => site_url('UMKM/UpdateProduk'),
			'product' => $this->UMKM_Model->editProduk($id),
			'kategori' => $this->UMKM_Model->kategoriProdukUMKM()
		);

		$this->load->view('Head', $user);
		$this->load->view('Header', $user);
		$this->load->view('Sidebar', $user);
		$this->load->view('UMKM/Edit_Produk', $data);
		$this->load->view('Footer');
	}

		
	public function UpdateProduk($id_produk){

		$id_umkm = $this->input->post('id_umkm');
		$harga = $this->input->post('harga');
		$pric = substr($harga,4);
		$hrg = str_replace(".", "", $pric);

		if (!empty($_FILES['foto_produk']['name'])) {
			$config['upload_path']      = './assets/foto_produk/';
			$config['allowed_types']    = 'pdf|jpg|jpeg|png|gif';

			$this->load->library('upload', $config);
			$this->upload->initialize($config);

			$path= './assets/foto_produk/';
			$file = $this->input->post('foto_old',TRUE);
			if (!empty($file)) {
				@unlink($path.$file);
			}

			if ($this->upload->do_upload('foto_produk')) {
				$uploadData = $this->upload->data();

				if ($hrg == 0) {
					$data = array(
						'nama_produk' => $this->input->post('nama_produk'),
						'foto_produk' => $uploadData['file_name'],
						'deskripsi_produk' => $this->input->post('deskripsi_produk'),
						'harga_produk' => $harga,
						'id_kategori_produk' => $this->input->post('id_kategori')
					);

					$this->UMKM_Model->updateProduk($data, $id_produk);
					$this->session->set_flashdata(
						'notif',
						'<div class="alert alert-success text-center"style="width: 100%">
						<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						Berhasil update produk UMKM
						</div>'
					);
					redirect('UMKM/Produk','refresh');
				}else{
					$data = array(
						'nama_produk' => $this->input->post('nama_produk'),
						'foto_produk' => $uploadData['file_name'],
						'deskripsi_produk' => $this->input->post('deskripsi_produk'),
						'harga_produk' => $hrg,
						'id_kategori_produk' => $this->input->post('id_kategori')
					);

					$this->UMKM_Model->updateProduk($data, $id_produk);
					$this->session->set_flashdata(
						'notif',
						'<div class="alert alert-success text-center"style="width: 100%">
						<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						Berhasil update produk UMKM
						</div>'
					); 
					redirect('UMKM/Produk','refresh');
				}

				
			} else {
				$this->session->set_flashdata(
					'notif',
					'<div class="alert alert-success text-center"style="width: 100%">
					<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					Gagal upload foto produk UMKM
					</div>'
				);
				redirect('UMKM/EditProduk/'.$id_produk,'refresh');
			}
		}else{
			if ($hrg == 0) {
				$data = array(
					'nama_produk' => $this->input->post('nama_produk'),
					'deskripsi_produk' => $this->input->post('deskripsi_produk'),
					'harga_produk' => $harga,
					'id_kategori_produk' => $this->input->post('id_kategori')
				);

				$this->UMKM_Model->updateProduk($data, $id_produk);
				$this->session->set_flashdata(
					'notif',
					'<div class="alert alert-success text-center"style="width: 100%">
					<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					Berhasil update produk UMKM tanpa gambar
					</div>'
				); 
				redirect('UMKM/Produk','refresh');
			}else{
				$data = array(
					'nama_produk' => $this->input->post('nama_produk'),
					'deskripsi_produk' => $this->input->post('deskripsi_produk'),
					'harga_produk' => $hrg,
					'id_kategori_produk' => $this->input->post('id_kategori')
				);

				$this->UMKM_Model->updateProduk($data, $id_produk);
				$this->session->set_flashdata(
					'notif',
					'<div class="alert alert-success text-center"style="width: 100%">
					<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					Berhasil update produk UMKM tanpa gambar
					</div>'
				); 
				redirect('UMKM/Produk','refresh');
			}

		}
	}

	public function HapusProduk($id)
	{
		$this->UMKM_Model->hapusProduk($id);
		$this->session->set_flashdata(
			'notif',
			'<div class="alert alert-success text-center"style="width: 100%">
			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			Berhasil hapus produk
			</div>'
		); 
		redirect('UMKM/Produk','refresh');
	}

	

	////////////PORTOFOLIO////////////

	public function TampilPortofolio()
	{
		$user = $this->user_umkm();

		$data = array(
			'tampil' => $this->UMKM_Model->semuaPortofolio($user['id_umkm'])
		);

		$this->load->view('Head', $user);
		$this->load->view('Header', $user);
		$this->load->view('Sidebar', $user);
		$this->load->view('UMKM/Tampil_Portofolio', $data);
		$this->load->view('Footer');
	}


	public function TambahPortofolio($id_umkm)
	{
		$user = $this->user_umkm();

		$data = array(
			'action' => site_url('UMKM/CreatePortofolio/'.$user['id_umkm']),
		);

		$this->load->view('Head', $user);
		$this->load->view('Header', $user);
		$this->load->view('Sidebar', $user);
		$this->load->view('UMKM/Tambah_Portofolio', $data);
		$this->load->view('Footer');
	}

	public function CreatePortofolio($id_umkm)
	{
		$user = $this->user_umkm();

		if (!empty($_FILES['foto_portofolio']['name'])) {
			$config['upload_path']      = './assets/foto_portofolio/';
			$config['allowed_types']    = 'pdf|jpg|jpeg|png|gif';

			$this->load->library('upload', $config);
			$this->upload->initialize($config);

			if ($this->upload->do_upload('foto_portofolio')) {
				$uploadData = $this->upload->data();

				$data = array(
					'foto_portofolio' => $uploadData['file_name'],
					'id_umkm' => $user['id_umkm'],
					'judul_portofolio' => $this->input->post('judul_portofolio'),
					'alamat' => $this->input->post('alamat'),
					'keterangan' => $this->input->post('keterangan'),
					'tanggal' => $this->input->post('tanggal'),
				);
				$this->UMKM_Model->insertPortofolio($data);
				$this->session->set_flashdata(
					'notif',
					'<div class="alert alert-success text-center"style="width: 100%">
					<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					Berhasil tambah portofolio
					</div>'
				); 
				redirect('UMKM/TampilPortofolio/'.$user['id_umkm'],'refresh');
			} else {
				$this->session->set_flashdata(
					'notif',
					'<div class="alert alert-danger text-center"style="width: 100%">
					<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					Gagal menambahkan foto portofolio
					</div>'
				); 
				redirect('UMKM/TambahPortofolio/'.$user['id_umkm'],'refresh');
			}
		}else{
			$data = array(
				'id_umkm' => $user['id_umkm'],
				'judul_portofolio' => $this->input->post('judul_portofolio'),
				'alamat' => $this->input->post('alamat'),
				'keterangan' => $this->input->post('keterangan'),
				'tanggal' => $this->input->post('tanggal'),
			);
			$this->UMKM_Model->insertPortofolio($data);
			$this->session->set_flashdata(
				'notif',
				'<div class="alert alert-success text-center"style="width: 100%">
				<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				Berhasil tambah portofolio tanpa foto
				</div>'
			); 
			redirect('UMKM/TampilPortofolio/'.$user['id_umkm'],'refresh');
		}
	}

	// public function DetailPortofolio($id_portofolio)
	// {
	// 	$user = $this->user_umkm();

	// 	$data = array(
	// 		'tampil' => $this->UMKM_Model->PortofolioById($id_portofolio)
	// 	);

	// 	$this->load->view('Head', $user);
	// 	$this->load->view('Header', $user);
	// 	$this->load->view('Sidebar', $user);
	// 	$this->load->view('UMKM/Detail_Portofolio', $data);
	// 	$this->load->view('Footer');
	// }

	public function EditPortofolio($id_portofolio)
	{
		$user = $this->user_umkm();

		$data = array(
			'tampil' => $this->UMKM_Model->PortofolioById($id_portofolio)
		);

		$this->load->view('Head', $user);
		$this->load->view('Header', $user);
		$this->load->view('Sidebar', $user);
		$this->load->view('UMKM/Edit_Portofolio', $data);
		$this->load->view('Footer');
	}

	public function UpdatePortofolio($id_portofolio)
	{
		
		$user = $this->user_umkm();

		$judul_portofolio = $this->input->post('judul_portofolio');
		$keterangan = $this->input->post('keterangan');
		$alamat = $this->input->post('alamat');
		$tanggal = $this->input->post('tanggal');
		$id_portofolio = $this->input->post('id_portofolio');

		if (!empty($_FILES['foto_portofolio']['name'])) {
			$config['upload_path']      = './assets/foto_portofolio/';
			$config['allowed_types']    = 'pdf|jpg|jpeg|png|gif';

			$this->load->library('upload', $config);
			$this->upload->initialize($config);

			if ($this->upload->do_upload('foto_portofolio')) {
				$uploadData = $this->upload->data();

				$data = array(
					'id_umkm' => $user['id_umkm'],
					'judul_portofolio' => $judul_portofolio,
					'foto_portofolio' => $uploadData['file_name'],
					'keterangan' => $keterangan,
					'alamat' => $alamat,
					'tanggal' => $tanggal,
				);
				// print_r($data);
				$this->UMKM_Model->updatePortofolio($data, $id_portofolio);
				$this->session->set_flashdata(
					'notif',
					'<div class="alert alert-success text-center"style="width: 100%">
					<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					Berhasil update portofolio
					</div>'
				); 
				redirect('UMKM/TampilPortofolio/'.$user['id_umkm'],'refresh');

			}else{
				$this->session->set_flashdata(
					'notif',
					'<div class="alert alert-success text-center"style="width: 100%">
					<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					Gagal upload foto portofolio
					</div>'
				); 
				redirect('UMKM/CreatePortofolio/'.$user['id_umkm'],'refresh');
			}

		}else{

			$data = array(
				'id_umkm' => $user['id_umkm'],
				'judul_portofolio' => $judul_portofolio,
				'keterangan' => $keterangan,
				'alamat' => $alamat,
				'tanggal' => $tanggal,
			);
			$this->UMKM_Model->updatePortofolio($data, $id_portofolio);
			$this->session->set_flashdata(
				'notif',
				'<div class="alert alert-success text-center"style="width: 100%">
				<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				Berhasil update portofolio
				</div>'
			); 
			redirect('UMKM/TampilPortofolio/'.$user['id_umkm'],'refresh');

		}
	}

	public function HapusPortofolio($id_portofolio)
	{
		$user = $this->user_umkm();

		$this->UMKM_Model->hapusPortofolio($id_portofolio);
		$this->session->set_flashdata(
			'notif',
			'<div class="alert alert-success text-center"style="width: 100%">
			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			Berhasil hapus portofolio
			</div>'
		); 
		redirect('UMKM/TampilPortofolio/'.$user['id_umkm']);
	}

	

	////////////MARKET////////////

	public function Market()
	{
		$user = $this->user_umkm();

		$data = array(
			'tampil' => $this->UMKM_Model->dataMarket($user['id_umkm'])
		);

		$this->load->view('Head', $user);
		$this->load->view('Header', $user);
		$this->load->view('Sidebar', $user);
		$this->load->view('UMKM/Tampil_Market', $data);
		$this->load->view('Footer');
	}

	public function TambahMarket()
	{
		$user = $this->user_umkm();

		$cek = $this->ModelUser->cekUser($user['username']);
		$data = array(
			'action' => site_url('UMKM/CreateMarket')
		);

		$this->load->view('Head', $user);
		$this->load->view('Header', $user);
		$this->load->view('Sidebar', $user);
		$this->load->view('UMKM/Tambah_Market', $data);
		$this->load->view('Footer');
	}

	public function CreateMarket()
	{
		$user = $this->user_umkm();

		$data = array(
			'nama_market' => $this->input->post('nama_market'),
			'alamat_market' => $this->input->post('alamat'),
			'link_market' => $this->input->post('link'),
			'id_umkm' => $user['id_umkm']
		);

		$this->UMKM_Model->CreateMarket($data);
		$this->session->set_flashdata(
			'notif',
			'<div class="alert alert-success text-center"style="width: 100%">
			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			Berhasil tambah market
			</div>'
		);
		redirect('UMKM/Market/'.$user['id_umkm'],'refresh');

	}

	public function EditMarket($id)
	{
		$user = $this->user_umkm();

		$data = array(
			'action' => site_url('UMKM/UpdateMarket'),
			'market' => $this->UMKM_Model->editMarket($id)
		);

		$this->load->view('Head', $user);
		$this->load->view('Header', $user);
		$this->load->view('Sidebar', $user);
		$this->load->view('UMKM/Edit_Market', $data);
		$this->load->view('Footer');
	}

	public function UpdateMarket($id_market){

		$id_umkm = $this->input->post('id_umkm');

		$data = array(
			'nama_market' => $this->input->post('nama_market'),
			'alamat_market' => $this->input->post('alamat'),
			'link_market' => $this->input->post('link'),
		);

		$this->UMKM_Model->UpdateMarket($data, $id_market);
		$this->session->set_flashdata(
			'notif',
			'<div class="alert alert-success text-center"style="width: 100%">
			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			Berhasil update market
			</div>'
		);
		redirect('UMKM/Market/'.$id_umkm,'refresh');
	}

	public function HapusMarket($id)
	{
		$this->UMKM_Model->hapusMarket($id);
		redirect('UMKM/Market','refresh');
	}



	///////////INFORMASI///////////

	public function Informasi()
	{
		$user = $this->user_umkm();

		$data = array(
			'informasi' => $this->UMKM_Model->Informasi($user['id_umkm']),
		);

		$this->load->view('Head', $user);
		$this->load->view('Header', $user);
		$this->load->view('Sidebar', $user);
		$this->load->view('UMKM/Tampil_Informasi', $data);
		$this->load->view('Footer', $data);
	}

	public function TambahInformasi()
	{
		$user = $this->user_umkm();

		$data = array(
			'action' => site_url('UMKM/CreateInformasi'),
		);

		$this->load->view('Head', $user);
		$this->load->view('Header', $user);
		$this->load->view('Sidebar', $user);
		$this->load->view('UMKM/Tambah_Informasi', $data);
		$this->load->view('Footer', $data);
	}

	public function CreateInformasi()
	{

		$user = $this->user_umkm();

		if (!empty($_FILES['gambar']['name'])) {
			$config['upload_path']      = './assets/foto_informasi/';
			$config['allowed_types']    = 'pdf|jpg|jpeg|png|gif';

			$this->load->library('upload', $config);
			$this->upload->initialize($config);

			if ($this->upload->do_upload('gambar')) {
				$uploadData = $this->upload->data();

				$data = array(
					'judul_informasi' => $this->input->post('judul'),
					'gambar' => $uploadData['file_name'],
					'isi_informasi' => $this->input->post('konten'),
					'id_umkm' => $user['id_umkm'],
					'status_informasi' => "aktif"
				);
				// print_r($data);
				$this->UMKM_Model->createInformasi($data);
				$this->session->set_flashdata(
					'notif',
					'<div class="alert alert-success text-center"style="width: 100%">
					<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					Berhasil tambah informasi
					</div>'
				);
				redirect('UMKM/Informasi/','refresh');
			} else {
				$this->session->set_flashdata(
					'notif',
					'<div class="alert alert-danger text-center"style="width: 100%">
					<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					Gagal upload foto informasi
					</div>'
				);
				redirect('UMKM/Informasi/','refresh');
			}
		}else{
			$data = array(
				'judul_informasi' => $this->input->post('judul'),
				'isi_informasi' => $this->input->post('konten'),
				'id_umkm' => $user['id_umkm'],
				'status_informasi' => "aktif"
			);
				// print_r($data);
			$this->UMKM_Model->createInformasi($data);
			$this->session->set_flashdata(
				'notif',
				'<div class="alert alert-success text-center"style="width: 100%">
				<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				Berhasil tambah informasi
				</div>'
			);
			redirect('UMKM/Informasi/','refresh');
		}
	}

	public function Aktifasi($id_informasi, $nilai)
	{
		if ($nilai == 1) {
			$flag = 'aktif';
			$this->UMKM_Model->Aktifasi($flag, $id_informasi);
			$this->session->set_flashdata(
				'notif',
				'<div class="alert alert-success text-center"style="width: 100%">
				<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				Berhasil Aktifkan Informasi
				</div>'
			);
			redirect('UMKM/Informasi/','refresh');
			// echo $flag." ".$id_informasi;
		}elseif ($nilai == 0) {
			$flag = 'tidak aktif';
			$this->UMKM_Model->Aktifasi($flag, $id_informasi);
			$this->session->set_flashdata(
				'notif',
				'<div class="alert alert-success text-center"style="width: 100%">
				<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				Berhasil Non Aktifkan informasi
				</div>'
			);
			redirect('UMKM/Informasi/','refresh');
			// echo $flag." ".$id_informasi;
		}
	}

	public function editInformasi($id_informasi)
	{
		$user = $this->user_umkm();

		$data = array(
			'action' => site_url('UMKM/updateInformasi'),
			'tampil' => $this->UMKM_Model->InformasiById($id_informasi),
			'umkm' => $this->UMKM_Model->semuaUMKM()
		);

		$this->load->view('Head', $user);
		$this->load->view('Header', $user);
		$this->load->view('Sidebar', $user);
		$this->load->view('UMKM/Edit_Informasi', $data);
		$this->load->view('Footer');
	}

	public function updateInformasi($id_informasi)
	{

		$user = $this->user_umkm();

		if (!empty($_FILES['gambar']['name'])) {
			$config['upload_path']      = './assets/foto_informasi/';
			$config['allowed_types']    = 'pdf|jpg|jpeg|png|gif';

			$this->load->library('upload', $config);
			$this->upload->initialize($config);

			if ($this->upload->do_upload('gambar')) {
				$uploadData = $this->upload->data();

				$data = array(
					'judul_informasi' => $this->input->post('judul'),
					'gambar' => $uploadData['file_name'],
					'isi_informasi' => $this->input->post('konten'),
					'id_umkm' => $user['id_umkm'],
				);
				// print_r($data);
				$this->UMKM_Model->updateInformasi($data, $id_informasi);
				$this->session->set_flashdata(
					'notif',
					'<div class="alert alert-success text-center"style="width: 100%">
					<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					Berhasil update informasi
					</div>'
				);

				redirect('UMKM/Informasi/','refresh');
			} else {
				$this->session->set_flashdata(
					'notif',
					'<div class="alert alert-success text-center"style="width: 100%">
					<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					Gagal update foto informasi
					</div>'
				);
				redirect('UMKM/TambahInformasi/','refresh');
			}
		}else{
			$data = array(
					'judul_informasi' => $this->input->post('judul'),
					'isi_informasi' => $this->input->post('konten'),
					'id_umkm' => $user['id_umkm'],
			);
				// print_r($data);
			$this->UMKM_Model->updateInformasi($data, $id_informasi);
			$this->session->set_flashdata(
				'notif',
				'<div class="alert alert-success text-center"style="width: 100%">
				<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				Berhasil update informasi
				</div>'
			);
			redirect('UMKM/Informasi/','refresh');
		}
	}

	public function HapusInformasi($id_informasi)
	{
		$this->UMKM_Model->HapusInformasi($id_informasi);
		redirect('UMKM/Informasi/','refresh');
	}

}

?>