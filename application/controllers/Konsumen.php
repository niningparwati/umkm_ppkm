<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Konsumen extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('M_konsumen');
		$this->load->helper('form');
	}

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

	// REGISTRASI

	function Register()
	{
		$data = array();
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
			$this->session->set_flashdata('warning', 'Username sudah terdaftar, silahkan gunakan username lain!');
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
			if (!is_null($this->M_konsumen->cekByEmail($email))) {	// cek email untuk melanjutkan validasi
				if ($this->sendEmail($email, $saltid)) {
					$this->session->set_flashdata('success', 'Silahkan cek email Anda untuk menyelesaikan proses registrasi!');
					redirect('Konsumen/index');
				}else{
					$this->session->set_flashdata('error','Pendaftaran Gagal');
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
			$this->session->set_flashdata('success', 'Verifikasi Email Berhasil');
			redirect('Konsumen/index');
		}else{
			$this->session->set_flashdata('warning', 'Verifikasi Email Gagal');
			redirect('Konsumen/Register');
		}
	}

	// PRODUK

	function Produk($key)
	{
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
				'q' => $q,												// pagination
				'pagination' => $this->pagination->create_links(),		// pagination
				'start' => $start,										// pagination
			);
			$this->load->view('Konsumen/Head');
			$this->load->view('Konsumen/Header', $data);
			$this->load->view('Konsumen/Produk', $data);
			$this->load->view('Konsumen/Footer');
		}
		
	}

	function detailProduk($idProduk)
	{
		$cek = $this->M_konsumen->produkById($idProduk);	// ambil detail produk
		$explode = explode(' ', $cek->nama_produk);
		$data = array(
			'id_produk' => $idProduk,
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
		);		
		$this->load->view('Konsumen/Head');
		$this->load->view('Konsumen/Header', $data);
		$this->load->view('Konsumen/detailProduk', $data);
		$this->load->view('Konsumen/Footer');
	}

}

?>