<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class admin_sub extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('msub');
        $this->load->model('mlog');
        $this->load->model('mkriteria');
        $this->load->helper('form','url');
    }

    public function index()
    {
        $data['title'] = 'Data Sub Kriteria';
        $data['qsub'] = $this->msub->get_all();
        $this->load->view('admin/vsub',$data);
    }

    public function form(){
        $mau_ke           = $this->uri->segment(3);
        $idkri            = $this->uri->segment(4);
        $idu              = $this->uri->segment(5);

        $ID_SUB                 = addslashes($this->input->post('ID_SUB'));
        $ID_KRITERIA            = addslashes($this->input->post('ID_KRITERIA'));
        $NAMA_SUB               = addslashes($this->input->post('NAMA_SUB'));
        $JENIS_KRITERIA         = addslashes($this->input->post('JENIS_KRITERIA'));
        $KETERANGAN             = addslashes($this->input->post('KETERANGAN'));
        $STATUS                 = addslashes($this->input->post('STATUS'));
        if ($STATUS == "Nonaktif") {
            $BOBOT_SUB          = 0;
        }else{
            $BOBOT_SUB          = addslashes($this->input->post('BOBOT_SUB'));
        }
        
        
        if ($mau_ke == "add") {
            $data['title'] = 'Tambah Data';
            $data['aksi'] = 'aksi_add';
            $data['qkriteria'] = $this->mkriteria->get_kriteria_byid($idkri);
            $this->load->view('admin/vformsub',$data);
        } else if ($mau_ke == "edit") {
            $data['qsub']   = $this->msub->get_sub_byid($idu);
            $data['title'] = 'Edit Data';
            $data['aksi'] = 'aksi_edit';
            $this->load->view('admin/vformsub',$data);
        } else if ($mau_ke == "aksi_add") {
                $qkriteria = $this->mkriteria->get_kriteria_byid($ID_KRITERIA);
                foreach ($qkriteria as $row) {
                    $BOBOT_KRITERIA = $row->BOBOT_KRITERIA;
                }
                $BOBOT_GLOBAL = ($BOBOT_SUB/100)*($BOBOT_KRITERIA/100);
                $data = array(
                    'ID_SUB'         => $ID_SUB,
                    'ID_KRITERIA'    => $ID_KRITERIA,
                    'NAMA_SUB'       => $NAMA_SUB,
                    'KETERANGAN'     => $KETERANGAN,
                    'JENIS_KRITERIA' => $JENIS_KRITERIA,
                    'STATUS'         => $STATUS,
                    'BOBOT_SUB'      => $BOBOT_SUB,
                    'BOBOT_GLOBAL'   => $BOBOT_GLOBAL
                );
                $this->msub->get_insert($data);

                $ketLog = $this->mkriteria->get_kriteria_byid($ID_KRITERIA);
                foreach ($ketLog as $key) {
                    $idAktvts = $key->NAMA_KRITERIA;
                }
                $var = $this->session->all_userdata();
                $user=$var['USERNAME'];
                date_default_timezone_set("Asia/Bangkok");
                $waktu = date ("Y-m-d H:i:s");
                $aktivitas = "Admin menambah data pernyataan baru, yaitu data: $NAMA_SUB pada kriteria : $idAktvts";
                $datalog = array(
                    'USERNAME'      => $user,
                    'WAKTU'         => $waktu,
                    'AKTIVITAS'     => $aktivitas
                );
                $this->mlog->get_insert($datalog);

                $this->session->set_flashdata("pesan", "<div class=\"alert alert-success\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Data berhasil di insert, silahkan atur ulang bobot kriteria</div>");
                redirect(base_url().'admin_sub/edit_sub/'.$ID_KRITERIA);
        } else if ($mau_ke == "aksi_edit") {
            $qkriteria = $this->mkriteria->get_kriteria_byid($ID_KRITERIA);
            foreach ($qkriteria as $row) {
                $BOBOT_KRITERIA = $row->BOBOT_KRITERIA;
            }
            $BOBOT_GLOBAL = ($BOBOT_SUB/100)*($BOBOT_KRITERIA/100);
            $data = array(
                'ID_SUB'        => $ID_SUB,
                'ID_KRITERIA'   => $ID_KRITERIA,
                'NAMA_SUB'      => $NAMA_SUB,
                'JENIS_KRITERIA' => $JENIS_KRITERIA,
                'STATUS'         => $STATUS,
                'KETERANGAN'    => $KETERANGAN,
                'BOBOT_SUB'     => $BOBOT_SUB,
                'BOBOT_GLOBAL' => $BOBOT_GLOBAL
            );
            $this->msub->get_update($ID_SUB,$data);

            $ketLog = $this->mkriteria->get_kriteria_byid($ID_KRITERIA);
            foreach ($ketLog as $key) {
                $idAktvts = $key->NAMA_KRITERIA;
            }
            $var = $this->session->all_userdata();
            $user=$var['USERNAME'];
            date_default_timezone_set("Asia/Bangkok");
            $waktu = date ("Y-m-d H:i:s");
            $aktivitas = "Admin mengubah data pada pernyataan : $NAMA_SUB pada kriteria $idAktvts";
            $datalog = array(
                'USERNAME'      => $user,
                'WAKTU'         => $waktu,
                'AKTIVITAS'     => $aktivitas
            );
            $this->mlog->get_insert($datalog);

            $this->session->set_flashdata("pesan", "<div class=\"alert alert-success\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Data berhasil diupdate, silahkan atur ulang bobot kriteria</div>");
            redirect(base_url().'admin_sub/edit_sub/'.$ID_KRITERIA);
        }
    }
    public function edit_sub($ID_KRITERIA){
        $data['qsub']   = $this->msub->get_sub_byidkriteria_bystatus($ID_KRITERIA);
        $data['qkriteria']   = $this->mkriteria->get_kriteria_byid($ID_KRITERIA);
        $data['title'] = 'Atur Ulang Bobot Sub Kriteria';
        $this->load->view('admin/vformsub_bobot',$data);
    }
    public function proses_edit($ID_KRITERIA){
        $total=0;
        foreach ($_POST['BOBOT_SUB'] as $row => $val) {
            $total = $total + $_POST['BOBOT_SUB'][$row];
        }
        if ($total != 100) {
            $this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Total Bobot Harus Bernilai 100 </div>");
            redirect(base_url().'admin_sub/edit_sub/'.$ID_KRITERIA);
        }else{
            $qkrit = $this->mkriteria->get_kriteria_byid($ID_KRITERIA);
            foreach ($qkrit as $rowd) {
                $BOBOT_KRITERIA = $rowd->BOBOT_KRITERIA;
            }
            foreach($_POST['ID_SUB'] as $key => $val){
                $BOBOT_SUB = $_POST['BOBOT_SUB'][$key];
                $BOBOT_GLOBAL = ($BOBOT_SUB/100)*($BOBOT_KRITERIA/100);
               $data = array(
                    'ID_SUB'         => $_POST['ID_SUB'][$key],
                    'BOBOT_SUB'           => $_POST['BOBOT_SUB'][$key],
                    'BOBOT_GLOBAL'        => $BOBOT_GLOBAL
                );
                $this->msub->get_update($_POST['ID_SUB'][$key],$data);
            }
            redirect(base_url().'admin_kriteria/detail/'.$ID_KRITERIA);
        }
    }

    public function hapus($gid, $ID_KRITERIA){
        $ketLog = $this->msub->get_sub_byid($gid);
        foreach ($ketLog as $key) {
            $idAktvts = $key->NAMA_SUB;
        }
        $ketLog2 = $this->mkriteria->get_kriteria_byid($ID_KRITERIA);
        foreach ($ketLog2 as $key) {
            $idAktvts2 = $key->NAMA_KRITERIA;
        }
        $var = $this->session->all_userdata();
        $user=$var['USERNAME'];
        date_default_timezone_set("Asia/Bangkok");
        $waktu = date ("Y-m-d H:i:s");
        $aktivitas = "Admin menghapus pernyataan : $idAktvts pada kriteria : $idAktvts2";
        $datalog = array(
            'USERNAME'      => $user,
            'WAKTU'         => $waktu,
            'AKTIVITAS'     => $aktivitas
        );
        $this->mlog->get_insert($datalog);

        $id = $ID_KRITERIA;
        $this->msub->del($gid);
        $this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Data berhasil dihapus, silahkan atur ulang bobot kriteria</div>");
        redirect(base_url().'admin_sub/edit_sub/'.$id);
    }
    public function search(){
        $ID_KRITERIA = addslashes($this->input->post('ID_KRITERIA'));
        $data['title'] = 'Hasil Pencarian Data sub';
        $data['qsub']=$this->msub->search($ID_KRITERIA);
        $this->load->view('admin/vsub',$data);
    }
}