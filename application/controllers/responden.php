<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Responden extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('mresponden');
        $this->load->model('mpekerjaan');
        $this->load->model('mpendidikan');
        $this->load->model('mtanggunganbiaya');
        $this->load->model('mpoli');
        $this->load->helper('form','url');
    }

	public function index()
	{
		$data['title'] = 'Data Responden';
	   	$jumlah= $this->mresponden->jumlah();
		$config['base_url'] = base_url().'/admin_responden';
		$config['total_rows'] = $jumlah;
		$config['per_page'] = 10;
		$dari = $this->uri->segment('3');
		$data['qresponden'] = $this->mresponden->get_alljoin($config['per_page'],$dari);
		$data['qpoli'] = $this->mpoli->get_all();
		$this->pagination->initialize($config); 
		$this->load->view('admin/vresponden',$data);
	}

    public function form(){
    	//ambil variabel URL
		$mau_ke					= $this->uri->segment(3);
		$idu					= $this->uri->segment(4);
        //print $mau_ke;

		//ambil variabel
		$ID_POLI        = addslashes($this->input->post('ID_POLI'));
		$NAMA        	= addslashes($this->input->post('NAMA'));
		$UMUR        	= addslashes($this->input->post('UMUR'));
		$JENIS_KELAMIN 	= addslashes($this->input->post('JENIS_KELAMIN'));
		$PEKERJAAN 		= addslashes($this->input->post('PEKERJAAN'));
		$PENDIDIKAN 	= addslashes($this->input->post('PENDIDIKAN'));
		$TANGGUNGAN_BIAYA 	= addslashes($this->input->post('TANGGUNGAN_BIAYA'));

		if ($mau_ke == "add") {
			$data['id_poli'] = $idu;
		    $data['title'] = 'Tambah Data';
		    $data['aksi'] = 'aksi_add';
		    $data['qpekerjaan']=$this->mpekerjaan->get_all();
		    $data['qpendidikan']=$this->mpendidikan->get_all();
		    $data['qtanggungan_biaya']=$this->mtanggunganbiaya->get_all();
            $this->load->view('responden/vformresponden',$data);
		} else if ($mau_ke == "aksi_add") {
			date_default_timezone_set("Asia/Bangkok");
			$WAKTU_INPUT = date ("Y-m-d H:i:s");
			$data = array(
                'NAMA'         	=> $NAMA,
                'UMUR'			=> $UMUR,
                'WAKTU_INPUT'	=> $WAKTU_INPUT,
                'JENIS_KELAMIN' => $JENIS_KELAMIN,
                'ID_PEKERJAAN'	=> $PEKERJAAN,
                'ID_PENDIDIKAN'	=> $PENDIDIKAN,
                'ID_TANGGUNGAN_BIAYA'	=> $TANGGUNGAN_BIAYA
            );
            $this->mresponden->get_insert($data);
            $qcoba = $this->mresponden->getby_name_time($NAMA, $WAKTU_INPUT);
			$this->session->set_flashdata("pesan", "<div class=\"alert alert-success\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Data berhasil di insert</div>");
            foreach ($qcoba as $key) {
            	$ID_RESPONDEN = $key->ID_RESPONDEN;
            }
            redirect(base_url().'survei/form/add/'.$ID_POLI.'/'.$ID_RESPONDEN);
        }
    }

	public function detail($id){
        $data['title'] = 'Detail Responden';
        $data['qresponden'] = $this->mresponden->get_all_byid($id);
        $data2['qsurvei'] = $this->msurvei->get_all_byidresponden($id);
        $data2['ID_RESPONDEN'] = $id;
        $this->load->view('admin/vdetresponden',$data);
        $this->load->view('admin/vsurvei',$data2);
    }

 	public function filter($filter=null){
 		if ($filter==null) {
 			$data['title'] = 'Data Responden';
	 	 	$filter = $this->input->get('ID_POLI');			
			$dari = $this->uri->segment('3');
			$data['qresponden'] = $this->mresponden->filter_poli($filter);
			$data['filter'] = $filter;
			$qpoli = $this->mpoli->get_byid($filter);
			$jumlah=0;
			foreach ($data['qresponden'] as $row) {
				$jumlah++;
			}
			$config['base_url'] = base_url().'admin_responden/filter/'.$filter;
			$config['per_page'] = 5;
			$this->pagination->initialize($config); 
			$data['qpoli']=$this->mpoli->get_byid($filter);
			$data['qperiode']=$this->mperiode->get_all();
			$this->load->view('admin/vresponden_poli',$data);
 		}else{
 			$data['title'] = 'Data Responden';
			$filter = $this->uri->segment(3);
	 	 	$periode = $this->input->get('ID_PERIODE');
			$dari = $this->uri->segment('4');
			$data['qresponden'] = $this->mresponden->filter_poliperiode($filter,$periode);
			$data['filter'] = $filter;
			$data['periode'] = $periode;
			$jumlah=0;
			foreach ($data['qresponden'] as $row) {
				$jumlah++;
			}
			$config['base_url'] = base_url().'admin_responden/filter/'.$filter;
			$config['per_page'] = 5;
			
			$qpoli = $this->mpoli->get_byid($filter);
			$data['qperiode']=$this->mperiode->get_all();
			foreach ($qpoli as $key) {
				$data['poli'] = $key->NAMA;
			}
			$this->pagination->initialize($config); 
			$this->load->view('admin/vresponden_poli',$data);
 		}
 	}
	public function search() {
		$ID_RESPONDEN = addslashes($this->input->post('ID_RESPONDEN'));
	    $data['title'] = 'Daftar Penilaian Supplier';
	    $data['qsurvei'] = $this->msurvei->get_all();
	    $data['qresponden'] = $this->mresponden->get_sort($ID_RESPONDEN);
		$this->load->view('admin/vresponden',$data);
	}

}