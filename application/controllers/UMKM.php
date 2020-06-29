<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class UMKM extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('ModelUser');
		$this->load->model('UMKM_Model');
		$this->load->library('form_validation');
		require 'session.php';

	}

	public function user_umkm()
	{
		$username = $this->session->userdata('username');
		$cekUser = $this->ModelUser->cekUser($username);
		$cekUMKM = $this->UMKM_Model->cekUMKM($cekUser->id_user);
		$id_umkm = $cekUMKM->id_umkm;

		//print_r($cekUMKM);

		$data = array(
			'username' => $cekUser->username,
			'password' => $cekUser->password,
			'level' => $cekUser->level,
			'nama' => $cekUser->nama_lengkap,
			'email' => $cekUser->email,
			'id_user' => $cekUser->id_user,
			'foto' => $cekUser->foto_user,
			'id_umkm' => $id_umkm,
		);

		return $data;
	}


	public function Dashboard()
	{
					$user = $this->user_umkm();

					$data = array(
							'jumlahProduk' => $this->UMKM_Model->ProdukByUMKM($user["id_user"]),
							'jumlahMenungguDikirim' => $this->UMKM_Model->menungguPengiriman($user["id_umkm"]),
							'jumlahDikirim' => $this->UMKM_Model->dikirim($user["id_umkm"]),
							'jumlahSelesai' => $this->UMKM_Model->selesai($user["id_umkm"]),
						);

					$this->load->view('Head', $user);
					$this->load->view('Header', $user);
					$this->load->view('Sidebar', $user);
					$this->load->view('UMKM/Home', $data);
					$this->load->view('Footer');

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

		$this->form_validation->set_rules('nama','Nama Lengkap','required|min_length[3]',
			 array(
				 'required'  => '%s tidak boleh kosong',
				 'min_length' => '%s minimal 5 karakter'
			 ));
			$this->form_validation->set_rules('tanggal_lahir','Tanggal Lahir','required',
			 array(
				 'required'  => '%s tidak boleh kosong'
			 ));
			$this->form_validation->set_rules('username','Username','required|min_length[5]|max_length[10]',
			 array(
				 'required'  => '%s tidak boleh kosong',				 
				 'min_length' => '%s minimal 5 karakter',				 
				 'max_length' => '%s maksimal 10 karakter'
			 ));
			$this->form_validation->set_rules('password','Password','required|min_length[5]|max_length[10]',
			 array(
				 'required'  => '%s tidak boleh kosong',				 
				 'min_length' => '%s minimal 5 karakter',				 
				 'max_length' => '%s maksimal 10 karakter'
			 ));
			$this->form_validation->set_rules('nama_umkm','Nama UMKM','required',
			 array(
				 'required'  => '%s tidak boleh kosong'
			 ));
			$this->form_validation->set_rules('id_kategori_umkm','kKategori UMKM','required',
			 array(
				 'required'  => 'Pilih Kategori UMKM'
			 ));
			$this->form_validation->set_rules('nomor_telp_umkm','Nomor Telp. UMKM','required|numeric|min_length[9]',
			 array(
				 'required'  => '%s tidak boleh kosong',
				 'numeric'   => '%s harus berupa angka',
				 'min_length'=> '%s minimal 9 karakter'
			 ));
			$this->form_validation->set_rules('alamat_umkm','Alamat UMKM','required|min_length[10]',
			 array(
				 'required'  => '%s tidak boleh kosong',
				 'min_length' => '%s minimal 10 karakter'
			 ));
			$this->form_validation->set_rules('kota_asal','Kota/Kabupaten Asal','required|min_length[5]|max_length[15]',
			 array(
				 'required'  => '%s tidak boleh kosong',
				 'min_length' => '%s minimal 5 karakter',	 
				 'max_length' => '%s maksimal 15 karakter'
			 ));
			$this->form_validation->set_rules('provinsi_asal','Alamat UMKM','required|min_length[5]|max_length[20]',
			 array(
				 'required'  => '%s tidak boleh kosong',
				 'min_length' => '%s minimal 5 karakter',
				 'max_length' => '%s maksimal 20 karakter'
			 ));


			if($this->form_validation->run() == FALSE){
				 $this->EditProfil();
			}else{

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
								'password' => md5($this->input->post('password')),
								'tanggal_lahir' => $this->input->post('tanggal_lahir'),
							);
							$dataUMKM = array(
								'nama_umkm' => $this->input->post('nama_umkm'),
								'nomor_telp_umkm' => $this->input->post('nomor_telp_umkm'),
								'alamat_umkm' => $this->input->post('alamat_umkm'),
								'kota_asal' => $this->input->post('kota_asal'),
								'provinsi_asal' => $this->input->post('provinsi_asal'),
								'id_kategori_umkm' => $this->input->post('id_kategori_umkm')
							);

							$this->ModelUser->updateProfil($dataUser, $user['id_user']);
							$this->UMKM_Model->updateProfil($dataUMKM, $id_umkm);

							// $this->session->set_flashdata('success', 'Berhasil Update Foto');
							if($user['username'] != $this->input->post('username') || $user['password'] != md5($this->input->post('password'))){
								redirect('LoginAU/logout/');
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
								'password' => md5($this->input->post('password')),
								'tanggal_lahir' => $this->input->post('tanggal_lahir'),
							);
							$dataUMKM = array(
								'nama_umkm' => $this->input->post('nama_umkm'),
								'nomor_telp_umkm' => $this->input->post('nomor_telp_umkm'),
								'alamat_umkm' => $this->input->post('alamat_umkm'),
								'kota_asal' => $this->input->post('kota_asal'),
								'provinsi_asal' => $this->input->post('provinsi_asal'),
								'id_kategori_umkm' => $this->input->post('id_kategori_umkm')
							);

						$this->ModelUser->updateProfil($dataUser, $user['id_user']);
						$this->UMKM_Model->updateProfil($dataUMKM, $id_umkm);
						
						
						if($user['username'] != $this->input->post('username')){
								redirect('LoginAU/logout/');
							}else{
								redirect('UMKM/Profil/','refresh');
							}
							
						
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

			$this->form_validation->set_rules('nama_produk','Nama Produk','required|min_length[3]',
			 array(
				 'required'  => '%s tidak boleh kosong',
				 'min_length' => 'Nama produk minimal 3 karakter'
			 ));
			$this->form_validation->set_rules('stok','Stok Produk','required',
			 array(
				 'required'  => '%s tidak boleh kosong'
			 ));
			$this->form_validation->set_rules('deskripsi_produk','Deskripsi Produk','required|min_length[5]',
			 array(
				 'required'  => '%s tidak boleh kosong',				 
				 'min_length' => 'Deskripsi produk minimal 5 karakter'
			 ));
			$this->form_validation->set_rules('harga','Harga Produk','required',
			 array(
				 'required'  => '%s tidak boleh kosong'
			 ));
			$this->form_validation->set_rules('id_kategori','kategori Produk','required',
			 array(
				 'required'  => 'Pilih Kategori Produk'
			 ));
			

			if($this->form_validation->run() == FALSE){
				 $this->TambahProduk();
			}else{

			
						if (!empty($_FILES['foto_produk']['name'])) {
							$config['upload_path']      = './assets/foto_produk/';
							$config['allowed_types']    = 'pdf|jpg|jpeg|png|gif';

							$this->load->library('upload', $config);
							$this->upload->initialize($config);

							if ($this->upload->do_upload('foto_produk')) {
								$uploadData = $this->upload->data();

								$data = array(
									'nama_produk' => $this->input->post('nama_produk'),
									'stok' => $this->input->post('stok'),
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
									Berhasil tambah produk <b>'.$this->input->post('nama_produk').'</b>
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
								'stok' => $this->input->post('stok'),
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
								Berhasil tambah produk <b>'.$this->input->post('nama_produk').'</b>
								</div>'
							);
							redirect('UMKM/Produk/'.$user['id_umkm'],'refresh');
						}
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

			$this->form_validation->set_rules('nama_produk','Nama Produk','required|min_length[3]',
			 array(
				 'required'  => '%s tidak boleh kosong',
				 'min_length' => 'Nama produk minimal 3 karakter'
			 ));
			$this->form_validation->set_rules('stok','Stok Produk','required',
			 array(
				 'required'  => '%s tidak boleh kosong'
			 ));
			$this->form_validation->set_rules('deskripsi_produk','Deskripsi Produk','required|min_length[5]',
			 array(
				 'required'  => '%s tidak boleh kosong',				 
				 'min_length' => 'Deskripsi produk minimal 5 karakter'
			 ));
			$this->form_validation->set_rules('harga','Harga Produk','required',
			 array(
				 'required'  => '%s tidak boleh kosong'
			 ));
			$this->form_validation->set_rules('id_kategori','Kategori Produk','required',
			 array(
				 'required'  => 'Pilih Kategori Produk'
			 ));

			if($this->form_validation->run() == FALSE){
				 $this->EditProduk($id_produk);
			}else{

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
									'stok' => $this->input->post('stok'),
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
									Berhasil update produk <b>'.$this->input->post('nama_produk').'</b>
									</div>'
								);
								redirect('UMKM/Produk','refresh');
							}else{
								$data = array(
									'nama_produk' => $this->input->post('nama_produk'),
									'stok' => $this->input->post('stok'),
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
									Berhasil update produk <b>'.$this->input->post('nama_produk').'</b>
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
								'stok' => $this->input->post('stok'),
								'deskripsi_produk' => $this->input->post('deskripsi_produk'),
								'harga_produk' => $harga,
								'id_kategori_produk' => $this->input->post('id_kategori')
							);

							$this->UMKM_Model->updateProduk($data, $id_produk);
							$this->session->set_flashdata(
								'notif',
								'<div class="alert alert-success text-center"style="width: 100%">
								<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
								Berhasil update produk <b>'.$this->input->post('nama_produk').'</b>
								</div>'
							); 
							redirect('UMKM/Produk','refresh');
						}else{
							$data = array(
								'nama_produk' => $this->input->post('nama_produk'),
								'stok' => $this->input->post('stok'),
								'deskripsi_produk' => $this->input->post('deskripsi_produk'),
								'harga_produk' => $hrg,
								'id_kategori_produk' => $this->input->post('id_kategori')
							);

							$this->UMKM_Model->updateProduk($data, $id_produk);
							$this->session->set_flashdata(
								'notif',
								'<div class="alert alert-success text-center"style="width: 100%">
								<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
								Berhasil update produk <b>'.$this->input->post('nama_produk').'</b>
								</div>'
							); 
							redirect('UMKM/Produk','refresh');
						}

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

	public function HideProduk($id)
	{
		$this->UMKM_Model->hideProduk($id);
		$this->session->set_flashdata(
			'notif',
			'<div class="alert alert-success text-center"style="width: 100%">
			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			Berhasil menyembunyikan produk
			</div>'
		); 
		redirect('UMKM/Produk','refresh');
	}

	public function ShowProduk($id)
	{
		$this->UMKM_Model->showProduk($id);
		$this->session->set_flashdata(
			'notif',
			'<div class="alert alert-success text-center"style="width: 100%">
			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			Berhasil menampilkan produk
			</div>'
		); 
		redirect('UMKM/Produk','refresh');
	}

	////////////PROMO////////////////
	public function Promo($id_umkm)
	{
		$user = $this->user_umkm();

		$data = array(
			'tampil' => $this->UMKM_Model->seluruhPromo($user['id_umkm'])
		);

		$this->load->view('Head', $user);
		$this->load->view('Header', $user);
		$this->load->view('Sidebar', $user);
		$this->load->view('UMKM/Tampil_Promo', $data);
		$this->load->view('Footer');
	}

	public function TambahPromo()
	{
		$user = $this->user_umkm();

		$cek = $this->ModelUser->cekUser($user['username']);
		$data = array(
			'action' => site_url('UMKM/CreatePromo')
		);

		$this->load->view('Head', $user);
		$this->load->view('Header', $user);
		$this->load->view('Sidebar', $user);
		$this->load->view('UMKM/Tambah_Promo', $data);
		$this->load->view('Footer');
	}

	public function CreatePromo()
	{
		$user = $this->user_umkm();

		$minimal_belanja 	= $this->input->post('minimal_belanja');
		$maksimum_potongan 	= $this->input->post('maksimum_potongan');

		$pric1				= substr($minimal_belanja, 4);
		$pric2 				= substr($maksimum_potongan, 4);
		$min_belanja 		= str_replace(".", "", $pric1);
		$max_potongan 		= str_replace(".", "", $pric2);

			$this->form_validation->set_rules('nama_promo','Nama Promo','required|min_length[5]',
			 array(
				 'required'  => '%s tidak boleh kosong',
				 'min_length' => '%s minimal 5 karakter'
			 ));
			$this->form_validation->set_rules('kode_promo','Kode Promo','required|min_length[5]|max_length[20]',
			 array(
				 'required'  => '%s tidak boleh kosong',
				 'min_length' => '%s minimal 5 karakter',
				 'max_length'=> '%s maksimal 20 karakter'
			 ));
			$this->form_validation->set_rules('besar_promo','Besar Promo','required',
			 array(
				 'required'  => '%s tidak boleh kosong'
			 ));
			$this->form_validation->set_rules('minimal_belanja','Minimal Belanja','required',
			 array(
				 'required'  => '%s tidak boleh kosong'
			 ));
			$this->form_validation->set_rules('maksimum_potongan','Maksimum Potongan','required',
			 array(
				 'required'  => '%s tidak boleh kosong'
			 ));
			$this->form_validation->set_rules('berlaku_sampai','Berlaku Sampai','required',
			 array(
				 'required'  => '%s tidak boleh kosong'
			 ));
			

			if($this->form_validation->run() == FALSE){
				 $this->TambahPromo();
			}else{

			
						if (!empty($_FILES['foto_promo']['name'])) {
							$config['upload_path']      = './assets/foto_promo/';
							$config['allowed_types']    = 'pdf|jpg|jpeg|png|gif';

							$this->load->library('upload', $config);
							$this->upload->initialize($config);

							if ($this->upload->do_upload('foto_promo')) {
								$uploadData = $this->upload->data();

								$data = array(
									'nama_promo' => $this->input->post('nama_promo'),
									'kode_promo' => $this->input->post('kode_promo'),
									'besar_promo' => $this->input->post('besar_promo'),
									'foto_promo' => $uploadData['file_name'],
									'minimal_belanja' => $min_belanja ,
									'maksimum_potongan' => $max_potongan,
									'id_umkm' => $user['id_umkm'],
									'status_promo' => 'aktif',
									'berlaku_sampai' => $this->input->post('berlaku_sampai')
								);
								$this->UMKM_Model->createPromo($data);
								$this->session->set_flashdata(
									'notif',
									'<div class="alert alert-success text-center"style="width: 100%">
									<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
									Berhasil tambah promo <b>'.$this->input->post('nama_promo').'</b>
									</div>'
								);
								redirect('UMKM/Promo/'.$user['id_umkm'],'refresh');
							} else {
								$this->session->set_flashdata(
									'notif',
									'<div class="alert alert-danger text-center"style="width: 100%">
									<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
									Gagal tambah promo
									</div>'
								);
								redirect('UMKM/TambahPromo','refresh');
							}
						}else{
							$data = array(
									'nama_promo' => $this->input->post('nama_promo'),
									'kode_promo' => $this->input->post('kode_promo'),
									'besar_promo' => $this->input->post('besar_promo'),
									'minimal_belanja' => $min_belanja ,
									'maksimum_potongan' => $max_potongan,
									'id_umkm' => $user['id_umkm'],
									'status_promo' => 'aktif',
									'berlaku_sampai' => $this->input->post('berlaku_sampai')
							);
							$this->UMKM_Model->createPromo($data);
							$this->session->set_flashdata(
								'notif',
								'<div class="alert alert-success text-center"style="width: 100%">
								<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
								Berhasil tambah promo <b>'.$this->input->post('nama_promo').'</b>
								</div>'
							);
							redirect('UMKM/Promo/'.$user['id_umkm'],'refresh');
						}
		}

	}

	public function EditPromo($id)
	{
		$user = $this->user_umkm();

		$data = array(
			'action' => site_url('UMKM/UpdatePromo'),
			'promo' => $this->UMKM_Model->editPromo($id),
		);

		$this->load->view('Head', $user);
		$this->load->view('Header', $user);
		$this->load->view('Sidebar', $user);
		$this->load->view('UMKM/Edit_Promo', $data);
		$this->load->view('Footer');
	}

	public function UpdatePromo($id_promo){

		$user = $this->user_umkm();

		$minimal_belanja 	= $this->input->post('minimal_belanja');
		$maksimum_potongan 	= $this->input->post('maksimum_potongan');

		$pric1				= substr($minimal_belanja, 4);
		$pric2 				= substr($maksimum_potongan, 4);
		$min_belanja 		= str_replace(".", "", $pric1);
		$max_potongan 		= str_replace(".", "", $pric2);

			$this->form_validation->set_rules('nama_promo','Nama Promo','required|min_length[5]',
			 array(
				 'required'  => '%s tidak boleh kosong',
				 'min_length' => '%s minimal 5 karakter'
			 ));
			$this->form_validation->set_rules('kode_promo','Kode Promo','required|min_length[5]|max_length[20]',
			 array(
				 'required'  => '%s tidak boleh kosong',
				 'min_length' => '%s minimal 5 karakter',
				 'max_length'=> '%s maksimal 20 karakter'
			 ));
			$this->form_validation->set_rules('besar_promo','Besar Promo','required',
			 array(
				 'required'  => '%s tidak boleh kosong'
			 ));
			$this->form_validation->set_rules('minimal_belanja','Minimal Belanja','required',
			 array(
				 'required'  => '%s tidak boleh kosong'
			 ));
			$this->form_validation->set_rules('maksimum_potongan','Maksimum Potongan','required',
			 array(
				 'required'  => '%s tidak boleh kosong'
			 ));
			$this->form_validation->set_rules('berlaku_sampai','Berlaku Sampai','required',
			 array(
				 'required'  => '%s tidak boleh kosong'
			 ));
			

			if($this->form_validation->run() == FALSE){
				 $this->EditPromo($id_promo);
			}else{
				if (!empty($_FILES['foto_promo']['name'])) {
							$config['upload_path']      = './assets/foto_promo/';
							$config['allowed_types']    = 'pdf|jpg|jpeg|png|gif';

							$this->load->library('upload', $config);
							$this->upload->initialize($config);

							if ($this->upload->do_upload('foto_promo')) {
								$uploadData = $this->upload->data();

								$data = array(
									'nama_promo' => $this->input->post('nama_promo'),
									'kode_promo' => $this->input->post('kode_promo'),
									'besar_promo' => $this->input->post('besar_promo'),
									'foto_promo' => $uploadData['file_name'],
									'minimal_belanja' => $min_belanja ,
									'maksimum_potongan' => $max_potongan,
									'id_umkm' => $user['id_umkm'],
									'status_promo' => 'aktif',
									'berlaku_sampai' => $this->input->post('berlaku_sampai')
								);
								$this->UMKM_Model->updatePromo($id_promo,$data);
								$this->session->set_flashdata(
									'notif',
									'<div class="alert alert-success text-center"style="width: 100%">
									<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
									Berhasil edit promo <b>'.$this->input->post('nama_promo').'</b>
									</div>'
								);
								redirect('UMKM/Promo/'.$user['id_umkm'],'refresh');
							} else {
								$this->session->set_flashdata(
									'notif',
									'<div class="alert alert-danger text-center"style="width: 100%">
									<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
									Gagal edit promo <b>'.$this->input->post('nama_promo').'</b>
									</div>'
								);
								redirect('UMKM/EditPromo'.$id_promo,'refresh');
							}
						}else{
							$data = array(
									'nama_promo' => $this->input->post('nama_promo'),
									'kode_promo' => $this->input->post('kode_promo'),
									'besar_promo' => $this->input->post('besar_promo'),
									'minimal_belanja' => $min_belanja ,
									'maksimum_potongan' => $max_potongan,
									'id_umkm' => $user['id_umkm'],
									'status_promo' => 'aktif',
									'berlaku_sampai' => $this->input->post('berlaku_sampai')
							);
							$this->UMKM_Model->updatePromo($id_promo,$data);
							$this->session->set_flashdata(
								'notif',
								'<div class="alert alert-success text-center"style="width: 100%">
								<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
								Berhasil edit promo <b>'.$this->input->post('nama_promo').'</b>
								</div>'
							);
							redirect('UMKM/Promo/'.$user['id_umkm'],'refresh');
						}
			}

	}

	public function Aktivasi_Promo($id_promo, $nilai)
	{
		$user = $this->user_umkm();

		if ($nilai == 1) {
			$flag = 'aktif';
			$this->UMKM_Model->Aktivasi_Promo($flag, $id_promo);
			$this->session->set_flashdata(
				'notif',
				'<div class="alert alert-success text-center"style="width: 100%">
				<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				Berhasil Aktifkan Promo
				</div>'
			);
			redirect('UMKM/Promo/'.$user['id_umkm'],'refresh');
			// echo $flag." ".$id_informasi;
		}elseif ($nilai == 0) {
			$flag = 'tidak aktif';
			$this->UMKM_Model->Aktivasi_Promo($flag, $id_promo);
			$this->session->set_flashdata(
				'notif',
				'<div class="alert alert-success text-center"style="width: 100%">
				<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				Berhasil Non Aktifkan Promo
				</div>'
			);
			redirect('UMKM/Promo/'.$user['id_umkm'],'refresh');
			// echo $flag." ".$id_informasi;
		}
	}

	////////////TRANSAKSI////////////

	public function Transaksi($id_umkm)
	{
		$user = $this->user_umkm();

		$data["transaksi"]   = $this->UMKM_Model->transaksiMasuk($id_umkm)->result();
		
		$this->load->view('Head', $user);
		$this->load->view('Header', $user);
		$this->load->view('Sidebar', $user);
		$this->load->view('UMKM/Tampil_TransaksiMasuk', $data);
		$this->load->view('Footer');
		//print_r($data["transaksi"]);
	}

	public function detail_transaksi($id_transaksi,$id_pengiriman)
	{
		$user = $this->user_umkm();
		$data["detail_transaksi"] = $this->UMKM_Model->detail_transaksi($id_transaksi,$user["id_umkm"],$id_pengiriman)->result();
		$data["id_umkm"] = $user['id_umkm'];

		$this->load->view('Head', $user);
		$this->load->view('Header', $user);
		$this->load->view('Sidebar', $user);
		$this->load->view('UMKM/Tampil_DetailTransaksi', $data);
		$this->load->view('Footer');
		//print_r($data["detail_transaksi"]);
	}


	public function set_dikirim($id_pengiriman,$id_transaksi)
	{
		$user = $this->user_umkm();
		$no_resi = $_GET['resi'];

		if($no_resi!=null){
			$this->db->query("UPDATE tb_pengiriman SET no_resi = '$no_resi' , status_pengiriman = 'dikirim' WHERE id_pengiriman = '$id_pengiriman'");

			$count_pengiriman = $this->db->query("SELECT COUNT(id_pengiriman) as jml_shipment FROM tb_pengiriman WHERE id_transaksi = '$id_transaksi' ")->row();

			$count_status = $this->db->query("SELECT COUNT(status_pengiriman) as jml_terkirim FROM tb_pengiriman WHERE status_pengiriman = 'dikirim' AND id_transaksi = '$id_transaksi' ")->row();

			if($count_pengiriman->jml_shipment == $count_status->jml_terkirim){
				$this->db->query("UPDATE tb_transaksi SET status = 'dikirim' WHERE id_transaksi = '$id_transaksi'");
			}

			redirect('UMKM/Transaksi/'.$user['id_umkm'],'refresh');
			// echo "$no_resi";
			
		}else{
			$this->session->set_flashdata(
					'notif',
					'<div class="alert alert-danger text-center"style="width: 100%">
					<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					Anda Harus Input Resi!
					</div>'
				); 
			redirect('UMKM/Transaksi/'.$user['id_umkm'],'refresh');
			
		}

		
	}

	public function set_selesai($id_transaksi)
	{
		$user = $this->user_umkm();

		$this->db->query("UPDATE tb_transaksi SET status = 'selesai' WHERE id_transaksi = '$id_transaksi'");

		redirect('UMKM/Transaksi/'.$user['id_umkm'],'refresh');
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

			$this->form_validation->set_rules('judul_portofolio','Judul Portofolio','required|min_length[5]',
			 array(
				 'required'  => '%s tidak boleh kosong',
				 'min_length' => 'Judul portofolio minimal 5 karakter'
			 ));
			$this->form_validation->set_rules('keterangan','Keterangan','required|min_length[15]',
			 array(
				 'required'  => '%s tidak boleh kosong',				 
				 'min_length' => 'Keterangan portofolio minimal 15 karakter'
			 ));
			$this->form_validation->set_rules('alamat','Alamat','required',
			 array(
				 'required'  => '%s tidak boleh kosong'
			 ));
			$this->form_validation->set_rules('tanggal','Tanggal Portofolio','required',
			 array(
				 'required'  => '%s tidak boleh kosong'
			 ));

		if($this->form_validation->run() == FALSE){
				 $this->TambahPortofolio($id_umkm);
		}else{

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
							Berhasil tambah portofolio <b>'.$this->input->post('judul_portofolio').'</b>
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
						Berhasil tambah portofolio
						</div>'
					); 
					redirect('UMKM/TampilPortofolio/'.$user['id_umkm'],'refresh');
				}

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

		$this->form_validation->set_rules('judul_portofolio','Judul Portofolio','required|min_length[5]',
			 array(
				 'required'  => '%s tidak boleh kosong',
				 'min_length' => 'Judul portofolio minimal 5 karakter'
			 ));
			$this->form_validation->set_rules('keterangan','Keterangan','required|min_length[15]',
			 array(
				 'required'  => '%s tidak boleh kosong',				 
				 'min_length' => 'Keterangan portofolio minimal 15 karakter'
			 ));
			$this->form_validation->set_rules('alamat','Alamat','required',
			 array(
				 'required'  => '%s tidak boleh kosong'
			 ));
			$this->form_validation->set_rules('tanggal','Tanggal Portofolio','required',
			 array(
				 'required'  => '%s tidak boleh kosong'
			 ));

		if($this->form_validation->run() == FALSE){
				 $this->EditPortofolio($id_portofolio);
		}else{

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
							Berhasil update portofolio <b>'.$this->input->post('judul_portofolio').'</b>
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
						Berhasil update portofolio <b>'.$this->input->post('judul_portofolio').'</b>
						</div>'
					); 
					redirect('UMKM/TampilPortofolio/'.$user['id_umkm'],'refresh');

				}
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

			$this->form_validation->set_rules('nama_market','Nama Market','required|min_length[5]',
			 array(
				 'required'  => '%s tidak boleh kosong',
				 'min_length' => '%s minimal 5 karakter'
			 ));
			$this->form_validation->set_rules('alamat','Alamat','required|min_length[5]',
			 array(
				 'required'  => '%s tidak boleh kosong',				 
				 'min_length' => '%s minimal 5 karakter'
			 ));
			$this->form_validation->set_rules('link','Link','required',
			 array(
				 'required'  => '%s tidak boleh kosong'
			 ));

		if($this->form_validation->run() == FALSE){
				 $this->TambahMarket();
		}else{

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
				Berhasil tambah market <b>'.$this->input->post('nama_market').'</b>
				</div>'
			);
			redirect('UMKM/Market/'.$user['id_umkm'],'refresh');
		}
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

			$this->form_validation->set_rules('nama_market','Nama Market','required|min_length[5]',
			 array(
				 'required'  => '%s tidak boleh kosong',
				 'min_length' => '%s minimal 5 karakter'
			 ));
			$this->form_validation->set_rules('alamat','Alamat','required|min_length[5]',
			 array(
				 'required'  => '%s tidak boleh kosong',				 
				 'min_length' => '%s minimal 5 karakter'
			 ));
			$this->form_validation->set_rules('link','Link','required',
			 array(
				 'required'  => '%s tidak boleh kosong'
			 ));

		if($this->form_validation->run() == FALSE){
				 $this->EditMarket($id_market);
		}else{

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
					Berhasil update market <b>'.$this->input->post('nama_market').'</b>
					</div>'
				);
				redirect('UMKM/Market/'.$id_umkm,'refresh');
		}
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

		$this->form_validation->set_rules('judul','Judul Informasi','required|min_length[5]',
			 array(
				 'required'  => '%s tidak boleh kosong',
				 'min_length' => '%s minimal 5 karakter'
			 ));
			$this->form_validation->set_rules('konten','Konten Informasi','required|min_length[10]',
			 array(
				 'required'  => '%s tidak boleh kosong',				 
				 'min_length' => '%s minimal 10 karakter'
			 ));

		if($this->form_validation->run() == FALSE){
				 $this->TambahInformasi();
		}else{

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
							Berhasil tambah informasi <b>'.$this->input->post('judul').'</b>
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
						Berhasil tambah informasi <b>'.$this->input->post('judul').'</b>
						</div>'
					);
					redirect('UMKM/Informasi/','refresh');
				}
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

		$this->form_validation->set_rules('judul','Judul Informasi','required|min_length[5]',
			 array(
				 'required'  => '%s tidak boleh kosong',
				 'min_length' => '%s minimal 5 karakter'
			 ));
			$this->form_validation->set_rules('konten','Konten Informasi','required|min_length[10]',
			 array(
				 'required'  => '%s tidak boleh kosong',				 
				 'min_length' => '%s minimal 10 karakter'
			 ));

		if($this->form_validation->run() == FALSE){
				 $this->editInformasi($id_informasi);
		}else{

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
							Berhasil update informasi <b>'.$this->input->post('judul').'</b>
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
						Berhasil update informasi <b>'.$this->input->post('judul').'</b>
						</div>'
					);
					redirect('UMKM/Informasi/','refresh');
				}
		}
	}

	public function HapusInformasi($id_informasi)
	{
		$this->UMKM_Model->HapusInformasi($id_informasi);
		$this->session->set_flashdata(
			'notif',
			'<div class="alert alert-success text-center"style="width: 100%">
			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			Berhasil hapus informasi
			</div>'
		);
		redirect('UMKM/Informasi/','refresh');
	}


	////////////////GALERI FOTO////////////////////////
	public function Galeri($id_umkm)
	{
		$user = $this->user_umkm();

		$data = array(
			'tampil' => $this->UMKM_Model->cekFoto($user["id_umkm"]),
			'id_umkm' => $user['id_umkm']
		);

		$this->load->view('Head', $user);
		$this->load->view('Header', $user);
		$this->load->view('Sidebar', $user);
		$this->load->view('UMKM/Tampil_Foto', $data);
		$this->load->view('Footer');
	}

	public function CreateFoto($id_umkm)
	{
		if (!empty($_FILES['foto']['name'])) {
			$config['upload_path']      = './assets/galeri_umkm/';
			$config['allowed_types']    = 'pdf|jpg|jpeg|png|gif';

			$this->load->library('upload', $config);
			$this->upload->initialize($config);

			if ($this->upload->do_upload('foto')) {
				$uploadData = $this->upload->data();

				$data = array(
					'id_umkm' => $id_umkm,
					'foto' => $uploadData['file_name'],
					'keterangan_foto' => $this->input->post('keterangan_foto'),
				);

				$this->UMKM_Model->insertFoto($data);
				$this->session->set_flashdata(
					'notif',
					'<div class="alert alert-success text-center"style="width: 100%">
					<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					Berhasil tambah foto umkm
					</div>'
				); 
				redirect('UMKM/Galeri/'.$id_umkm,'refresh');
			} else {
				$this->session->set_flashdata(
					'notif',
					'<div class="alert alert-danger text-center"style="width: 100%">
					<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					Gagal upload foto umkm
					</div>'
				); 
				redirect('UMKM/Galeri/'.$id_umkm,'refresh');
			}
		}else{

			$this->session->set_flashdata(
				'notif',
				'<div class="alert alert-danger text-center"style="width: 100%">
				<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				Gagal tambah foto umkm
				</div>'
			); 
			redirect('UMKM/Galeri/'.$id_umkm,'refresh');
		}	
	}

	public function EditFoto($id_foto)
	{
		$user = $this->user_umkm();

		if (!empty($_FILES['foto']['name'])) {
			$config['upload_path']      = './assets/galeri_umkm/';
			$config['allowed_types']    = 'pdf|jpg|jpeg|png|gif';

			$this->load->library('upload', $config);
			$this->upload->initialize($config);

			if ($this->upload->do_upload('foto')) {
				$uploadData = $this->upload->data();

				$data = array(
					'foto' => $uploadData['file_name'],
					'keterangan_foto' => $this->input->post('keterangan_foto'),
				);

				$this->UMKM_Model->updateFoto($id_foto,$data);
				$this->session->set_flashdata(
					'notif',
					'<div class="alert alert-success text-center"style="width: 100%">
					<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					Berhasil Edit Foto
					</div>'
				); 
				redirect('UMKM/Galeri/'.$user["id_umkm"],'refresh');
			} else {

				$this->session->set_flashdata(
					'notif',
					'<div class="alert alert-danger text-center"style="width: 100%">
					<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					Gagal upload foto 
					</div>'
				); 
				redirect('UMKM/Galeri/'.$user["id_umkm"],'refresh');
			}
		}else{
				$data = array(
					'foto' => $this->input->post('foto_old'),
					'keterangan_foto' => $this->input->post('keterangan_foto'),
				);

				$this->UMKM_Model->updateFoto($id_foto,$data);
				$this->session->set_flashdata(
					'notif',
					'<div class="alert alert-success text-center"style="width: 100%">
					<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					Berhasil Edit Foto
					</div>'
				); 
				redirect('UMKM/Galeri/'.$user["id_umkm"],'refresh');
		}	
	}

	public function HapusFoto($id_foto)
	{
		$user = $this->user_umkm();

		$this->UMKM_Model->hapusFoto($id_foto);
		$this->session->set_flashdata(
			'notif',
			'<div class="alert alert-success text-center"style="width: 100%">
			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			Berhasil hapus foto
			</div>'
		);
		redirect('UMKM/Galeri/'.$user['id_umkm'],'refresh');
	}


	////////////////Banner////////////////////////
	public function Banner($id_umkm)
	{
		$user = $this->user_umkm();

		$data = array(
			'tampil' => $this->UMKM_Model->showBanner($user["id_umkm"]),
			'id_umkm' => $user['id_umkm']
		);

		$this->load->view('Head', $user);
		$this->load->view('Header', $user);
		$this->load->view('Sidebar', $user);
		$this->load->view('UMKM/Tampil_Banner', $data);
		$this->load->view('Footer');
	}

	public function CreateBanner($id_umkm)
	{
		if (!empty($_FILES['foto']['name'])) {
			$config['upload_path']      = './assets/foto_banner/';
			$config['allowed_types']    = 'pdf|jpg|jpeg|png|gif';

			$this->load->library('upload', $config);
			$this->upload->initialize($config);

			if ($this->upload->do_upload('foto')) {
				$uploadData = $this->upload->data();

				$data = array(
					'id_umkm' => $id_umkm,
					'foto_banner' => $uploadData['file_name'],
					'nama_banner' => $this->input->post('nama_banner'),
				);

				$this->UMKM_Model->insertBanner($data);
				$this->session->set_flashdata(
					'notif',
					'<div class="alert alert-success text-center"style="width: 100%">
					<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					Berhasil tambah Banner <b>'.$this->input->post('nama_banner').'</b>
					</div>'
				); 
				redirect('UMKM/Banner/'.$id_umkm,'refresh');
			} else {
				$this->session->set_flashdata(
					'notif',
					'<div class="alert alert-danger text-center"style="width: 100%">
					<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					Gagal upload foto banner
					</div>'
				); 
				redirect('UMKM/Banner/'.$id_umkm,'refresh');
			}
		}else{

			$this->session->set_flashdata(
				'notif',
				'<div class="alert alert-danger text-center"style="width: 100%">
				<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				Gagal tambah foto banner
				</div>'
			); 
			redirect('UMKM/Banner/'.$id_umkm,'refresh');
		}	
	}

	public function EditBanner($id_banner)
	{
		$user = $this->user_umkm();

		if (!empty($_FILES['foto']['name'])) {
			$config['upload_path']      = './assets/foto_banner/';
			$config['allowed_types']    = 'pdf|jpg|jpeg|png|gif';

			$this->load->library('upload', $config);
			$this->upload->initialize($config);

			if ($this->upload->do_upload('foto')) {
				$uploadData = $this->upload->data();

				$data = array(
					'foto_banner' => $uploadData['file_name'],
					'nama_banner' => $this->input->post('nama_banner'),
				);

				$this->UMKM_Model->editBanner($id_banner,$data);
				$this->session->set_flashdata(
					'notif',
					'<div class="alert alert-success text-center"style="width: 100%">
					<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					Berhasil Edit Banner <b>'.$this->input->post('nama_banner').'</b>
					</div>'
				); 
				redirect('UMKM/Banner/'.$user["id_umkm"],'refresh');
			} else {

				$this->session->set_flashdata(
					'notif',
					'<div class="alert alert-danger text-center"style="width: 100%">
					<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					Gagal upload foto banner
					</div>'
				); 
				redirect('UMKM/Banner/'.$user["id_umkm"],'refresh');
			}
		}else{
				$data = array(
					'foto_banner' => $this->input->post('banner_old'),
					'nama_banner' => $this->input->post('nama_banner'),
				);

				$this->UMKM_Model->editBanner($id_banner,$data);
				$this->session->set_flashdata(
					'notif',
					'<div class="alert alert-success text-center"style="width: 100%">
					<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					Berhasil Edit Banner <b>'.$this->input->post('nama_banner').'</b>
					</div>'
				); 
				redirect('UMKM/Banner/'.$user["id_umkm"],'refresh');
		}	
	}

	public function HapusBanner($id_banner)
	{
		$user = $this->user_umkm();

		$this->UMKM_Model->hapusBanner($id_banner);
		$this->session->set_flashdata(
			'notif',
			'<div class="alert alert-success text-center"style="width: 100%">
			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			Berhasil hapus banner
			</div>'
		);
		redirect('UMKM/Banner/'.$user['id_umkm'],'refresh');
	}

}

?>