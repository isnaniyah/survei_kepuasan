<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pengawas_user extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('muser');
        $this->load->helper('form','url');
    }

    public function index()
    {
        $data['title'] = 'User'; //judul title
        $data['quser'] = $this->muser->get_all(); //query model semua Data

        $this->load->view('pengawas/vuser',$data);
    }
    public function ganti()
    {
        $var = $this->session->all_userdata();
        $USERNAME=$var['USERNAME'];
        $data['title'] = 'Edit pengguna';
        $data['quser'] = $this->muser->get_byid($USERNAME);

        $data['title'] = 'Edit Data';
        $data['aksi'] = 'aksi_edit';
        $this->load->view('pengawas/vformuser',$data);
    }
      public function user_byid()
    {
        $var = $this->session->all_userdata();
        $USERNAME=$var['USERNAME'];
        $data['title'] = 'Edit pengguna';
        $data['quser'] = $this->muser->get_byid($USERNAME); //query model semua Data

        $this->load->view('pengawas/vuser',$data);
    }
    public function form(){
        
        $mau_ke                 = $this->uri->segment(3);
        $idu                    = $this->uri->segment(4);

        $USERNAME       = addslashes($this->input->post('USERNAME'));
        $NAMA_USER      = addslashes($this->input->post('NAMA_USER'));
        $PASSWORD_LAMA1 = addslashes($this->input->post('PASSWORD_LAMA'));
        $PASSWORD_ACC   = addslashes($this->input->post('PASSWORD_ACC'));
        $PASSWORD1      = addslashes($this->input->post('pass'));
        $PASSWORD21     = addslashes($this->input->post('KONFIRMASI_PASSWORD'));
        $HAK_AKSES      = addslashes($this->input->post('HAK_AKSES'));

        $PASSWORD_LAMA = md5($PASSWORD_LAMA1);
        $PASSWORD      = md5($PASSWORD1);
        $PASSWORD2     = md5($PASSWORD21);

        if ($mau_ke == "add") {
            $data['title'] = 'Tambah Data';
            $data['aksi'] = 'aksi_add';
            $this->load->view('pengawas/vformuser',$data);
        } else if ($mau_ke == "edit") {
            $data['quser']  = $this->muser->get_byid($idu);
            $data['title'] = 'Edit Data';
            $data['aksi'] = 'aksi_edit';
            $this->load->view('pengawas/vformuser',$data);
        } else if ($mau_ke == "aksi_add") {
         if ($PASSWORD==$PASSWORD2 ) {
            $data = array(
                'USERNAME'           => $USERNAME,
                'NAMA_USER'     => $NAMA_USER,
                'PASSWORD'      => $PASSWORD,
                'HAK_AKSES'     => $HAK_AKSES
            );
            $this->muser->get_insert($data);
            $this->session->set_flashdata("pesan", "<div class=\"alert alert-success\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Data berhasil di insert</div>");
            redirect(base_url().'pengawas_user');
         } else {
            $this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Password tidak cocok! </div>");
            redirect(base_url().'pengawas_user/form/add');
         }
        } else if ($mau_ke == "aksi_edit") {
            if ($PASSWORD_LAMA==$PASSWORD_ACC) {
                if ($PASSWORD==$PASSWORD2 ) {
                $data = array(
                    'USERNAME'           => $USERNAME,
                    'NAMA_USER'     => $NAMA_USER,
                    'PASSWORD'      => $PASSWORD,
                    'HAK_AKSES'     => $HAK_AKSES
                );
                $this->muser->get_update($USERNAME,$data);
                $this->session->set_flashdata("pesan", "<div class=\"alert alert-success\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Data berhasil diupdate</div>");
                redirect(base_url().'pengawas_user/user_byid');
                }else{
                    $this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Password tidak cocok! </div>");
                    redirect(base_url().'pengawas_user/form/edit/'.$USERNAME);
                }
            } else {
                $this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Password lama salah! </div>");
                redirect(base_url().'pengawas_user/form/edit/'.$USERNAME);
            }            
        }
    }
    public function hapus($gid){

        $this->muser->del($gid);
        $this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Data berhasil dihapus</div>");
        redirect(base_url().'pengawas_user/user_byid');
    }
}