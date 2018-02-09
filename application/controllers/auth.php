<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function __construct() {
        parent::__construct();
        $this->load->model('mlogin');
        $this->load->model('mpoli');
        $this->load->model('mperiode');
        $this->load->model('mranking');
        $this->load->model('mpekerjaan');
        $this->load->model('mpendidikan');
        $this->load->model('mtanggunganbiaya');
        $this->load->helper('form','url');
    }

	public function index(){
		$data['qpoli']=$this->mpoli->get_all();
		$periode = $this->mperiode->get_all();
		if (!empty($periode)) {
			foreach ($periode as $key) {
				$id = $key->ID_PERIODE;
			}
			$data['qranking'] = $this->mranking->get_bysortperiode($id);
		}
	    $data['title'] = 'Hasil Penilaian Kepuasan Pasien';
		$data['qpekerjaan']=$this->mpekerjaan->get_all();
		$data['qpendidikan']=$this->mpendidikan->get_all();
		$data['qtanggungan_biaya']=$this->mtanggunganbiaya->get_all();
		$this->load->view('index',$data);
	}

	public function login()
	{
        if ($this->session->userdata('USERNAME')!='') {
			if ($this->session->userdata('HAK_AKSES')=='Admin'){
				redirect(base_url().'home/admin');
			}elseif ($this->session->userdata('HAK_AKSES')=='Petugas'){
				redirect(base_url().'home/petugas');
			}elseif ($this->session->userdata('HAK_AKSES')=='Pengawas'){
				redirect(base_url().'home/pengawas');
			}       	
        }else{
			$this->load->view('login');
		}
	}

	public function cek_login()
	{
		$data = array('USERNAME' => $this->input->post('USERNAME'), 
					  'PASSWORD' => md5($this->input->post('PASSWORD'))
					  );
		$hasil = $this->mlogin->cek_user($data);
		if ($hasil->num_rows() == 1){
			foreach($hasil->result() as $sess)
            {
              $sess_data['logged_in'] = 'Sudah Login';
              $sess_data['USERNAME'] = $sess->USERNAME;
              $sess_data['HAK_AKSES'] = $sess->HAK_AKSES;
              $this->session->set_userdata($sess_data);
            }
			if ($this->session->userdata('HAK_AKSES')=='Admin'){
				redirect(base_url().'home/admin');
			}elseif ($this->session->userdata('HAK_AKSES')=='Petugas'){
				redirect(base_url().'home/petugas');
			}elseif ($this->session->userdata('HAK_AKSES')=='Pengawas'){
				redirect(base_url().'home/pengawas');
			}
		}
		else
		{
			$this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Username dan Password yang anda masukkan tidak terdaftar! </div>");
			redirect(base_url().'auth/login');
		}
		
	}

	public function logout() {
		$this->session->sess_destroy();
		redirect(base_url().'auth/login');
	} 

}