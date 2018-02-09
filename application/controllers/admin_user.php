<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_user extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('muser');
        $this->load->model('mlog');
        $this->load->helper('form','url');
    }

	public function index()
	{
	    $data['title'] = 'Daftar User';
        $data['ket'] = 'all';
	    $data['quser'] = $this->muser->get_all();
        $var = $this->session->all_userdata();
        $data['user']=$var['USERNAME'];

		$this->load->view('admin/vuser',$data);
	}
    public function user_byid()
    {
        $var = $this->session->all_userdata();
        $USERNAME=$var['USERNAME'];
        $data['title'] = 'Edit pengguna';
        $data['ket'] = 'byid';
        $data['quser'] = $this->muser->get_byid($USERNAME);

        $this->load->view('admin/vuser',$data);
    }

    public function edit_user()
    {
        $var = $this->session->all_userdata();
        $USERNAME=$var['USERNAME'];
        $data['title'] = 'Edit pengguna';
        $data['ket'] = 'byid';
        $data['quser'] = $this->muser->get_byid($USERNAME);

        //$this->load->view('admin/vuser',$data);
        redirect(base_url().'admin_user/form/edit/'.$data['ket'].'/'.$USERNAME);
    }

    public function form(){
        
		$mau_ke					= $this->uri->segment(3);
        $ket                    = $this->uri->segment(4);
        $idu                    = $this->uri->segment(5);

		$USERNAME       = addslashes($this->input->post('USERNAME'));
		$NAMA_USER      = addslashes($this->input->post('NAMA_USER'));
        $PASSWORD_LAMA1 = addslashes($this->input->post('PASSWORD_LAMA'));
        $PASSWORD_ACC   = addslashes($this->input->post('PASSWORD_ACC'));
        $PASSWORD1      = addslashes($this->input->post('pass'));
        $PASSWORD21     = addslashes($this->input->post('KONFIRMASI_PASSWORD'));
        $HAK_AKSES      = addslashes($this->input->post('HAK_AKSES'));
        $keterangan     = addslashes($this->input->post('ket'));

        $PASSWORD_LAMA = md5($PASSWORD_LAMA1);
        $PASSWORD      = md5($PASSWORD1);
        $PASSWORD2     = md5($PASSWORD21);

		if ($mau_ke == "add") {
		    $data['title'] = 'Tambah Data';
            $data['ket'] = $ket;
		    $data['aksi'] = 'aksi_add';
            $this->load->view('admin/vformuser',$data);
		} else if ($mau_ke == "edit") {
			$data['quser']	= $this->muser->get_byid($idu);
			$data['title'] = 'Edit Data';
            $data['ket'] = $ket;
		    $data['aksi'] = 'aksi_edit';
            $this->load->view('admin/vformuser',$data);
		} else if ($mau_ke == "aksi_add") {
            $quser = $this->muser->get_all();
            $cek=0;
            foreach ($quser as $row) {
                if ($USERNAME==$row->USERNAME) {
                    $cek++;
                }
            }
            if ($cek>0) {
                $this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> User dengan Username : ".$USERNAME." sudah ada! </div>");
                redirect(base_url().'admin_user/form/add');
            }else{
                 if ($PASSWORD==$PASSWORD2 ) {
                    $data = array(
                        'USERNAME'      => $USERNAME,
                        'NAMA_USER'     => $NAMA_USER,
                        'PASSWORD'      => $PASSWORD,
                        'HAK_AKSES'     => $HAK_AKSES
                    );
                    $this->muser->get_insert($data);

                    $var = $this->session->all_userdata();
                    $user=$var['USERNAME'];
                    date_default_timezone_set("Asia/Bangkok");
                    $waktu = date ("Y-m-d H:i:s");
                    $aktivitas = "Admin menambahkan data user $USERNAME pada tabel user";
                    $datalog = array(
                        'USERNAME'      => $user,
                        'WAKTU'         => $waktu,
                        'AKTIVITAS'     => $aktivitas
                    );
                    $this->mlog->get_insert($datalog);

                    $this->session->set_flashdata("pesan", "<div class=\"alert alert-success\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Data berhasil di insert</div>");
                    redirect(base_url().'admin_user');
                 } else {
                    $this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Password tidak cocok! </div>");
                    redirect(base_url().'admin_user/form/add');
                }
         }
        } else if ($mau_ke == "aksi_edit") {
            if ($PASSWORD_LAMA==$PASSWORD_ACC) {
                if ($PASSWORD==$PASSWORD2 ) {
                    $data = array(
                        'USERNAME'      => $USERNAME,
                        'NAMA_USER'     => $NAMA_USER,
                        'PASSWORD'      => $PASSWORD,
                        'HAK_AKSES'     => $HAK_AKSES
                    );
                    $this->muser->get_update($USERNAME,$data);

                    $var = $this->session->all_userdata();
                    $user=$var['USERNAME'];
                    date_default_timezone_set("Asia/Bangkok");
                    $waktu = date ("Y-m-d H:i:s");
                    $aktivitas = "Admin mengubah data user pada user dengan username $USERNAME";
                    $datalog = array(
                        'USERNAME'      => $user,
                        'WAKTU'         => $waktu,
                        'AKTIVITAS'     => $aktivitas
                    );
                    $this->mlog->get_insert($datalog);
                    if ($keterangan=='all') {
                        $this->session->set_flashdata("pesan", "<div class=\"alert alert-success\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Data berhasil diupdate</div>");
                        redirect(base_url().'admin_user');
                    }else{
                        $this->session->set_flashdata("pesan", "<div class=\"alert alert-success\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Data berhasil diupdate</div>");
                        redirect(base_url().'admin_user/user_byid');
                    }
                }else{
                    $this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Password tidak cocok! </div>");
                    redirect(base_url().'admin_user/form/edit/'.$keterangan.'/'.$USERNAME);
                }
            } else {
                $this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Password lama salah! </div>");
                redirect(base_url().'admin_user/form/edit/'.$keterangan.'/'.$USERNAME);
            }            
		}
    }
    public function hapus($gid){

        $var = $this->session->all_userdata();
        $user=$var['USERNAME'];
        date_default_timezone_set("Asia/Bangkok");
        $waktu = date ("Y-m-d H:i:s");
        $aktivitas = "Admin menghapus data user dengan username $gid";
        $datalog = array(
            'USERNAME'      => $user,
            'WAKTU'         => $waktu,
            'AKTIVITAS'     => $aktivitas
        );
        $this->mlog->get_insert($datalog);

        $this->muser->del($gid);
        $this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Data berhasil dihapus</div>");
        redirect(base_url().'admin_user');
	}
}