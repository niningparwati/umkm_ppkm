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

//Kelola Promo
	public function getPromo()
	{
		return $this->db->get('tb_promo')->result();
	}

	public function getPromoId($id)
	{
		return $this->db->query("SELECT * FROM tb_promo WHERE id_promo = '$id'")->row();
	}

	public function create_promo($data){
		return $this->db->insert('tb_promo',$data);
	}

	public function update_promo($data,$id){
	 $this->db->where('id_promo',$id);
	 $o = $this->db->update('tb_promo',$data);
	 return $o;
	}

	public function hapus_promo($id){
		$this->db->where('id_promo',$id);
    return $this->db->delete('tb_promo');
	}

	public function getPromoUMKM()
	{
		return $this->db->query("SELECT * FROM tb_promo WHERE id_umkm IS NOT NULL")->result();
	}

//Kelola Produk
	public function getProduk(){
		return $this->db->query('SELECT * FROM tb_produk JOIN tb_kategori_produk USING(id_kategori_produk) JOIN tb_umkm USING(id_umkm)')->result();
	}

//Kelola Transaksi
	//Transaksi produk
	// public function getTransaksi(){
	// 	return $this->db->query("SELECT id_umkm,nama_konsumen, nama_produk, harga_produk, jumlah_produk, id_transaksi, tanggal_transaksi, jumlah_harga, bukti_pembayaran, status FROM tb_konsumen JOIN tb_transaksi USING(id_konsumen) JOIN tb_detail_transaksi USING(id_transaksi) JOIN tb_produk USING(id_produk) WHERE status!='dana dikirim' AND status!='selesai'")->result();
	// }

	public function getTransaksi()
	{
		return $this->db->query("SELECT a.*, b.*, c.*, d.*, e.*, SUM(b.jumlah_produk) as jml_item FROM tb_transaksi a
								JOIN tb_detail_transaksi b ON b.id_transaksi = a.id_transaksi
								JOIN tb_konsumen c ON c.id_konsumen = a.id_konsumen
								JOIN tb_produk d ON d.id_produk = b.id_produk
								JOIN tb_umkm e ON e.id_umkm = d.id_umkm
								GROUP BY a.id_transaksi
						")->result();
	}

	// public function hitung($id)
	// {
	// 	return $this->db->query("SELECT COUNT(id_umkm) as hasil FROM tb_produk
	// 							JOIN tb_detail_transaksi USING(id_produk)
	// 							WHERE id_transaksi = '$id'
	// 							GROUP BY id_umkm
	// 							")->row();
	// }

	public function ambil_umkm($id_transaksi)
	{
		return $this->db->query("SELECT d.id_umkm as umkm,d.* FROM tb_transaksi a
								JOIN tb_detail_transaksi b ON b.id_transaksi = a.id_transaksi
								JOIN tb_konsumen c ON c.id_konsumen = a.id_konsumen
								JOIN tb_produk d ON d.id_produk = b.id_produk
								JOIN tb_umkm e ON e.id_umkm = d.id_umkm
								WHERE b.id_transaksi = '$id_transaksi'
								GROUP BY d.id_umkm
			 					")->result();
	}

	public function iniproduk($id)
	{
		return $this->db->query("SELECT * FROM tb_detail_transaksi JOIN tb_produk USING(id_produk) JOIN tb_umkm USING (id_umkm) WHERE id_transaksi = $id")->result();
	}


	public function create_pengiriman($data){
		return $this->db->insert('tb_pengiriman',$data);
	}

	public function update_transaksi($data,$id){
	 $this->db->where('id_transaksi',$id);
	 $o = $this->db->update('tb_transaksi',$data);
	 return $o;
	}

	public function getTransaksiUMKM(){
		return $this->db->query("SELECT nama_umkm, nama_produk, harga_produk, jumlah_produk, id_transaksi, jumlah_harga, status FROM tb_transaksi JOIN tb_detail_transaksi USING(id_transaksi) JOIN tb_produk USING(id_produk) JOIN tb_umkm USING(id_umkm) WHERE status='diterima' OR status='selesai' OR status='dana dikirim'")->result();
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

//Kelola Banner
//Kelola Slide
	public function getBanner(){
		return $this->db->get('tb_banner')->result();
	}

	public function getBannerId($id){
		return $this->db->query("SELECT * FROM tb_banner WHERE id_banner = '$id'")->row();
	}

	public function create_banner($data){
		return $this->db->insert('tb_banner',$data);
	}

	public function hapus_banner($id){
		$this->db->where('id_banner',$id);
		return $this->db->delete('tb_banner');
	}

	public function update_banner($data,$id){
	 $this->db->where('id_banner',$id);
	 $o = $this->db->update('tb_banner',$data);
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
