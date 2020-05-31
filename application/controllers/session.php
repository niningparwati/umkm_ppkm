<?php
	if($this->session->userdata('status') != 'login'){
		redirect(base_url("Login"));
	}
?>