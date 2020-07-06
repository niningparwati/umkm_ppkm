<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Konsumen extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('M_konsumen');
		$this->load->helper('form');
	}

	private $api_key = '590213f97cfe285c488355e8c2138907';

	// LOGIN

	function index()
	{
		$data = array(

		);
		$this->load->view('Konsumen/Head');
		$this->load->view('Konsumen/Header');
		$this->load->view('Konsumen/Login', $data);
		$this->load->view('Konsumen/Footer');
	}

	function prosesLogin()
	{
		$username = $this->input->post('username');
		$pass = md5($this->input->post('password'));
		$cek = $this->M_konsumen->cekAkun($username, $pass);
		if (!is_null($cek)) {
			if ($cek == 'tidak aktif') {
				$this->session->set_flashdata('warning', 'akun sudah tidak aktif!');
				redirect('Konsumen/index');
			}else{
				$session_konsumen = array(
					'id_konsumen' => $cek->id_konsumen,
					'nama_konsumen' => $cek->nama_konsumen,
				);
				$this->session->set_userdata($session_konsumen);
				$this->session->set_flashdata('success','Selamat! Login berhasil!');
				redirect('Konsumen/Home');
			}
		}else{
			$this->session->set_flashdata('warning', 'username atau password salah!');
			redirect('Konsumen/index');
		}
	}

	function Logout()
	{
		$this->session->sess_destroy();
		$this->session->set_flashdata('success','Anda telah keluar dari aplikasi');
		redirect('Konsumen/index');
	}

	// REGISTRASI

	function Register()
	{
		$data = array(

		);
		$this->load->view('Konsumen/Head');
		$this->load->view('Konsumen/Header');
		$this->load->view('Konsumen/Register', $data);
		$this->load->view('Konsumen/Footer');
	}

	function prosesRegister()
	{
		$username = $this->input->post('username');
		$email = $this->input->post('email');
		$saltid = md5($email);
		if (!is_null($this->M_konsumen->cekUsername($username))) {
			$this->session->set_flashdata('warning', 'username sudah terdaftar, silahkan gunakan username lain!');
			redirect('Konsumen/Register');
		}else{
			$data = array(
				'nama_konsumen' => $this->input->post('nama_konsumen'),
				'username_konsumen' => $username,
				'password_konsumen' => md5($this->input->post('password1')),
				'email_konsumen' => $email,
				'nomor_telp_konsumen' => $this->input->post('no_telp'),
				'tanggal_join' => date('Y-m-d H-i-s'),
				'status_konsumen' => 'tidak aktif',
			);
			$this->M_konsumen->registrasi($data);
			if (!empty($this->M_konsumen->cekByEmail($email))) {	// cek email untuk melanjutkan validasi
				if ($this->sendEmail($email, $saltid)) {
					$this->session->set_flashdata('success', 'silahkan cek email Anda untuk menyelesaikan proses registrasi!');
					redirect('Konsumen/index');
				}else{
					$this->session->set_flashdata('error','pendaftaran gagal');
					redirect('Konsumen/Register');
				}
			}
		}
	}

	function sendEmail($email, $saltid)
	{
		// konfigurasi email
		$config['protocol'] = 'smtp';
		$config['smtp_host'] = 'ssl://smtp.gmail.com';
		$config['smtp_port'] = '465';
		$config['smtp_user'] = 'umkmppkm@gmail.com';
		$config['smtp_pass'] = 'umkmppkm2020';
		$config['mailtype'] = 'html';
		$config['charset'] = 'iso-8859-1';
		$config['wordwrap'] = TRUE;
		$config['newline'] = "\r\n";
		$this->email->initialize($config);
		$url = base_url()."Konsumen/Konfirmasi/".$saltid;
		$this->email->from('umkmppkm@gmail.com', 'UMKM PPKM');
		$this->email->to($email);
		$this->email->subject('Please Verify Your Email Address');
		$message = "<html><head></head><body><p>Hai, </p><p>Thanks for registration with UMKM PPKM APPS. </p><p>Please click below link to verify your email. </p>".$url."<br/><p>Sincerely, </p><p>UMKM PPKM</p></body></html>";
		$this->email->message($message);
		return $this->email->send();
	}

	function Konfirmasi($key)
	{
		if ($this->M_konsumen->verifyEmail($key)) {
			$this->session->set_flashdata('success', 'berhasil verifikasi email');
			redirect('Konsumen/index');
		}else{
			$this->session->set_flashdata('warning', 'gagal verifikasi email');
			redirect('Konsumen/Register');
		}
	}

	// HOME

	function Home()
	{
		if (isset($_GET['search'])) {
			if ($_GET['search'] != '') {
				$data = array(
					'produk' => $this->M_konsumen->searchProduk($_GET['search']),
					'umkm' => $this->M_konsumen->searchUmkm($_GET['search']),
				);
				$this->load->view('Konsumen/Head');
				$this->load->view('Konsumen/Header');
				$this->load->view('Konsumen/Search', $data);
				$this->load->view('Konsumen/Footer');
				return;
			}
		}

		$data = array(
			'produk' => $this->M_konsumen->getProdukHome(),
			'umkm' => $this->M_konsumen->getUmkmHome(),
			'informasi' => $this->M_konsumen->getInformasiHome(),
			'promo' => $this->M_konsumen->getPromo(),
			'banner' => $this->M_konsumen->getBanner(),
			'slide' => $this->M_konsumen->getSlide(),
		);

		$this->load->view('Konsumen/Head');
		$this->load->view('Konsumen/Header');
		$this->load->view('Konsumen/Home', $data);
		$this->load->view('Konsumen/Footer');
	}

	// PRODUK

	function Produk($key)
	{
		if ($this->session->userdata('id_konsumen')) {	// sudah login
			if ($key == 'semua') { // semua produk
				$q = urldecode($this->input->get('q', TRUE));
				$start = intval($this->input->get('start'));
				if ($q <> '') {
					$config['base_url'] = base_url() . '/Konsumen/Produk/'.$key.'/?q=' . urlencode($q);
					$config['first_url'] = base_url() . '/Konsumen/Produk/'.$key.'/?q=' . urlencode($q);
				} else {
					$config['base_url'] = base_url() . '/Konsumen/Produk/'.$key;
					$config['first_url'] = base_url() . '/Konsumen/Produk/'.$key;
				}
				$config['per_page'] = 9;
				$config['page_query_string'] = TRUE;
				$config['total_rows'] = $this->M_konsumen->total_rows($q);
				$produk = $this->M_konsumen->get_produk($config['per_page'], $start, $q);
				$this->load->library('pagination');
				$this->pagination->initialize($config);


				$data = array(
					'produk' => $produk,
					'jumlah_produk' => $this->M_konsumen->jumlahProduk()->jumlah,
					'kategori' => $this->M_konsumen->kategoriProduk(),
					'jenis' => 'semua',
					'q' => $q,												// pagination
					'pagination' => $this->pagination->create_links(),		// pagination
					'start' => $start,										// pagination
					'jumlah' => $this->M_konsumen->jmlhProduk()->jumlah,
					'batas' => $config['per_page'],
				);
				$this->load->view('Konsumen/Head');
				$this->load->view('Konsumen/Header', $data);
				$this->load->view('Konsumen/Produk', $data);
				$this->load->view('Konsumen/Footer');
			}else {
				$q = urldecode($this->input->get('q', TRUE));
				$start = intval($this->input->get('start'));
				if ($q <> '') {
					$config['base_url'] = base_url() . '/Konsumen/Produk/'.$key.'/?q=' . urlencode($q);
					$config['first_url'] = base_url() . '/Konsumen/Produk/'.$key.'/?q=' . urlencode($q);
				} else {
					$config['base_url'] = base_url() . '/Konsumen/Produk/'.$key;
					$config['first_url'] = base_url() . '/Konsumen/Produk/'.$key;
				}
				$config['per_page'] = 9;
				$config['page_query_string'] = TRUE;
				$config['total_rows'] = $this->M_konsumen->total_produk_kategori($q, $key);
				$produk = $this->M_konsumen->get_produk_kategori($config['per_page'], $start, $q, $key);
				$this->load->library('pagination');
				$this->pagination->initialize($config);


				$data = array(
					'produk' => $produk,
					'jumlah_produk' => $this->M_konsumen->jumlahProduk()->jumlah,
					'kategori' => $this->M_konsumen->kategoriProduk(),
					'jenis' => $this->M_konsumen->getKategoriProduk($key)->nama_kategori_produk,
					'q' => $q,												// pagination
					'pagination' => $this->pagination->create_links(),		// pagination
					'start' => $start,										// pagination
					'jumlah' => $this->M_konsumen->jmlhProduk()->jumlah,
					'batas' => $config['per_page'],
				);
				$this->load->view('Konsumen/Head');
				$this->load->view('Konsumen/Header', $data);
				$this->load->view('Konsumen/Produk', $data);
				$this->load->view('Konsumen/Footer');
			}
		}else{
			if ($key == 'semua') { // semua produk
				$q = urldecode($this->input->get('q', TRUE));
				$start = intval($this->input->get('start'));
				if ($q <> '') {
					$config['base_url'] = base_url() . '/Konsumen/Produk/'.$key.'/?q=' . urlencode($q);
					$config['first_url'] = base_url() . '/Konsumen/Produk/'.$key.'/?q=' . urlencode($q);
				} else {
					$config['base_url'] = base_url() . '/Konsumen/Produk/'.$key;
					$config['first_url'] = base_url() . '/Konsumen/Produk/'.$key;
				}
				$config['per_page'] = 9;
				$config['page_query_string'] = TRUE;
				$config['total_rows'] = $this->M_konsumen->total_rows($q);
				$produk = $this->M_konsumen->get_produk($config['per_page'], $start, $q);
				$this->load->library('pagination');
				$this->pagination->initialize($config);


				$data = array(
					'produk' => $produk,
					'jumlah_produk' => $this->M_konsumen->jumlahProduk()->jumlah,
					'kategori' => $this->M_konsumen->kategoriProduk(),
					'jenis' => 'semua',
					'q' => $q,												// pagination
					'pagination' => $this->pagination->create_links(),		// pagination
					'start' => $start,										// pagination
					'jumlah' => $this->M_konsumen->jmlhProduk()->jumlah,
					'batas' => $config['per_page'],
				);
				$this->load->view('Konsumen/Head');
				$this->load->view('Konsumen/Header', $data);
				$this->load->view('Konsumen/Produk', $data);
				$this->load->view('Konsumen/Footer');
			}else {
				$q = urldecode($this->input->get('q', TRUE));
				$start = intval($this->input->get('start'));
				if ($q <> '') {
					$config['base_url'] = base_url() . '/Konsumen/Produk/'.$key.'/?q=' . urlencode($q);
					$config['first_url'] = base_url() . '/Konsumen/Produk/'.$key.'/?q=' . urlencode($q);
				} else {
					$config['base_url'] = base_url() . '/Konsumen/Produk/'.$key;
					$config['first_url'] = base_url() . '/Konsumen/Produk/'.$key;
				}
				$config['per_page'] = 9;
				$config['page_query_string'] = TRUE;
				$config['total_rows'] = $this->M_konsumen->total_produk_kategori($q, $key);
				$produk = $this->M_konsumen->get_produk_kategori($config['per_page'], $start, $q, $key);
				$this->load->library('pagination');
				$this->pagination->initialize($config);


				$data = array(
					'produk' => $produk,
					'jumlah_produk' => $this->M_konsumen->jumlahProduk()->jumlah,
					'kategori' => $this->M_konsumen->kategoriProduk(),
					'jenis' => $this->M_konsumen->getKategoriProduk($key)->nama_kategori_produk,
					'q' => $q,												// pagination
					'pagination' => $this->pagination->create_links(),		// pagination
					'start' => $start,										// pagination
					'jumlah' => $this->M_konsumen->jmlhProduk()->jumlah,
					'batas' => $config['per_page'],
				);
				$this->load->view('Konsumen/Head');
				$this->load->view('Konsumen/Header', $data);
				$this->load->view('Konsumen/Produk', $data);
				$this->load->view('Konsumen/Footer');
			}
		}

	}

	function detailProduk($idProduk)
	{
		$cek = $this->M_konsumen->produkById($idProduk);	// ambil detail produk
		$explode = explode(' ', $cek->nama_produk);
		$data = array(
			'id_produk' => $idProduk,
			'id_umkm' => $cek->id_umkm,
			'nama_produk' => $cek->nama_produk,
			'foto_produk' => $cek->foto_produk,
			'deskripsi' => $cek->deskripsi_produk,
			'harga' => $cek->harga_produk,
			'nama_umkm' => $cek->nama_umkm,
			'deskripsi_umkm' => $cek->deskripsi_umkm,
			'alamat' => $cek->alamat_umkm,
			'no_telp' => $cek->nomor_telp_umkm,
			'stok' => $cek->stok,
			'serupa' => $this->M_konsumen->produkSerupa($explode[0], $cek->nama_produk),
			'kategori' => $this->M_konsumen->kategoriProduk(),
			'produk_lain' => $this->M_konsumen->produkLain($cek->id_umkm, $idProduk),
			'jml_produk_lainnya' => $this->M_konsumen->jml_produk_lainnya($cek->id_umkm, $idProduk)->jmlh,
		);
		$this->load->view('Konsumen/Head');
		$this->load->view('Konsumen/Header', $data);
		$this->load->view('Konsumen/DetailProduk', $data);
		$this->load->view('Konsumen/Footer');
	}

	// UMKM

	function Umkm($key,$x)
	{
		if ($key == 'semua' AND $x==0) {
			$q = urldecode($this->input->get('q', TRUE));
			$start = intval($this->input->get('start'));
			if ($q <> '') {
				$config['base_url'] = base_url() . '/Konsumen/Umkm/'.$key.'/'.$x.'/?q=' . urlencode($q);
				$config['first_url'] = base_url() . '/Konsumen/Umkm/'.$key.'/'.$x.'/?q=' . urlencode($q);
			} else {
				$config['base_url'] = base_url() . '/Konsumen/Umkm/'.$key.'/'.$x;
				$config['first_url'] = base_url() . '/Konsumen/Umkm/'.$key.'/'.$x;
			}
			$config['per_page'] = 4;
			$config['page_query_string'] = TRUE;
			$config['total_rows'] = $this->M_konsumen->total_umkm($q);
			$umkm = $this->M_konsumen->get_umkm($config['per_page'], $start, $q);
			$this->load->library('pagination');
			$this->pagination->initialize($config);

			$data = array(
				'umkm' => $umkm,
				'q' => $q,												// pagination
				'pagination' => $this->pagination->create_links(),		// pagination
				'start' => $start,										// pagination
				'kategori' => $this->M_konsumen->kategoriUmkm(),
				'kabupaten' => $this->M_konsumen->semuaKabupaten(),
				'judul' => 'Semua',
				'jumlah' => $this->M_konsumen->jumlahUmkm()->jumlah,
				'batas' => $config['per_page'],
			);
			$this->load->view('Konsumen/Head');
			$this->load->view('Konsumen/Header', $data);
			$this->load->view('Konsumen/UMKM', $data);
			$this->load->view('Konsumen/Footer');
			// print_r($data);
		}elseif ($key == 'Kategori' AND $x>0) {
			$q = urldecode($this->input->get('q', TRUE));
			$start = intval($this->input->get('start'));
			if ($q <> '') {
				$config['base_url'] = base_url() . '/Konsumen/Umkm/'.$key.'/'.$x.'/?q=' . urlencode($q);
				$config['first_url'] = base_url() . '/Konsumen/Umkm/'.$key.'/'.$x.'/?q=' . urlencode($q);
			} else {
				$config['base_url'] = base_url() . '/Konsumen/Umkm/'.$key.'/'.$x;
				$config['first_url'] = base_url() . '/Konsumen/Umkm/'.$key.'/'.$x;
			}
			$config['per_page'] = 4;
			$config['page_query_string'] = TRUE;
			$config['total_rows'] = $this->M_konsumen->total_kategori($q, $x);
			$kategori = $this->M_konsumen->get_kategori($config['per_page'], $start, $q, $x);
			$this->load->library('pagination');
			$this->pagination->initialize($config);

			$data = array(
				'umkm' => $kategori,
				'q' => $q,												// pagination
				'pagination' => $this->pagination->create_links(),		// pagination
				'start' => $start,										// pagination
				'kategori' => $this->M_konsumen->kategoriUmkm(),
				'kabupaten' => $this->M_konsumen->semuaKabupaten(),
				'judul' => $this->M_konsumen->getKategoriUmkm($x)->nama_kategori_umkm,
				'jumlah' => $this->M_konsumen->jumlahUmkm()->jumlah,
				'batas' => $config['per_page'],
			);
			$this->load->view('Konsumen/Head');
			$this->load->view('Konsumen/Header', $data);
			$this->load->view('Konsumen/UMKM', $data);
			$this->load->view('Konsumen/Footer');
			// print_r($data);
		}elseif ($key == 'Kota') {
			$q = urldecode($this->input->get('q', TRUE));
			$start = intval($this->input->get('start'));
			if ($q <> '') {
				$config['base_url'] = base_url() . '/Konsumen/Umkm/'.$key.'/'.$x.'/?q=' . urlencode($q);
				$config['first_url'] = base_url() . '/Konsumen/Umkm/'.$key.'/'.$x.'/?q=' . urlencode($q);
			} else {
				$config['base_url'] = base_url() . '/Konsumen/Umkm/'.$key.'/'.$x;
				$config['first_url'] = base_url() . '/Konsumen/Umkm/'.$key.'/'.$x;
			}
			$config['per_page'] = 4;
			$config['page_query_string'] = TRUE;
			$config['total_rows'] = $this->M_konsumen->total_kota($q, $x);
			$kota = $this->M_konsumen->get_kota($config['per_page'], $start, $q, $x);
			$this->load->library('pagination');
			$this->pagination->initialize($config);

			$data = array(
				'umkm' => $kota,
				'q' => $q,												// pagination
				'pagination' => $this->pagination->create_links(),		// pagination
				'start' => $start,										// pagination
				'kategori' => $this->M_konsumen->kategoriUmkm(),
				'kabupaten' => $this->M_konsumen->semuaKabupaten(),
				'judul' => 'di Kota '.ucwords(str_replace('%20', ' ', $x)),
				'jumlah' => $this->M_konsumen->jumlahUmkm()->jumlah,
				'batas' => $config['per_page'],
			);
			$this->load->view('Konsumen/Head');
			$this->load->view('Konsumen/Header', $data);
			$this->load->view('Konsumen/UMKM', $data);
			$this->load->view('Konsumen/Footer');
			// echo "kota";
			// print_r($data);
		}
	}

	function detailUmkm($idUmkm, $key)
	{
		if ($key == 'semua') {
			$cek = $this->M_konsumen->umkmById($idUmkm);	// ambil detail umkm

			$q = urldecode($this->input->get('q', TRUE));
			$start = intval($this->input->get('start'));
			if ($q <> '') {
				$config['base_url'] = base_url() . '/Konsumen/detailUmkm/'.$idUmkm.'/'.$key.'/?q=' . urlencode($q);
				$config['first_url'] = base_url() . '/Konsumen/detailUmkm/'.$idUmkm.'/'.$key.'/?q=' . urlencode($q);
			} else {
				$config['base_url'] = base_url() . '/Konsumen/detailUmkm/'.$idUmkm.'/'.$key;
				$config['first_url'] = base_url() . '/Konsumen/detailUmkm/'.$idUmkm.'/'.$key;
			}
			$config['per_page'] = 6;
			$config['page_query_string'] = TRUE;
			$config['total_rows'] = $this->M_konsumen->total_barang_serupa($q, $idUmkm);
			$produk = $this->M_konsumen->get_produk_umkm($config['per_page'], $start, $q, $idUmkm);
			$this->load->library('pagination');
			$this->pagination->initialize($config);

			$data = array(
				'id_umkm' => $idUmkm,
				'nama_umkm' => $cek->nama_umkm,
				'alamat' => $cek->alamat_umkm,
				'deskripsi' => $cek->deskripsi_umkm,
				'no_telp' => $cek->nomor_telp_umkm,
				'foto' => $cek->foto_user,
				'produk' => $produk,
				'kategori_produk' => $this->M_konsumen->kategoriProdukById($idUmkm),
				'cekFoto' => $this->M_konsumen->semuaFotoUMKM($idUmkm),
				'portofolio' => $this->M_konsumen->cekPortofolio($idUmkm),
				'market' => $this->M_konsumen->cekMarket($idUmkm),
				'informasi' => $this->M_konsumen->cekInformasi($idUmkm),
				'jmlh_informasi' => $this->M_konsumen->jmlhInformasi($idUmkm)->jmlh,
				'jenis' => 'semua',
				'q' => $q,												// pagination
				'pagination' => $this->pagination->create_links(),		// pagination
				'start' => $start,										// pagination
				'jumlah' => $this->M_konsumen->jmlhProduk($idUmkm)->jumlah,
				'batas' => $config['per_page'],
			);
			$this->load->view('Konsumen/Head');
			$this->load->view('Konsumen/Header', $data);
			$this->load->view('Konsumen/DetailUMKM', $data);
			$this->load->view('Konsumen/Footer');
		}elseif ($key != 'semua') {
			$cek = $this->M_konsumen->umkmById($idUmkm);	// ambil detail umkm berdasarkan produk tertentu

			$q = urldecode($this->input->get('q', TRUE));
			$start = intval($this->input->get('start'));
			if ($q <> '') {
				$config['base_url'] = base_url() . '/Konsumen/detailUmkm/'.$idUmkm.'/'.$key.'/?q=' . urlencode($q);
				$config['first_url'] = base_url() . '/Konsumen/detailUmkm/'.$idUmkm.'/'.$key.'/?q=' . urlencode($q);
			} else {
				$config['base_url'] = base_url() . '/Konsumen/detailUmkm/'.$idUmkm.'/'.$key;
				$config['first_url'] = base_url() . '/Konsumen/detailUmkm/'.$idUmkm.'/'.$key;
			}
			$config['per_page'] = 6;
			$config['page_query_string'] = TRUE;
			$config['total_rows'] = $this->M_konsumen->total_barang_kategori($q, $idUmkm, $key);
			$produk = $this->M_konsumen->get_produk_umkm_kategori($config['per_page'], $start, $q, $idUmkm, $key);
			$this->load->library('pagination');
			$this->pagination->initialize($config);

			$data = array(
				'id_umkm' => $idUmkm,
				'nama_umkm' => $cek->nama_umkm,
				'alamat' => $cek->alamat_umkm,
				'deskripsi' => $cek->deskripsi_umkm,
				'no_telp' => $cek->nomor_telp_umkm,
				'foto' => $cek->foto_user,
				'produk' => $produk,
				'kategori_produk' => $this->M_konsumen->kategoriProdukById($idUmkm),
				'cekFoto' => $this->M_konsumen->semuaFotoUMKM($idUmkm),
				'portofolio' => $this->M_konsumen->cekPortofolio($idUmkm),
				'market' => $this->M_konsumen->cekMarket($idUmkm),
				'informasi' => $this->M_konsumen->cekInformasi($idUmkm),
				'jmlh_informasi' => $this->M_konsumen->jmlhInformasi($idUmkm)->jmlh,
				'jenis' => $this->M_konsumen->getKategoriProduk($key)->nama_kategori_produk,
				'q' => $q,												// pagination
				'pagination' => $this->pagination->create_links(),		// pagination
				'start' => $start,										// pagination
				'jumlah' => $this->M_konsumen->jmlhProduk($idUmkm)->jumlah,
				'batas' => $config['per_page'],
			);
			$this->load->view('Konsumen/Head');
			$this->load->view('Konsumen/Header', $data);
			$this->load->view('Konsumen/DetailUMKM', $data);
			$this->load->view('Konsumen/Footer');
		}
	}

	// KERANJANG

	function inputKeranjang($idProduk)
	{
		if ($this->session->userdata('id_konsumen')) {
			$cek = $this->M_konsumen->produkById($idProduk);	// mengambil data produk dari tabel produk
			$produk = $this->M_konsumen->cekProdukKeranjang($idProduk, $this->session->userdata('id_konsumen'));	// mengecek apakah produk sudah ada di keranjang atau belum
			// $cekCheckout = $this->M_konsumen->cekIdTransaksi($this->session->userdata('id_konsumen'));	// mengecek apakah ada yang status transaksi menunggu pembayaran

			if ($produk->id_produk != $idProduk AND $jumlah <= $cek->stok) {		// jika produk belum ada di keranjang
				$jumlah = $this->input->post('qty');
				$data = array(
					'id_konsumen' => $this->session->userdata('id_konsumen'),
					'id_produk' => $idProduk,
					'jumlah_barang' => $jumlah,
				);
				$insert = $this->M_konsumen->inputKeranjang($data);
				$this->session->set_flashdata('success', $cek->nama_produk.' berhasil ditambahkan ke keranjang!');
				redirect('Konsumen/detailProduk/'.$idProduk);
			}if($produk->id_produk != $idProduk AND $jumlah > $cek->stok){
				$this->session->set_flashdata('warning', 'Stok '.$cek->nama_produk.' hanya '.$cek->stok.' produk. Anda sudah memasukan ke keranjang sebanyak '.$produk->jumlah_barang.' produk');
				redirect('Konsumen/detailProduk/'.$idProduk);
			}if($produk->id_produk == $idProduk AND $jumlah <= $cek->stok){
				$awal = $produk->jumlah_barang;
				$tambah = $this->input->post('qty');
				$jumlah = $awal+$tambah;
				$data1 = array(
					'jumlah_barang' => $jumlah,
				);
				$this->M_konsumen->updateProdukKonsumen($data1,$idProduk,$this->session->userdata('id_konsumen'));
				$this->session->set_flashdata('success', ' berhasil menambah '.$cek->nama_produk.'ke keranjang!');
				redirect('Konsumen/detailProduk/'.$idProduk);
			}if ($produk->id_produk == $idProduk AND $jumlah > $cek->stok) {
				$this->session->set_flashdata('warning', 'Stok '.$cek->nama_produk.' hanya '.$cek->stok.' produk. Anda sudah memasukan ke dalam keranjang sebanyak '.$produk->jumlah_barang.' produk');
				redirect('Konsumen/detailProduk/'.$idProduk);
			}
		}else{
			$this->session->set_flashdata('warning', 'silahkan login terlebih dahulu!');
			redirect('Konsumen/index');
		}
	}

	function Keranjang()
	{
		if ($this->session->userdata('id_konsumen')) {
			$idKonsumen = $this->session->userdata('id_konsumen');
			$produk = $this->M_konsumen->cekKeranjangKonsumen($idKonsumen);	// mengecek keranjang produk yang dimasukan ke keranjang
			$data = array(
				'produk' => $this->M_konsumen->keranjangByKonsumen($idKonsumen),
			);
			$this->load->view('Konsumen/Head');
			$this->load->view('Konsumen/Header', $data);
			$this->load->view('Konsumen/Keranjang', $data);
			$this->load->view('Konsumen/Footer');
		}else{
			$this->session->set_flashdata('warning', 'silahkan login terlebih dahulu!');
			redirect('Konsumen/index');
		}
	}

	function kurangiBarang($idKeranjang)
	{
		if ($this->session->userdata('id_konsumen')) {
			$cek = $this->M_konsumen->getKeranjang($idKeranjang)->jumlah_barang;
			$jml = $cek - 1;
			if ($jml >= 1) {	// jika ada produk tersebut yang dimasukan keranjang
				$data = array(
					'jumlah_barang' => $jml
				);
				$this->M_konsumen->updateKeranjang($data, $idKeranjang);
				redirect('Konsumen/Keranjang/'.$this->session->userdata('id_konsumen'));
			}else{
				redirect('Konsumen/Keranjang/'.$this->session->userdata('id_konsumen'));
			}
		}else{
			$this->session->set_flashdata('warning', 'silahkan login terlebih dahulu!');
			redirect('Konsumen/index');
		}
	}

	function tambahBarang($idKeranjang)
	{
		if ($this->session->userdata('id_konsumen')) {
			$cek = $this->M_konsumen->getKeranjang($idKeranjang);	// jumlah barang per produk di keranjang
			$stok = $this->M_konsumen->produkById($cek->id_produk)->stok;		// cek stok produk
			$jml = $cek->jumlah_barang + 1;
			// echo $stok;
			if ($jml <= $stok) {	// jika jumlah produk melebihi stok
				$data = array(
					'jumlah_barang' => $jml
				);
				$this->M_konsumen->updateKeranjang($data, $idKeranjang);
				redirect('Konsumen/Keranjang/'.$this->session->userdata('id_konsumen'));
			}else{
				$data = array(
					'jumlah_barang' => $stok
				);
				$this->M_konsumen->updateKeranjang($data, $idKeranjang);
				$this->session->set_flashdata('warning', 'stok produk yang tersedia hanya '.$stok);
				redirect('Konsumen/Keranjang/'.$this->session->userdata('id_konsumen'));
			}
		}else{
			$this->session->set_flashdata('warning', 'silahkan login terlebih dahulu!');
			redirect('Konsumen/index');
		}
	}

	function hapusKeranjang()
	{
		if ($this->session->userdata('id_konsumen')) {
			$hapus = $this->M_konsumen->hapusKeranjang($this->session->userdata('id_konsumen'));
			$this->session->set_flashdata('success', 'semua produk dalam keranjang berhasil dihapus!');
			redirect('Konsumen/Keranjang/'.$this->session->userdata('id_konsumen'));
		}else{
			$this->session->set_flashdata('warning', 'silahkan login terlebih dahulu!');
			redirect('Konsumen/index');
		}
	}

	function hapusProduk($idProduk)
	{
		if ($this->session->userdata('id_konsumen')) {
			$this->M_konsumen->hapusProduk($idProduk, $this->session->userdata('id_konsumen'));
			$this->session->set_flashdata('success', 'produk berhasil dihapus dari keranjang!');
			redirect('Konsumen/Keranjang/'.$this->session->userdata('id_konsumen'));
		}else{
			$this->session->set_flashdata('warning', 'silahkan login terlebih dahulu!');
			redirect('Konsumen/index');
		}
	}

	// PESANAN

	function Pesanan()
	{
		if ($this->session->userdata('id_konsumen')) {
			$idKonsumen = $this->session->userdata('id_konsumen');
			$pesanan = $this->M_konsumen->cekPesanan($idKonsumen);	// mengecek keranjang produk yang dimasukan ke keranjang
			if (!empty($pesanan)) {	// mengecek jika ada produk di keranjang
				$data = array(
					'menunggu_pembayaran' => $this->M_konsumen->pesananMenungguPembayaran($idKonsumen),
					'menunggu_konfirmasi' => $this->M_konsumen->pesananMenungguKonfirmasi($idKonsumen),
					'diproses' => $this->M_konsumen->pesananDiproses($idKonsumen),
					'dikirim' => $this->M_konsumen->pesananDikirim($idKonsumen),
					'selesai' => $this->M_konsumen->pesananSelesai($idKonsumen),
				);
				$this->load->view('Konsumen/Head');
				$this->load->view('Konsumen/Header', $data);
				$this->load->view('Konsumen/Pesanan', $data);
				$this->load->view('Konsumen/Footer');
			}else{
				$this->session->set_flashdata('warning', 'Silahkan checkout produk terlebih dahulu');
				redirect('Konsumen/Home');
			}
		}else{
			$this->session->set_flashdata('warning', 'silahkan login terlebih dahulu!');
			redirect('Konsumen/index');
		}
	}

	function terimaPesanan($idTransaksi)
	{
		if ($this->session->userdata('id_konsumen')) {
			$data = array(
				'status' => 'diterima'
			);
			$this->M_konsumen->terimaPesanan($idTransaksi,$data);
			$this->session->set_flashdata('success', 'Terima kasih atas pesanan Anda!');
			redirect('Konsumen/Pesanan');
		}else{
			$this->session->set_flashdata('warning', 'silahkan login terlebih dahulu!');
			redirect('Konsumen/index');
		}
	}

	// CHECKOUT & PEMBAYARAN

	// function Checkout()
	// {
	// 	if ($this->session->userdata('id_konsumen')) {
	// 		if (empty($this->M_konsumen->cekIdTransaksi($this->session->userdata('id_konsumen')))) {
	// 			$data1 = array(
	// 				'id_konsumen' => $this->session->userdata('id_konsumen'),
	// 				'status' => 'menunggu pembayaran',
	// 				'tanggal_transaksi' => date('Y-m-d H-i-s'),
	// 			);
	// 			$this->M_konsumen->createTransaksi($data1);	// Create ke tabel transaksi status menunggu pembayaran
	// 			$idTransaksi = $this->M_konsumen->cekIdTransaksi($this->session->userdata('id_konsumen'))->id_transaksi;
	// 			$idKeranjang = $_POST['keranjang'];		// name checkbox di form, id keranjang yang akan di checkout
	// 			if (count($idKeranjang)>1) {	// jika produk yang dicheckout lebih dari 1 produk
	// 				// $result = array();
	// 				for($i=0 ;$i < count($idKeranjang); $i++) {
	// 					$cekKeranjang = $this->M_konsumen->cekKeranjang($idKeranjang[$i]);
	// 					$cekProduk = $this->M_konsumen->cekProduk($cekKeranjang->id_produk);	// mengambil data produk
	// 					$hargaProduk = $cekProduk->harga_produk;	// mengambil harga per produk
	// 					$jumlahProduk = $cekKeranjang->jumlah_barang;
	// 					$jumlahHarga = $hargaProduk*$jumlahProduk;
	// 					$data = array(
	// 						'id_transaksi' => $idTransaksi,
	// 						'id_produk' => $cekProduk->id_produk,
	// 						'jumlah_produk' => $jumlahProduk,
	// 						'jumlah_harga' => $jumlahHarga,
	// 					);
	// 					$this->M_konsumen->detailTransaksi($data);	// insert ke tabel detail transaksi
	// 					$this->M_konsumen->deleteKeranjangMultiple($idKeranjang[$i]);		// hapus produk dari tabel keranjang
	// 					$stok = $cekProduk->stok;
	// 					$data1 = array(
	// 						'stok' => $stok-$jumlahProduk,
	// 					);
	// 					$this->M_konsumen->updateProdukById($data1, $cekProduk->id_produk);	// update jumlah stok di tabel produk
	// 				}
	// 				$totalHarga = $this->M_konsumen->getTotalHarga($idTransaksi)->total;	// mengambil total harga produk yang dicheckout
	// 				$this->M_konsumen->updatetotalHarga($totalHarga, $idTransaksi);	// mengupdate total harga di tabel transaksi
	// 				// print_r($data);
	// 				$this->session->set_flashdata('success', 'produk berhasil dicheckout!');
	// 				redirect('Konsumen/Pengiriman');

	// 			}elseif(count($idKeranjang)==0){	// jika produk yang dicheckout tidak ada
	// 				$this->session->set_flashdata('warning', 'silahkan pilih produk yang akan dicheckout!');
	// 				redirect('Konsumen/Keranjang');
	// 			}elseif(count($idKeranjang)==1){	// jika produk yang dicheckout hanya 1 produk
	// 				$cekKeranjang = $this->M_konsumen->cekKeranjang($idKeranjang[0]);
	// 				$cekProduk = $this->M_konsumen->cekProduk($cekKeranjang->id_produk);
	// 				$hargaProduk = $cekProduk->harga_produk;
	// 				$jumlahProduk = $cekKeranjang->jumlah_barang;
	// 				$jumlahHarga = $hargaProduk*$jumlahProduk;
	// 				$data = array(
	// 					'id_transaksi' => $idTransaksi,
	// 					'id_produk' => $cekProduk->id_produk,
	// 					'jumlah_produk' => $jumlahProduk,
	// 					'jumlah_harga' => $jumlahHarga,
	// 				);
	// 				$this->M_konsumen->detailTransaksi($data);	// insert ke tabel detail transaksi
	// 				$this->M_konsumen->deleteKeranjangMultiple($idKeranjang[0]);		// hapus produk dari tabel keranjang
	// 				$stok = $cekProduk->stok;
	// 				$data1 = array(
	// 					'stok' => $stok-$jumlahProduk,
	// 				);
	// 				$this->M_konsumen->updateProdukById($data1, $cekProduk->id_produk);		// update jumlah stok di tabel produk
	// 				$totalHarga = $this->M_konsumen->getTotalHarga($idTransaksi)->total;
	// 				$this->M_konsumen->updatetotalHarga($totalHarga, $idTransaksi);	// mengupdate total harga di tabel transaksi

	// 				$this->session->set_flashdata('success', 'produk berhasil dicheckout!');
	// 				redirect('Konsumen/Pengiriman');
	// 			}
	// 			// print_r($idKeranjang);
	// 		}else{
	// 			$this->session->set_flashdata('warning', 'Silahkan selesaikan transaksi sebelumnya terlebih dahulu!');
	// 			redirect('Konsumen/Keranjang');
	// 		}
	// 	}else{
	// 		$this->session->set_flashdata('warning', 'silahkan login terlebih dahulu!');
	// 		redirect('Konsumen/index');
	// 	}
	// }

	function Checkout()
	{
		if ($this->session->userdata('id_konsumen')) {
			if (empty($this->M_konsumen->cekIdTransaksi($this->session->userdata('id_konsumen')))) {
				$data1 = array(
					'id_konsumen' => $this->session->userdata('id_konsumen'),
					'status' => 'menunggu pembayaran',
					'tanggal_transaksi' => date('Y-m-d H-i-s'),
				);
				$this->M_konsumen->createTransaksi($data1);	// Create ke tabel transaksi status menunggu pembayaran
				$idTransaksi = $this->M_konsumen->cekIdTransaksi($this->session->userdata('id_konsumen'))->id;
				$idKeranjang = $_POST['keranjang'];		// name checkbox di form, id keranjang yang akan di checkout
				if (count($idKeranjang)>1) {	// jika produk yang dicheckout lebih dari 1 produk
					// $result = array();
					for($i=0 ;$i < count($idKeranjang); $i++) {
						$cekKeranjang = $this->M_konsumen->cekKeranjang($idKeranjang[$i]);
						$cekProduk = $this->M_konsumen->cekProduk($cekKeranjang->id_produk);	// mengambil data produk
						$hargaProduk = $cekProduk->harga_produk;	// mengambil harga per produk
						$jumlahProduk = $cekKeranjang->jumlah_barang;
						$jumlahHarga = $hargaProduk*$jumlahProduk;
						$data = array(
							'id_transaksi' => $idTransaksi,
							'id_produk' => $cekProduk->id_produk,
							'jumlah_produk' => $jumlahProduk,
							'jumlah_harga' => $jumlahHarga,
						);
						$this->M_konsumen->detailTransaksi($data);	// insert ke tabel detail transaksi
						$this->M_konsumen->deleteKeranjangMultiple($idKeranjang[$i]);		// hapus produk dari tabel keranjang
						$stok = $cekProduk->stok;
						$data1 = array(
							'stok' => $stok-$jumlahProduk,
						);
						$this->M_konsumen->updateProdukById($data1, $cekProduk->id_produk);	// update jumlah stok di tabel produk
					}
					$totalHarga = $this->M_konsumen->getTotalHarga($idTransaksi)->total;	// mengambil total harga produk yang dicheckout
					$this->M_konsumen->updatetotalHarga($totalHarga, $idTransaksi);	// mengupdate total harga di tabel transaksi
					// print_r($data);
					$this->session->set_flashdata('success', 'produk berhasil dicheckout!');
					redirect('Konsumen/Pengiriman/'.$idTransaksi);

				}elseif(count($idKeranjang)==0){	// jika produk yang dicheckout tidak ada
					$this->session->set_flashdata('warning', 'silahkan pilih produk yang akan dicheckout!');
					redirect('Konsumen/Keranjang');
				}elseif(count($idKeranjang)==1){	// jika produk yang dicheckout hanya 1 produk
					$cekKeranjang = $this->M_konsumen->cekKeranjang($idKeranjang[0]);
					$cekProduk = $this->M_konsumen->cekProduk($cekKeranjang->id_produk);
					$hargaProduk = $cekProduk->harga_produk;
					$jumlahProduk = $cekKeranjang->jumlah_barang;
					$jumlahHarga = $hargaProduk*$jumlahProduk;
					$data = array(
						'id_transaksi' => $idTransaksi,
						'id_produk' => $cekProduk->id_produk,
						'jumlah_produk' => $jumlahProduk,
						'jumlah_harga' => $jumlahHarga,
					);
					$this->M_konsumen->detailTransaksi($data);	// insert ke tabel detail transaksi
					$this->M_konsumen->deleteKeranjangMultiple($idKeranjang[0]);		// hapus produk dari tabel keranjang
					$stok = $cekProduk->stok;
					$data1 = array(
						'stok' => $stok-$jumlahProduk,
					);
					$this->M_konsumen->updateProdukById($data1, $cekProduk->id_produk);		// update jumlah stok di tabel produk
					$totalHarga = $this->M_konsumen->getTotalHarga($idTransaksi)->total;
					$this->M_konsumen->updatetotalHarga($totalHarga, $idTransaksi);	// mengupdate total harga di tabel transaksi

					$this->session->set_flashdata('success', 'produk berhasil dicheckout!');
					redirect('Konsumen/Pengiriman/'.$idTransaksi);
				}
				// print_r($idKeranjang);
			}else{
				$data1 = array(
					'id_konsumen' => $this->session->userdata('id_konsumen'),
					'status' => 'menunggu pembayaran',
					'tanggal_transaksi' => date('Y-m-d H-i-s'),
				);
				$this->M_konsumen->createTransaksi($data1);	// Create ke tabel transaksi status menunggu pembayaran
				$idTransaksi = $this->M_konsumen->cekIdTransaksi($this->session->userdata('id_konsumen'))->id;
				$idKeranjang = $_POST['keranjang'];		// name checkbox di form, id keranjang yang akan di checkout
				if (count($idKeranjang)>1) {	// jika produk yang dicheckout lebih dari 1 produk
					// $result = array();
					for($i=0 ;$i < count($idKeranjang); $i++) {
						$cekKeranjang = $this->M_konsumen->cekKeranjang($idKeranjang[$i]);
						$cekProduk = $this->M_konsumen->cekProduk($cekKeranjang->id_produk);	// mengambil data produk
						$hargaProduk = $cekProduk->harga_produk;	// mengambil harga per produk
						$jumlahProduk = $cekKeranjang->jumlah_barang;
						$jumlahHarga = $hargaProduk*$jumlahProduk;
						$data = array(
							'id_transaksi' => $idTransaksi,
							'id_produk' => $cekProduk->id_produk,
							'jumlah_produk' => $jumlahProduk,
							'jumlah_harga' => $jumlahHarga,
						);
						$this->M_konsumen->detailTransaksi($data);	// insert ke tabel detail transaksi
						$this->M_konsumen->deleteKeranjangMultiple($idKeranjang[$i]);		// hapus produk dari tabel keranjang
						$stok = $cekProduk->stok;
						$data1 = array(
							'stok' => $stok-$jumlahProduk,
						);
						$this->M_konsumen->updateProdukById($data1, $cekProduk->id_produk);	// update jumlah stok di tabel produk
					}
					$totalHarga = $this->M_konsumen->getTotalHarga($idTransaksi)->total;	// mengambil total harga produk yang dicheckout
					$this->M_konsumen->updatetotalHarga($totalHarga, $idTransaksi);	// mengupdate total harga di tabel transaksi
					// print_r($data);
					$this->session->set_flashdata('success', 'produk berhasil dicheckout!');
					redirect('Konsumen/Pengiriman/'.$idTransaksi);

				}elseif(count($idKeranjang)==0){	// jika produk yang dicheckout tidak ada
					$this->session->set_flashdata('warning', 'silahkan pilih produk yang akan dicheckout!');
					redirect('Konsumen/Keranjang');
				}elseif(count($idKeranjang)==1){	// jika produk yang dicheckout hanya 1 produk
					$cekKeranjang = $this->M_konsumen->cekKeranjang($idKeranjang[0]);
					$cekProduk = $this->M_konsumen->cekProduk($cekKeranjang->id_produk);
					$hargaProduk = $cekProduk->harga_produk;
					$jumlahProduk = $cekKeranjang->jumlah_barang;
					$jumlahHarga = $hargaProduk*$jumlahProduk;
					$data = array(
						'id_transaksi' => $idTransaksi,
						'id_produk' => $cekProduk->id_produk,
						'jumlah_produk' => $jumlahProduk,
						'jumlah_harga' => $jumlahHarga,
					);
					$this->M_konsumen->detailTransaksi($data);	// insert ke tabel detail transaksi
					$this->M_konsumen->deleteKeranjangMultiple($idKeranjang[0]);		// hapus produk dari tabel keranjang
					$stok = $cekProduk->stok;
					$data1 = array(
						'stok' => $stok-$jumlahProduk,
					);
					$this->M_konsumen->updateProdukById($data1, $cekProduk->id_produk);		// update jumlah stok di tabel produk
					$totalHarga = $this->M_konsumen->getTotalHarga($idTransaksi)->total;
					$this->M_konsumen->updatetotalHarga($totalHarga, $idTransaksi);	// mengupdate total harga di tabel transaksi

					$this->session->set_flashdata('success', 'produk berhasil dicheckout!');
					redirect('Konsumen/Pengiriman/'.$idTransaksi);
				}
				// print_r($idKeranjang);
			}
		}else{
			$this->session->set_flashdata('warning', 'silahkan login terlebih dahulu!');
			redirect('Konsumen/index');
		}
	}

	function Pengiriman($idTransaksi)
	{
		if ($this->session->userdata('id_konsumen')) {
			if (!is_null($this->M_konsumen->cekIdTransaksi($this->session->userdata('id_konsumen'))->id)) {
				// $idTransaksi = $this->M_konsumen->cekIdTransaksi($this->session->userdata('id_konsumen'))->id;	// mengambil id transaksi yang statusnya menunggu pembayaran

			// api rajaongkir
				$data['ongkir'] = '';
			if (count($_POST)) {	// mengecek apakah ada inputan
				// get data inputan dari json
				$curl = curl_init();

				curl_setopt_array($curl, array(
					CURLOPT_URL => "https://api.rajaongkir.com/starter/cost",
					CURLOPT_RETURNTRANSFER => true,
					CURLOPT_ENCODING => "",
					CURLOPT_MAXREDIRS => 10,
					CURLOPT_TIMEOUT => 30,
					CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
					CURLOPT_CUSTOMREQUEST => "POST",
					CURLOPT_POSTFIELDS => "origin=22&destination=".$this->input->post('kota_tujuan')."&weight=".$this->input->post('berat')."&courier=".$this->input->post('ekspedisi'),
					CURLOPT_HTTPHEADER => array(
						"content-type: application/x-www-form-urlencoded",
						"key: 28b6e68fb3460455044054d3d955e252"
					),
				));
				$response = curl_exec($curl);
				$err = curl_error($curl);

				curl_close($curl);

				if ($err) {
					echo "cURL Error #:" . $err;
				}else{									// jika tidak error
					$biaya = json_decode($response, true);
					$alamat = array(
						'provinsi' => $biaya['rajaongkir']['destination_details']['province'],
						'kota' => $biaya['rajaongkir']['destination_details']['city_name'],
						'detail_alamat' => $this->input->post('detail_alamat'),
						'tanggal_transaksi' => date('Y-m-d H-i-s'),
						// 'ongkir' => $response
					);
					$this->M_konsumen->updateTransaksi($alamat,$idTransaksi);
					$data = array(
						'produk' => $this->M_konsumen->produkBayar($idTransaksi),
						'ongkir' => $response,
						'alamat' => $this->M_konsumen->getTransaksi($idTransaksi),
						'totalHarga' => $this->M_konsumen->getTotalHarga($idTransaksi)->total,
						'transaksi' => $this->M_konsumen->getTransaksi($idTransaksi),
					);

					$this->load->view('Konsumen/Head');
					$this->load->view('Konsumen/Header', $data);
					$this->load->view('Konsumen/Checkout', $data);
					$this->load->view('Konsumen/Footer');
				}
			}
			$data = array(
				'produk' => $this->M_konsumen->produkBayar($idTransaksi),	// mengambil data produk
				'ongkir' => '',
				'alamat' => $this->M_konsumen->getTransaksi($idTransaksi),
				'totalHarga' => $this->M_konsumen->getTotalHarga($idTransaksi)->total,
				'transaksi' => $this->M_konsumen->getTransaksi($idTransaksi),
			);
			$this->load->view('Konsumen/Head');
			$this->load->view('Konsumen/Header', $data);
			$this->load->view('Konsumen/Checkout', $data);
			$this->load->view('Konsumen/Footer');
		}else{
			$this->session->set_flashdata('warning', 'Tidak ada produk yang dicheckout!');
			redirect('Konsumen/Produk/semua');
		}
	}else{
		$this->session->set_flashdata('warning', 'silahkan login terlebih dahulu!');
		redirect('Konsumen/index');
	}
}

function inputDiskon($idTransaksi)
{
	if ($this->session->userdata('id_konsumen')) {
		if (!empty($_POST['kode_diskon'])) {
			$kode_diskon = $this->input->post('kode_diskon');
			$cekKode = $this->M_konsumen->cekKodeDiskon($kode_diskon);	// ambil data diskon berdasarkan kode diskon
			if (!empty($cekKode)) {
				$transaksi = $this->M_konsumen->getTransaksi($idTransaksi);	// ambil data transaksi

				if (!is_null($cekKode->id_umkm)) {		// jika promo dari umkm tertentu
					$total_belanja = $this->M_konsumen->getProduk($idTransaksi, $cekKode->id_umkm)->total;
					$Umkm = $this->M_konsumen->umkmById($cekKode->id_umkm);
					if (!empty($total_belanja)) {		// jika ada produk dari umkm tersebut
						if ($total_belanja >= $cekKode->minimal_belanja) {		// cek belanja maksimum dan minimum
							$besarDiskon = ($transaksi->total_harga*$cekKode->besar_promo)/100;
							if ($besarDiskon <= $cekKode->maksimum_potongan) {	// jika diskon kurang dari maksimal potongan
								$data1 = array(
									'id_promo' => $cekKode->id_promo,
									'tanggal_transaksi' => date('Y-m-d H-i-s'),
								);
								$this->M_konsumen->terimaPesanan($idTransaksi, $data1);	// masukan id_promo ke tabel transaksi

								$data2 = array(
									'besar_diskon' => $besarDiskon,
									'tanggal_transaksi' => date('Y-m-d H-i-s'),
								);
								$this->M_konsumen->terimaPesanan($idTransaksi, $data2);	// masukan besar diskon yang diterima ke tabel transaksi
								$this->session->set_flashdata('success', 'voucher diskon berhasil digunakan!');
								redirect('Konsumen/Pengiriman/'.$idTransaksi);
							}else{		// jika diskon melebihi maksimal potongan
								$data1 = array(
									'id_promo' => $cekKode->id_promo,
									'tanggal_transaksi' => date('Y-m-d H-i-s'),
								);
								$this->M_konsumen->terimaPesanan($idTransaksi, $data1);	// masukan id_promo ke tabel transaksi

								$data2 = array(
									'besar_diskon' => $cekKode->maksimum_potongan,
									'tanggal_transaksi' => date('Y-m-d H-i-s'),
								);
								$this->M_konsumen->terimaPesanan($idTransaksi, $data2);	// masukan besar diskon yang diterima ke tabel transaksi
								$this->session->set_flashdata('success', 'voucher diskon berhasil digunakan!');
								redirect('Konsumen/Pengiriman/'.$idTransaksi);
							}
						}else{
							$this->session->set_flashdata('warning', 'voucher diskon hanya dapat digunakan untuk pembelian produk minimall Rp '.number_format($cekKode->minimal_belanja,2,',','.'));
							redirect('Konsumen/Pengiriman/'.$idTransaksi);
						}
					}else{		// jika tidak ada produk dari umkm tersebut
						$this->session->set_flashdata('warning', 'voucher diskon hanya dapat digunakan untuk pembelian produk dari '.$Umkm->nama_umkm);
						redirect('Konsumen/Pengiriman/'.$idTransaksi);
					}
				}else{		// jika promo untuk semua umkm
					if ($transaksi->total_harga >= $cekKode->minimal_belanja) {		// cek belanja maksimum dan minimum
						$besarDiskon = ($transaksi->total_harga*$cekKode->besar_promo)/100;
							if ($besarDiskon <= $cekKode->maksimum_potongan) {	// jika diskon kurang dari maksimal potongan
								$data1 = array(
									'id_promo' => $cekKode->id_promo,
									'tanggal_transaksi' => date('Y-m-d H-i-s'),
								);
								$this->M_konsumen->terimaPesanan($idTransaksi, $data1);	// masukan id_promo ke tabel transaksi

								$data2 = array(
									'besar_diskon' => $besarDiskon,
									'tanggal_transaksi' => date('Y-m-d H-i-s'),
								);
								$this->M_konsumen->terimaPesanan($idTransaksi, $data2);	// masukan besar diskon yang diterima ke tabel transaksi
								$this->session->set_flashdata('success', 'voucher diskon berhasil digunakan!');
								redirect('Konsumen/Pengiriman/'.$idTransaksi);
							}else{		// jika diskon melebihi maksimal potongan
								$data1 = array(
									'id_promo' => $cekKode->id_promo,
									'tanggal_transaksi' => date('Y-m-d H-i-s'),
								);
								$this->M_konsumen->terimaPesanan($idTransaksi, $data1);	// masukan id_promo ke tabel transaksi

								$data2 = array(
									'besar_diskon' => $cekKode->maksimum_potongan,
									'tanggal_transaksi' => date('Y-m-d H-i-s'),
								);
								$this->M_konsumen->terimaPesanan($idTransaksi, $data2);	// masukan besar diskon yang diterima ke tabel transaksi
								$this->session->set_flashdata('success', 'voucher diskon berhasil digunakan!');
								redirect('Konsumen/Pengiriman/'.$idTransaksi);
							}
						}else{
							$this->session->set_flashdata('warning', 'voucher diskon hanya dapat digunakan untuk pembelian produk minimal Rp '.number_format($cekKode->minimal_belanja,2,',','.'));
							redirect('Konsumen/Pengiriman/'.$idTransaksi);
						}
					}

				}else{
					$this->session->set_flashdata('warning', 'kode diskon tidak terdaftar!');
					redirect('Konsumen/Pengiriman/'.$idTransaksi);
				}
			}else{
				$this->session->set_flashdata('warning', 'tidak ada kode diskon yang diinputkan!');
				redirect('Konsumen/Pengiriman/'.$idTransaksi);
			}
		}else{
			$this->session->set_flashdata('warning', 'silahkan login terlebih dahulu!');
			redirect('Konsumen/index');
		}
	}

	function updateBiaya($idTransaksi,$service,$level,$biaya,$hari)
	{
		if ($this->session->userdata('id_konsumen')) {
			// $transaksi = $this->M_konsumen->cekIdTransaksi($this->session->userdata('id_konsumen'));
			// $idTransaksi = $transaksi->id_transaksi;
			$awal = $this->M_konsumen->getTotalHarga($idTransaksi)->total;
			$total = $awal+$biaya;
			$data = array(
				'ekspedisi_pengiriman' => strtoupper($service)." (".str_replace('%20', ' ', $level).")",
				'estimasi_pengiriman' => str_replace('%20', ' ', $hari),
				'ongkos_kirim' => $biaya,
				'tanggal_transaksi' => date('Y-m-d H-i-s'),
			);
			$this->M_konsumen->inputOngkir($data,$idTransaksi);
			redirect('Konsumen/Pengiriman/'.$idTransaksi);
		}else{
			$this->session->set_flashdata('warning', 'silahkan login terlebih dahulu!');
			redirect('Konsumen/index');
		}
	}

	function BatalkanTransaksi($idTransaksi)
	{
		if ($this->session->userdata('id_konsumen')) {
			$cek = $this->M_konsumen->getDetailTransaksi($idTransaksi);

			for ($i=0; $i < COUNT($cek); $i++) {
				// echo $cek[$i]->id_produk.",".$cek[$i]->jumlah_produk.",<br>";
				$jml = $cek[$i]->jumlah_produk;
				$id = $cek[$i]->id_produk;
				$stok = $this->M_konsumen->produkById($id)->stok;
				$data = array(
					'stok' => $stok+$jml,
				);
				$this->M_konsumen->updateProdukById($data, $id);
			}
			$this->M_konsumen->BatalkanTransaksi1($idTransaksi);
			$this->M_konsumen->BatalkanTransaksi2($idTransaksi);
			$this->session->set_flashdata('success', 'Transaksi dibatalkan');
			redirect('Konsumen/Keranjang');
		}else{
			$this->session->set_flashdata('warning', 'silahkan login terlebih dahulu!');
			redirect('Konsumen/index');
		}
	}

	function Pembayaran($idTransaksi)
	{
		if ($this->session->userdata('id_konsumen')) {
			$cek = $this->M_konsumen->getTransaksi($idTransaksi);
			if (!empty($cek->provinsi) AND !empty($cek->kota) AND !empty($cek->detail_alamat) AND !empty($cek->ekspedisi_pengiriman) AND !empty($cek->estimasi_pengiriman) AND !empty($cek->ongkos_kirim) ) {		// sudah terisi semua

				$data = array(
					'kontak' =>$this->M_konsumen->Kontak(),
					'id_transaksi' => $idTransaksi,
					'transaksi' => $cek,
				);
				$this->load->view('Konsumen/Head');
				$this->load->view('Konsumen/Header', $data);
				$this->load->view('Konsumen/Pembayaran', $data);
				$this->load->view('Konsumen/Footer');

			}elseif (!empty($cek->ekspedisi_pengiriman) AND !empty($cek->estimasi_pengiriman) AND !empty($cek->ongkos_kirim) ) {	// ongkir belum diisi

				$this->session->set_flashdata('warning', 'pastikan ekpedisi pengiriman sudah dipilih!');
				redirect('Konsumen/Pengiriman/'.$idTransaksi);

			}else{

				$this->session->set_flashdata('warning', 'pastikan alamat sudah terisi dan ekpedisi pengiriman sudah dipilih!');
				redirect('Konsumen/Pengiriman/'.$idTransaksi);

			}
		}else{
			$this->session->set_flashdata('warning', 'silahkan login terlebih dahulu!');
			redirect('Konsumen/index');
		}
	}

	function buktiBayar($idTransaksi)
	{
		if ($this->session->userdata('id_konsumen')) {	// jika ada foto yang diupload
			if (!empty($_FILES['bukti']['name'])) {
				$config['file_name'] 		= 'bukti_'.$idTransaksi;
				$config['upload_path']      = './assets/foto_bukti/';
				$config['allowed_types']    = 'jpg|jpeg|png';

				$this->load->library('upload', $config);
				$this->upload->initialize($config);

				if ($this->upload->do_upload('bukti')) {
					$uploadData = $this->upload->data();
					$data = array(
						'bukti_pembayaran' => $uploadData['file_name'],
						'tanggal_transaksi' => date('Y-m-d H-i-s'),
						'status' => 'menunggu konfirmasi'
					);
					$this->M_konsumen->inputOngkir($data,$idTransaksi);	// update data
					$this->session->set_flashdata('success', 'Terima kasih sudah melakukan transaksi! Pesanan akan segera diproses!');
					redirect('Konsumen/Produk/semua');
				}else{
					$this->session->set_flashdata('warning', 'fotmat bukti pembayaran tidak sesuai!');
					redirect('Konsumen/Pembayaran/'.$idTransaksi);
				}
			}
		}else{
			$this->session->set_flashdata('warning', 'silahkan login terlebih dahulu!');
			redirect('Konsumen/index');
		}
	}

		// CEK ONGKIR

	function kota($provinsi)
	{
		$curl = curl_init();

		curl_setopt_array($curl, array(
			CURLOPT_URL => "https://api.rajaongkir.com/starter/city?&province=".$provinsi,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "GET",
			CURLOPT_HTTPHEADER => array(
				"key: 28b6e68fb3460455044054d3d955e252"
			),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {
			echo "cURL Error #:" . $err;
		} else {
			$kota = json_decode($response, true);
			echo "<option value=''> -------- pilih kota -------- </option>";
			if ($kota['rajaongkir']['status']['code'] == '200') {
				foreach ($kota['rajaongkir']['results'] as $kt) {
					echo "<option value='".$kt['city_id']."'>".$kt['city_name']."</option>";
				}
			}
  // var_dump($response);
		}
	}

	// INFORMASI

	function Informasi()
	{
		$q = urldecode($this->input->get('q', TRUE));
		$start = intval($this->input->get('start'));
		if ($q <> '') {
			$config['base_url'] = base_url() . '/Konsumen/Informasi/?q=' . urlencode($q);
			$config['first_url'] = base_url() . '/Konsumen/Informasi/?q=' . urlencode($q);
		} else {
			$config['base_url'] = base_url() . '/Konsumen/Informasi';
			$config['first_url'] = base_url() . '/Konsumen/Informasi';
		}
		$config['per_page'] = 6;
		$config['page_query_string'] = TRUE;
		$config['total_rows'] = $this->M_konsumen->total_informasi($q);
		$informasi = $this->M_konsumen->get_informasi($config['per_page'], $start, $q);
		$this->load->library('pagination');
		$this->pagination->initialize($config);

		$data = array(
			'informasi' => $informasi,
			'q' => $q,												// pagination
			'pagination' => $this->pagination->create_links(),		// pagination
			'start' => $start,										// pagination
			'jumlah' => $this->M_konsumen->jmlInformasi()->jumlah,
			'batas' => $config['per_page'],
		);
		$this->load->view('Konsumen/Head');
		$this->load->view('Konsumen/Header', $data);
		$this->load->view('Konsumen/Informasi', $data);
		$this->load->view('Konsumen/Footer');
	}

	function detailInformasi($id)
	{
		$cek = $this->M_konsumen->detailInformasi($id);
		$data = array(
			'id_informasi' => $cek->id_informasi,
			'judul_informasi' => $cek->judul_informasi,
			'isi_informasi' => $cek->isi_informasi,
			'gambar' => $cek->gambar,
			'nama_umkm' => $cek->nama_umkm,
			'id_umkm' => $cek->id_umkm
		);
		$this->load->view('Konsumen/Head');
		$this->load->view('Konsumen/Header', $data);
		$this->load->view('Konsumen/DetailInformasi', $data);
		$this->load->view('Konsumen/Footer');
	}

	// PROFILE

	function Profil()
	{
		if ($this->session->userdata('id_konsumen')) {
			$cek = $this->M_konsumen->Profil($this->session->userdata('id_konsumen'));
			$data = array(
				'nama_konsumen' => $cek->nama_konsumen,
				'username_konsumen' => $cek->username_konsumen,
				'email_konsumen' => $cek->email_konsumen,
				'foto_konsumen' => $cek->foto_konsumen,
				'no_telp' => $cek->nomor_telp_konsumen,
				'jenis_kelamin' => $cek->jenis_kelamin,
				'tanggal_lahir' => $cek->tanggal_lahir,
			);
			$this->load->view('Konsumen/Head');
			$this->load->view('Konsumen/Header', $data);
			$this->load->view('Konsumen/Profile', $data);
			$this->load->view('Konsumen/Footer');
		}else{
			$this->session->set_flashdata('warning', 'silahkan login terlebih dahulu!');
			redirect('Konsumen/index');
		}
	}

	function editProfil()
	{
		if ($this->session->userdata('id_konsumen')) {
			if (!empty($_FILES['foto_konsumen']['name'])) {
				$config['file_name'] 		= 'konsumen_'.$this->session->userdata('id_konsumen').date('Y-m-d H-i-s');
				$config['upload_path']      = './assets/foto_konsumen/';
				$config['allowed_types']    = 'jpg|jpeg|png';

				$this->load->library('upload', $config);
				$this->upload->initialize($config);

				if ($this->upload->do_upload('foto_konsumen')) {
					$uploadData = $this->upload->data();
					$data = array(
						'foto_konsumen' => $uploadData['file_name'],
						'nama_konsumen' => $this->input->post('nama_konsumen'),
						'username_konsumen' => $this->input->post('username_konsumen'),
						'email_konsumen' => $this->input->post('email_konsumen'),
						'nomor_telp_konsumen' => $this->input->post('nomor_telp_konsumen'),
						'jenis_kelamin' => $this->input->post('jenis_kelamin'),
						'tanggal_lahir' => $this->input->post('tanggal_lahir'),
					);
					$this->M_konsumen->updateProfil($data,$this->session->userdata('id_konsumen'));	// update data
					$this->session->set_flashdata('success', 'Profil berhasil diupdate!');
					redirect('Konsumen/Profil');
				}else{
					$this->session->set_flashdata('warning', 'fotmat foto profile tidak sesuai!');
					redirect('Konsumen/Profil');
				}
			}else{
				$data = array(
					'nama_konsumen' => $this->input->post('nama_konsumen'),
					'username_konsumen' => $this->input->post('username_konsumen'),
					'email_konsumen' => $this->input->post('email_konsumen'),
					'nomor_telp_konsumen' => $this->input->post('nomor_telp_konsumen'),
					'jenis_kelamin' => $this->input->post('jenis_kelamin'),
					'tanggal_lahir' => $this->input->post('tanggal_lahir'),
				);
				$this->M_konsumen->updateProfil($data,$this->session->userdata('id_konsumen'));	// update data
				$this->session->set_flashdata('success', 'Profil berhasil diupdate!');
				redirect('Konsumen/Profil');
			}
		}else{
			$this->session->set_flashdata('warning', 'silahkan login terlebih dahulu!');
			redirect('Konsumen/index');
		}
	}

	function detailPromo($idPromo)
	{
		$cek = $this->M_konsumen->detailPromo($idPromo);
		$data = array(
			'id_promo' => $cek->id_promo,
			'nama_promo' => $cek->nama_promo,
			'kode_promo' => $cek->kode_promo,
			'besar_promo' => $cek->besar_promo,
			'minimal_belanja' => $cek->minimal_belanja,
			'maksimum_potongan' => $cek->maksimum_potongan,
			'foto_promo' => $cek->foto_promo,
			'berlaku_sampai' => $cek->berlaku_sampai,
			'id_umkm' => $cek->id_umkm,
		);
		$this->load->view('Konsumen/Head');
		$this->load->view('Konsumen/Header', $data);
		$this->load->view('Konsumen/DetailPromo', $data);
		$this->load->view('Konsumen/Footer');
	}

	function SyaratKetentuan()
	{
		$this->load->view('Konsumen/Head');
		$this->load->view('Konsumen/Header');
		$this->load->view('Konsumen/SyaratKetentuan');
		$this->load->view('Konsumen/Footer');
	}

}

?>
