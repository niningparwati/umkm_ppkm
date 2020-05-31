<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class ModelRegister extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

    public function idUser()
    {
      $nomer = "SELECT id_user FROM tb_user ORDER BY id_user DESC";
      $baris = $this->db->query($nomer);
      $akhir =  $baris->row()->id_user;
      $akhir++;
      return $akhir;
    }

    public function idAdmin(){
      $nomer = "SELECT id_admin FROM tb_admin ORDER BY id_admin DESC";
      $baris = $this->db->query($nomer);
      $akhir =  $baris->row()->id_admin;
      $akhir++;
      return $akhir;
    }

    public function idUMKM(){
      $nomer = "SELECT id_umkm FROM tb_umkm ORDER BY id_umkm DESC";
      $baris = $this->db->query($nomer);
      $akhir =  $baris->row()->id_umkm;
      $akhir++;
      return $akhir;
    }

    public function create_user($data)
    {
    	return $this->db->insert('tb_user',$data);
    }

    public function create_umkm($data)
    {
    	return $this->db->insert('tb_umkm',$data);
    }

    public function create_admin($data)
    {
    	return $this->db->insert('tb_admin',$data);
    }

    public function cekUser($username,$password,$email)
    {
      return $this->db->query("SELECT * FROM tb_user WHERE username='$username' AND password='$password' AND email='$email'")->row();
    }

    public function cekUMKM()
    {
      return $this->db->get('tb_umkm')->result();
    }

    public function cekAdmin()
    {
      return $this->db->get('tb_admin')->result();
    }

    public function cekUserr()
    {
      return $this->db->get('tb_user')->result();
    }
}
