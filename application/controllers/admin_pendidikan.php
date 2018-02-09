<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_pendidikan extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('mpendidikan');
        $this->load->model('mlog');
        $this->load->helper('form','url');
    }

	public function index()
	{
	    $data['title'] = 'Daftar Pendidikan';
	    $data['qpendidikan'] = $this->mpendidikan->get_all();
		$this->load->view('admin/vpendidikan',$data);

	}

    public function form(){
    	//ambil variabel URL
		$mau_ke					= $this->uri->segment(3);
		$idu					= $this->uri->segment(4);
        //print $mau_ke;

		//ambil variabel
		$ID_PENDIDIKAN      = addslashes($this->input->post('ID_PENDIDIKAN'));
		$NAMA_PENDIDIKAN    = addslashes($this->input->post('NAMA_PENDIDIKAN'));
        $KETERANGAN        = addslashes($this->input->post('KETERANGAN'));

		if ($mau_ke == "add") {
		    $data['title'] = 'Tambah Data';
		    $data['aksi'] = 'aksi_add';
            $this->load->view('admin/vformpendidikan',$data);
		} else if ($mau_ke == "edit") {
			$data['qpendidikan']	= $this->mpendidikan->get_byid($idu);
			$data['title'] = 'Edit Data';
		    $data['aksi'] = 'aksi_edit';
            $this->load->view('admin/vformpendidikan',$data);
		} else if ($mau_ke == "aksi_add") {
			$data = array(
                'ID_PENDIDIKAN'   => $ID_PENDIDIKAN,
                'NAMA_PENDIDIKAN' => $NAMA_PENDIDIKAN,
                'KETERANGAN' => $KETERANGAN
            );
            $this->mpendidikan->get_insert($data);

            $var = $this->session->all_userdata();
            $user=$var['USERNAME'];
            date_default_timezone_set("Asia/Bangkok");
            $waktu = date ("Y-m-d H:i:s");
            $aktivitas = "Admin menambah data pendidikan dengan nama $NAMA_PENDIDIKAN";
            $datalog = array(
                'USERNAME'      => $user,
                'WAKTU'         => $waktu,
                'AKTIVITAS'     => $aktivitas
            );
            $this->mlog->get_insert($datalog);
			$this->session->set_flashdata("pesan", "<div class=\"alert alert-success\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Data berhasil di insert</div>");
            redirect(base_url().'admin_pendidikan');
        } else if ($mau_ke == "aksi_edit") {
            $data = array(
                'ID_PENDIDIKAN'   => $ID_PENDIDIKAN,
                'NAMA_PENDIDIKAN' => $NAMA_PENDIDIKAN,
                'KETERANGAN' => $KETERANGAN
            );
            $this->mpendidikan->get_update($ID_PENDIDIKAN,$data);

            $var = $this->session->all_userdata();
            $user=$var['USERNAME'];
            date_default_timezone_set("Asia/Bangkok");
            $waktu = date ("Y-m-d H:i:s");
            $aktivitas = "Admin mengubah data pendidikan pada data dengan nama $NAMA_PENDIDIKAN";
            $datalog = array(
                'USERNAME'      => $user,
                'WAKTU'         => $waktu,
                'AKTIVITAS'     => $aktivitas
            );
            $this->mlog->get_insert($datalog);
			$this->session->set_flashdata("pesan", "<div class=\"alert alert-success\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Data berhasil diupdate</div>");
			redirect(base_url().'admin_pendidikan');
		}
    }

    public function hapus($gid){
        $ketLog = $this->mpendidikan->get_byid($gid);
        foreach ($ketLog as $key) {
            $idAktvts = $key->NAMA_PENDIDIKAN;
        }
        $var = $this->session->all_userdata();
        $user=$var['USERNAME'];
        date_default_timezone_set("Asia/Bangkok");
        $waktu = date ("Y-m-d H:i:s");
        $aktivitas = "Admin menghapus data pendidikan dengan nama $idAktvts";
        $datalog = array(
            'USERNAME'      => $user,
            'WAKTU'         => $waktu,
            'AKTIVITAS'     => $aktivitas
        );
        $this->mlog->get_insert($datalog);
        $this->mpendidikan->del($gid);
        $this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Data berhasil dihapus</div>");
        redirect(base_url().'admin_pendidikan');
	}
}

/* End of file Data.php */
/* Location: ./application/controllers/Data.php */