<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('M_admin');
	}

	public function index()
	{
		$this->load->view('admin/dashboard');
	}

  //Kelola Akun
    //kelola UMKM
    public function kelolaUMKM()
    {
      $this->load->view('admin/kelolaumkm');
    }

    //kelola Konsumen
    public function kelolaKonsumen()
    {
      $this->load->view('admin/kelolakonsumen');
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
