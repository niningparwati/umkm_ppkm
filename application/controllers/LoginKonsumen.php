<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class LoginKonsumen extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('M_konsumen');
	}

	public function index()
	{

	}

}

?>