<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('muser');
    }
	public function index()
	{
		$data['title'] = 'Selamat Datang';
		$this->load->view('vhome', $data);
	}
	public function admin()
	{
        $var = $this->session->all_userdata();
        $USERNAME=$var['USERNAME'];
        $data['quser'] = $this->muser->get_byid($USERNAME);
		$data['title'] = 'Selamat Datang';
		$this->load->view('admin/vhome', $data);
	}
	public function pengawas()
	{
        $var = $this->session->all_userdata();
        $USERNAME=$var['USERNAME'];
        $data['quser'] = $this->muser->get_byid($USERNAME);
		$data['title'] = 'Selamat Datang';
		$data['title'] = 'Selamat Datang';
		$this->load->view('pengawas/vhome', $data);
	}
	public function petugas()
	{
        $var = $this->session->all_userdata();
        $USERNAME=$var['USERNAME'];
        $data['quser'] = $this->muser->get_byid($USERNAME);
		$data['title'] = 'Selamat Datang';
		$this->load->view('petugas/vhome', $data);
	}
}