<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pengawas_ranking extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('mranking');
        $this->load->model('mperiode');
        $this->load->model('msub');
        $this->load->model('msurvei');
        $this->load->model('mperhitungan');
        $this->load->model('mpoli');
        $this->load->helper('form','url');
        $this->load->helper('dompdf_helper');
        $this->load->helper(array('dompdf','dompdf_helper'));
        $this->load->library('table');
    }
	public function index()
	{
		$id = addslashes($this->input->post('ID_PERIODE'));
		if ($id==null) {
			$periode = $this->mperiode->get_all();
			if (!empty($periode)) {
				foreach ($periode as $key) {
					$id = $key->ID_PERIODE;
				}
			}
		}
	    $data['title'] = 'Hasil Penilaian Kepuasan Pasien';
	    $data['qranking'] = $this->mranking->get_bysortperiode($id);
	    $data['qperiode'] = $this->mperiode->get_all();
	    $data['id'] = $id;
		$this->load->view('pengawas/vranking',$data);
	}
	public function search() {
		$id = addslashes($this->input->post('ID_PERIODE'));

	    $data['title'] = 'Hasil Penilaian Kepuasan Pasien';
	    $data['qranking'] = $this->mranking->get_bysortperiode($id);
	    $data['qperiode'] = $this->mperiode->get_all();
	    $data['id'] = $id;
		$this->load->view('pengawas/vranking',$data);
	}
	public function detail($poli, $periode){
        $data['title'] = 'Detail Poli';

	    $data['qranking'] = $this->mranking->get_byperiode_poli($poli, $periode);
	    $data['qservqual'] = $this->mperhitungan->get_servqual($poli, $periode);
		$this->load->view('pengawas/vdetranking',$data);
        $this->load->view('pengawas/vservqual',$data);
    }
	public function perhitungan($id){
        $data['title'] = 'Detail Perhitungan';
        $data['qsurvei'] = $this->mperhitungan->get_hitung_periode($id);
        $data['qpoli'] = $this->mpoli->get_all();
        $data['qsub'] = $this->msub->get_all();
        $data['qperiode'] = $this->mperiode->get_periode_byid($id);
        $data['qnilai_akhir'] = $this->mranking->get_join_periode($id);
        $data['qranking'] = $this->mranking->get_sort($id);
        $this->load->view('pengawas/vdetperiode',$data);
    }
    function cetak($periode) {
        $this->load->helper(array('dompdf', 'file'));
        ini_set('memory_limit', '1280M');
        $data['sub'] = $this->msub->getall();
        $data['survei'] = $this->msurvei->get_all_join($periode);
        $data['qservqual'] = $this->mperhitungan->get_servqual_periode($periode);
        $data['poli'] = $this->mpoli->get_all();
        $data['ranking'] = $this->mranking->get_bysortperiode($periode);
        $data['nilai_akhir'] = $this->mranking->get_join_periode($periode);
        $html = $this->load->view('pengawas/cetak_hasil', $data, true);
        pdf_create($html, 'Hasil Perhitungan');   
    }
}