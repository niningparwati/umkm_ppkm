<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class M_admin extends CI_Model {


//Kelola Kontak
	public function getKontak(){
		return $this->db->get('tb_kontak')->row();
	}

	public function getKontakk($id){
		return $this->db->query("SELECT * FROM tb_kontak WHERE id_kontak = '$id'")->row();
	}

	public function update_kontak($data,$id){
	 $this->db->where('id_kontak',$id);
	 $o = $this->db->update('tb_kontak',$data);
	 return $o;
	}

}

/* End of file M_admin.php */
/* Location: ./application/models/M_admin.php */
?>
