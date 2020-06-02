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

	function produkById($id)
	{
		return $this->db->query("SELECT tb_produk.*, tb_umkm.* FROM tb_produk JOIN tb_umkm ON tb_produk.id_umkm=tb_umkm.id_umkm JOIN tb_user ON tb_umkm.id_user=tb_user.id_user WHERE tb_produk.id_produk='$id' AND tb_user.status='aktif'")->row();
	}

	function produkSerupa($key, $nama)
	{
		return $this->db->query("SELECT tb_produk.* FROM tb_produk JOIN tb_umkm ON tb_produk.id_umkm=tb_umkm.id_umkm JOIN tb_user ON tb_umkm.id_user=tb_user.id_user WHERE nama_produk LIKE '%$key%' AND nama_produk != '$nama' AND tb_user.status='aktif'")->result();
	}

	// KATEGORI PRODUK

	function kategoriProduk()
	{
		return $this->db->query("SELECT * FROM tb_kategori_produk")->result();
	}

	// PAGINATION PRODUK SEBELUM LOGIN

	function total_rows($q = NULL)
	{	
		$this->db->like('a.nama_produk', $q);
		$this->db->from('tb_produk a');
		$this->db->join('tb_umkm b', 'a.id_umkm=b.id_umkm');
		$this->db->join('tb_user c', 'b.id_user=c.id_user');
		$this->db->where('c.status', 'aktif');
		return $this->db->count_all_results();
	}

	function get_produk($limit, $start = 0, $q = NULL)
	{
		$this->db->join('tb_umkm', 'tb_produk.id_umkm=tb_umkm.id_umkm');
		$this->db->join('tb_user', 'tb_umkm.id_user=tb_user.id_user');
		$this->db->order_by('tb_produk.id_produk', 'DESC');
		$this->db->limit($limit, $start);
		$this->db->group_by('tb_produk.id_produk');
		$this->db->where('tb_user.status', 'aktif');
		return $this->db->get('tb_produk')->result();
	}

}

/* End of file M_konsumen.php */
/* Location: ./application/models/M_konsumen.php */
?>