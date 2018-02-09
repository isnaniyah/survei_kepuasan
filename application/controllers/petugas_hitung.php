<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Petugas_hitung extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('mranking');
        $this->load->model('mnilai');
        $this->load->model('msub');
        $this->load->model('msupplier');
        $this->load->model('mtahun');
        $this->load->helper('form','url');
    }
	public function index()
	{
	    $data['title'] = 'Hasil Perhitungan SAW';
	    $data['qranking'] = $this->mranking->get_rank();
	    $data['qtahun'] = $this->mtahun->get_all();
		$this->load->view('petugas/vhitung',$data);
	}
	public function detail($tahun)
	{
	    $data['title'] = 'Hasil Perhitungan SAW';
	    $data['qranking'] = $this->mranking->get_bysorttahun($tahun);
	    $data['qtahun'] = $this->mtahun->get_byid($tahun);
	    $data['qsub'] = $this->msub->get_all();
	    $data['qsupplier'] = $this->msupplier->get_all();
	    $data['qnilai'] = $this->mnilai->get_tahun($tahun);
		$this->load->view('petugas/vhitung',$data);
	}
}