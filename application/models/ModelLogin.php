<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ModelLogin extends CI_Model {

	function __construct()
    {
        parent::__construct();
    }

	public function getUser($username, $password)
	{
		return $this->db->query("SELECT * FROM tb_user WHERE username='$username' AND password='$password'")->row();
	}

}

  ?>