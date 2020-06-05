<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Konsumen extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('M_konsumen');
		$this->load->helper('form');
		// $this->load->library('rajaongkir');
	}

	private $api_key = 'af417221fb9e011a9af3883cf52f8320';

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
				redirect('Konsumen/index');
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
			if (!is_null($this->M_konsumen->cekByEmail($email))) {	// cek email untuk melanjutkan validasi
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
			$this->session->set_flashdata('success', 'verifikasi Eeail berhasil');
			redirect('Konsumen/index');
		}else{
			$this->session->set_flashdata('warning', 'verifikasi email gagal');
			redirect('Konsumen/Register');
		}
	}

	// HOME

	function Home()
	{

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
				'q' => $q,												// pagination
				'pagination' => $this->pagination->create_links(),		// pagination
				'start' => $start,										// pagination
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

	// UMKM

	function Umkm($key)
	{
		if ($key == 'semua') {
			$q = urldecode($this->input->get('q', TRUE));
			$start = intval($this->input->get('start'));
			if ($q <> '') {
				$config['base_url'] = base_url() . '/Konsumen/Umkm/'.$key.'/?q=' . urlencode($q);
				$config['first_url'] = base_url() . '/Konsumen/Umkm/'.$key.'/?q=' . urlencode($q);
			} else {
				$config['base_url'] = base_url() . '/Konsumen/Umkm/'.$key;
				$config['first_url'] = base_url() . '/Konsumen/Umkm/'.$key;
			}
			$config['per_page'] = 1;
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
			);
			$this->load->view('Konsumen/Head');
			$this->load->view('Konsumen/Header', $data);
			$this->load->view('Konsumen/UMKM', $data);
			$this->load->view('Konsumen/Footer');
			// print_r($data);
		}
	}

	function detailUmkm($idUmkm)
	{
		$cek = $this->M_konsumen->umkmById($idUmkm);	// ambil detail umkm
		$data = array(
			'id_umkm' => $idUmkm,
			'nama_umkm' => $cek->nama_umkm,
			'alamat' => $cek->alamat_umkm,
			'deskripsi' => $cek->deskripsi_umkm,
			'no_telp' => $cek->nomor_telp_umkm,
			'produk' => $this->M_konsumen->getProdukUmkm($idUmkm),
		);
		$this->load->view('Konsumen/Head');
		$this->load->view('Konsumen/Header', $data);
		$this->load->view('Konsumen/detailUMKM', $data);
		$this->load->view('Konsumen/Footer');
	}

	// KERANJANG

	function inputKeranjang($idProduk)
	{
		if ($this->session->userdata('id_konsumen')) {
			$cek = $this->M_konsumen->produkById($idProduk);
			$data = array(
				'id_konsumen' => $this->session->userdata('id_konsumen'),
				'id_produk' => $idProduk,
				'jumlah_barang' => $this->input->post('qty'),
			);
			$insert = $this->M_konsumen->inputKeranjang($data);
			if (insert) {
				$this->session->set_flashdata('success', $cek->nama_produk.' berhasil ditambahkan ke keranjang!');
				redirect('Konsumen/detailProduk/'.$idProduk);
			}else{
				$this->session->set_flashdata('warning', $cek->nama_produk.' gagal ditambahkan ke keranjang!');
				redirect('Konsumen/detailProduk/'.$idProduk);
			}
		}else{
			$this->session->set_flashdata('warning', 'silahkan login terlebih dahulu!');
			redirect('Konsumen/index');
		}
	}

	function Keranjang($idKonsumen)
	{
		if ($this->session->userdata('id_konsumen')) {
			$data['ongkir'] = '';
			if (count($_POST)) {
				$curl = curl_init();

				curl_setopt_array($curl, array(
					CURLOPT_URL => "https://api.rajaongkir.com/starter/cost",
					CURLOPT_RETURNTRANSFER => true,
					CURLOPT_ENCODING => "",
					CURLOPT_MAXREDIRS => 10,
					CURLOPT_TIMEOUT => 30,
					CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
					CURLOPT_CUSTOMREQUEST => "POST",
					CURLOPT_POSTFIELDS => "origin=".$this->input->post('kota')."&destination=".$this->input->post('kota_tujuan')."&weight=".$this->input->post('berat')."&courier=".$this->input->post('ekspedisi'),
					CURLOPT_HTTPHEADER => array(
						"content-type: application/x-www-form-urlencoded",
						"key: f0c4c771784c6fc34e0dd6fa17b75e4d"
					),
				));

				$response = curl_exec($curl);
				$err = curl_error($curl);

				curl_close($curl);

				if ($err) {
					echo "cURL Error #:" . $err;
					// $data = array(
					// 	'produk' => $this->M_konsumen->keranjangByKonsumen($idKonsumen),
					// 	'ongkir' => ''
					// );
					// $this->load->view('Konsumen/Head');
					// $this->load->view('Konsumen/Header', $data);
					// $this->load->view('Konsumen/Keranjang', $data);
					// $this->load->view('Konsumen/Footer');
				} else {
					// $data['ongkir'] = $response;
					$data = array(
						'produk' => $this->M_konsumen->keranjangByKonsumen($idKonsumen),
						'ongkir' => $response
					);
					$this->load->view('Konsumen/Head');
					$this->load->view('Konsumen/Header', $data);
					$this->load->view('Konsumen/Keranjang', $data);
					$this->load->view('Konsumen/Footer');
				}
			}

			$data = array(
				'produk' => $this->M_konsumen->keranjangByKonsumen($idKonsumen),
				'ongkir' => ''
			);
			$this->load->view('Konsumen/Head');
			$this->load->view('Konsumen/Header', $data);
			$this->load->view('Konsumen/Keranjang', $data);
			$this->load->view('Konsumen/Footer');

			// $data = array(
			// 	'produk' => $this->M_konsumen->keranjangByKonsumen($idKonsumen),
			// 	'ongkir' => $response
				// 'province' => $this->provinsi(),
				// 'shipping_cost' => $this->cek_shipping_cost()
			// );
			// $this->load->view('Konsumen/Head');
			// $this->load->view('Konsumen/Header', $data);
			// $this->load->view('Konsumen/Keranjang', $data);
			// $this->load->view('Konsumen/Footer');
			// print_r($data);
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
			if ($jml > 0) {	// jika ada produk tersebut yang dimasukan keranjang
				$data = array(
					'jumlah_barang' => $jml
				);
				$this->M_konsumen->updateKeranjang($data, $idKeranjang);
				redirect('Konsumen/Keranjang/'.$this->session->userdata('id_konsumen'));
			}else{
				echo 0;
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
				$this->session->set_flashdata('warning', 'stok produk hanya '.$stok);
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
				"key: f0c4c771784c6fc34e0dd6fa17b75e4d"
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

	// function get_provinsi()
	// {
	// 	//Mendapatkan semua propinsi
	// 	$provinces = $this->rajaongkir->province();
	// 	print_r($provinces);
	// }

	// function provinsi()
	// {
	// 	$curl = curl_init();

	// 	curl_setopt_array($curl, array(
	// 		CURLOPT_URL => "https://api.rajaongkir.com/starter/province",
	// 		CURLOPT_RETURNTRANSFER => true,
	// 		CURLOPT_ENCODING => "",
	// 		CURLOPT_MAXREDIRS => 10,
	// 		CURLOPT_TIMEOUT => 30,
	// 		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	// 		CURLOPT_CUSTOMREQUEST => "GET",
	// 		CURLOPT_HTTPHEADER => array(
	// 			"key: $this->api_key"
	// 		),
	// 	));

	// 	$response = curl_exec($curl);
	// 	$err = curl_error($curl);

	// 	curl_close($curl);

	// 	if ($err) {
	// 		echo "cURL Error #:" . $err;
	// 	} else {
	// 		return json_decode($response, true);
	// 	}
	// }

	// function get_city($province_id){
	// 	$curl = curl_init();

	// 	curl_setopt_array($curl, array(
	// 		CURLOPT_URL => "https://api.rajaongkir.com/starter/city?province=$province_id",
	// 		CURLOPT_RETURNTRANSFER => true,
	// 		CURLOPT_ENCODING => "",
	// 		CURLOPT_MAXREDIRS => 10,
	// 		CURLOPT_TIMEOUT => 30,
	// 		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	// 		CURLOPT_CUSTOMREQUEST => "GET",
	// 		CURLOPT_HTTPHEADER => array(
	// 		    "key: $this->api_key" // sesuai dengan api raja ongkir
	// 		),
	// 	));

	// 	$response = curl_exec($curl);
	// 	$err = curl_error($curl);

	// 	curl_close($curl);

	// 	if ($err) {
	// 		echo "cURL Error #:" . $err;
	// 	} else {
	// 		return json_decode($response);
	// 	}
	// }

	// function get_city_by_province($province_id){
	// 	$city = $this->get_city($province_id);
	// 	$output = '<option value="">-------- pilih kota --------</option>';

	// 	foreach ($city->rajaongkir->results as $cty) {
	// 		$output .='<option value="'.$cty->city_id.'">'.$cty->city_name.'</option>';
	// 	}

	// 	echo $output;
	// }

	// function get_cost($origin,$destination,$weight,$courier)
	// {
	// 	$curl = curl_init();

	// 	curl_setopt_array($curl, array(
	// 		CURLOPT_URL => "https://api.rajaongkir.com/starter/cost",
	// 		CURLOPT_RETURNTRANSFER => true,
	// 		CURLOPT_ENCODING => "",
	// 		CURLOPT_MAXREDIRS => 10,
	// 		CURLOPT_TIMEOUT => 30,
	// 		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	// 		CURLOPT_CUSTOMREQUEST => "POST",
	// 		CURLOPT_POSTFIELDS => "origin=$origin&destination=$destination&weight=$weight&courier=$courier",
	// 		CURLOPT_HTTPHEADER => array(
	// 			"content-type: application/x-www-form-urlencoded",
	// 			"key: $this->api_key"
	// 		),
	// 	));

	// 	$response = curl_exec($curl);
	// 	$err = curl_error($curl);

	// 	curl_close($curl);

	// 	if ($err) {
	// 		echo "cURL Error #:" . $err;
	// 	} else {
	// 		return json_decode($response);
	// 	}
	// }

	// function cek_shipping_cost()
	// {
	// 	if (isset($_POST['submit'])) {
	// 		$origin_city = $this->input->post('origin_city');
	// 		$destination_city = $this->input->post('destination_city');
	// 		$weight = 1000;
	// 		$courier = $this->input->post('courier');
	// 		$shipping_cost = $this->get_cost($origin_city,$destination_city,$weight,$courier);
	// 		return json_decode($shipping_cost); die;
	// 		// foreach ($shipping_cost as $key) {
	// 		// 	echo $key->value;
	// 		// }
	// 	}
	// }


	// TRANSAKSI

	function Transaksi()
	{
		if ($this->session->userdata('id_konsumen')) {
			$data1 = array(
				'id_konsumen' => $this->session->userdata('id_konsumen'),
				'status' => 'menunggu pembayaran',
				'tanggal_transaksi' => date('Y-m-d H-i-s'),
			);
			$this->M_konsumen->createTransaksi($data1);	// Create ke tabel transaksi
			$idTransaksi = $this->M_konsumen->cekIdTransaksi($this->session->userdata('id_konsumen'))->id_transaksi;
			$keranjang = $this->input->post('keranjang');		// name checkbox di form
			$result = array();
			foreach ($produk as $key => $val) {
				$cek = $this->M_konsumen->cekProduk($_POST['keranjang'][$key]);
				$hargaProduk = $this->M_konsumen->hargaProduk($cek->id_produk);
				$result[] = array(
					'id_transaksi' => $idTransaksi,
					'id_konsumen' => $this->session->userdata('id_konsumen'),
					'id_produk' => $cek->idProduk,
					'jumlah_produk' => $cek->jumlah_barang
				);
			}
			
		}else{
			$this->session->set_flashdata('warning', 'silahkan login terlebih dahulu!');
			redirect('Konsumen/index');
		}
	}
}

?>