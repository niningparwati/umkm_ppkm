<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class UMKM_Model extends CI_Model {

	////////////UMKM////////////

	public function Profil($id_umkm)
	{
		return $this->db->query("SELECT a.*, b.*,c.* FROM tb_umkm a JOIN tb_user b ON a.id_user=b.id_user LEFT JOIN tb_kategori_umkm c ON a.id_kategori_umkm=c.id_kategori_umkm WHERE a.id_umkm='$id_umkm'")->row();
	}

	public function updateProfil($data, $id_umkm)
	{
		$this->db->where('id_umkm', $id_umkm);
        $this->db->update('tb_umkm', $data);
	}

	public function semuaUMKM()
	{
		return $this->db->query("SELECT tb_umkm.* FROM `tb_umkm`")->result();
	}

	public function countUMKM()
	{
		return $this->db->query("SELECT COUNT(id_umkm) as jumlah FROM tb_umkm")->row();
	}

	public function allUMKM()
	{
		return $this->db->query("SELECT tb_umkm.*, tb_user.* FROM `tb_umkm` JOIN tb_user ON tb_umkm.id_user=tb_user.id_user ORDER BY RAND() LIMIT 12")->result();
	}
	
	public function dataUMKM($id_paguyuban) 
	{
		return $this->db->query("SELECT * FROM tb_umkm a JOIN user_umkm b ON a.id_umkm=b.id_umkm JOIN tb_user c ON b.id_user=c.id_user WHERE a.id_paguyuban='$id_paguyuban'")->result();
	}

	public function cekUMKM($id_user)
	{
		return $this->db->query("SELECT * FROM tb_umkm WHERE id_user='$id_user'")->row();
	}

	public function Approve($id_user) 
	{
		$this->db->query("UPDATE tb_user SET status='verified' WHERE id_user='$id_user'");
	}

	public function Aktifkan($id_user) 
	{
		$this->db->query("UPDATE tb_user SET status='verified' WHERE id_user='$id_user'");
	}

	public function NonAktif($id_user) 
	{
		$this->db->query("UPDATE tb_user SET status='NonAktif' WHERE id_user='$id_user'");
	}

	public function umkmById($id_umkm)
	{
		return $this->db->query("SELECT b.foto, a.nama_umkm, a.id_umkm, a.alamat, b.nama, b.email FROM tb_umkm a JOIN tb_user b ON a.id_user=b.id_user WHERE id_umkm='$id_umkm'")->row();
	}

	public function umkmPaguyuban($id_umkm)
	{
		return $this->db->query("SELECT a.*, b.* FROM tb_umkm a JOIN tb_paguyuban b ON a.id_paguyuban=b.id_paguyuban WHERE id_umkm='$id_umkm'")->row();
	}

	public function total_rows($q = NULL, $id_paguyuban) 
    { 
        $this->db->like('id_umkm', $q);
        $this->db->or_like('nama_umkm', $q);
        $this->db->or_like('alamat', $q);
        $this->db->or_like('id_paguyuban', $q);
        $this->db->or_like('id_user', $q);
        $this->db->where('id_paguyuban', $id_paguyuban);
        $this->db->from('tb_umkm');
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_umkm($limit, $start = 0, $q = NULL, $id_paguyuban) 
    { 
        $this->db->order_by('id_umkm', 'DESC');
        $this->db->limit($limit, $start);
        $this->db->group_by('id_umkm');
        $this->db->where('id_paguyuban', $id_paguyuban);
        return $this->db->get('tb_umkm')->result();
    }
	
	public function UMKMByPaguyuban($id_user)
    {
        return $this->db->query("SELECT COUNT(tb_umkm.id_umkm) jumlahumkm FROM tb_umkm JOIN tb_paguyuban ON tb_umkm.id_paguyuban=tb_paguyuban.id_paguyuban JOIN tb_user ON tb_paguyuban.id_user=tb_user.id_user WHERE tb_user.id_user='$id_user'")->row();
    }

    public function kategoriUMKM()
    {
    	return $this->db->query("SELECT * FROM tb_kategori_umkm")->result();
    }


    ////////////TRANSAKSI////////

    public function transaksiMasuk($id_umkm)
    {
       
         $this->db->from('tb_transaksi a');
         $this->db->join('tb_konsumen b', 'a.id_konsumen = b.id_konsumen');
         $this->db->join('tb_detail_transaksi c', 'c.id_transaksi = a.id_transaksi', 'left');
         $this->db->join('tb_produk d', 'c.id_produk = d.id_produk');
         $this->db->join('tb_umkm e', 'e.id_umkm = d.id_umkm');
         $this->db->where('a.status','diproses');
         $this->db->or_where('a.status','dana dikirim');
         $this->db->or_where('a.status','selesai');
         $this->db->where('e.id_umkm',$id_umkm);
         $this->db->group_by('a.id_transaksi');
         $this->db->order_by('a.tanggal_transaksi','TIMESTAMPDIFF(DAY,Now(),`a.tanggal_transaksi`)','ASC');
         return $this->db->get();
    }

    public function detail_transaksi($id_transaksi,$id_umkm)
    {
         $this->db->from('tb_transaksi a');
         $this->db->join('tb_konsumen b', 'a.id_konsumen = b.id_konsumen');
         $this->db->join('tb_detail_transaksi c', 'c.id_transaksi = a.id_transaksi', 'left');
         $this->db->join('tb_produk d', 'c.id_produk = d.id_produk');
         $this->db->join('tb_umkm e', 'e.id_umkm = d.id_umkm');
         $this->db->where('a.id_transaksi',$id_transaksi);
         $this->db->where('e.id_umkm',$id_umkm);
         return $this->db->get();
    
    }

   public function produk_dipesan($id_transaksi)
   {
         $this->db->from('tb_detail_transaksi a');
         $this->db->join('tb_produk b', 'b.id_produk = a.id_produk');
         $this->db->join('tb_umkm c', 'c.id_umkm = b.id_umkm');
         $this->db->where('a.id_transaksi',$id_transaksi);
         return $this->db->get();
   }

    ////////////PRODUK////////////

    public function semuaProduk()
	{
		return $this->db->query("SELECT tb_umkm.*, tb_produk.* FROM tb_produk JOIN tb_umkm ON tb_produk.id_umkm=tb_umkm.id_umkm ORDER BY RAND() LIMIT 12")->result();
	}

     public function kategoriProdukUMKM() //NINING
    {
        return $this->db->query("SELECT * FROM tb_kategori_produk ORDER BY nama_kategori_produk ASC")->result();
    }

    public function countProduk()
    {
        return $this->db->query("SELECT COUNT(id_produk) as jumlah FROM tb_produk")->row();
    }

	public function produkUMKM($id_umkm)
	{
		return $this->db->query("SELECT a.*, b.nama_kategori FROM tb_produk a JOIN tb_kategori_produk b ON a.id_kategori_produk_produk=b.id_kategori_produk_produk JOIN tb_umkm c ON a.id_umkm=c.id_umkm WHERE a.id_umkm = '$id_umkm'")->result();
	}

	
	public function cekProduk($id)
	{
		return $this->db->get("tb_produk JOIN tb_kategori_produk USING (id_kategori_produk) WHERE id_produk='$id'")->row();
	}

	public function dataProdukUMKM($id_paguyuban) 
	{
		return $this->db->query("SELECT produk.*, umkm.* FROM tb_umkm umkm JOIN tb_paguyuban paguyuban ON umkm.id_paguyuban=paguyuban.id_paguyuban JOIN tb_produk produk ON produk.id_umkm=umkm.id_umkm WHERE umkm.id_paguyuban='$id_paguyuban'")->result();
	}

	
	public function seluruhProduk($id_umkm)
	{
		$produk = $this->db->query("SELECT * FROM tb_produk JOIN tb_kategori_produk USING (id_kategori_produk) WHERE id_umkm='$id_umkm'")->result();
		return $produk;
	}

	public function createProduk($data)
    {
        $this->db->insert('tb_produk', $data);
	}

	public function editProduk($id)
	{
		return $this->db->get("tb_produk JOIN tb_kategori_produk USING (id_kategori_produk) WHERE id_produk='$id'")->row();
	}
	
	public function updateProduk($data, $id_produk)
    {
        $this->db->where('id_produk', $id_produk);
        $this->db->update('tb_produk', $data);
	}
	
	public function hapusProduk($id)
    {
        $this->db->where('id_produk', $id);
        $this->db->delete('tb_produk');
    }

    public function jumlahProduk($id_paguyuban)
	{
		return $this->db->query("SELECT COUNT(id_produk) FROM `tb_produk` JOIN tb_umkm ON tb_produk.id_umkm=tb_umkm.id_umkm JOIN tb_paguyuban ON tb_umkm.id_paguyuban=tb_paguyuban.id_paguyuban WHERE tb_umkm.id_paguyuban='$id_paguyuban' GROUP BY tb_umkm.id_paguyuban")->row();
	}

	public function total_rows_by_umkm($q = NULL, $id_umkm) 
    { 
        $this->db->like('id_produk', $q);
        $this->db->or_like('nama_produk', $q);
        $this->db->or_like('foto_produk', $q);
        $this->db->or_like('keterangan', $q);
        $this->db->or_like('harga', $q);
        $this->db->or_like('id_umkm', $q);
        $this->db->where('id_umkm', $id_umkm);
        $this->db->from('tb_produk');
        $this->db->join('tb_kategori_produk', 'tb_produk.id_kategori_produk=tb_kategori_produk.id_kategori_produk');
        return $this->db->count_all_results();
    }

    function get_paguyuban_by_umkm($limit, $start = 0, $q = NULL, $id_umkm) 
    { 
        $this->db->order_by('id_produk', 'DESC');
        $this->db->limit($limit, $start);
        $this->db->group_by('id_produk');
        $this->db->where('id_umkm', $id_umkm);
        $this->db->join('tb_kategori_produk', 'tb_produk.id_kategori_produk=tb_kategori_produk.id_kategori_produk');
        return $this->db->get('tb_produk')->result();
    }

    public function total_rows_by_kategori($q = NULL, $id_umkm, $id_kategori_produk) 
    { 
        $this->db->like('id_produk', $q);
        $this->db->or_like('nama_produk', $q);
        $this->db->or_like('foto_produk', $q);
        $this->db->or_like('keterangan', $q);
        $this->db->or_like('harga', $q);
        $this->db->or_like('id_umkm', $q);
        $this->db->where('id_umkm', $id_umkm);
        $this->db->where('tb_kategori_produk.id_kategori_produk', $id_kategori_produk);
        $this->db->from('tb_produk');
        $this->db->join('tb_kategori_produk', 'tb_produk.id_kategori_produk=tb_kategori_produk.id_kategori_produk');
        return $this->db->count_all_results();
    }

    function get_paguyuban_by_kategori($limit, $start = 0, $q = NULL, $id_umkm, $id_kategori_produk) 
    { 
        $this->db->order_by('id_produk', 'DESC');
        $this->db->limit($limit, $start);
        $this->db->group_by('id_produk');
        $this->db->where('id_umkm', $id_umkm);
        $this->db->where('tb_kategori_produk.id_kategori_produk', $id_kategori_produk);
        $this->db->join('tb_kategori_produk', 'tb_produk.id_kategori_produk=tb_kategori_produk.id_kategori_produk');
        return $this->db->get('tb_produk')->result();
    }

    public function ProdukByUMKM($id_user)
    {
        return $this->db->query("SELECT COUNT(tb_produk.id_produk) as jumlahproduk FROM tb_produk JOIN tb_umkm ON tb_produk.id_umkm=tb_umkm.id_umkm JOIN tb_user ON tb_umkm.id_user=tb_user.id_user WHERE tb_user.id_user='$id_user'")->row();
    }

    public function ProdukByPaguyuban($id_user)
    {
        return $this->db->query("SELECT COUNT(tb_produk.id_produk) as jumlahproduk FROM tb_produk JOIN tb_umkm ON tb_produk.id_umkm=tb_umkm.id_umkm JOIN tb_paguyuban ON tb_umkm.id_paguyuban=tb_paguyuban.id_paguyuban JOIN tb_user ON tb_paguyuban.id_user=tb_user.id_user WHERE tb_user.id_user='$id_user'")->row();
    }


    ////////////PORTOFOLIO////////////

    public function semuaPortofolio()
	{
		return $this->db->query("SELECT tb_portofolio.*, tb_umkm.* FROM tb_portofolio JOIN tb_umkm ON tb_portofolio.id_umkm=tb_umkm.id_umkm ORDER BY RAND()")->result();
	}

	public function cekPortofolio($id_umkm)
	{
		return $this->db->query("SELECT * FROM tb_portofolio WHERE id_umkm='$id_umkm'")->result();
	}

	public function countPortofolio()
	{
		return $this->db->query("SELECT COUNT(id_portofolio) as jumlah FROM tb_portofolio")->row();
	}

	public function insertPortofolio($data)
	{
		$this->db->insert('tb_portofolio', $data);
	}

	public function PortofolioById($id_portofolio)
	{
		return $this->db->query("SELECT * FROM tb_portofolio WHERE id_portofolio='$id_portofolio'")->row();
	}

	public function updatePortofolio($data, $id_portofolio)
    {
        $this->db->where('id_portofolio', $id_portofolio);
        $this->db->update('tb_portofolio', $data);
    }

    public function hapusPortofolio($id_portofolio)
    {
        $this->db->where('id_portofolio', $id_portofolio);
        $this->db->delete('tb_portofolio');
    }

    public function PortofolioByUMKM($id_user)
    {
        return $this->db->query("SELECT COUNT(tb_portofolio.id_portofolio) as jumlahportofolio FROM tb_portofolio JOIN tb_umkm ON tb_portofolio.id_umkm=tb_umkm.id_umkm JOIN tb_user ON tb_umkm.id_user=tb_user.id_user WHERE tb_user.id_user='$id_user'")->row();
    }


    //////////MARKET///////////

    public function dataMarket($id_umkm)
    {
        return $produk = $this->db->query("SELECT a.* FROM tb_market a JOIN tb_umkm b ON a.id_umkm=b.id_umkm WHERE a.id_umkm='$id_umkm'")->result();
    }

    public function createMarket($data)
    {
        $this->db->insert('tb_market', $data);
    }

    public function editMarket($id)
    {
        return $this->db->get("tb_market WHERE id_market='$id'")->row();
    }

    public function updateMarket($data, $id_market)
    {
        $this->db->where('id_market', $id_market);
        $this->db->update('tb_market', $data);
    }

    public function hapusMarket($id)
    {
        $this->db->where('id_market', $id);
        $this->db->delete('tb_market');
    }

    public function MarketByUMKM($id_user)
    {
        return $this->db->query("SELECT COUNT(tb_market.id_market) as jumlahmarket FROM tb_market JOIN tb_umkm ON tb_market.id_umkm=tb_umkm.id_umkm JOIN tb_user ON tb_umkm.id_user=tb_user.id_user WHERE tb_user.id_user='$id_user'")->row();
    }



    ///////////INFORMASI//////////////
    public function createInformasi($data)
    {
        $this->db->insert('tb_informasi', $data);
    }

    public function Informasi($id_umkm)
    {
        return $this->db->query("SELECT * FROM tb_informasi WHERE id_umkm='$id_umkm'")->result();
    }

    public function semuaInformasi()
    {
        return $this->db->query("SELECT tb_informasi.*, tb_umkm.* FROM tb_informasi JOIN tb_umkm ON tb_informasi.id_umkm=tb_umkm.id_umkm")->result();
    }

    public function dataInformasi()
    {
        return $this->db->query("SELECT tb_informasi.*, tb_umkm.* FROM tb_informasi JOIN tb_umkm ON tb_informasi.id_umkm=tb_umkm.id_umkm WHERE tb_informasi.flag='yes' ORDER BY RAND() LIMIT 8")->result();
    }

    public function Aktifasi($flag, $id_informasi)
    {
        $this->db->query("UPDATE tb_informasi SET status_informasi='$flag' WHERE id_informasi='$id_informasi'");
    }

    public function InformasiById($id_informasi)
    {
        return $this->db->query("SELECT tb_informasi.*, tb_umkm.* FROM tb_informasi JOIN tb_umkm ON tb_informasi.id_umkm=tb_umkm.id_umkm WHERE id_informasi='$id_informasi'")->row();
    }

    public function updateInformasi($data, $id_informasi)
    {
        $this->db->where('id_informasi', $id_informasi);
        $this->db->update('tb_informasi', $data);
    }

    public function HapusInformasi($id_informasi)
    {
        $this->db->where('id_informasi', $id_informasi);
        $this->db->delete('tb_informasi');
    }

    public function informasiByUMKM($id_umkm)
    {
        return $this->db->query("SELECT tb_informasi.*, tb_umkm.* FROM tb_informasi JOIN tb_umkm ON tb_informasi.id_umkm=tb_umkm.id_umkm WHERE tb_informasi.id_umkm='$id_umkm' AND tb_informasi.flag='yes'")->result();
    }

    public function InformasiUMKM($id_user)
    {
        return $this->db->query("SELECT COUNT(tb_informasi.id_informasi) as jumlahinformasi FROM tb_informasi JOIN tb_umkm ON tb_informasi.id_umkm=tb_umkm.id_umkm JOIN tb_paguyuban ON tb_umkm.id_paguyuban=tb_paguyuban.id_paguyuban JOIN tb_user ON tb_paguyuban.id_user=tb_user.id_user WHERE tb_user.id_user='$id_user'")->row();
    }

    public function searchInformasi($cari)
    {
        return $this->db->query("SELECT * FROM tb_informasi WHERE judul LIKE '%$cari%'")->result();
    }


    ///////////GALERI FOTO UMKM/////////////////

    public function cekFoto($id_umkm)
        {
            return $this->db->query("SELECT tb_foto.* FROM tb_foto WHERE id_umkm='$id_umkm'")->result();
        }   

    public function FotoById($id_foto)
    {
        return $this->db->query("SELECT * FROM tb_foto WHERE id_foto='$id_foto'")->row();
    }

    public function insertFoto($data)
    {
        $this->db->insert('tb_foto', $data);
    }

    public function updateFoto($data, $id_foto)
    {
        $this->db->where('id_foto', $id_foto);
        $this->db->update('tb_foto', $data);
    }

    public function hapusFoto($id_foto)
    {
        $this->db->where('id_foto', $id_foto);
        $this->db->delete('tb_foto');
    }

    public function FotoByUMKM($id_user)
    {
        return $this->db->query("SELECT COUNT(tb_foto.id_foto) as jumlahfoto FROM tb_foto JOIN tb_umkm ON tb_foto.id_umkm=tb_umkm.id_umkm JOIN tb_user ON tb_umkm.id_user=tb_user.id_user WHERE tb_user.id_user='$id_user'")->row();
    }


}

 ?>