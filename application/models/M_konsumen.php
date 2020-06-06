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
		return $this->db->query("SELECT * FROM tb_konsumen WHERE username_konsumen='$username' AND password_konsumen='$pass'")->row();
	}

	// PRODUK UMKM

	function getAllProduk()	// belum dipakai
	{
		return $this->db->query("SELECT tb_produk.* FROM tb_produk JOIN tb_umkm ON tb_produk.id_umkm=tb_umkm.id_umkm JOIN tb_user ON tb_umkm.id_user=tb_user.id_user WHERE tb_user.status='aktif'")->result();
	}

	function jumlahProduk()
	{
		return $this->db->query("SELECT COUNT(tb_produk.id_produk) as jumlah FROM tb_produk JOIN tb_umkm ON tb_produk.id_umkm=tb_umkm.id_umkm JOIN tb_user ON tb_umkm.id_user=tb_user.id_user WHERE tb_user.status='aktif'")->row();
	}

	function produkByKategori($idK)	// jumlah produk per kategori
	{
		return $this->db->query("SELECT COUNT(tb_produk.id_produk) as jumlah FROM tb_produk JOIN tb_umkm ON tb_produk.id_umkm=tb_umkm.id_umkm JOIN tb_user ON tb_umkm.id_user=tb_user.id_user WHERE tb_produk.id_kategori_produk='$idK' AND tb_user.status='aktif' ")->row();
	}

	function produkById($id)	// detail produk
	{
		return $this->db->query("SELECT tb_produk.*, tb_umkm.* FROM tb_produk JOIN tb_umkm ON tb_produk.id_umkm=tb_umkm.id_umkm JOIN tb_user ON tb_umkm.id_user=tb_user.id_user WHERE tb_produk.id_produk='$id' AND tb_user.status='aktif'")->row();
	}

	function produkSerupa($key, $nama)	// produk yang sama
	{
		return $this->db->query("SELECT tb_produk.* FROM tb_produk JOIN tb_umkm ON tb_produk.id_umkm=tb_umkm.id_umkm JOIN tb_user ON tb_umkm.id_user=tb_user.id_user WHERE nama_produk LIKE '%$key%' AND nama_produk != '$nama' AND tb_user.status='aktif'")->result();
	}

	function jmlProdukByUmkm($id)	// jumlah produk setiap umkm
	{
		return $this->db->query("SELECT COUNT(id_umkm) as jumlah FROM tb_produk WHERE id_umkm='$id'")->row();
	}

	function getProdukUmkm($id)
	{
		return $this->db->query("SELECT * FROM tb_produk WHERE id_umkm='$id'")->result();
	}


	// KATEGORI PRODUK

	function kategoriProduk()
	{
		return $this->db->query("SELECT * FROM tb_kategori_produk")->result();
	}

	// KATEGORI UMKM

	function kategoriUmkm()
	{
		return $this->db->query("SELECT * FROM tb_kategori_umkm")->result();
	}


	// PAGINATION SEBELUM LOGIN

	function total_rows($q = NULL)	// pagination produk (search)
	{	
		$this->db->like('a.nama_produk', $q);
		$this->db->from('tb_produk a');
		$this->db->join('tb_umkm b', 'a.id_umkm=b.id_umkm');
		$this->db->join('tb_user c', 'b.id_user=c.id_user');
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

	// UMKM

	function fotoUmkm($id)	// 1 foto umkm
	{
		return $this->db->query("SELECT foto FROM tb_foto WHERE id_umkm='$id' LIMIT 1")->row();
	}

	function semuaFotoUMKM($id)	// semua foto umkm
	{
		return $this->db->query("SELECT foto FROM tb_foto WHERE id_umkm='$id'")->result();
	}

	function umkmById($id)
	{
		return $this->db->query("SELECT * FROM tb_umkm WHERE id_umkm='$id'")->row();
	}

	function jmlProdukUmkm($id)	// jumlah produk setiap umkm
	{
		return $this->db->query("SELECT COUNT(id_umkm) as jumlah FROM tb_produk WHERE id_umkm='$id'")->row();
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

	function updateProduk($data, $id)	// update jumlah produk yang disimpan dalam keranjang
	{
		$this->db->where('id_produk', $id);
		$this->db->update('tb_keranjang', $data);
	}

	function cekKeranjangKonsumen($id)
	{
		return $this->db->query("SELECT * FROM tb_keranjang WHERE id_konsumen='$id'")->row();
	}

	function keranjangByKonsumen($id)	// mengambil data produk di tabel keranjang berdasarkan id konsumen
	{
		return $this->db->query("SELECT tb_keranjang.*, tb_produk.*, tb_umkm.* FROM tb_keranjang JOIN tb_produk ON tb_keranjang.id_produk=tb_produk.id_produk JOIN tb_umkm ON tb_produk.id_umkm=tb_umkm.id_umkm WHERE tb_keranjang.id_konsumen='$id'")->result();
	}

	function getKeranjang($id)
	{
		return $this->db->query("SELECT * FROM tb_keranjang WHERE id_keranjang='$id'")->row();
	}

	// function cekIdTransaksi($data, $id)	// update jumlah barang dalam keranjang
	// {
	// 	$this->db->where('id_keranjang', $id);
	// 	$this->db->update('tb_keranjang', $data);
	// }

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
		return $this->db->query("SELECT * FROM tb_transaksi WHERE id_konsumen='$id' AND status='menunggu pembayaran'")->row();
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

	function updateTransaksi($data,$idKonsumen)
	{
		$this->db->where('status', 'menunggu pembayaran');
		$this->db->where('id_konsumen', $idKonsumen);
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

}

/* End of file M_konsumen.php */
/* Location: ./application/models/M_konsumen.php */
?>