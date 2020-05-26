<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class M_admin extends CI_Model {

//Kelola Kategori UMKM
	public function getkategoriUMKM(){
		return $this->db->get('tb_kategori_umkm')->result();
	}

	public function getkategoriUMKMId($id){
		return $this->db->query("SELECT * FROM tb_kategori_umkm WHERE id_kategori_umkm = '$id'")->row();
	}

	public function create_kategori_umkm($data){
		return $this->db->insert('tb_kategori_umkm',$data);
	}

	public function update_kategori_umkm($data,$id){
	 $this->db->where('id_kategori_umkm',$id);
	 $o = $this->db->update('tb_kategori_umkm',$data);
	 return $o;
	}

	public function hapus_k_UMKM($id){
		$this->db->where('id_kategori_umkm',$id);
    return $this->db->delete('tb_kategori_umkm');
	}

//Kelola Kategori Produk UMKM
	public function getkategoriProduk(){
		return $this->db->get('tb_kategori_produk')->result();
	}

	public function getkategoriProdukId($id){
		return $this->db->query("SELECT * FROM tb_kategori_produk WHERE id_kategori_produk = '$id'")->row();
	}

	public function create_kategori_produk($data){
		return $this->db->insert('tb_kategori_produk',$data);
	}

	public function update_kategori_produk($data,$id){
	 $this->db->where('id_kategori_produk',$id);
	 $o = $this->db->update('tb_kategori_produk',$data);
	 return $o;
	}

	public function hapus_k_Produk($id){
		$this->db->where('id_kategori_produk',$id);
    return $this->db->delete('tb_kategori_produk');
	}

//Kelola Produk
	public function getProduk(){
		return $this->db->query('SELECT * FROM tb_produk JOIN tb_kategori_produk USING(id_kategori_produk)')->result();
	}

//Kelola Informasi
	public function getInformasi(){
		return $this->db->get('tb_informasi')->result();
	}

//Kelola Market
	public function getMarket(){
		return $this->db->get('tb_market')->result();
	}

//Kelola Portofolio
	public function getPortofolio(){
		return $this->db->get('tb_portofolio')->result();
	}

//Kelola Slide
	public function getSlide(){
		return $this->db->get('tb_slide')->result();
	}

	public function getSlideId($id){
		return $this->db->query("SELECT * FROM tb_slide WHERE id_slide = '$id'")->row();
	}

	public function create_slide($data){
		return $this->db->insert('tb_slide',$data);
	}

	public function hapus_slide($id){
		$this->db->where('id_slide',$id);
    return $this->db->delete('tb_slide');
	}

	public function update_slide($data,$id){
	 $this->db->where('id_slide',$id);
	 $o = $this->db->update('tb_slide',$data);
	 return $o;
	}

//Kelola Kontak
	public function getKontak(){
		return $this->db->get('tb_kontak')->row();
	}

	public function getKontakk($id){
		return $this->db->query("SELECT * FROM tb_kontak WHERE id_kontak = '$id'")->row();
	}

	public function update_kontak($data,$id){
	 $this->db->where('id_kontak',$id);
	 $o = $this->db->update('tb_kontak',$data);
	 return $o;
	}

}

/* End of file M_admin.php */
/* Location: ./application/models/M_admin.php */
?>
