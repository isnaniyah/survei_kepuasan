<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_responden extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('mresponden');
        $this->load->model('msurvei');
        $this->load->model('mpoli');
        $this->load->model('mlog');
        $this->load->model('msub');
        $this->load->model('mperiode');
        $this->load->model('mpendidikan');
        $this->load->model('mpekerjaan');
        $this->load->model('mtanggunganbiaya');
        $this->load->helper('form','url');
        $this->load->helper('dompdf_helper');
        $this->load->helper(array('dompdf','dompdf_helper'));
        $this->load->library('table');
    }

	public function index()
	{
		$data['title'] = 'Data Responden';        
	   	$jumlah= $this->mresponden->jumlah_alljoin();

		$config['base_url'] = base_url().'/admin_responden/index';
		$config['total_rows'] = $jumlah;
		$config['per_page'] = 10;
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = '&laquo; First';
        $config['first_tag_open'] = '<li class="prev page">';
        $config['first_tag_close'] = '</li>';
 
        $config['last_link'] = 'Last &raquo;';
        $config['last_tag_open'] = '<li class="next page">';
        $config['last_tag_close'] = '</li>';
 
        $config['next_link'] = 'Next &rarr;';
        $config['next_tag_open'] = '<li class="next page">';
        $config['next_tag_close'] = '</li>';
 
        $config['prev_link'] = '&larr; Prev';
        $config['prev_tag_open'] = '<li class="prev page">';
        $config['prev_tag_close'] = '</li>';
 
        $config['cur_tag_open'] = '<li class="current"><a href="">';
        $config['cur_tag_close'] = '</a></li>';
 
        $config['num_tag_open'] = '<li class="page">';
        $config['num_tag_close'] = '</li>';

		$dari = $this->uri->segment('3');
		$data['qresponden'] = $this->mresponden->get_alljoin($config['per_page'],$dari);
		$data['qpoli'] = $this->mpoli->get_all();
		$data['qperiode']=$this->mperiode->get_all();
		$data['poli'] = "null";
		$data['periode'] = "null";
        $data['jumlah_data'] = $jumlah;
        $data['nomer'] = $dari;
		$this->pagination->initialize($config); 
        $data['page']=$this->pagination->create_links();
		$this->load->view('admin/vresponden',$data);
	}
	public function detail($id){
        $data['title'] = 'Detail Responden';
        $data['qresponden'] = $this->mresponden->get_all_byid($id);
        $data2['qsurvei'] = $this->msurvei->get_all_byidresponden($id);
        $data2['ID_RESPONDEN'] = $id;
        $this->load->view('admin/vdetresponden',$data);
        $this->load->view('admin/vsurvei',$data2);
    }

 	public function filter($periode=null, $poli=null){
		$data['title'] = 'Data Responden';
        $periode = $this->input->get('ID_PERIODE');
        $poli = $this->input->get('ID_POLI');
        $dari=$this->input->get('per_page');
        $config['base_url'] = base_url().'admin_responden/filter/?ID_PERIODE='.$periode.'&ID_POLI='.$poli;
        
        $config['page_query_string'] = TRUE;
        $config['per_page'] = 10;
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = '&laquo; First';
        $config['first_tag_open'] = '<li class="prev page">';
        $config['first_tag_close'] = '</li>';
 
        $config['last_link'] = 'Last &raquo;';
        $config['last_tag_open'] = '<li class="next page">';
        $config['last_tag_close'] = '</li>';
 
        $config['next_link'] = 'Next &rarr;';
        $config['next_tag_open'] = '<li class="next page">';
        $config['next_tag_close'] = '</li>';
 
        $config['prev_link'] = '&larr; Prev';
        $config['prev_tag_open'] = '<li class="prev page">';
        $config['prev_tag_close'] = '</li>';
 
        $config['cur_tag_open'] = '<li class="current"><a href="">';
        $config['cur_tag_close'] = '</a></li>';
 
        $config['num_tag_open'] = '<li class="page">';
        $config['num_tag_close'] = '</li>';

 	 	if ($periode=="null" && $poli =="null") {
 	 		redirect(base_url().'admin_responden');
 	 	} elseif($periode=="null" && $poli !="null"){
            $jumlah= $this->mresponden->jumlah_poli($poli);
 	 		$data['qresponden'] = $this->mresponden->filter_poli($config['per_page'],$dari,$poli);
 	 	} elseif ($periode!="null" && $poli =="null") {
            $jumlah= $this->mresponden->jumlah_periode($periode);
 	 		$data['qresponden'] = $this->mresponden->filter_periode($config['per_page'],$dari,$periode);
 	 	} else{
            $jumlah= $this->mresponden->jumlah_poliperiode($poli,$periode);
 	 		$data['qresponden'] = $this->mresponden->filter_poliperiode($config['per_page'],$dari,$poli,$periode);
 	 	}
        $config['total_rows'] = $jumlah;
		$data['poli'] = $poli;
		$data['periode'] = $periode;
		$data['qpoli'] = $this->mpoli->get_all();
		$data['qperiode']=$this->mperiode->get_all();
        $data['jumlah_data'] = $jumlah;
        $data['nomer'] = $dari;
        $this->pagination->initialize($config); 
        $data['page']=$this->pagination->create_links();
        $this->load->view('admin/vresponden',$data);
 	}
    public function hapus($ID_RESPONDEN){
    	$data = $this->mresponden->get_all_byid($ID_RESPONDEN);
    	foreach ($data as $key) {
    		$periode = $key->ID_PERIODE;
    		$poli = $key->ID_POLI;
    		$idAktvts = $key->NAMA;
    	}
        $var = $this->session->all_userdata();
        $user=$var['USERNAME'];
        date_default_timezone_set("Asia/Bangkok");
        $waktu = date ("Y-m-d H:i:s");
        $aktivitas = "Admin menghapus data responden dengan nama $idAktvts";
        $datalog = array(
            'USERNAME'      => $user,
            'WAKTU'         => $waktu,
            'AKTIVITAS'     => $aktivitas
        );
        $this->mlog->get_insert($datalog);
        $this->mresponden->del_responden($ID_RESPONDEN);
        $apa = 'delete_responden';
        redirect(base_url().'survei/hitung_nilai_servqual/'.$periode.'/'.$poli.'/'.$apa);
	}
    function cetak($periode=null, $poli=null) {
        $this->load->helper(array('dompdf', 'file'));
        ini_set('memory_limit', '1280M');
        set_time_limit(1000);
        $data['sub'] = $this->msub->getall();

        if ($poli !="null"){
            $data['responden'] = $this->mresponden->get_all($periode, $poli);
        } else {
            $poli="kosong";
            $data['responden'] = $this->mresponden->get_all($periode, $poli);
        }
        $data['survei'] = $this->msurvei->get_survei_byperiode($periode);
        $data['pendidikan'] = $this->mpendidikan->get_all();
        $data['pekerjaan'] = $this->mpekerjaan->get_all();
        $data['tanggungan_biaya'] = $this->mtanggunganbiaya->get_all();
        $html = $this->load->view('admin/cetak_responden', $data, true);
        pdf_create_land($html, 'responden');   
    }

}