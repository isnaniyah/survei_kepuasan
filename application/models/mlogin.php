<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mlogin extends CI_Model
{
	public function cek_user($data){
		$query = $this->db->get_where('user',$data);
		return $query;
	}
}