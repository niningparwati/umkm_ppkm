<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('M_admin');
		$this->load->model('ModelRegister');
		$this->load->library('form_validation');
	}

	public function index()
	{
		$user = $this->session->username;
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
	}

  //Kelola Akun
    //kelola UMKM
    public function kelolaUMKM()
    {
			$user = $this->session->username;
			$data = array(
				'akun' => $this->M_admin->getAkun($user),
				'umkm' => $this->M_admin->getUMKM(),
			);
      $this->load->view('admin/Kelolaumkm',$data);
    }

		public function tambahUMKM()
		{
			$user = $this->session->username;
			$data = array(
				'akun'     => $this->M_admin->getAkun($user),
				'kategori' => $this->M_admin->getkategoriUMKM(),
			);
			$this->load->view('admin/Tambahumkm',$data);
		}

		public function createUMKM()
		{
			$config['upload_path'] = "./assets/foto_user/";
			$config['allowed_types'] = "gif|jpg|png";
			$config['max_size'] = 2000;
			$config['encrypt_name'] = TRUE;

			$this->form_validation->set_rules('username','Username','required',
			 array(
				 'required'  => '%s tidak boleh kosong'
			 ));
			 $this->form_validation->set_rules('password','Password','required',
			 array(
				 'required'  => '%s tidak boleh kosong'
			 ));
			 $this->form_validation->set_rules('email','Email','required',
 			 array(
 				 'required'  => '%s tidak boleh kosong'
 			 ));
 			 $this->form_validation->set_rules('namalengkap','Nama Lengkap','required',
 			 array(
 				 'required'  => '%s tidak boleh kosong'
 			 ));
			 $this->form_validation->set_rules('namaumkm','Nama UMKM','required',
 			 array(
 				 'required'  => '%s tidak boleh kosong'
 			 ));
			 $this->form_validation->set_rules('alamat','Alamat','required',
 			 array(
 				 'required'  => '%s tidak boleh kosong'
 			 ));
			 $this->form_validation->set_rules('deskripsi','Deskripsi','required',
 			 array(
 				 'required'  => '%s tidak boleh kosong'
 			 ));
			 $this->form_validation->set_rules('idkategori','Nama kategori','required',
 			 array(
 				 'required'  => '%s tidak boleh kosong'
 			 ));
			 $this->form_validation->set_rules('status','Status','required',
 			 array(
 				 'required'  => '%s tidak boleh kosong'
 			 ));
			 $this->form_validation->set_rules('nohp','NO.HP','required',
 			 array(
 				 'required'  => '%s tidak boleh kosong'
 			 ));
			 if($this->form_validation->run() == FALSE){
				 $this->tambahUMKM();
			 }else{
			$this->load->library('upload',$config);
			if ($this->upload->do_upload('foto')) {
				$gambar = $this->upload->data();
				$User = $this->ModelRegister->idUser();
				$data = array(
					'id_user'  		 => $User,
					'username' 		 => $this->input->post('username'),
					'password' 		 => md5($this->input->post('password')),
					'nama_lengkap' => $this->input->post('namalengkap'),
					'email' 			 => $this->input->post('email'),
					'foto_user'  		=> $gambar['file_name'],
					'tanggal_join' => $this->input->post('tgl'),
					'status' 			 => 'pending',
					'level'				 => "UMKM",
				);
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
			}else{
				$User = $this->ModelRegister->idUser();
				$data = array(
					'id_user'  		 => $User,
					'username' 		 => $this->input->post('username'),
					'password' 		 => md5($this->input->post('password')),
					'nama_lengkap' => $this->input->post('namalengkap'),
					'email' 			 => $this->input->post('email'),
					'tanggal_join' => $this->input->post('tgl'),
					'status' 			 => 'pending',
					'level'				 => "UMKM",
				);
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
			}
			$cek = $this->M_admin->create_user($data);
			$cek = $this->M_admin->create_umkm($dataq);
			redirect('Admin/kelolaUMKM');
		}
		}

		public function pilihUMKM($id)
		{
			$user = $this->session->username;
			$data = array(
				'akun' 			=> $this->M_admin->getAkun($user),
				'umkm' 			=> $this->M_admin->getUMKMId($id),
				'produk'		=> $this->M_admin-> getProdukId($id),
				'market'		=> $this->M_admin-> getMarketId($id),
				'portofolio'=> $this->M_admin-> getPortofolioId($id),
				'informasi' => $this->M_admin->getInformasiId($id)
			);
			$cek = $this->load->view('admin/Detailumkm',$data);
		}

		public function editUMKM($id)
		{
			$user = $this->session->username;
			$data = array(
				'akun'		 => $this->M_admin->getAkun($user),
				'kategori' => $this->M_admin->getkategoriUMKM(),
				'umkm'     => $this->M_admin->getUMKMId($id),
			);
			$cek = $this->load->view('admin/Editumkm',$data);
		}

		public function updateUMKM()
		{
			$id = $this->input->post('iduser');
			$config['upload_path'] = "./assets/foto_user/";
			$config['allowed_types'] = "gif|jpg|png";
			$config['max_size'] = 2000;
			$config['encrypt_name'] = TRUE;

			$this->load->library('upload',$config);
			if ($this->upload->do_upload('foto')) {
				$gambar = $this->upload->data();
				$data = array(
					'username' 		 => $this->input->post('username'),
					'password' 		 => md5($this->input->post('password')),
					'nama_lengkap' => $this->input->post('namalengkap'),
					'email' 			 => $this->input->post('email'),
					'foto_user'  		=> $gambar['file_name'],
				);
				$dataq = array(
					'nama_umkm' => $this->input->post('namaumkm'),
					'alamat_umkm' => $this->input->post('alamat'),
					'deskripsi_umkm' => $this->input->post('deskripsi'),
					'nomor_telp_umkm' => $this->input->post('nohp'),
					'id_kategori_umkm' => $this->input->post('idkategori'),
				);
			}else{
				$User = $this->ModelRegister->idUser();
				$data = array(
					'username' 		 => $this->input->post('username'),
					'password' 		 => md5($this->input->post('password')),
					'nama_lengkap' => $this->input->post('namalengkap'),
					'email' 			 => $this->input->post('email'),
				);
				$dataq = array(
					'nama_umkm' => $this->input->post('namaumkm'),
					'alamat_umkm' => $this->input->post('alamat'),
					'deskripsi_umkm' => $this->input->post('deskripsi'),
					'nomor_telp_umkm' => $this->input->post('nohp'),
					'id_kategori_umkm' => $this->input->post('idkategori'),
				);
			}
			$idd = $this->input->post('idumkm');
			$ceka = $this->M_admin->update_user($data,$id);
			$cek = $this->M_admin->update_umkm($dataq,$idd);
			redirect('Admin/kelolaUMKM');
		}

		public function updateAktifUMKM($id)
		{
			$iduser = $this->M_admin->getID($id);
			$data = array(
				'status'			=> 'aktif',
			);
			$cek = $this->M_admin->update_status($data,$iduser->id_user);
			redirect('Admin/kelolaUMKM');
		}

		public function updateTdkAktifUMKM($id)
		{
			$iduser = $this->M_admin->getID($id);
			$data = array(
				'status'			=> 'tidak aktif',
			);
			$cek = $this->M_admin->update_status($data,$iduser->id_user);
			redirect('Admin/kelolaUMKM');
		}

		public function hapusUMKM($id)
		{
			$cek = $this->M_admin->hapus_umkm($id);
			redirect('admin/kelolaUMKM');
		}

    //kelola Konsumen
    public function kelolaKonsumen()
    {
			$user = $this->session->username;
			$data = array(
				'akun'		 => $this->M_admin->getAkun($user),
				'konsumen' => $this->M_admin->getKonsumen(),
			);
      $this->load->view('admin/Kelolakonsumen',$data);
    }

		public function tambahKonsumen()
		{
			$user = $this->session->username;
			$data = array(
		 	'akun'						=> $this->M_admin->getAkun($user),
	 		);
			$this->load->view('admin/Tambahkonsumen',$data);
		}

		public function createKonsumen()
		{
			$config['upload_path'] = "./assets/foto_konsumen/";
			$config['allowed_types'] = "gif|jpg|png";
			$config['max_size'] = 2000;
			$config['encrypt_name'] = TRUE;

			$this->form_validation->set_rules('username','Username','required',
			 array(
				 'required'  => '%s tidak boleh kosong'
			 ));
			 $this->form_validation->set_rules('password','Password','required',
			 array(
				 'required'  => '%s tidak boleh kosong'
			 ));
			 $this->form_validation->set_rules('email','Email','required',
				array(
					'required'  => '%s tidak boleh kosong'
				));
				$this->form_validation->set_rules('nohp','Nomor HP','required',
				array(
					'required'  => '%s tidak boleh kosong'
				));
				$this->form_validation->set_rules('tgll','Tgl Lahir','required',
				array(
					'required'  => '%s tidak boleh kosong'
				));
				$this->form_validation->set_rules('jk','Jenis Kelamin','required',
				array(
					'required'  => '%s tidak boleh kosong'
				));
				$this->form_validation->set_rules('status','Status','required',
				array(
					'required'  => '%s tidak boleh kosong'
				));
			 if($this->form_validation->run() == FALSE){
				 $this->tambahKonsumen();
			 }else{
			$this->load->library('upload',$config);
			if ($this->upload->do_upload('foto')) {
				$gambar = $this->upload->data();
				$data = array(
					'username_konsumen'   => $this->input->post('username'),
					'password_konsumen'   => md5($this->input->post('password')),
					'email_konsumen'		  => $this->input->post('email'),
					'foto_konsumen'			  => $gambar['file_name'],
					'nomor_telp_konsumen' => $this->input->post('nohp'),
					'jenis_kelamin'		  	=> $this->input->post('jk'),
					'tanggal_lahir'  			=> $this->input->post('tgll'),
					'tanggal_join'				=> $this->input->post('tgl'),
					'status_konsumen'			=> $this->input->post('status'),
				);
			}else{
				$data = array(
					'username_konsumen'   => $this->input->post('username'),
					'password_konsumen'   => md5($this->input->post('password')),
					'email_konsumen'		  => $this->input->post('email'),
					'nomor_telp_konsumen' => $this->input->post('nohp'),
					'jenis_kelamin'		  	=> $this->input->post('jk'),
					'tanggal_lahir'  			=> $this->input->post('tgll'),
					'tanggal_join'				=> $this->input->post('tgl'),
					'status_konsumen'			=> $this->input->post('status'),
				);
			}
			$cek = $this->M_admin->create_konsumen($data);
			redirect('Admin/kelolaKonsumen');
		}}

		public function pilihKonsumen($id)
		{
			$user = $this->session->username;
			$data = array(
				'akun'	 	 => $this->M_admin->getAkun($user),
				'konsumen' => $this->M_admin->getKonsumenId($id),
			);
			$cek = $this->load->view('admin/Detailkonsumen',$data);
		}

		public function editKonsumen($id)
		{
			$user = $this->session->username;
			$data = array(
				'akun'		 => $this->M_admin->getAkun($user),
				'konsumen' => $this->M_admin->getKonsumenId($id),
			);
			$cek = $this->load->view('admin/Editkonsumen',$data);
		}

		public function hapusKonsumen($id)
		{
			$cek = $this->M_admin->hapus_konsumen($id);
			redirect('admin/kelolaKonsumen');
		}

		public function updateKonsumen()
		{
			$config['upload_path'] = "./assets/foto_konsumen/";
			$config['allowed_types'] = "gif|jpg|png";
			$config['max_size'] = 2000;
			$config['encrypt_name'] = TRUE;
			$id = $this->input->post('idkonsumen');
			$this->load->library('upload',$config);
			if ($this->upload->do_upload('foto')) {
				$gambar = $this->upload->data();
				$data = array(
					'username_konsumen'   => $this->input->post('username'),
					'email_konsumen'		  => $this->input->post('email'),
					'foto_konsumen'			  => $gambar['file_name'],
					'nomor_telp_konsumen' => $this->input->post('nohp'),
					'jenis_kelamin'		  	=> $this->input->post('jk'),
					'tanggal_lahir'  			=> $this->input->post('tgll'),
					'status_konsumen'			=> $this->input->post('status'),
				);
			}else{
				$data = array(
					'username_konsumen'   => $this->input->post('username'),
					'email_konsumen'		  => $this->input->post('email'),
					'nomor_telp_konsumen' => $this->input->post('nohp'),
					'jenis_kelamin'		  	=> $this->input->post('jk'),
					'tanggal_lahir'  			=> $this->input->post('tgll'),
					'status_konsumen'			=> $this->input->post('status'),
				);
			}
			$cek = $this->M_admin->update_konsumen($data,$id);
			redirect('Admin/kelolaKonsumen');
		}

  //Kelola kategori
    //kategori UMKM
    public function kategoriUMKM()
    {
			$user = $this->session->username;
			$data = array(
				'akun'		 => $this->M_admin->getAkun($user),
				'kategori' => $this->M_admin->getkategoriUMKM()
			);
      $this->load->view('admin/Kategoriumkm',$data);
    }

		public function createKategoriUMKM()
		{
			$this->form_validation->set_rules('nama','Kategori UMKM','required',
			 array(
				 'required'  => '%s tidak boleh kosong'
			 ));
			 $this->form_validation->set_rules('keterangan','Keterangan','required',
			 array(
				 'required'  => '%s tidak boleh kosong'
			 ));
			 if($this->form_validation->run() == FALSE){
				 $this->kategoriUMKM();
			 }else{
			$user = $this->session->username;
			$data = array(
				'nama_kategori_umkm' => $this->input->post('nama'),
				'keterangan'				 => $this->input->post('keterangan')
			);
			$cek = $this->M_admin->create_kategori_umkm($data);
			redirect('Admin/kategoriUMKM');
			}
		}

		public function hapusKategoriUMKM($id)
		{
			$cek = $this->M_admin->hapus_k_UMKM($id);
			redirect('admin/kategoriUMKM');
		}

		public function pilihKategoriUMKM($id)
		{
			$user = $this->session->username;
			$data = array(
				'akun'		 => $this->M_admin->getAkun($user),
				'kategori' => $this->M_admin->getkategoriUMKMId($id)
			);
			$this->load->view('admin/Editkategoriumkm',$data);
		}

		public function updateKategoriUMKM()
		{
			$id = $this->input->post('id_kategori_umkm');
			$user = $this->session->username;
			$data = array(
				'nama_kategori_umkm' => $this->input->post('nama'),
				'keterangan'				 => $this->input->post('keterangan')
			);
			$cek = $this->M_admin->update_kategori_umkm($data,$id);
			redirect('Admin/kategoriUMKM');
		}

    //kategori Produk
    public function kategoriProduk()
    {
			$user = $this->session->username;
			$data = array(
				'akun'		 => $this->M_admin->getAkun($user),
				'kategori' => $this->M_admin->getkategoriProduk()
			);
      $this->load->view('admin/Kategoriproduk',$data);
    }

		public function createKategoriProduk()
		{
			$this->form_validation->set_rules('nama','Kategori Produk','required',
			 array(
				 'required'  => '%s tidak boleh kosong'
			 ));
			 $this->form_validation->set_rules('keterangan','Keterangan','required',
			 array(
				 'required'  => '%s tidak boleh kosong'
			 ));
			 if($this->form_validation->run() == FALSE){
				 $this->kategoriProduk();
			 }else{
			$user = $this->session->username;
			$data = array(
				'nama_kategori_produk' => $this->input->post('nama'),
				'keterangan'				   => $this->input->post('keterangan')
			);
			$cek = $this->M_admin->create_kategori_produk($data);
			redirect('Admin/kategoriProduk');
		}
		}

		public function hapusKategoriProduk($id)
		{
			$cek = $this->M_admin->hapus_k_Produk($id);
			redirect('admin/KategoriProduk');
		}

		public function pilihKategoriProduk($id)
    {
			$user = $this->session->username;
			$data = array(
				'akun'		 => $this->M_admin->getAkun($user),
				'kategori' => $this->M_admin->getkategoriProdukId($id)
			);
      $this->load->view('admin/Editkategoriproduk',$data);
    }

		public function updateKategoriProduk()
		{
			$id = $this->input->post('id_kategori_produk');
			$user = $this->session->username;
			$data = array(
				'nama_kategori_produk' => $this->input->post('nama'),
				'keterangan'				   => $this->input->post('keterangan')
			);
			$cek = $this->M_admin->update_kategori_produk($data,$id);
			redirect('Admin/kategoriProduk');
		}

  //Kelola Produk UMKM
    public function kelolaProdukUMKM()
    {
			$user = $this->session->username;
			$data = array(
				'akun'	 => $this->M_admin->getAkun($user),
				'produk' => $this->M_admin->getProduk(),
			);
      $this->load->view('admin/KelolaprodukUMKM',$data);
    }


		//Kelola Promo
		public function kelolaPromo()
		{
			$user = $this->session->username;
			$data = array(
				'promo'  => $this->M_admin->getPromo(),
				'akun'	 => $this->M_admin->getAkun($user),
			);
      $this->load->view('admin/Kelolapromo',$data);
		}

		public function tambahPromo()
		{
			$user = $this->session->username;
			$data = array(
				'akun'	 => $this->M_admin->getAkun($user),
			);
      $this->load->view('admin/Tambahpromo',$data);
		}

		public function createPromo()
		{
				$config['upload_path'] = "./assets/foto_promo/";
				$config['allowed_types'] = "gif|jpg|png";
				$config['max_size'] = 2000;
				$config['encrypt_name'] = TRUE;

					$this->form_validation->set_rules('namapromo','Nama Promo','required',
				 	array(
					 	'required'  => '%s tidak boleh kosong'
				 	));
					$this->form_validation->set_rules('kodepromo','Kode Promo','required',
				 	array(
					 	'required'  => '%s tidak boleh kosong'
				 	));
					$this->form_validation->set_rules('besarpromo','Besar Promo','required',
				 	array(
					 	'required'  => '%s tidak boleh kosong'
				 	));
					$this->form_validation->set_rules('minimal','Minimal Belanja','required',
				 	array(
					 	'required'  => '%s tidak boleh kosong'
				 	));
					$this->form_validation->set_rules('maksimum','Maksimum Potongan','required',
				 	array(
					 	'required'  => '%s tidak boleh kosong'
				 	));
					$this->form_validation->set_rules('berlaku_sampai','Ini','required',
				 	array(
					 	'required'  => '%s tidak boleh kosong'
				 	));
					$this->form_validation->set_rules('status','Status','required',
					array(
						'required'  => '%s tidak boleh kosong'
					));
				 if($this->form_validation->run() == FALSE){
					 $this->tambahPromo();
				 }else{
				$this->load->library('upload',$config);
				if ($this->upload->do_upload('foto')) {
					$foto = $this->upload->data();
					$data = array(
					'nama_promo' => $this->input->post('namapromo'),
					'kode_promo'  => $this->input->post('kodepromo'),
					'besar_promo'  => $this->input->post('besarpromo'),
					'minimal_belanja'  => $this->input->post('minimal'),
					'maksimum_potongan'  => $this->input->post('maksimum'),
					'status_promo'   => $this->input->post('status'),
					'foto_promo'   => $foto['file_name'],
					'berlaku_sampai'   => $this->input->post('berlaku_sampai'),
					);
				}else{
					$data = array(
						'nama_promo' => $this->input->post('namapromo'),
						'kode_promo'  => $this->input->post('kodepromo'),
						'besar_promo'  => $this->input->post('besarpromo'),
						'minimal_belanja'  => $this->input->post('minimal'),
						'maksimum_potongan'  => $this->input->post('maksimum'),
						'status_promo'   => $this->input->post('status'),
						'berlaku_sampai'   => $this->input->post('berlaku_sampai'),
					);
				}
			$cek = $this->M_admin->create_promo($data);
			redirect('Admin/kelolaPromo');
		}
		}

		public function pilihPromo($id)
		{
			$user = $this->session->username;
			$data = array(
				'akun'	=> $this->M_admin->getAkun($user),
				'promo' => $this->M_admin->getPromoId($id),
			);
			$this->load->view('admin/Editpromo',$data);
		}

		public function updatePromo()
		{
				$config['upload_path'] = "./assets/foto_promo/";
				$config['allowed_types'] = "gif|jpg|png";
				$config['max_size'] = 2000;
				$config['encrypt_name'] = TRUE;

					$this->form_validation->set_rules('namapromo','Nama Promo','required',
				 	array(
					 	'required'  => '%s tidak boleh kosong'
				 	));
					$this->form_validation->set_rules('kodepromo','Kode Promo','required',
				 	array(
					 	'required'  => '%s tidak boleh kosong'
				 	));
					$this->form_validation->set_rules('besarpromo','Besar Promo','required',
				 	array(
					 	'required'  => '%s tidak boleh kosong'
				 	));
					$this->form_validation->set_rules('minimal','Minimal Belanja','required',
				 	array(
					 	'required'  => '%s tidak boleh kosong'
				 	));
					$this->form_validation->set_rules('maksimum','Maksimum Potongan','required',
				 	array(
					 	'required'  => '%s tidak boleh kosong'
				 	));
					$this->form_validation->set_rules('berlaku_sampai','Ini','required',
				 	array(
					 	'required'  => '%s tidak boleh kosong'
				 	));
					$this->form_validation->set_rules('status','Status','required',
					array(
						'required'  => '%s tidak boleh kosong'
					));
				 if($this->form_validation->run() == FALSE){
					 $this->tambahPromo();
				 }else{
				$this->load->library('upload',$config);
				$id = $this->input->post('idpromo');
				if ($this->upload->do_upload('foto')) {
					$foto = $this->upload->data();
					$data = array(
					'nama_promo' => $this->input->post('namapromo'),
					'kode_promo'  => $this->input->post('kodepromo'),
					'besar_promo'  => $this->input->post('besarpromo'),
					'minimal_belanja'  => $this->input->post('minimal'),
					'maksimum_potongan'  => $this->input->post('maksimum'),
					'status_promo'   => $this->input->post('status'),
					'foto_promo'   => $foto['file_name'],
					'berlaku_sampai'   => $this->input->post('berlaku_sampai'),
					);
				}else{
					$data = array(
						'nama_promo' => $this->input->post('namapromo'),
						'kode_promo'  => $this->input->post('kodepromo'),
						'besar_promo'  => $this->input->post('besarpromo'),
						'minimal_belanja'  => $this->input->post('minimal'),
						'maksimum_potongan'  => $this->input->post('maksimum'),
						'status_promo'   => $this->input->post('status'),
						'berlaku_sampai'   => $this->input->post('berlaku_sampai'),
					);
				}
			$cek = $this->M_admin->update_promo($data,$id);
			redirect('Admin/kelolaPromo');
		}
		}

		public function hapusPromo($id)
		{
			$cek = $this->M_admin->hapus_promo($id);
			redirect('admin/kelolaPromo');
		}

		public function kelolaPromoUMKM()
		{
			$user = $this->session->username;
			$data = array(
				'akun'	 => $this->M_admin->getAkun($user),
				'promoumkm' =>$this->M_admin->getPromoUMKM()
			);
			$this->load->view('admin/KelolapromoUMKM',$data);
		}

		public function updateAktif($id)
		{
			$data = array(
				'status_promo'			=> 'aktif',
			);
			$cek = $this->M_admin->update_promo($data,$id);
			redirect('Admin/kelolaPromoUMKM');
		}

		public function updateTdkAktif($id)
		{
			$data = array(
				'status_promo'			=> 'tidak aktif',
			);
			$cek = $this->M_admin->update_promo($data,$id);
			redirect('Admin/kelolaPromoUMKM');
		}

		public function updateExpired($id)
		{
			$data = array(
				'status_promo'			=> 'expired',
			);
			$cek = $this->M_admin->update_promo($data,$id);
			redirect('Admin/kelolaPromoUMKM');
		}

	//Kelola transaksi
		//Transaksi Produk
	    public function kelolaTransaksi()
	    {
				$user = $this->session->username;
				$data = array(
					'akun'	 => $this->M_admin->getAkun($user),
					'transaksi' => $this->M_admin->getTransaksi(),
				);
	      $this->load->view('admin/Kelolatransaksi',$data);
	    }

			public function updateDiproses($id)
			{
				$data = array(
					'status'			=> 'diproses',
				);
				$ini = $this->M_admin->hitung($id);//hitung ada brapa toko/umkm dalam satu transaksi
				$umkm = $this->M_admin->ambil_umkm($id);//ambil id umkm nya
				$a = $ini->hasil;
				for ($i=0; $i<$a ; $i++) {
					$dataq = array(
					'id_umkm'				=> $umkm[$i]->umkm,
					'id_transaksi'	=> $id
					);
					$ceq = $this->M_admin->create_pengiriman($dataq);
				}
				$cek = $this->M_admin->update_transaksi($data,$id);
				redirect('Admin/kelolaTransaksi');

				//echo "$a";
				//print_r($umkm);
			}

			public function updateBatal($id)
			{
				$data = array(
					'status'			=> 'ditolak',
				);
				$cek = $this->M_admin->update_transaksi($data,$id);
				redirect('Admin/kelolaTransaksi');
			}

		//Kelola Transaksi umkm
			public function kelolaTransaksiUMKM()
			{
				$user = $this->session->username;
				$data = array(
					'akun'	 => $this->M_admin->getAkun($user),
					'transaksi' => $this->M_admin->getTransaksiUMKM(),
				);
				$this->load->view('admin/KelolatransaksiUMKM',$data);
			}

			public function updateTerkirim($id)
			{
				$data = array(
					'status'			=> 'dana dikirim',
				);
				$cek = $this->M_admin->update_transaksi($data,$id);
				redirect('Admin/kelolaTransaksiUMKM');
			}

			public function updateBlmTerkirim($id)
			{
				$data = array(
					'status'			=> 'diterima',
				);
				$cek = $this->M_admin->update_transaksi($data,$id);
				redirect('Admin/kelolaTransaksiUMKM');
			}

  //Kelola Informasi
    public function kelolaInformasi()
    {
			$user = $this->session->username;
			$data = array(
				'akun'			=> $this->M_admin->getAkun($user),
				'informasi' => $this->M_admin->getInformasi(),
			);
      $this->load->view('admin/Kelolainformasi',$data);
    }

    //Kelola Market
      public function kelolaMarket()
      {
				$user = $this->session->username;
				$data = array(
					'akun'	 => $this->M_admin->getAkun($user),
					'market' => $this->M_admin->getMarket(),
				);
        $this->load->view('admin/Kelolamarket',$data);
      }

    //Kelola Portofolio
        public function kelolaPortofolio()
        {
					$user = $this->session->username;
					$data = array(
						'akun'		   => $this->M_admin->getAkun($user),
						'portofolio' => $this->M_admin->getPortofolio(),
					);
          $this->load->view('admin/Kelolaportofolio',$data);
        }

  	//Kelola Slide
      public function kelolaSlide()
      {
				$user = $this->session->username;
				$data = array(
					'akun'	=> $this->M_admin->getAkun($user),
					'slide' => $this->M_admin->getSlide(),
				);
        $this->load->view('admin/Kelolaslide',$data);
      }

			public function tambahSlide()
			{
				$user = $this->session->username;
				$data = array(
					'akun'	=> $this->M_admin->getAkun($user),
				);
				$this->load->view('admin/Tambahslide',$data);
			}

			public function createSlide()
			{
				  $config['upload_path'] = "./assets/gambar_slide/";
					$config['allowed_types'] = "gif|jpg|png";
					$config['max_size'] = 2000;
					$config['encrypt_name'] = TRUE;

					$this->form_validation->set_rules('judul','Judul Slide','required',
					 array(
						 'required'  => '%s tidak boleh kosong'
					 ));
					 $this->form_validation->set_rules('deskripsi','Deskripsi','required',
					 array(
						 'required'  => '%s tidak boleh kosong'
					 ));
					 $this->form_validation->set_rules('url','URL','required',
						array(
							'required'  => '%s tidak boleh kosong'
						));
						$this->form_validation->set_rules('status','Status','required',
						array(
							'required'  => '%s tidak boleh kosong'
						));
					 if($this->form_validation->run() == FALSE){
						 $this->tambahSlide();
					 }else{
	        $this->load->library('upload',$config);
					if ($this->upload->do_upload('gambar')) {
						$gambarslide = $this->upload->data();
						$data = array(
						'judul' => $this->input->post('judul'),
						'deskripsi'  => $this->input->post('deskripsi'),
						'gambar'   => $gambarslide['file_name'],
						'url'   => $this->input->post('url'),
						'status'   => $this->input->post('status'),
						);
					}else{
						$data = array(
						'judul' => $this->input->post('judul'),
						'deskripsi'  => $this->input->post('deskripsi'),
						'url'   => $this->input->post('url'),
						'status'   => $this->input->post('status'),
						);
					}
				$cek = $this->M_admin->create_slide($data);
				redirect('Admin/kelolaSlide');
			}
			}

			public function hapusSlide($id)
			{
				$cek = $this->M_admin->hapus_slide($id);
				redirect('admin/kelolaSlide');
			}

			public function pilihSlide($id)
			{
				$user = $this->session->username;
				$data = array(
					'akun'	=> $this->M_admin->getAkun($user),
					'slide' => $this->M_admin->getSlideId($id),
				);
        $this->load->view('admin/Editslide',$data);
			}

			public function updateSlide()
			{
					$config['upload_path'] = "./assets/gambar_slide/";
					$config['allowed_types'] = "gif|jpg|png";
					$config['max_size'] = 2000;
					$config['encrypt_name'] = TRUE;

					$id = $this->input->post('idslide');
					$this->load->library('upload',$config);
					if ($this->upload->do_upload('gambar')) {
						$gambarslide = $this->upload->data();
						$data = array(
						'judul' => $this->input->post('judul'),
						'deskripsi'  => $this->input->post('deskripsi'),
						'gambar'   => $gambarslide['file_name'],
						'url'   => $this->input->post('url'),
						'status'   => $this->input->post('status'),
						);
					}else{
						$data = array(
						'judul' => $this->input->post('judul'),
						'deskripsi'  => $this->input->post('deskripsi'),
						'url'   => $this->input->post('url'),
						'status'   => $this->input->post('status'),
						);
					}
				$cek = $this->M_admin->update_slide($data,$id);
				redirect('Admin/kelolaSlide');
			}

			//Kelola Banner
			public function kelolaBanner()
			{
				$user = $this->session->username;
				$data = array(
					'akun'	=> $this->M_admin->getAkun($user),
					'slide' => $this->M_admin->getBanner(),
				);
				$this->load->view('admin/Kelolabanner',$data);
			}

			public function tambahBanner()
			{
				$user = $this->session->username;
				$data = array(
					'akun'	=> $this->M_admin->getAkun($user),
					'umkm'	=> $this->M_admin->getUMKM()
				);
				$this->load->view('admin/Tambahbanner',$data);
			}

			public function createBanner()
			{
					$config['upload_path'] = "./assets/foto_banner/";
					$config['allowed_types'] = "gif|jpg|png";
					$config['max_size'] = 2000;
					$config['encrypt_name'] = TRUE;

					$this->form_validation->set_rules('namabanner','Nama Banner','required',
					 array(
						 'required'  => '%s tidak boleh kosong'
					 ));
					 $u = $this->input->post('idumkm');
					 if($this->form_validation->run() == FALSE){
						 $this->tambahBanner();
					 }else{
					$this->load->library('upload',$config);
					if ($this->upload->do_upload('foto')) {
						if ($u == 'NULL') {
							$gambar = $this->upload->data();
							$data = array(
								'nama_banner' => $this->input->post('namabanner'),
								'foto_banner'   => $gambar['file_name'],
							);
						}else{
							$gambar = $this->upload->data();
							$data = array(
								'nama_banner' => $this->input->post('namabanner'),
								'id_umkm'  => $this->input->post('idumkm'),
								'foto_banner'   => $gambar['file_name'],
							);
						}
					}else{
						if ($u == 'NULL') {
							$data = array(
								'nama_banner' => $this->input->post('namabanner'),
							);
						}else{
							$data = array(
								'nama_banner' => $this->input->post('namabanner'),
								'id_umkm'  => $this->input->post('idumkm'),
							);
						}
					}
				$cek = $this->M_admin->create_banner($data);
				redirect('Admin/kelolaBanner');
			}
			}

			public function hapusBanner($id)
			{
				$cek = $this->M_admin->hapus_banner($id);
				redirect('admin/kelolaBanner');
			}

			public function pilihBanner($id)
			{
				$user = $this->session->username;
				$data = array(
					'akun'	=> $this->M_admin->getAkun($user),
					'banner' => $this->M_admin->getBannerId($id),
					'umkm'	=> $this->M_admin->getUMKM()
				);
				if ($data['banner']->id_umkm == NULL) {
					$this->load->view('admin/Editbanners',$data);
				}else{
					$this->load->view('admin/Editbanner',$data);
				}
			}

			public function updateBanner()
			{
				$config['upload_path'] = "./assets/foto_banner/";
				$config['allowed_types'] = "gif|jpg|png";
				$config['max_size'] = 2000;
				$config['encrypt_name'] = TRUE;

				$this->form_validation->set_rules('namabanner','Nama Banner','required',
				 array(
					 'required'  => '%s tidak boleh kosong'
				 ));
				 $u = $this->input->post('idumkm');
				 if($this->form_validation->run() == FALSE){
					 $this->tambahBanner();
				 }else{
				$this->load->library('upload',$config);
				if ($this->upload->do_upload('foto')) {
						$gambar = $this->upload->data();
						$data = array(
							'nama_banner' => $this->input->post('namabanner'),
							'id_umkm'  => $this->input->post('idumkm'),
							'foto_banner'   => $gambar['file_name'],
						);
				}else{
						$data = array(
							'nama_banner' => $this->input->post('namabanner'),
							'id_umkm'  => $this->input->post('idumkm'),
						);
					}
				$id = $this->input->post('id_banner');
				$cek = $this->M_admin->update_banner($data,$id);
				redirect('Admin/kelolaBanner');
				}}

		public function updateBanners()
		{
			$config['upload_path'] = "./assets/foto_banner/";
			$config['allowed_types'] = "gif|jpg|png";
			$config['max_size'] = 2000;
			$config['encrypt_name'] = TRUE;

			$this->form_validation->set_rules('namabanner','Nama Banner','required',
			 array(
				 'required'  => '%s tidak boleh kosong'
			 ));
			 $u = $this->input->post('idumkm');
			 if($this->form_validation->run() == FALSE){
				 $this->pilihBanner();
			 }else{
			$this->load->library('upload',$config);
			if ($this->upload->do_upload('foto')) {
					$gambar = $this->upload->data();
					$data = array(
						'nama_banner' => $this->input->post('namabanner'),
						'foto_banner'   => $gambar['file_name'],
					);
			}else{
					$data = array(
						'nama_banner' => $this->input->post('namabanner'),
					);
				}
			}
			$id = $this->input->post('id_banner');
			$cek = $this->M_admin->update_banner($data,$id);
			redirect('Admin/kelolaBanner');
			}

  //Kelola Kontak
      public function kelolaKontak()
      {
				$user = $this->session->username;
				$data = array(
					'akun'	 => $this->M_admin->getAkun($user),
					'kontak' => $this->M_admin->getKontak(),
				);
        $this->load->view('admin/Kelolakontak',$data);
      }

			public function editKontak($id)
			{
				$user = $this->session->username;
				$data = array(
					'akun'			=> $this->M_admin->getAkun($user),
				  'kontak'    => $this->M_admin->getKontakk($id));
				$this->load->view('admin/Editkontak',$data);
			}

			public function updateKontak()
			{
				$id = $this->input->post('idkontak');
				$user = $this->session->username;
				$data = array(
				'alamat' 					=> $this->input->post('alamat'),
				'email'  					=> $this->input->post('email'),
				'telepon'  				=> $this->input->post('notlp'),
				'website'   			=> $this->input->post('website'),
				'facebook'    	 	=> $this->input->post('fb'),
				'instagram'     	=> $this->input->post('ig'),
				'nama_bank'				=> $this->input->post('namabank'),
				'pemilik_rekening'=> $this->input->post('pemilik'),
				'nomor_rekening'	=> $this->input->post('norek')
			  );
				$update = $this->M_admin->update_kontak($data,$id);
				redirect('Admin/kelolaKontak');
			}

			public function editProfil()
			{
				$user = $this->session->username;
				$data = array(
					'akun'			=> $this->M_admin->getAkun($user),
				);
				$this->load->view('admin/Editprofile',$data);
			}

			public function edittProfil()
			{
				$user = $this->session->username;
				$data = array(
					'akun'			=> $this->M_admin->getAkun($user),
				);
				$this->load->view('admin/Editprofil',$data);
			}

			public function updateProfil()
			{
					$config['upload_path'] = "./assets/foto_user/";
					$config['allowed_types'] = "gif|jpg|png";
					$config['max_size'] = 2000;
					$config['encrypt_name'] = TRUE;

					$id = $this->input->post('iduser');
					$this->load->library('upload',$config);
					if ($this->upload->do_upload('fotouser')) {
						$foto = $this->upload->data();
						$data = array(
						'foto_user' 				 => $foto['file_name'],
						'nama_lengkap' => $this->input->post('namalengkap'),
						'tanggal_lahir'=> $this->input->post('tgllahir'),
						'email'				 => $this->input->post('email')
						);
						$dataq = array(
							'alamat_admin' 		=> $this->input->post('alamat'),
							'nomor_telp_admin'=> $this->input->post('notlp')
						);
					}else{
						$data = array(
						'nama_lengkap' => $this->input->post('namalengkap'),
						'tanggal_lahir'=> $this->input->post('tgllahir'),
						'email'				 => $this->input->post('email')
						);
						$dataq = array(
							'alamat_admin' 		=> $this->input->post('alamat'),
							'nomor_telp_admin'=> $this->input->post('notlp')
						);
					}
				$ceq = $this->M_admin->update_user($data,$id);
				$cek = $this->M_admin->update_admin($dataq,$id);
				redirect('Admin/editProfil');
			}
}
