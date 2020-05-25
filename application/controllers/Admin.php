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
    //kelola UMKM
    public function kelolaKonsumen()
    {
      $this->load->view('admin/kelolakonsumen');
    }

  //Kelola kategori
    //kategori UMKM
    public function kategoriUMKM()
    {
      $this->load->view('admin/kategoriumkm');
    }

    //kategori Produk
    public function kategoriProduk()
    {
      $this->load->view('admin/kategoriproduk');
    }

  //Kelola Produk UMKM
    public function kelolaProdukUMKM()
    {
      $this->load->view('admin/kelolaProdukUMKM');
    }

  //Kelola Informasi
    public function kelolaInformasi()
    {
      $this->load->view('admin/kelolainformasi');
    }

    //Kelola Market
      public function kelolaMarket()
      {
        $this->load->view('admin/kelolamarket');
      }

    //Kelola Portofolio
        public function kelolaPortofolio()
        {
          $this->load->view('admin/kelolaportofolio');
        }

  //Kelola Slide
      public function kelolaSlide()
      {
        $this->load->view('admin/kelolaslide');
      }

  //Kelola Kontak
      public function kelolaKontak()
      {
				$data['kontak'] = $this->M_admin->getKontak();
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
