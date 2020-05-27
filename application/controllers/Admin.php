<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('M_admin');
	}

	public function index()
	{
		$data = array(
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
			$data = array(
				'umkm' => $this->M_admin->getUMKM(),
			);
      $this->load->view('admin/kelolaumkm',$data);
    }

		public function tambahUMKM()
		{
			$data = array(
				'kategori' => $this->M_admin->getkategoriUMKM(),
			);
			$this->load->view('admin/tambahumkm',$data);
		}

		public function createUMKM()
		{
			$data = array(
				'username_umkm'   => $this->input->post('username'),
				'password_umkm'   => md5($this->input->post('password')),
				'email_umkm'		  => $this->input->post('email'),
				'nama_umkm'			  => $this->input->post('namaumkm'),
				'alamat_umkm'		  => $this->input->post('alamat'),
				'deskripsi_umkm'  => $this->input->post('deskripsi'),
				'nomor_telp_umkm' => $this->input->post('nohp'),
				'tanggal_join'		=> $this->input->post('tgl'),
				'id_kategori_umkm'=> $this->input->post('idkategori'),
				'status_umkm'			=> $this->input->post('status'),
			);
			$cek = $this->M_admin->create_umkm($data);
			redirect('Admin/kelolaUMKM');
		}

		public function pilihUMKM($id)
		{
			$data = array(
				'umkm' => $this->M_admin->getUMKMId($id),
			);
			$cek = $this->load->view('admin/detailumkm',$data);
		}

		public function editUMKM($id)
		{
			$data = array(
				'kategori' => $this->M_admin->getkategoriUMKM(),
				'umkm' => $this->M_admin->getUMKMId($id),
			);
			$cek = $this->load->view('admin/editumkm',$data);
		}

		public function updateUMKM()
		{
			$id = $this->input->post('idumkm');
			$data = array(
				'username_umkm'   => $this->input->post('username'),
				'email_umkm'		  => $this->input->post('email'),
				'nama_umkm'			  => $this->input->post('namaumkm'),
				'alamat_umkm'		  => $this->input->post('alamat'),
				'deskripsi_umkm'  => $this->input->post('deskripsi'),
				'nomor_telp_umkm' => $this->input->post('nohp'),
				'id_kategori_umkm'=> $this->input->post('idkategori'),
				'status_umkm'			=> $this->input->post('status'),
			);
			$cek = $this->M_admin->update_umkm($data,$id);
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
			$data = array(
				'konsumen' => $this->M_admin->getKonsumen(),
			);
      $this->load->view('admin/kelolakonsumen',$data);
    }

		public function tambahKonsumen()
		{
			$data = array(

			);
			$this->load->view('admin/tambahkonsumen',$data);
		}

		public function createKonsumen()
		{
			$config['upload_path'] = "./uploads/foto_konsumen/";
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
			$data = array(
				'konsumen' => $this->M_admin->getKonsumenId($id),
			);
			$cek = $this->load->view('admin/detailkonsumen',$data);
		}

		public function editKonsumen($id)
		{
			$data = array(
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
			$config['upload_path'] = "./uploads/foto_konsumen/";
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
			$data = array(
				'kategori' => $this->M_admin->getkategoriUMKM()
			);
      $this->load->view('admin/kategoriumkm',$data);
    }

		public function createKategoriUMKM()
		{
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
			$data = array(
				'kategori' => $this->M_admin->getkategoriUMKMId($id)
			);
			$this->load->view('admin/editkategoriumkm',$data);
		}

		public function updateKategoriUMKM()
		{
			$id = $this->input->post('id_kategori_umkm');
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
			$data = array(
				'kategori' => $this->M_admin->getkategoriProduk()
			);
      $this->load->view('admin/kategoriproduk',$data);
    }

		public function createKategoriProduk()
		{
			$data = array(
				'nama_kategori_produk' => $this->input->post('nama'),
				'keterangan'				 => $this->input->post('keterangan')
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
			$data = array(
				'kategori' => $this->M_admin->getkategoriProdukId($id)
			);
      $this->load->view('admin/editkategoriproduk',$data);
    }

		public function updateKategoriProduk()
		{
			$id = $this->input->post('id_kategori_produk');
			$data = array(
				'nama_kategori_produk' => $this->input->post('nama'),
				'keterangan'				 => $this->input->post('keterangan')
			);
			$cek = $this->M_admin->update_kategori_produk($data,$id);
			redirect('Admin/kategoriProduk');
		}

  //Kelola Produk UMKM
    public function kelolaProdukUMKM()
    {
			$data = array(
				'produk' => $this->M_admin->getProduk(),
			);
      $this->load->view('admin/kelolaProdukUMKM',$data);
    }

  //Kelola Informasi
    public function kelolaInformasi()
    {
			$data = array(
				'informasi' => $this->M_admin->getInformasi(),
			);
      $this->load->view('admin/kelolainformasi',$data);
    }

    //Kelola Market
      public function kelolaMarket()
      {
				$data = array(
					'market' => $this->M_admin->getMarket(),
				);
        $this->load->view('admin/kelolamarket',$data);
      }

    //Kelola Portofolio
        public function kelolaPortofolio()
        {
					$data = array(
						'portofolio' => $this->M_admin->getPortofolio(),
					);
          $this->load->view('admin/kelolaportofolio',$data);
        }

  	//Kelola Slide
      public function kelolaSlide()
      {
				$data = array(
					'slide' => $this->M_admin->getSlide(),
				);
        $this->load->view('admin/kelolaslide',$data);
      }

			public function tambahSlide()
			{
				$this->load->view('admin/tambahslide');
			}

			public function createSlide()
			{
				  $config['upload_path'] = "./uploads/foto_slide/";
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
				$data = array(
					'slide' => $this->M_admin->getSlideId($id),
				);
        $this->load->view('admin/editslide',$data);
			}

			public function updateSlide()
			{
					$config['upload_path'] = "./uploads/foto_slide/";
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
				$data = array(
					'kontak' => $this->M_admin->getKontak(),
				);
        $this->load->view('admin/kelolakontak',$data);
      }

			public function editKontak($id)
			{
				$data['kontak'] = $this->M_admin->getKontakk($id);
				$this->load->view('admin/editkontak',$data);
			}

			public function updateKontak()
			{
				$id = $this->input->post('idkontak');
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
}
