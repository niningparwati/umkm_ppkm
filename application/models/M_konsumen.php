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

	function inputKeranjang($data)
	{
		$this->db->insert('tb_keranjang', $data);
	}

	function keranjangByKonsumen($id)
	{
		return $this->db->query("SELECT tb_keranjang.*, tb_produk.* FROM tb_keranjang JOIN tb_produk ON tb_keranjang.id_produk=tb_produk.id_produk WHERE tb_keranjang.id_konsumen='$id'")->result();
	}

	function getKeranjang($id)
	{
		return $this->db->query("SELECT * FROM tb_keranjang WHERE id_keranjang='$id'")->row();
	}

	function updateKeranjang($data, $id)	// update jumlah barang dalam keranjang
	{
		$this->db->where('id_keranjang', $id);
		$this->db->update('tb_keranjang', $data);
	}

	function hapusKeranjang($id)
	{
		$this->db->query("DELETE FROM tb_keranjang WHERE id_konsumen='$id'");
	}

	function hapusProduk($idProduk, $idKonsumen)
	{
		$this->db->query("DELETE FROM tb_keranjang WHERE id_produk='$idProduk' AND id_konsumen='$idKonsumen'");
	}

}

/* End of file M_konsumen.php */
/* Location: ./application/models/M_konsumen.php */
?>