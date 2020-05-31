<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ModelAdmin extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		
	}

	public function allAdmin($where1, $where2)
	{
		return $this->db->query("SELECT * FROM tb_user WHERE username = '$where1' AND level = '$where2'")->row();
	}

	public function cekAdmin($where1)
	{
		return $this->db->query("SELECT * FROM tb_user WHERE username = '$where1'")->row();
	}

	public function cekDataAdmin($username, $password, $email)
    {
        return $this->db->query("SELECT * FROM tb_user WHERE username='$username' OR password='$password' OR email='$email'")->result();
    }

    public function createAdmin($data)
    {
        $this->db->insert('tb_user', $data);
    }

    public function dataAdmin($username)
    {
    	return $this->db->query("SELECT * FROM tb_user WHERE level='Admin' AND username!='$username'")->result();
    }

    public function AdminById($id)
    {
    	return $this->db->query("SELECT * FROM tb_user WHERE id_user='$id'")->row();
    }

    public function updateAdmin($data, $id_user)
    {
        $this->db->where('id_user', $id_user);
        $this->db->update('tb_user', $data);
    }

    public function hapusAdmin($id_user)
    {
        $this->db->where('id_user', $id_user);
        $this->db->delete('tb_user');
    }
}

 ?>