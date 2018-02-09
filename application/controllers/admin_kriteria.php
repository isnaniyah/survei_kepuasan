<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class admin_kriteria extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('mkriteria');
        $this->load->model('msub');
        $this->load->model('mlog');
        $this->load->helper('form','url');
    }

    public function index()
    {
        $data['title'] = 'Data Kriteria';
        $data['qkriteria'] = $this->mkriteria->get_all();
        $data['qsub'] = $this->msub->get_all();
        
        $this->load->view('admin/vkriteria',$data);
    }

    public function form(){
        $mau_ke                 = $this->uri->segment(3);
        $idu                    = $this->uri->segment(4);

        $ID_KRITERIA            = addslashes($this->input->post('ID_KRITERIA'));
        $NAMA_KRITERIA          = addslashes($this->input->post('NAMA_KRITERIA'));
        $BOBOT_KRITERIA         = addslashes($this->input->post('BOBOT_KRITERIA'));
        
        if ($mau_ke == "add") {
            $data['title'] = 'Tambah Data';
            $data['aksi'] = 'aksi_add';
            $this->load->view('admin/vformkriteria',$data);
        } else if ($mau_ke == "edit") {
            $data['qkriteria']   = $this->mkriteria->get_kriteria_byid($idu);
            $data['title'] = 'Edit Data';
            $data['aksi'] = 'aksi_edit';
            $this->load->view('admin/vformkriteria',$data);
        } else if ($mau_ke == "aksi_add") {
            $qkriteria = $this->mkriteria->get_all();
            $cek=0;
            foreach ($qkriteria as $row) {
                if ($ID_KRITERIA==$row->ID_KRITERIA) {
                    $cek++;
                }
            }
            if ($cek>0) {
                $this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> kriteria dengan no. ".$ID_KRITERIA." sudah ada! </div>");
                redirect(base_url().'admin_kriteria/form/add');
            }else{
                $data = array(
                    'ID_KRITERIA'       => $ID_KRITERIA,
                    'NAMA_KRITERIA'     => $NAMA_KRITERIA,
                    'BOBOT_KRITERIA'    => $BOBOT_KRITERIA
                );
                $this->mkriteria->get_insert($data);
                $var = $this->session->all_userdata();
                $user=$var['USERNAME'];
                date_default_timezone_set("Asia/Bangkok");
                $waktu = date ("Y-m-d H:i:s");
                $aktivitas = "Admin memasukkan data kriteria baru dengan nama $NAMA_KRITERIA";
                $datalog = array(
                    'USERNAME'      => $user,
                    'WAKTU'         => $waktu,
                    'AKTIVITAS'     => $aktivitas
                );
                $this->mlog->get_insert($datalog);
                $this->session->set_flashdata("pesan", "<div class=\"alert alert-success\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Data berhasil di insert, silahkan atur ulang bobot kriteria</div>");
                redirect(base_url().'admin_kriteria/edit_kriteria');
            }
        } else if ($mau_ke == "aksi_edit") {
          $data = array(
                'ID_KRITERIA'        => $ID_KRITERIA,
                'NAMA_KRITERIA'      => $NAMA_KRITERIA,
                'BOBOT_KRITERIA'     => $BOBOT_KRITERIA
            );
            $this->mkriteria->get_update($ID_KRITERIA,$data);
            $var = $this->session->all_userdata();
            $user=$var['USERNAME'];
            date_default_timezone_set("Asia/Bangkok");
            $waktu = date ("Y-m-d H:i:s");
            $aktivitas = "Admin mengubah data kriteria pada kriteria $NAMA_KRITERIA";
            $datalog = array(
                'USERNAME'      => $user,
                'WAKTU'         => $waktu,
                'AKTIVITAS'     => $aktivitas
            );
            $this->mlog->get_insert($datalog);

            $this->session->set_flashdata("pesan", "<div class=\"alert alert-success\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Data berhasil diupdate, silahkan atur ulang bobot kriteria</div>");
            redirect(base_url().'admin_kriteria/edit_kriteria');
        }
    }

    public function detail($id){
        $data['title'] = 'Detail Kriteria';
        $data['qkriteria'] = $this->mkriteria->get_kriteria_byid($id);
        $data2['qsub'] = $this->msub->get_sub_byidkriteria($id);
        $data2['ID_KRITERIA'] = $id;
        $this->load->view('admin/vdetkriteria',$data);
        $this->load->view('admin/vsub',$data2);
    }
    public function hapus($gid){
        $ketLog = $this->mkriteria->get_kriteria_byid($gid);
        foreach ($ketLog as $key) {
            $idAktvts = $key->NAMA_KRITERIA;
        }
        $var = $this->session->all_userdata();
        $user=$var['USERNAME'];
        date_default_timezone_set("Asia/Bangkok");
        $waktu = date ("Y-m-d H:i:s");
        $aktivitas = "Admin menghapus data kriteria dengan nama kriteria $idAktvts";
        $datalog = array(
            'USERNAME'      => $user,
            'WAKTU'         => $waktu,
            'AKTIVITAS'     => $aktivitas
        );
        $this->mlog->get_insert($datalog);
        $this->mkriteria->del($gid);
        $ket = "delete_kriteria";
        redirect(base_url().'survei/hitung_ulang/'.$ket);
    }
    public function search(){
        $ID_KRITERIA = addslashes($this->input->post('ID_KRITERIA'));
        $data['title'] = 'Hasil Pencarian Data Kriteria';
        $data['qkriteria']=$this->mkriteria->search($ID_KRITERIA);
        $this->load->view('admin/vkriteria',$data);
    }
    public function edit_kriteria(){
        $data['qkriteria']   = $this->mkriteria->get_all();
        $data['title'] = 'Atur Ulang Bobot Kriteria';
        $this->load->view('admin/vformkriteria_bobot',$data);
    }
    public function proses_edit(){
        $total=0;
        foreach ($_POST['BOBOT_KRITERIA'] as $row => $val) {
            $total = $total + $_POST['BOBOT_KRITERIA'][$row];
        }
        if ($total != 100) {
            $this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Total Bobot Harus Bernilai 100 </div>");
            redirect(base_url().'admin_kriteria/edit_kriteria');
        }else{
            foreach($_POST['ID_KRITERIA'] as $key => $val){
               $data = array(
                    'ID_KRITERIA'         => $_POST['ID_KRITERIA'][$key],
                    'NAMA_KRITERIA'       => $_POST['NAMA_KRITERIA'][$key],
                    'BOBOT_KRITERIA'      => $_POST['BOBOT_KRITERIA'][$key]
                );
                $this->mkriteria->get_update($_POST['ID_KRITERIA'][$key],$data);
            }
            redirect(base_url().'admin_kriteria/edit_bobotglobal');
        }
    }
    public function edit_bobotglobal(){
        $qkriteria = $this->mkriteria->get_all();
        foreach ($qkriteria as $row) {
            $BOBOT_KRITERIA = $row->BOBOT_KRITERIA;
            $qsub = $this->msub->get_sub_byidkriteria($row->ID_KRITERIA);
            foreach ($qsub as $rowdata) {
                $BOBOT_SUB = $rowdata->BOBOT_SUB;
                $BOBOT_GLOBAL = ($BOBOT_SUB/100)*($BOBOT_KRITERIA/100);
                $data = array(
                    'BOBOT_GLOBAL' => $BOBOT_GLOBAL
                );
                $this->msub->get_update($rowdata->ID_SUB,$data);
            }
        }
        redirect(base_url().'admin_kriteria');
    }
}