<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Petugas_supplier extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('msupplier');
        $this->load->model('mnilai');
        $this->load->model('mtahun');
        $this->load->helper('form','url');
    }

    public function index()
    {
        $data['title'] = 'Daftar Supplier';
        $data['qsupplier'] = $this->msupplier->get_all();
        $this->load->view('petugas/vsupplier',$data);
    }

    public function detail($id){
        $data['title'] = 'Detail Kontrak';
        $data['qsupplier'] = $this->msupplier->get_byid($id);
        $data2['qsupplier'] = $this->msupplier->get_byid($id);
        $data2['qnilai'] = $this->mnilai->get_detail_supplier($id);
        $data2['qtahun'] = $this->mtahun->get_all();
        $this->load->view('petugas/vdetsupplier',$data);
        $this->load->view('petugas/vnilai',$data2);
        
    }
}

/* End of file Data.php */
/* Location: ./application/controllers/Data.php */