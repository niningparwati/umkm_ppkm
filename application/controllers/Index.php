<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends CI_Controller {

	public function index()
	{
		$this->load->view('Landingpage/Head');
		$this->load->view('Landingpage/Header');
		$this->load->view('Landingpage/home');
		$this->load->view('Landingpage/Footer');
	}

	public function Paguyuban()
	{
		$this->load->view('Landingpage/Head');
		$this->load->view('Landingpage/Header');
		$this->load->view('Landingpage/paguyuban');
		$this->load->view('Landingpage/Footer');
	}

}

 ?>