<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('M_admin');
		$this->load->model('ModelRegister');
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
		$this->load->view('admin/dashboard',$data);
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
      $this->load->view('admin/kelolaumkm',$data);
    }

		public function tambahUMKM()
		{
			$user = $this->session->username;
			$data = array(
				'akun'     => $this->M_admin->getAkun($user),
				'kategori' => $this->M_admin->getkategoriUMKM(),
			);
			$this->load->view('admin/tambahumkm',$data);
		}

		public function createUMKM()
		{
			$config['upload_path'] = "./assets/foto_user/";
			$config['allowed_types'] = "gif|jpg|png";
			$config['max_size'] = 2000;
			$config['encrypt_name'] = TRUE;

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
			$cek = $this->load->view('admin/detailumkm',$data);
		}

		public function editUMKM($id)
		{
			$user = $this->session->username;
			$data = array(
				'akun'		 => $this->M_admin->getAkun($user),
				'kategori' => $this->M_admin->getkategoriUMKM(),
				'umkm'     => $this->M_admin->getUMKMId($id),
			);
			$cek = $this->load->view('admin/editumkm',$data);
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
			$cek = $this->M_admin->update_umkm($data,$id);
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
      $this->load->view('admin/kelolakonsumen',$data);
    }

		public function tambahKonsumen()
		{
			$user = $this->session->username;
			$data = array(
		 	'akun'						=> $this->M_admin->getAkun($user),
	 		);
			$this->load->view('admin/tambahkonsumen',$data);
		}

		public function createKonsumen()
		{
			$config['upload_path'] = "./assets/foto_konsumen/";
			$config['allowed_types'] = "gif|jpg|png";
			$config['max_size'] = 2000;
			$config['encrypt_name'] = TRUE;

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
		}

		public function pilihKonsumen($id)
		{
			$user = $this->session->username;
			$data = array(
				'akun'	 	 => $this->M_admin->getAkun($user),
				'konsumen' => $this->M_admin->getKonsumenId($id),
			);
			$cek = $this->load->view('admin/detailkonsumen',$data);
		}

		public function editKonsumen($id)
		{
			$user = $this->session->username;
			$data = array(
				'akun'		 => $this->M_admin->getAkun($user),
				'konsumen' => $this->M_admin->getKonsumenId($id),
			);
			$cek = $this->load->view('admin/editkonsumen',$data);
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
      $this->load->view('admin/kategoriumkm',$data);
    }

		public function createKategoriUMKM()
		{
			$user = $this->session->username;
			$data = array(
				'nama_kategori_umkm' => $this->input->post('nama'),
				'keterangan'				 => $this->input->post('keterangan')
			);
			$cek = $this->M_admin->create_kategori_umkm($data);
			redirect('Admin/kategoriUMKM');
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
			$this->load->view('admin/editkategoriumkm',$data);
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
      $this->load->view('admin/kategoriproduk',$data);
    }

		public function createKategoriProduk()
		{
			$user = $this->session->username;
			$data = array(
				'nama_kategori_produk' => $this->input->post('nama'),
				'keterangan'				   => $this->input->post('keterangan')
			);
			$cek = $this->M_admin->create_kategori_produk($data);
			redirect('Admin/kategoriProduk');
		}

		public function hapusKategoriProduk($id)
		{
			$cek = $this->M_admin->hapus_k_Produk($id);
			redirect('admin/kategoriProduk');
		}

		public function pilihKategoriProduk($id)
    {
			$user = $this->session->username;
			$data = array(
				'akun'		 => $this->M_admin->getAkun($user),
				'kategori' => $this->M_admin->getkategoriProdukId($id)
			);
      $this->load->view('admin/editkategoriproduk',$data);
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
      $this->load->view('admin/kelolaProdukUMKM',$data);
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
	      $this->load->view('admin/kelolatransaksi',$data);
	    }

			public function updateDiproses($id)
			{
				$data = array(
					'status'			=> 'diproses',
				);
				$cek = $this->M_admin->update_transaksi($data,$id);
				redirect('Admin/kelolaTransaksi');
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
				$this->load->view('admin/kelolatransaksiUMKM',$data);
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
      $this->load->view('admin/kelolainformasi',$data);
    }

    //Kelola Market
      public function kelolaMarket()
      {
				$user = $this->session->username;
				$data = array(
					'akun'	 => $this->M_admin->getAkun($user),
					'market' => $this->M_admin->getMarket(),
				);
        $this->load->view('admin/kelolamarket',$data);
      }

    //Kelola Portofolio
        public function kelolaPortofolio()
        {
					$user = $this->session->username;
					$data = array(
						'akun'		   => $this->M_admin->getAkun($user),
						'portofolio' => $this->M_admin->getPortofolio(),
					);
          $this->load->view('admin/kelolaportofolio',$data);
        }

  	//Kelola Slide
      public function kelolaSlide()
      {
				$user = $this->session->username;
				$data = array(
					'akun'	=> $this->M_admin->getAkun($user),
					'slide' => $this->M_admin->getSlide(),
				);
        $this->load->view('admin/kelolaslide',$data);
      }

			public function tambahSlide()
			{
				$user = $this->session->username;
				$data = array(
					'akun'	=> $this->M_admin->getAkun($user),
				);
				$this->load->view('admin/tambahslide',$data);
			}

			public function createSlide()
			{
				  $config['upload_path'] = "./assets/gambar_slide/";
					$config['allowed_types'] = "gif|jpg|png";
					$config['max_size'] = 2000;
					$config['encrypt_name'] = TRUE;

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
        $this->load->view('admin/editslide',$data);
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

  //Kelola Kontak
      public function kelolaKontak()
      {
				$user = $this->session->username;
				$data = array(
					'akun'	 => $this->M_admin->getAkun($user),
					'kontak' => $this->M_admin->getKontak(),
				);
        $this->load->view('admin/kelolakontak',$data);
      }

			public function editKontak($id)
			{
				$user = $this->session->username;
				$data = array(
					'akun'			=> $this->M_admin->getAkun($user),
				  'kontak'    => $this->M_admin->getKontakk($id));
				$this->load->view('admin/editkontak',$data);
			}

			public function updateKontak()
			{
				$id = $this->input->post('idkontak');
				$user = $this->session->username;
				$data = array(
				'alamat' => $this->input->post('alamat'),
				'email'  => $this->input->post('email'),
				'telepon'  => $this->input->post('notlp'),
				'website'   => $this->input->post('website'),
				'facebook'     => $this->input->post('fb'),
				'instagram'     => $this->input->post('ig')
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
				$this->load->view('admin/editprofile',$data);
			}

			public function edittProfil()
			{
				$user = $this->session->username;
				$data = array(
					'akun'			=> $this->M_admin->getAkun($user),
				);
				$this->load->view('admin/editprofil',$data);
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
