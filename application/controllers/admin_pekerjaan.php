<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_pekerjaan extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('mpekerjaan');
        $this->load->model('mlog');
        $this->load->helper('form','url');
    }

	public function index()
	{
	    $data['title'] = 'Daftar Pekerjaan';
	    $data['qpekerjaan'] = $this->mpekerjaan->get_all();
		$this->load->view('admin/vpekerjaan',$data);

	}

    public function form(){
    	//ambil variabel URL
		$mau_ke					= $this->uri->segment(3);
		$idu					= $this->uri->segment(4);
        //print $mau_ke;

		//ambil variabel
		$ID_PEKERJAAN      = addslashes($this->input->post('ID_PEKERJAAN'));
		$NAMA_PEKERJAAN    = addslashes($this->input->post('NAMA_PEKERJAAN'));
        $KETERANGAN        = addslashes($this->input->post('KETERANGAN'));

		if ($mau_ke == "add") {
		    $data['title'] = 'Tambah Data';
		    $data['aksi'] = 'aksi_add';
            $this->load->view('admin/vformpekerjaan',$data);
		} else if ($mau_ke == "edit") {
			$data['qpekerjaan']	= $this->mpekerjaan->get_byid($idu);
			$data['title'] = 'Edit Data';
		    $data['aksi'] = 'aksi_edit';
            $this->load->view('admin/vformpekerjaan',$data);
		} else if ($mau_ke == "aksi_add") {
			$data = array(
                'ID_PEKERJAAN'   => $ID_PEKERJAAN,
                'NAMA_PEKERJAAN' => $NAMA_PEKERJAAN,
                'KETERANGAN' => $KETERANGAN
            );
            $this->mpekerjaan->get_insert($data);

            $var = $this->session->all_userdata();
            $user=$var['USERNAME'];
            date_default_timezone_set("Asia/Bangkok");
            $waktu = date ("Y-m-d H:i:s");
            $aktivitas = "Admin membuat data baru pada tabel pekerjaan dengan nama $NAMA_PEKERJAAN";
            $datalog = array(
                'USERNAME'      => $user,
                'WAKTU'         => $waktu,
                'AKTIVITAS'     => $aktivitas
            );
            $this->mlog->get_insert($datalog);
			$this->session->set_flashdata("pesan", "<div class=\"alert alert-success\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Data berhasil di insert</div>");
            redirect(base_url().'admin_pekerjaan');
        } else if ($mau_ke == "aksi_edit") {
            $data = array(
                'ID_PEKERJAAN'   => $ID_PEKERJAAN,
                'NAMA_PEKERJAAN' => $NAMA_PEKERJAAN,
                'KETERANGAN' => $KETERANGAN
            );
            $this->mpekerjaan->get_update($ID_PEKERJAAN,$data);

            $var = $this->session->all_userdata();
            $user=$var['USERNAME'];
            date_default_timezone_set("Asia/Bangkok");
            $waktu = date ("Y-m-d H:i:s");
            $aktivitas = "Admin mengubah data pendidikan pada data dengan nama $NAMA_PEKERJAAN";
            $datalog = array(
                'USERNAME'      => $user,
                'WAKTU'         => $waktu,
                'AKTIVITAS'     => $aktivitas
            );
            $this->mlog->get_insert($datalog);
			$this->session->set_flashdata("pesan", "<div class=\"alert alert-success\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Data berhasil diupdate</div>");
			redirect(base_url().'admin_pekerjaan');
		}
    }

    public function hapus($gid){
        $ketLog = $this->mpekerjaan->get_byid($gid);
        foreach ($ketLog as $key) {
            $idAktvts = $key->NAMA_PEKERJAAN;
        }
        $var = $this->session->all_userdata();
        $user=$var['USERNAME'];
        date_default_timezone_set("Asia/Bangkok");
        $waktu = date ("Y-m-d H:i:s");
        $aktivitas = "Admin menghapus data pekerjaan dengan nama $idAktvts";
        $datalog = array(
            'USERNAME'      => $user,
            'WAKTU'         => $waktu,
            'AKTIVITAS'     => $aktivitas
        );
        $this->mlog->get_insert($datalog);
        $this->mpekerjaan->del($gid);
        $this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Data berhasil dihapus</div>");
        redirect(base_url().'admin_pekerjaan');
	}
}

/* End of file Data.php */
/* Location: ./application/controllers/Data.php */