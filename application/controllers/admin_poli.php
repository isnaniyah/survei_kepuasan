<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_poli extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('mpoli');
        $this->load->model('mlog');
        $this->load->helper('form','url');
    }

	public function index()
	{
	    $data['title'] = 'Daftar poli';
	    $data['qpoli'] = $this->mpoli->get_all();

		$this->load->view('admin/vpoli',$data);

	}

    public function form(){
    	//ambil variabel URL
		$mau_ke					= $this->uri->segment(3);
		$idu					= $this->uri->segment(4);
        //print $mau_ke;

		//ambil variabel
		$ID_POLI          = addslashes($this->input->post('ID_POLI'));
		$NAMA_POLI        = addslashes($this->input->post('NAMA_POLI'));
		$PENANGGUNG_JAWAB = addslashes($this->input->post('PENANGGUNG_JAWAB'));
		if ($mau_ke == "add") {
		    $data['title'] = 'Tambah Data';
		    $data['aksi'] = 'aksi_add';
            $this->load->view('admin/vformpoli',$data);
		} else if ($mau_ke == "edit") {
			$data['qpoli']	= $this->mpoli->get_byid($idu);
			$data['title'] = 'Edit Data';
		    $data['aksi'] = 'aksi_edit';
            $this->load->view('admin/vformpoli',$data);
		} else if ($mau_ke == "aksi_add") {
			$data = array(
                'ID_POLI'           => $ID_POLI,
                'NAMA_POLI'         => $NAMA_POLI,
                'PENANGGUNG_JAWAB'  => $PENANGGUNG_JAWAB
            );
            $this->mpoli->get_insert($data);

            $var = $this->session->all_userdata();
            $user=$var['USERNAME'];
            date_default_timezone_set("Asia/Bangkok");
            $waktu = date ("Y-m-d H:i:s");
            $aktivitas = "Admin menambah data poli baru yaitu $NAMA_POLI";
            $datalog = array(
                'USERNAME'      => $user,
                'WAKTU'         => $waktu,
                'AKTIVITAS'     => $aktivitas
            );
            $this->mlog->get_insert($datalog);

			$this->session->set_flashdata("pesan", "<div class=\"alert alert-success\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Data berhasil di insert</div>");
            redirect(base_url().'admin_poli');
        } else if ($mau_ke == "aksi_edit") {
            $data = array(
                'ID_POLI'           => $ID_POLI,
                'NAMA_POLI'         => $NAMA_POLI,
                'PENANGGUNG_JAWAB'  => $PENANGGUNG_JAWAB
            );
            $this->mpoli->get_update($ID_POLI,$data);

            $var = $this->session->all_userdata();
            $user=$var['USERNAME'];
            date_default_timezone_set("Asia/Bangkok");
            $waktu = date ("Y-m-d H:i:s");
            $aktivitas = "Admin mengubah data pada $NAMA_POLI";
            $datalog = array(
                'USERNAME'      => $user,
                'WAKTU'         => $waktu,
                'AKTIVITAS'     => $aktivitas
            );
            $this->mlog->get_insert($datalog);
			$this->session->set_flashdata("pesan", "<div class=\"alert alert-success\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Data berhasil diupdate</div>");
			redirect(base_url().'admin_poli');
		}
    }

    public function hapus($gid){
        $ketLog = $this->mpoli->get_byid($gid);
        foreach ($ketLog as $key) {
            $idAktvts = $key->NAMA_POLI;
        }
        $var = $this->session->all_userdata();
        $user=$var['USERNAME'];
        date_default_timezone_set("Asia/Bangkok");
        $waktu = date ("Y-m-d H:i:s");
        $aktivitas = "Admin menghapus data poli dengan nama $idAktvts";
        $datalog = array(
            'USERNAME'      => $user,
            'WAKTU'         => $waktu,
            'AKTIVITAS'     => $aktivitas
        );
        $this->mlog->get_insert($datalog);
        $this->mpoli->del($gid);
        $ket = "delete_poli";
        redirect(base_url().'survei/hitung_ulang/'.$ket);
	}
}

/* End of file Data.php */
/* Location: ./application/controllers/Data.php */