<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Petugas_ranking extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('mranking');
        $this->load->model('mtahun');
        $this->load->helper('form','url');
    }
	public function index()
	{
	    $data['title'] = 'Daftar Penilaian Supplier';
	    $data['ket'] = 'awal';
	    $data['qranking'] = $this->mranking->get_rank();
	    $data['qtahun'] = $this->mtahun->get_all();
		$this->load->view('petugas/vranking',$data);
	}
	public function search() {
		$ID_TAHUN = addslashes($this->input->post('ID_TAHUN'));
	    $data['title'] = 'Daftar Penilaian Supplier';
	    $data['ket'] = 'search';
	    $data['qtahun'] = $this->mtahun->get_all();
	    $data['qranking'] = $this->mranking->get_sort($ID_TAHUN);
		$this->load->view('petugas/vranking',$data);
	}
	public function detail($ID_TAHUN) {
	    $data['title'] = 'Daftar Penilaian Supplier';
	    $data['ket'] = 'search';
	    $data['qtahun'] = $this->mtahun->get_all();
	    $data['qranking'] = $this->mranking->get_sort($ID_TAHUN);
		$this->load->view('petugas/vranking',$data);
	}
}