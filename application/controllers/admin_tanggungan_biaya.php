<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_tanggungan_biaya extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('mtanggunganbiaya');
        $this->load->model('mlog');
        $this->load->helper('form','url');
    }

	public function index()
	{
	    $data['title'] = 'Daftar Tanggungan Biaya';
	    $data['qtanggungan_biaya'] = $this->mtanggunganbiaya->get_all();
		$this->load->view('admin/vtanggungan_biaya',$data);

	}

    public function form(){
    	//ambil variabel URL
		$mau_ke					= $this->uri->segment(3);
		$idu					= $this->uri->segment(4);
        //print $mau_ke;

		//ambil variabel
		$ID_TANGGUNGAN_BIAYA      = addslashes($this->input->post('ID_TANGGUNGAN_BIAYA'));
		$NAMA_TANGGUNGAN_BIAYA    = addslashes($this->input->post('NAMA_TANGGUNGAN_BIAYA'));
        $KETERANGAN               = addslashes($this->input->post('KETERANGAN'));

		if ($mau_ke == "add") {
		    $data['title'] = 'Tambah Data';
		    $data['aksi'] = 'aksi_add';
            $this->load->view('admin/vformtanggungan_biaya',$data);
		} else if ($mau_ke == "edit") {
			$data['qtanggungan_biaya']	= $this->mtanggunganbiaya->get_byid($idu);
			$data['title'] = 'Edit Data';
		    $data['aksi'] = 'aksi_edit';
            $this->load->view('admin/vformtanggungan_biaya',$data);
		} else if ($mau_ke == "aksi_add") {
			$data = array(
                'ID_TANGGUNGAN_BIAYA'   => $ID_TANGGUNGAN_BIAYA,
                'NAMA_TANGGUNGAN_BIAYA' => $NAMA_TANGGUNGAN_BIAYA,
                'KETERANGAN' => $KETERANGAN
            );
            $this->mtanggunganbiaya->get_insert($data);

            $var = $this->session->all_userdata();
            $user=$var['USERNAME'];
            date_default_timezone_set("Asia/Bangkok");
            $waktu = date ("Y-m-d H:i:s");
            $aktivitas = "Admin menambah data tanggungan biaya dengan nama : $NAMA_TANGGUNGAN_BIAYA";
            $datalog = array(
                'USERNAME'      => $user,
                'WAKTU'         => $waktu,
                'AKTIVITAS'     => $aktivitas
            );
            $this->mlog->get_insert($datalog);

			$this->session->set_flashdata("pesan", "<div class=\"alert alert-success\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Data berhasil di insert</div>");
            redirect(base_url().'admin_tanggungan_biaya');
        } else if ($mau_ke == "aksi_edit") {
            $data = array(
                'ID_TANGGUNGAN_BIAYA'   => $ID_TANGGUNGAN_BIAYA,
                'NAMA_TANGGUNGAN_BIAYA' => $NAMA_TANGGUNGAN_BIAYA,
                'KETERANGAN' => $KETERANGAN
            );
            $this->mtanggunganbiaya->get_update($ID_TANGGUNGAN_BIAYA,$data);

            $var = $this->session->all_userdata();
            $user=$var['USERNAME'];
            date_default_timezone_set("Asia/Bangkok");
            $waktu = date ("Y-m-d H:i:s");
            $aktivitas = "Admin mengubah data Tanggungan biaya pada data $NAMA_TANGGUNGAN_BIAYA";
            $datalog = array(
                'USERNAME'      => $user,
                'WAKTU'         => $waktu,
                'AKTIVITAS'     => $aktivitas
            );
            $this->mlog->get_insert($datalog);
			$this->session->set_flashdata("pesan", "<div class=\"alert alert-success\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Data berhasil diupdate</div>");
			redirect(base_url().'admin_tanggungan_biaya');
		}
    }

    public function hapus($gid){
        $ketLog = $this->mtanggunganbiaya->get_byid($gid);
        foreach ($ketLog as $key) {
            $idAktvts = $key->NAMA_TANGGUNGAN_BIAYA;
        }
        $var = $this->session->all_userdata();
        $user=$var['USERNAME'];
        date_default_timezone_set("Asia/Bangkok");
        $waktu = date ("Y-m-d H:i:s");
        $aktivitas = "Admin menghapus data tanggungan biaya dengan nama $idAktvts";
        $datalog = array(
            'USERNAME'      => $user,
            'WAKTU'         => $waktu,
            'AKTIVITAS'     => $aktivitas
        );
        $this->mlog->get_insert($datalog);
        $this->mtanggunganbiaya->del($gid);
        $this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Data berhasil dihapus</div>");
        redirect(base_url().'admin_tanggungan_biaya');
	}
}

/* End of file Data.php */
/* Location: ./application/controllers/Data.php */