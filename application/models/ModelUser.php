<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class ModelUser extends CI_Model {

	public function cekUser($username) //NINING
	{
		return $this->db->query("SELECT * FROM tb_user WHERE username = '$username'")->row();
	}

	public function allUser($where1, $where2)
	{
		return $this->db->query("SELECT * FROM tb_user WHERE username = '$where1' AND level = '$where2'")->row();
	}

	public function updateProfil($data, $id_user)
	{
		$this->db->where('id_user', $id_user);
        $this->db->update('tb_user', $data);
	}

}
 ?>