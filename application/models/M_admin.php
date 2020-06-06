<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class M_admin extends CI_Model {

//Dashboard
	public function getAkunUser()
	{
		return $this->db->query("SELECT COUNT(id_user) as hasil FROM tb_user")->row();
	}

	public function getAkun($user)
	{
		return $this->db->query("SELECT * FROM tb_user JOIN tb_admin USING(id_user) WHERE username='$user'")->row();
	}

	public function create_user($data){
		return $this->db->insert('tb_user',$data);
	}

	public function getjumKU()
	{
		return $this->db->query("SELECT COUNT(id_kategori_umkm) as hasil FROM tb_kategori_umkm")->row();
	}

	public function getjumPU()
	{
		return $this->db->query("SELECT COUNT(id_kategori_produk) as hasil FROM tb_kategori_produk")->row();
	}

	public function getjumP()
	{
		return $this->db->query("SELECT COUNT(id_produk) as hasil FROM tb_produk")->row();
	}

	public function getjumI()
	{
		return $this->db->query("SELECT COUNT(id_informasi) as hasil FROM tb_informasi")->row();
	}

	public function getjumM()
	{
		return $this->db->query("SELECT COUNT(id_market) as hasil FROM tb_market")->row();
	}

	public function getjumPo()
	{
		return $this->db->query("SELECT COUNT(id_portofolio) as hasil FROM tb_portofolio")->row();
	}

	public function getjumS()
	{
		return $this->db->query("SELECT COUNT(id_slide) as hasil FROM tb_slide")->row();
	}

//Kelola UMKM
	public function getUMKM()
	{
		return $this->db->query('SELECT * FROM tb_umkm JOIN tb_user USING(id_user)')->result();
	}

	public function getUMKMId($id)
	{
		return $this->db->query("SELECT * FROM tb_umkm JOIN tb_kategori_umkm USING(id_kategori_umkm) JOIN tb_user USING(id_user) WHERE id_umkm = '$id'")->row();
	}

	public function getProdukId($id){
		return $this->db->query("SELECT * FROM tb_umkm JOIN tb_produk USING(id_umkm) JOIN tb_kategori_produk USING(id_kategori_produk) WHERE id_umkm= '$id'")->result();
	}

	public function getMarketId($id){
		return $this->db->query("SELECT * FROM tb_market WHERE id_umkm= '$id'")->result();
	}

	public function getPortofolioId($id){
		return $this->db->query("SELECT * FROM tb_portofolio WHERE id_umkm= '$id'")->result();
	}

	public function getInformasiId($id){
		return $this->db->query("SELECT * FROM tb_informasi WHERE id_umkm= '$id'")->result();
	}

	public function update_user($data,$id){
	 $this->db->where('id_user',$id);
	 $o = $this->db->update('tb_user',$data);
	 return $o;
	}

	public function update_admin($data,$id){
	 $this->db->where('id_user',$id);
	 $o = $this->db->update('tb_admin',$data);
	 return $o;
	}

	public function create_umkm($data){
		return $this->db->insert('tb_umkm',$data);
	}

	public function getID($id)
	{
		return $this->db->query("SELECT * FROM tb_user JOIN tb_umkm USING(id_user) WHERE id_umkm = $id")->row();
	}

	public function update_umkm($data,$id){
	 $this->db->where('id_umkm',$id);
	 $o = $this->db->update('tb_umkm',$data);
	 return $o;
	}

	public function update_status($data,$id){
	 $this->db->where('id_user',$id);
	 $o = $this->db->update('tb_user',$data);
	 return $o;
	}

	public function hapus_umkm($id){
		$this->db->where('id_umkm',$id);
    return $this->db->delete('tb_umkm');
	}

//Kelola Konsumen
	public function getKonsumen()
	{
		return $this->db->get('tb_konsumen')->result();
	}

	public function getKonsumenId($id)
	{
		return $this->db->query("SELECT * FROM tb_konsumen WHERE id_konsumen = '$id'")->row();
	}

	public function create_konsumen($data){
		return $this->db->insert('tb_konsumen',$data);
	}

	public function update_konsumen($data,$id){
	 $this->db->where('id_konsumen',$id);
	 $o = $this->db->update('tb_konsumen',$data);
	 return $o;
	}

	public function hapus_konsumen($id){
		$this->db->where('id_konsumen',$id);
		return $this->db->delete('tb_konsumen');
	}

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
		return $this->db->query('SELECT * FROM tb_produk JOIN tb_kategori_produk USING(id_kategori_produk) JOIN tb_umkm USING(id_umkm)')->result();
	}

//Kelola Transaksi
	//Transaksi produk
	public function getTransaksi(){
		return $this->db->query("SELECT nama_konsumen, nama_produk, harga_produk, jumlah_produk, id_transaksi, tanggal_transaksi, total_harga, bukti_pembayaran, status FROM tb_konsumen JOIN tb_transaksi USING(id_konsumen) JOIN tb_detail_transaksi USING(id_transaksi) JOIN tb_produk USING(id_produk) WHERE status!='dana dikirim' AND status!='selesai'")->result();
	}

	public function update_transaksi($data,$id){
	 $this->db->where('id_transaksi',$id);
	 $o = $this->db->update('tb_transaksi',$data);
	 return $o;
	}

	public function getTransaksiUMKM(){
		return $this->db->query("SELECT nama_umkm, nama_produk, harga_produk, jumlah_produk, id_transaksi, total_harga, status FROM tb_transaksi JOIN tb_detail_transaksi USING(id_transaksi) JOIN tb_produk USING(id_produk) JOIN tb_umkm USING(id_umkm) WHERE status='diterima' OR status='selesai' OR status='dana dikirim'")->result();
	}

//Kelola Informasi
	public function getInformasi(){
		return $this->db->query('SELECT * FROM tb_informasi JOIN tb_umkm USING(id_umkm)')->result();
	}

//Kelola Market
	public function getMarket(){
		return $this->db->get('tb_market')->result();
	}

//Kelola Portofolio
	public function getPortofolio(){
		return $this->db->query('SELECT * FROM tb_portofolio JOIN tb_umkm USING(id_umkm)')->result();
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
