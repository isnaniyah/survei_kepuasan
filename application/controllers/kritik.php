<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Kritik extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('mpoli');
        $this->load->model('mlog');
        $this->load->model('mresponden');
        $this->load->model('mkritik');
        $this->load->helper('form','url');
    }

	public function index() {
	    $data['title'] = 'Kritik dan Saran';
        $jumlah= $this->mkritik->jumlah_all();

        $config['base_url'] = base_url().'/kritik/index';
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
	    $data['qkritik'] = $this->mkritik->get_all_desc($config['per_page'],$dari);

        $data['jumlah_data'] = $jumlah;
        $data['nomer'] = $dari;
        $this->pagination->initialize($config); 
        $data['page']=$this->pagination->create_links();
		$this->load->view('pengawas/vkritik',$data);
	}

    public function search($tgl=null) {
        $tgl=$this->input->get('tgl');
        $dari=$this->input->get('per_page');
        $config['base_url'] = base_url().'kritik/search/?tgl='.$tgl;
        
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


        $data['title'] = 'Kritik dan Saran';
        if ($tgl==null) {
            redirect(base_url().'kritik');
        } else{
            $jumlah= $this->mkritik->jumlah_tgl($tgl);
            $data['qkritik'] = $this->mkritik->get_by_tgl($config['per_page'],$dari,$tgl);
        }
        $config['total_rows'] = $jumlah;
        $data['tgl'] = $tgl;
        $data['jumlah_data'] = $jumlah;
        $data['nomer'] = $dari;
        $this->pagination->initialize($config); 
        $data['page']=$this->pagination->create_links();
        $this->load->view('pengawas/vkritik',$data);
    }

    public function form(){
    	//ambil variabel URL
		$mau_ke					= $this->uri->segment(3);
		$idu					= $this->uri->segment(4);
        //print $mau_ke;

		//ambil variabel
        $ID_RESPONDEN     = addslashes($this->input->post('ID_RESPONDEN'));
        $KRITIK_SARAN     = addslashes($this->input->post('KRITIK_SARAN'));
		if ($mau_ke == "add") {
		    $data['title'] = 'Tambah Data';
		    $data['aksi'] = 'aksi_add';
            $this->load->view('admin/vformpoli',$data);
		} else if ($mau_ke == "aksi_add") {
            date_default_timezone_set("Asia/Bangkok");
            $WAKTU = date("Y-m-d");
			$data = array(
                'ID_RESPONDEN'      => $ID_RESPONDEN,
                'TANGGAL_MASUK'     => $WAKTU,
                'KRITIK_SARAN'      => $KRITIK_SARAN
            );
            $this->mkritik->get_insert($data);
            redirect(base_url());
        }
    }

    public function hapus($gid){
        $data = $this->mkritik->get_by_responden($gid);
        foreach ($data as $key) {
            $idAktvts = $key->NAMA;
        }
        $var = $this->session->all_userdata();
        $user=$var['USERNAME'];
        date_default_timezone_set("Asia/Bangkok");
        $waktu = date ("Y-m-d H:i:s");
        $aktivitas = "Pengawas menghapus data kritik dan saran dari responden bernama $idAktvts";
        $datalog = array(
            'USERNAME'      => $user,
            'WAKTU'         => $waktu,
            'AKTIVITAS'     => $aktivitas
        );
        $this->mlog->get_insert($datalog);
        $this->mkritik->del($gid);
        $this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Data berhasil dihapus</div>");
        redirect(base_url().'kritik');
	}
}

/* End of file Data.php */
/* Location: ./application/controllers/Data.php */