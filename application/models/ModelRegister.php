<?php 

defined('BASEPATH') OR exit('No direct script access allowed');
                        
class ModelRegister extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
                        
    public function idUser() //NINING
    { 
        $user = "USR";    
        $nomer = "SELECT MAX(TRIM(REPLACE(id_user,'USR', ''))) as a FROM tb_user WHERE id_user LIKE '$user%'";
        $baris = $this->db->query($nomer);
        $akhir =  $baris->row()->a;
        $akhir++;
        $id =str_pad($akhir, 4, "0", STR_PAD_LEFT);
        $id = "USR".$id;
        return $id;                                            
    }

    public function idPaguyuban(){
        $paguyuban = "PGB";
        $nomer = "SELECT MAX(TRIM(REPLACE(id_paguyuban,'PGB', ''))) as a FROM tb_paguyuban WHERE id_paguyuban LIKE '$paguyuban%'";
        $baris = $this->db->query($nomer);
        $akhir =  $baris->row()->a;
        $akhir++;
        $id =str_pad($akhir, 4, "0", STR_PAD_LEFT);
        $id = "PGB".$id;
        return $id;                                            
    }

    public function idUMKM(){ //NINING
        $umkm = "UKM";
        $nomer = " SELECT MAX(TRIM(REPLACE(id_umkm,'UKM', ''))) as a FROM tb_umkm WHERE id_umkm LIKE '$umkm%'";
        $baris = $this->db->query($nomer);
        $akhir =  $baris->row()->a;
        $akhir++;
        $id =str_pad($akhir, 4, "0", STR_PAD_LEFT);
        $id = "UKM".$id;
        return $id;                                            
    }

    public function cekUser($username, $password, $email) //NINING
    {
        return $this->db->query("SELECT * FROM tb_user WHERE username='$username' OR password='$password' OR email='$email'")->result();
    }

    public function dataPaguyuban()
    {
        return $this->db->query("SELECT * FROM tb_paguyuban")->result();
    }

    public function createUser($data) //NINING
    {
        $this->db->insert('tb_user', $data);
    }

    public function createPaguyuban($data)
    {
        $this->db->insert('tb_paguyuban', $data);
    }

    public function createUMKM($data) //NINING
    {
        $this->db->insert('tb_umkm', $data);
    }

    public function createUserUMKM($data) //NINING
    {
        $this->db->insert('user_umkm', $data);
    }
                        
                            
                        
}                     