<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_tahun extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('mtahun');
        $this->load->helper('form','url');
    }

	public function index()
	{
	    $data['title'] = 'Daftar Tahun';
	    $data['qtahun'] = $this->mtahun->get_all();

		$this->load->view('admin/vtahun',$data);

	}

    public function form(){
    	//ambil variabel URL
		$mau_ke					= $this->uri->segment(3);
		$idu					= $this->uri->segment(4);
        //print $mau_ke;

		//ambil variabel
		$ID_TAHUN      = addslashes($this->input->post('ID_TAHUN'));
		$TAHUN    = addslashes($this->input->post('TAHUN'));

		if ($mau_ke == "add") {
		    $data['title'] = 'Tambah Data';
		    $data['aksi'] = 'aksi_add';
            $this->load->view('admin/vformtahun',$data);
		} else if ($mau_ke == "edit") {
			$data['qtahun']	= $this->mtahun->get_byid($idu);
			$data['title'] = 'Edit Data';
		    $data['aksi'] = 'aksi_edit';
            $this->load->view('admin/vformtahun',$data);
		} else if ($mau_ke == "aksi_add") {
			$data = array(
                'ID_TAHUN'   => $ID_TAHUN,
                'TAHUN' => $TAHUN
            );
            $this->mtahun->get_insert($data);
			$this->session->set_flashdata("pesan", "<div class=\"alert alert-success\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Data berhasil di insert</div>");
            redirect(base_url().'admin_tahun');
        } else if ($mau_ke == "aksi_edit") {
            $data = array(
                'ID_TAHUN'   => $ID_TAHUN,
                'TAHUN' => $TAHUN
            );
            $this->mtahun->get_update($ID_TAHUN,$data);
			$this->session->set_flashdata("pesan", "<div class=\"alert alert-success\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Data berhasil diupdate</div>");
			redirect(base_url().'admin_tahun');
		}
    }

    public function hapus($gid){
        $this->mtahun->del($gid);
        $this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Data berhasil dihapus</div>");
        redirect(base_url().'admin_tahun');
	}
}

/* End of file Data.php */
/* Location: ./application/controllers/Data.php */