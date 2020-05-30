<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class M_login extends CI_Model {

	public function cekLogin($user,$pass)
	{
		return $this->db->query("SELECT * FROM tb_user WHERE username='$user' AND password='$pass'")->row();
	}

}

/* End of file M_informasi.php */
/* Location: ./application/models/M_informasi.php */
?>
