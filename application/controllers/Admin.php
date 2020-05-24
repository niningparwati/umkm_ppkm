<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

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
        $this->load->view('admin/kelolakontak');
      }
}
