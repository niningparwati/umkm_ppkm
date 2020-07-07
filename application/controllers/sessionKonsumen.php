<?php
	if($this->session->userdata('status') != 'login'){
		$message = "Maaf, anda harus login terlebih dahulu!";
			$this->session->sess_destroy();
	   	echo "<script type='text/javascript'>
	   			alert('$message');
	   			window.location.href = '". base_url() ."Konsumen/index/?to=$_SERVER[REQUEST_URI]';</script>";
		//redirect(base_url("LoginAU"));
	}
?>