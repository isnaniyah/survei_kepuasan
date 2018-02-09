<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_periode extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('mperiode');
        $this->load->model('mpoli');
        $this->load->model('msub');
        $this->load->model('mperhitungan');
        $this->load->model('mranking');
        $this->load->model('mlog');
        $this->load->helper('form','url');
    }

	public function index() {
	    $data['title'] = 'Daftar periode';
	    $data['qperiode'] = $this->mperiode->get_all_desc();

		$this->load->view('admin/vperiode',$data);

	}
	public function detail($id){
        $data['title'] = 'Detail Perhitungan';
        $data['qsurvei'] = $this->mperhitungan->get_hitung_periode($id);
        $data['qpoli'] = $this->mpoli->get_all();
        $data['qsub'] = $this->msub->get_all();
        $data['qperiode'] = $this->mperiode->get_periode_byid($id);
        $data['qnilai_akhir'] = $this->mranking->get_join_periode($id);
        $data['qranking'] = $this->mranking->get_sort($id);
        $this->load->view('admin/vdetperiode',$data);
    }
    public function hapus($gid){
        $ketLog = $this->mperiode->get_periode_byid($gid);
        foreach ($ketLog as $key) {
            $bulan = $key->BULAN;
            $tahun = $key->TAHUN;
        }
        $var = $this->session->all_userdata();
        $user=$var['USERNAME'];
        date_default_timezone_set("Asia/Bangkok");
        $waktu = date ("Y-m-d H:i:s");
        $aktivitas = "Admin menghapus data periode $bulan - $tahun";
        $datalog = array(
            'USERNAME'      => $user,
            'WAKTU'         => $waktu,
            'AKTIVITAS'     => $aktivitas
        );
        $this->mlog->get_insert($datalog);
        $this->mperiode->del($gid);
        $this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Data berhasil dihapus</div>");
        redirect(base_url().'admin_periode/');
	}
}

/* End of file Data.php */
/* Location: ./application/controllers/Data.php */