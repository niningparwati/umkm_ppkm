<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class M_konsumen extends CI_Model {

	// REGISTRASI AKUN

	function registrasi($data)
	{
		$this->db->insert('tb_konsumen', $data);
	}

	function cekUsername($username)
	{
		$sql = "SELECT * FROM tb_konsumen WHERE username_konsumen='$username'";
		return $this->db->query($sql)->row();
	}

	function cekByEmail($email)
	{
		$sql = "SELECT email_konsumen FROM tb_konsumen WHERE email_konsumen='$email'";
		return $this->db->query($sql)->row();
	}

	function verifyEmail($key)
	{
		$data = array(
			'status_konsumen' => 'aktif'
		);
		$this->db->where('md5(email_konsumen)', $key);
		return $this->db->update('tb_konsumen', $data);
	}

	// LOGIN

	function cekAkun($username, $pass)
	{
		return $this->db->query("SELECT * FROM tb_konsumen WHERE username_konsumen='$username' AND password_konsumen='$pass' AND status_konsumen='aktif' ")->row();
	}

	// PRODUK UMKM

	function getAllProduk()	// belum dipakai
	{
		return $this->db->query("SELECT tb_produk.* FROM tb_produk JOIN tb_umkm ON tb_produk.id_umkm=tb_umkm.id_umkm JOIN tb_user ON tb_umkm.id_user=tb_user.id_user WHERE tb_user.status='aktif' AND tb_produk.status_produk=1 AND tb_user.status='aktif' ")->result();
	}

	function jumlahProduk()
	{
		return $this->db->query("SELECT COUNT(tb_produk.id_produk) as jumlah FROM tb_produk JOIN tb_umkm ON tb_produk.id_umkm=tb_umkm.id_umkm JOIN tb_user ON tb_umkm.id_user=tb_user.id_user WHERE tb_user.status='aktif' AND tb_produk.status_produk=1 AND tb_user.status='aktif' ")->row();
	}

	function produkByKategori($idK)	// jumlah produk per kategori
	{
		return $this->db->query("SELECT COUNT(tb_produk.id_produk) as jumlah FROM tb_produk JOIN tb_umkm ON tb_produk.id_umkm=tb_umkm.id_umkm JOIN tb_user ON tb_umkm.id_user=tb_user.id_user WHERE tb_produk.id_kategori_produk='$idK' AND tb_user.status='aktif' AND tb_produk.status_produk=1 ")->row();
	}

	function produkById($id)	// detail produk
	{
		return $this->db->query("SELECT tb_produk.*, tb_umkm.* FROM tb_produk JOIN tb_umkm ON tb_produk.id_umkm=tb_umkm.id_umkm JOIN tb_user ON tb_umkm.id_user=tb_user.id_user WHERE tb_produk.id_produk='$id' AND tb_user.status='aktif' AND tb_produk.status_produk=1 ")->row();
	}

	function produkSerupa($key, $nama)	// produk yang sama
	{
		return $this->db->query("SELECT tb_produk.* FROM tb_produk JOIN tb_umkm ON tb_produk.id_umkm=tb_umkm.id_umkm JOIN tb_user ON tb_umkm.id_user=tb_user.id_user WHERE nama_produk LIKE '%$key%' AND nama_produk != '$nama' AND tb_user.status='aktif' AND tb_produk.status_produk=1 ")->result();
	}

	function jmlProdukByUmkm($id)	// jumlah produk setiap umkm
	{
		return $this->db->query("SELECT COUNT(id_umkm) as jumlah FROM tb_produk WHERE id_umkm='$id' AND status_produk=1 ")->row();
	}

	function getProdukUmkm($id)
	{
		return $this->db->query("SELECT * FROM tb_produk WHERE id_umkm='$id' AND status_produk=1 ")->result();
	}

	function produkUmkmByKategori($id, $idK)
	{
		return $this->db->query("SELECT * FROM tb_produk WHERE id_umkm='$id' AND id_kategori_produk='$idK' AND status_produk=1 ")->result();
	}

	function jmlhProduk()
	{
		return $this->db->query("SELECT COUNT(id_produk) as jumlah FROM tb_produk WHERE status_produk=1")->row();
	}

	function jmlhProdukUmkm($idUmkm)
	{
		return $this->db->query("SELECT COUNT(id_produk) as jumlah FROM tb_produk WHERE status_produk=1 AND id_umkm='$idUmkm' ")->row();
	}

	function getProdukHome()
	{
		return $this->db->query("SELECT * FROM tb_produk WHERE status_produk=1 LIMIT 4")->result();
	}


	// KATEGORI PRODUK

	function kategoriProduk()
	{
		return $this->db->query("SELECT * FROM tb_kategori_produk")->result();
	}

	function getKategoriProduk($id)
	{
		return $this->db->query("SELECT * FROM tb_kategori_produk WHERE id_kategori_produk='$id'")->row();
	}

	function kategoriProdukById($id)
	{
		return $this->db->query("SELECT tb_produk.*, tb_kategori_produk.* FROM tb_produk JOIN tb_kategori_produk ON tb_produk.id_kategori_produk=tb_kategori_produk.id_kategori_produk WHERE tb_produk.id_umkm='$id' AND tb_produk.status_produk=1 GROUP BY tb_produk.id_kategori_produk ORDER BY tb_produk.id_kategori_produk ASC")->result();
	}

	// KATEGORI UMKM

	function kategoriUmkm()
	{
		return $this->db->query("SELECT * FROM tb_kategori_umkm")->result();
	}

	function getKategoriUmkm($id)
	{
		return $this->db->query("SELECT * FROM tb_kategori_umkm WHERE id_kategori_umkm='$id'")->row();
	}


	// PAGINATION SEBELUM LOGIN

	function total_rows($q = NULL)	// pagination produk (search)
	{
		$this->db->like('a.nama_produk', $q);
		$this->db->from('tb_produk a');
		$this->db->join('tb_umkm b', 'a.id_umkm=b.id_umkm');
		$this->db->join('tb_user c', 'b.id_user=c.id_user');
		$this->db->where('c.status', 'aktif');
		$this->db->where('a.status_produk', 1);
		$this->db->where('c.status', 'aktif');
		return $this->db->count_all_results();
	}

	function get_produk($limit, $start = 0, $q = NULL)	// pagination produk
	{
		$this->db->join('tb_umkm', 'tb_produk.id_umkm=tb_umkm.id_umkm');
		$this->db->join('tb_user', 'tb_umkm.id_user=tb_user.id_user');
		$this->db->order_by('tb_produk.id_produk', 'DESC');
		$this->db->limit($limit, $start);
		$this->db->group_by('tb_produk.id_produk');
		$this->db->where('tb_user.status', 'aktif');
		$this->db->where('tb_produk.status_produk', 1);
		return $this->db->get('tb_produk')->result();
	}

	function total_produk_kategori($q = NULL, $x)	// pagination produk (search)
	{
		$this->db->where('a.id_kategori_produk', $x);
		$this->db->where('c.status', 'aktif');
		$this->db->like('a.nama_produk', $q);
		$this->db->from('tb_produk a');
		$this->db->join('tb_umkm b', 'a.id_umkm=b.id_umkm');
		$this->db->join('tb_user c', 'b.id_user=c.id_user');
		$this->db->where('a.status_produk', 1);
		$this->db->where('c.status', 'aktif');
		return $this->db->count_all_results();
	}

	function get_produk_kategori($limit, $start = 0, $q = NULL, $x)	// pagination produk
	{
		$this->db->join('tb_umkm', 'tb_produk.id_umkm=tb_umkm.id_umkm');
		$this->db->join('tb_user', 'tb_umkm.id_user=tb_user.id_user');
		$this->db->order_by('tb_produk.id_produk', 'DESC');
		$this->db->limit($limit, $start);
		$this->db->group_by('tb_produk.id_produk');
		$this->db->where('tb_user.status', 'aktif');
		$this->db->where('tb_produk.id_kategori_produk', $x);
		$this->db->where('tb_produk.status_produk', 1);
		return $this->db->get('tb_produk')->result();
	}

	function total_umkm($q = NULL)	// pagination umkm (search)
	{
		$this->db->like('a.nama_umkm', $q);
		$this->db->from('tb_umkm a');
		$this->db->join('tb_user b', 'a.id_user=b.id_user');
		$this->db->where('b.status', 'aktif');
		return $this->db->count_all_results();
	}

	function get_umkm($limit, $start = 0, $q = NULL)	// pagination umkm ()
	{
		$this->db->join('tb_user', 'tb_umkm.id_user=tb_user.id_user');
		$this->db->order_by('tb_umkm.id_umkm', 'DESC');
		$this->db->limit($limit, $start);
		$this->db->group_by('tb_umkm.id_umkm');
		$this->db->where('tb_user.status', 'aktif');
		return $this->db->get('tb_umkm')->result();
	}

	function get_kategori($limit, $start = 0, $q = NULL, $x)	// pagination umkm berdasarkan kategori()
	{
		$this->db->join('tb_user', 'tb_umkm.id_user=tb_user.id_user');
		$this->db->order_by('tb_umkm.id_umkm', 'DESC');
		$this->db->limit($limit, $start);
		$this->db->group_by('tb_umkm.id_umkm');
		$this->db->where('tb_user.status', 'aktif');
		$this->db->where('tb_umkm.id_kategori_umkm', $x);
		return $this->db->get('tb_umkm')->result();
	}

	function total_kategori($q = NULL, $x)	// pagination umkm (search)
	{
		$this->db->where('a.id_kategori_umkm', $x);
		$this->db->where('b.status', 'aktif');
		$this->db->like('a.nama_umkm', $q);
		$this->db->from('tb_umkm a');
		$this->db->join('tb_user b', 'a.id_user=b.id_user');
		return $this->db->count_all_results();
	}

	function get_kota($limit, $start = 0, $q = NULL, $x)	// pagination umkm berdasarkan kota()
	{
		$this->db->join('tb_user', 'tb_umkm.id_user=tb_user.id_user');
		$this->db->order_by('tb_umkm.id_umkm', 'DESC');
		$this->db->limit($limit, $start);
		$this->db->group_by('tb_umkm.id_umkm');
		$this->db->where('tb_user.status', 'aktif');
		$this->db->where('tb_umkm.kota_asal', $x);
		return $this->db->get('tb_umkm')->result();
	}

	function total_kota($q = NULL, $x)	// pagination umkm (search)
	{
		$this->db->where('a.kota_asal', $x);
		$this->db->where('b.status', 'aktif');
		$this->db->like('a.nama_umkm', $q);
		$this->db->from('tb_umkm a');
		$this->db->join('tb_user b', 'a.id_user=b.id_user');
		return $this->db->count_all_results();
	}

	// PRODUK UMKM

	function total_barang_serupa($q = NULL, $idUmkm)	// pagination produk (search)
	{	
		$this->db->like('a.nama_produk', $q);
		$this->db->from('tb_produk a');
		$this->db->join('tb_umkm b', 'a.id_umkm=b.id_umkm');
		$this->db->join('tb_user c', 'b.id_user=c.id_user');
		$this->db->where('c.status', 'aktif');
		$this->db->where('a.id_umkm', $idUmkm);
		$this->db->where('a.status_produk', 1);
		$this->db->where('c.status', 'aktif');
		return $this->db->count_all_results();
	}

	function get_produk_umkm($limit, $start = 0, $q = NULL, $idUmkm)	// pagination produk
	{
		$this->db->join('tb_umkm', 'tb_produk.id_umkm=tb_umkm.id_umkm');
		$this->db->join('tb_user', 'tb_umkm.id_user=tb_user.id_user');
		$this->db->order_by('tb_produk.id_produk', 'DESC');
		$this->db->limit($limit, $start);
		$this->db->group_by('tb_produk.id_produk');
		$this->db->where('tb_user.status', 'aktif');
		$this->db->where('tb_produk.status_produk', 1);
		$this->db->where('tb_produk.id_umkm', $idUmkm);
		return $this->db->get('tb_produk')->result();
	}

	function total_barang_kategori($q = NULL, $idUmkm, $key)	// pagination produk (search)
	{	
		$this->db->like('a.nama_produk', $q);
		$this->db->from('tb_produk a');
		$this->db->join('tb_umkm b', 'a.id_umkm=b.id_umkm');
		$this->db->join('tb_user c', 'b.id_user=c.id_user');
		$this->db->where('c.status', 'aktif');
		$this->db->where('a.id_umkm', $idUmkm);
		$this->db->where('a.status_produk', 1);
		$this->db->where('c.status', 'aktif');
		return $this->db->count_all_results();
	}

	function get_produk_umkm_kategori($limit, $start = 0, $q = NULL, $idUmkm, $key)	// pagination produk
	{
		$this->db->join('tb_umkm', 'tb_produk.id_umkm=tb_umkm.id_umkm');
		$this->db->join('tb_user', 'tb_umkm.id_user=tb_user.id_user');
		$this->db->order_by('tb_produk.id_produk', 'DESC');
		$this->db->limit($limit, $start);
		$this->db->group_by('tb_produk.id_produk');
		$this->db->where('tb_user.status', 'aktif');
		$this->db->where('tb_produk.status_produk', 1);
		$this->db->where('tb_produk.id_umkm', $idUmkm);
		$this->db->where('tb_produk.id_kategori_produk', $key);
		return $this->db->get('tb_produk')->result();
	}

	// UMKM

	function fotoUmkm($id)	// 3 foto umkm untuk ditampilkan di halaman umkm
	{
		return $this->db->query("SELECT foto FROM tb_foto WHERE id_umkm='$id' LIMIT 3")->result();
	}

	function fotoUmkmLimit($id)	// 1 foto umkm untuk ditampilkan di halaman umkm
	{
		return $this->db->query("SELECT foto FROM tb_foto WHERE id_umkm='$id' LIMIT 1")->row();
	}

	function semuaFotoUMKM($id)	// semua foto umkm
	{
		return $this->db->query("SELECT foto FROM tb_foto WHERE id_umkm='$id'")->result();
	}

	function umkmById($id)
	{
		return $this->db->query("SELECT tb_umkm.*, tb_user.* FROM tb_umkm JOIN tb_user ON tb_umkm.id_user=tb_user.id_user WHERE tb_umkm.id_umkm='$id' AND tb_user.status='aktif' ")->row();
	}

	function jmlProdukUmkm($id)	// jumlah produk setiap umkm
	{
		return $this->db->query("SELECT COUNT(id_umkm) as jumlah FROM tb_produk WHERE id_umkm='$id' AND status_produk=1 ")->row();
	}

	function produkLain($idumkm, $idProduk)
	{
		return $this->db->query("SELECT * FROM tb_produk WHERE id_umkm='$idumkm' AND id_produk!='$idProduk' AND status_produk=1 LIMIT 6")->result();
	}

	function jml_produk_lainnya($idumkm, $idProduk)
	{
		return $this->db->query("SELECT COUNT(id_produk) as jmlh FROM tb_produk WHERE id_umkm='$idumkm' AND id_produk!='$idProduk' AND status_produk=1 ")->row();
	}

	function jmlUMKM()
	{
		return $this->db->query("SELECT COUNT(tb_umkm.id_umkm) as jumlah FROM tb_umkm JOIN tb_user ON tb_umkm.id_user=tb_user.id_user WHERE tb_user.id_user='status' ")->row();
	}

	function jmlUmkmByKategori($id)
	{
		return $this->db->query("SELECT COUNT(tb_umkm.id_umkm) as jumlah FROM tb_umkm JOIN tb_user ON tb_umkm.id_user=tb_user.id_user WHERE tb_umkm.id_kategori_umkm='$id' AND tb_user.status='aktif' ")->row();
	}

	function semuaKabupaten()
	{
		return $this->db->query("SELECT tb_umkm.* FROM tb_umkm JOIN tb_user ON tb_umkm.id_user=tb_user.id_user WHERE tb_umkm.kota_asal!='' GROUP BY tb_umkm.kota_asal ORDER BY tb_umkm.kota_asal ASC")->result();
	}

	function jumlahUmkm()
	{
		return $this->db->query("SELECT COUNT(tb_umkm.id_umkm) as jumlah FROM tb_umkm JOIN tb_user ON tb_umkm.id_user=tb_user.id_user WHERE tb_user.status='aktif' ")->row();
	}

	function getUmkmHome()
	{
		return $this->db->query("SELECT tb_umkm.*, tb_user.* FROM tb_umkm JOIN tb_user ON tb_umkm.id_user=tb_user.id_user WHERE tb_user.status='aktif' LIMIT 4")->result();
	}

	// PORTOFOLIO

	function cekPortofolio($id)
	{
		return $this->db->query("SELECT * FROM tb_portofolio WHERE id_umkm='$id'")->result();
	}

	// MARKET

	function cekMarket($id)
	{
		return $this->db->query("SELECT * FROM tb_market WHERE id_umkm='$id'")->result();
	}

	// INFORMASI

	function cekInformasi($id)
	{
		return $this->db->query("SELECT * FROM tb_informasi WHERE id_umkm='$id' LIMIT 3")->result();
	}

	function jmlhInformasi($id)
	{
		return $this->db->query("SELECT COUNT(id_informasi) as jmlh FROM tb_informasi WHERE id_umkm='$id' ")->row();
	}

	function detailInformasi($id)
	{
		return $this->db->query("SELECT tb_informasi.*, tb_umkm.* FROM tb_informasi JOIN tb_umkm ON tb_informasi.id_umkm=tb_umkm.id_umkm WHERE tb_informasi.id_informasi='$id' ")->row();
	}

	// KERANJANG

	function produkKeranjang($id)	// mengecek produk di keranjang
	{
		return $this->db->query("SELECT * FROM tb_keranjang WHERE id_produk='$id'")->row();
	}

	function inputKeranjang($data)
	{
		$this->db->insert('tb_keranjang', $data);
	}

	function updateKeranjang($data, $idKeranjang)
	{
		$this->db->where('id_keranjang', $idKeranjang);
		$this->db->update('tb_keranjang', $data);
	}

	function updateProduk($data, $id)	// update jumlah produk yang disimpan dalam keranjang
	{
		$this->db->where('id_produk', $id);
		$this->db->update('tb_keranjang', $data);
	}

	function updateProdukKonsumen($data, $id, $idK)	// update jumlah produk yang disimpan dalam keranjang
	{
		$this->db->where('id_konsumen', $idK);
		$this->db->where('id_produk', $id);
		$this->db->update('tb_keranjang', $data);
	}

	function cekKeranjangKonsumen($id)
	{
		return $this->db->query("SELECT * FROM tb_keranjang WHERE id_konsumen='$id'")->row();
	}

	function cekProdukKeranjang($idProduk, $idK)
	{
		return $this->db->query("SELECT COUNT(id_produk) as jumlah, id_produk FROM tb_keranjang WHERE id_produk='$idProduk' AND id_konsumen='$idK'")->row();
	}

	function keranjangByKonsumen($id)	// mengambil data produk di tabel keranjang berdasarkan id konsumen
	{
		return $this->db->query("SELECT tb_keranjang.*, tb_produk.*, tb_umkm.* FROM tb_keranjang JOIN tb_produk ON tb_keranjang.id_produk=tb_produk.id_produk JOIN tb_umkm ON tb_produk.id_umkm=tb_umkm.id_umkm WHERE tb_keranjang.id_konsumen='$id' AND tb_produk.status_produk=1 ")->result();
	}

	function getKeranjang($id)
	{
		return $this->db->query("SELECT * FROM tb_keranjang WHERE id_keranjang='$id'")->row();
	}

	function hapusKeranjang($id)
	{
		$this->db->query("DELETE FROM tb_keranjang WHERE id_konsumen='$id'");
	}

	function hapusProduk($idProduk, $idKonsumen)
	{
		$this->db->query("DELETE FROM tb_keranjang WHERE id_produk='$idProduk' AND id_konsumen='$idKonsumen'");
	}

	// TRANSAKSI

	function createTransaksi($data1)	// create di tabel transaksi, status menunggu pembayaran
	{
		$this->db->insert('tb_transaksi', $data1);
	}

	function cekIdTransaksi($id)		// cek transaksi yang belum dibayar (hanya 1 transaksi yang boleh dibayar)
	{
		return $this->db->query("SELECT MAX(id_transaksi) as id FROM tb_transaksi WHERE id_konsumen='$id' AND status='menunggu pembayaran'")->row();
	}

	function cekKeranjang($id)		// cek keranjang berdasarkan id keranjang
	{
		return $this->db->query("SELECT * FROM tb_keranjang WHERE id_keranjang='$id'")->row();
	}

	function cekProduk($id)		// cek produk berdasarkan id produk
	{
		return $this->db->query("SELECT * FROM tb_produk WHERE id_produk='$id'")->row();
	}

	// function hargaProduk($id)	// cek harga produk
	// {
	// 	return $this->db->query("SELECT * FROM tb_produk WHERE id_produk='$id'")->row();
	// }

	function getTransaksi($idTransaksi)
	{
		return $this->db->query("SELECT * FROM tb_transaksi WHERE id_transaksi='$idTransaksi' ")->row();
	}

	function detailTransaksi($result)	// insert multiple data ke tabel detail transaksi
	{
		$this->db->insert('tb_detail_transaksi', $result);
	}

	function deleteKeranjangMultiple($idKeranjang)	// hapus produk di keranjang ketika sudah di chcekout
	{
		$this->db->where('id_keranjang', $idKeranjang);
		$this->db->delete('tb_keranjang');
	}

	function getTotalHarga($id)	// mendapatkan total harga yang di checkout
	{
		return $this->db->query("SELECT SUM(jumlah_harga) as total FROM tb_detail_transaksi WHERE id_transaksi='$id'")->row();
	}

	function updatetotalHarga($harga,$id)	// mengupdate total harga produk yang di checkout
	{
		$this->db->query("UPDATE tb_transaksi SET total_harga='$harga' WHERE id_transaksi='$id'");
	}

	function updateProdukById($data, $id)	// mengupdate produk berdasarkan id produk
	{
		$this->db->where('id_produk', $id);
		$this->db->update('tb_produk', $data);
	}

	function produkBayar($id)	// mengambil data produk yang akan di checkout
	{
		return $this->db->query("SELECT a.*, b.*, c.*, d.* FROM tb_detail_transaksi a JOIN tb_produk b ON a.id_produk=b.id_produk JOIN tb_umkm c ON b.id_umkm=c.id_umkm JOIN tb_transaksi d ON a.id_transaksi=d.id_transaksi WHERE a.id_transaksi='$id' AND d.status='menunggu pembayaran' ")->result();
	}

	function getProduk($idTransaksi, $idUmkm)
	{
		return $this->db->query("SELECT SUM(jumlah_harga) as total FROM tb_detail_transaksi JOIN tb_produk ON tb_detail_transaksi.id_produk=tb_produk.id_produk WHERE tb_detail_transaksi.id_transaksi='$idTransaksi' AND tb_produk.id_umkm='$idUmkm' GROUP BY id_detail_transaksi")->row();
	}

	function updateTransaksi($data,$idTransaksi)
	{
		$this->db->where('id_transaksi', $idTransaksi);
		$this->db->update('tb_transaksi',$data);
	}

	function terimaPesanan($id, $data)
	{
		$this->db->where('id_transaksi', $id);
		$this->db->update('tb_transaksi', $data);
	}

	function inputOngkir($data,$id)
	{
		$this->db->where('status', 'menunggu pembayaran');
		$this->db->where('id_transaksi', $id);
		$this->db->update('tb_transaksi',$data);
	}

	// function updateTransaksi($data, $idKonsumen)
	// {
	// 	$this->db->where('id_konsumen',$idKonsumen);
	// 	$this->db->update('tb_transaksi', $data);
	// }

	// function updateHargaTotal($biaya, $id)
	// {
	// 	$this->db->query("UPDATE tb_transaksi SET total_harga='$biaya' WHERE id_transaksi='$id' ");
	// }

	function getDetailTransaksi($idTransaksi)
	{
		return $this->db->query("SELECT * FROM tb_detail_transaksi WHERE id_transaksi='$idTransaksi' ")->result();
	}

	function BatalkanTransaksi1($id)	// menghapus dari tabel detail transaksi
	{
		$this->db->query("DELETE FROM tb_detail_transaksi WHERE id_transaksi='$id'");
	}

	function BatalkanTransaksi2($id)	// menghapus dari tabel transaksi
	{
		$this->db->query("DELETE FROM tb_transaksi WHERE id_transaksi='$id'");
	}

	// KODE DISKON

	function cekKodeDiskon($kode)
	{
		return $this->db->query("SELECT * FROM tb_promo WHERE kode_promo='$kode' ")->row();
	}

	// PESANAN

	function cekPesanan($id)
	{
		return $this->db->query("SELECT * FROM tb_transaksi WHERE id_konsumen='$id' AND (status='menunggu pembayaran' OR status='menunggu konfirmasi' OR status='diproses' OR status='dikirim' OR status='diterima' OR status='dana dikirim' OR status='selesai')")->result();
	}

	function pesananMenungguPembayaran($id)
	{
		return $this->db->query("SELECT a.*, b.*, c.* FROM tb_transaksi a JOIN tb_detail_transaksi b ON a.id_transaksi=b.id_transaksi JOIN tb_produk c ON b.id_produk=c.id_produk WHERE a.status='menunggu pembayaran' AND a.id_konsumen='$id' GROUP BY a.id_transaksi")->result();
	}

	function pesananMenungguKonfirmasi($id)
	{
		return $this->db->query("SELECT a.*, b.*, c.* FROM tb_transaksi a JOIN tb_detail_transaksi b ON a.id_transaksi=b.id_transaksi JOIN tb_produk c ON b.id_produk=c.id_produk WHERE a.status='menunggu konfirmasi' AND a.id_konsumen='$id' GROUP BY a.id_transaksi")->result();
	}

	function pesananDiproses($id)
	{
		return $this->db->query("SELECT a.*, b.*, c.* FROM tb_transaksi a JOIN tb_detail_transaksi b ON a.id_transaksi=b.id_transaksi JOIN tb_produk c ON b.id_produk=c.id_produk WHERE a.status='diproses'  AND a.id_konsumen='$id' GROUP BY a.id_transaksi ")->result();
	}

	function pesananDikirim($id)
	{
		return $this->db->query("SELECT a.*, b.*, c.* FROM tb_transaksi a JOIN tb_detail_transaksi b ON a.id_transaksi=b.id_transaksi JOIN tb_produk c ON b.id_produk=c.id_produk WHERE a.status='dikirim'  AND a.id_konsumen='$id' GROUP BY a.id_transaksi")->result();
	}

	function pesananSelesai($id)
	{
		return $this->db->query("SELECT a.*, b.*, c.* FROM tb_transaksi a JOIN tb_detail_transaksi b ON a.id_transaksi=b.id_transaksi JOIN tb_produk c ON b.id_produk=c.id_produk WHERE (a.status='diterima' OR a.status='selesai' OR a.status='dana dikirim' OR a.status='selesai')  AND a.id_konsumen='$id' GROUP BY a.id_transaksi")->result();
	}

	function getProdukPesanan($id)
	{
		return $this->db->query("SELECT a.*, b.* FROM tb_detail_transaksi a JOIN tb_produk b ON a.id_produk=b.id_produk WHERE a.id_transaksi='$id'")->result();
	}

	function getResi($idTransaksi)
	{
		return $this->db->query("SELECT * FROM tb_pengiriman WHERE id_transaksi='$idTransaksi' ")->result();
	}

	// INFORMASI

	function total_informasi($q = NULL)	// pagination informasi (search)
	{
		$this->db->like('a.judul_informasi', $q);
		$this->db->from('tb_informasi a');
		$this->db->join('tb_umkm b', 'a.id_umkm=b.id_umkm');
		$this->db->join('tb_user c', 'b.id_user=c.id_user');
		$this->db->where('a.status_informasi', 'aktif');
		$this->db->where('c.status', 'aktif');
		return $this->db->count_all_results();
	}

	function get_informasi($limit, $start = 0, $q = NULL)	// pagination produk
	{
		$this->db->join('tb_umkm', 'tb_informasi.id_umkm=tb_umkm.id_umkm');
		$this->db->order_by('tb_informasi.id_informasi', 'ASC');
		$this->db->limit($limit, $start);
		$this->db->group_by('tb_informasi.id_informasi');
		$this->db->where('tb_informasi.status_informasi', 'aktif');
		return $this->db->get('tb_informasi')->result();
	}

	function jmlInformasi()
	{
		return $this->db->query("SELECT COUNT(id_informasi) as jumlah FROM tb_informasi")->row();
	}

	function getInformasiHome()
	{
		return $this->db->query("SELECT tb_umkm.*, tb_informasi.* FROM tb_informasi JOIN tb_umkm ON tb_informasi.id_umkm=tb_umkm.id_umkm LIMIT 3")->result();
	}

	// PROFILE

	function Profil($id)
	{
		return $this->db->query("SELECT * FROM tb_konsumen WHERE id_konsumen='$id'")->row();
	}

	function updateProfil($data, $id)
	{
		$this->db->where('id_konsumen', $id);
		$this->db->update('tb_konsumen', $data);
	}

	// KONTAK

	function Kontak()
	{
		return $this->db->query("SELECT * FROM tb_kontak LIMIT 1")->row();
	}

	// PROMO

	function getPromo()
	{
		return $this->db->query("SELECT * FROM tb_promo WHERE status_promo='aktif' ")->result();
	}

	function detailPromo($idPromo)
	{
		return $this->db->query("SELECT * FROM tb_promo WHERE id_promo='$idPromo' ")->row();
	}

	// BANNER

	function getBanner()
	{
		return $this->db->query("SELECT tb_banner.* FROM tb_banner LIMIT 3")->result();
	}

	// SLIDE

	function getSlide()
	{
		return $this->db->query("SELECT* FROM tb_slide WHERE status='aktif'")->result();
	}

	// SEARCH
	function searchProduk($search)
	{
		return $this->db->query("SELECT * FROM tb_produk WHERE (status_produk=1) AND (nama_produk LIKE '%$search%' OR deskripsi_produk LIKE '%$search%') LIMIT 8")->result();
	}

	function searchUmkm($search)
	{
		return $this->db->query("SELECT tb_umkm.*, tb_user.* FROM tb_umkm JOIN tb_user ON tb_umkm.id_user=tb_user.id_user WHERE (tb_user.status='aktif') AND (tb_umkm.nama_umkm LIKE '%$search%' OR tb_umkm.deskripsi_umkm LIKE '%$search%') LIMIT 8")->result();
	}

}

/* End of file M_konsumen.php */
/* Location: ./application/models/M_konsumen.php */
?>
