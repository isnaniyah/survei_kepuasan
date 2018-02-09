<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Petugas_nilai extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('mnilai');
        $this->load->model('msupplier');
        $this->load->model('mtahun');
        $this->load->model('msub');
        $this->load->model('mranking');
        $this->load->helper('form','url');
    }

    public function index($id){
        $data['title'] = 'Daftar Nilai';
        $data['qnilai'] = $this->mnilai->get_all($id);
        $data['qsub'] = $this->msub->get_all();
        $this->load->view('petugas/vceklist',$data);
    }

    public function detail($id, $idu)
    {
        $data['title'] = 'Daftar Nilai';
        $data['qnilai'] = $this->mnilai->get_bytahun($id, $idu);
        $data['qtahun'] = $this->mtahun->get_byid($id);
        $data['qsub'] = $this->msub->get_all();

        $this->load->view('petugas/vdetnilai',$data);
    }

    public function form(){

		$mau_ke					= $this->uri->segment(3);
		$supplier				= $this->uri->segment(4);
       
		$ID_TAHUN		  = addslashes($this->input->post('ID_TAHUN'));
		$ID_SUPPLIER	  = addslashes($this->input->post('ID_SUPPLIER'));
        $NILAI_NORMALISASI= addslashes($this->input->post('NILAI_NORMALISASI'));

		if ($mau_ke == "add") {
		    $data['title'] = 'Tambah Data';
		    $data['aksi'] = 'aksi_add';
            $data['qsub']   = $this->msub->get_all();
            $data['qtahun']   = $this->mtahun->get_all();
            $data['qsupplier'] = $this->msupplier->get_byid($supplier);
            $this->load->view('petugas/vformnilai',$data);
		} else if ($mau_ke == "edit") {
			$data['qnilai']	= $this->mnilai->get_byid($supplier);
            $data['qsub'] = $this->msub->get_all();
			$data['title'] = 'Edit Data';
		    $data['aksi'] = 'aksi_edit';
            $this->load->view('petugas/vformnilai_edit',$data);
		} else if ($mau_ke == "aksi_add") {
            $qcektahun = $this->mnilai->get_bysupplier($_POST['ID_SUPPLIER']);
            $cek=0;
            foreach ($qcektahun as $row) {
                if ($_POST['ID_TAHUN'] == $row->ID_TAHUN) {
                    $cek++;
                }
            }
            if ($cek > 0) {
                $this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Data Penilaian tahun ini sudah pernah dilakukan</div>");
                redirect(base_url().'petugas_nilai/form/add/'.$ID_SUPPLIER);
            }else{
            $i=0;
            foreach($_POST['ID_NILAI'] as $key => $val){
                

               $data = array(
                    'ID_NILAI'         => $_POST['ID_NILAI'][$key],
                    'ID_SUB'           => $_POST['ID_SUB'][$key],
                    'ID_TAHUN'         => $_POST['ID_TAHUN'],
                    'ID_SUPPLIER'      => $_POST['ID_SUPPLIER'],
                    'NILAI_MATRIKS'    => $_POST['NILAI_MATRIKS'][$key],
                    'NILAI_NORMALISASI'=> $NILAI_NORMALISASI
                );
                $this->mnilai->get_insert($data);
                $id_data=$_POST['ID_SUPPLIER'];
            }
            $apa='insert';
            redirect(base_url().'petugas_nilai/hitung_normalisasi/'.$ID_TAHUN.'/'.$id_data.'/'.$apa);

        }
        } else if ($mau_ke == "aksi_edit") {
            $ID_NILAI         = addslashes($this->input->post('ID_NILAI'));
            $ID_SUB           = addslashes($this->input->post('ID_SUB'));
            $NILAI_MATRIKS    = addslashes($this->input->post('NILAI_MATRIKS'));
          $data = array(
            'ID_NILAI'         => $ID_NILAI,
            'ID_SUB'           => $ID_SUB,
            'ID_TAHUN'         => $ID_TAHUN,
            'ID_SUPPLIER'      => $ID_SUPPLIER,
            'NILAI_MATRIKS'    => $NILAI_MATRIKS,
            'NILAI_NORMALISASI'=> $NILAI_NORMALISASI
            );
            $this->mnilai->get_update($ID_NILAI,$data);
            $apa = 'update';
            redirect(base_url().'petugas_nilai/hitung_normalisasi/'.$ID_TAHUN.'/'.$ID_SUPPLIER.'/'.$apa);
        }
    }
    public function delete($tahun,$supplier){
        $this->mnilai->del($tahun,$supplier);
        $this->mranking->del($tahun,$supplier);
        $apa = 'delete';
        redirect(base_url().'petugas_nilai/hitung_normalisasi/'.$tahun.'/'.$supplier.'/'.$apa);
	}

    public function hitung_normalisasi($tahun, $supplier,$kete){
        $qdata = $this->mnilai->get_tahun($tahun);
        foreach($qdata as $baris){
            $banding=$baris->NILAI_MATRIKS;
            $qket = $this->msub->get_sub_byid($baris->ID_SUB);
            foreach ($qket as $row) {
                if ($row->KETERANGAN == 'Benefit') {
                    $ket = 'benefit';
                }else {
                    $ket = 'cost';
                }
            }
            if ($ket=='benefit') {
                $qsub = $this->mnilai->get_bysubtahun($baris->ID_SUB, $baris->ID_TAHUN);
                foreach ($qsub as $row) {
                    if ($row->NILAI_MATRIKS > $banding) {
                        $banding = $row->NILAI_MATRIKS;
                    }
                }
                $nilaim=$baris->NILAI_MATRIKS;
                $NILAI_NORMALISASI = $nilaim/$banding;
            }else{
                $qsub = $this->mnilai->get_bysubtahun($baris->ID_SUB, $baris->ID_TAHUN);
                foreach ($qsub as $row) {
                    if ($row->NILAI_MATRIKS < $banding) {
                        $banding = $row->NILAI_MATRIKS;
                    }
                }
                $nilaim=$baris->NILAI_MATRIKS;
                $NILAI_NORMALISASI = $banding/$nilaim;
            }
            $data = array(
                'ID_NILAI'         => $baris->ID_NILAI,
                'ID_SUB'           => $baris->ID_SUB,
                'ID_TAHUN'         => $baris->ID_TAHUN,
                'ID_SUPPLIER'      => $baris->ID_SUPPLIER,
                'NILAI_MATRIKS'    => $baris->NILAI_MATRIKS,
                'NILAI_NORMALISASI'=> $NILAI_NORMALISASI
            );
            $this->mnilai->get_update($baris->ID_NILAI,$data);
            }
            if ($kete == 'insert') {
                redirect(base_url().'petugas_nilai/insert_v/'.$tahun.'/'.$supplier.'/'.$kete);
            }else{
                redirect(base_url().'petugas_nilai/hitung_v/'.$tahun.'/'.$supplier.'/'.$kete);
            }
    }
    public function insert_v($tahun, $supplier,$kete){
            $data = array(
                'ID_RANKING'       => $ID_RANKING,
                'ID_SUPPLIER'      => $supplier,
                'ID_TAHUN'         => $tahun,
                'NILAI_AKHIR'      => '0'
            );
            $this->mranking->get_insert($data);
            redirect(base_url().'petugas_nilai/hitung_v/'.$tahun.'/'.$supplier.'/'.$kete);
    }
    public function hitung_v($tahun, $supplier,$kete){
        $qsupp = $this->mranking->get_bytahun($tahun);
        foreach ($qsupp as $baris_supp) {
            $qdata = $this->mnilai->get_bytahun($tahun, $baris_supp->ID_SUPPLIER);
            $nilai=0;
            foreach($qdata as $baris){
                $qket = $this->msub->get_all();
                foreach ($qket as $row) {
                    if ($baris->ID_SUB == $row->ID_SUB) {
                        $bobot = $row->BOBOT_GLOBAL;
                        $normal=$baris->NILAI_NORMALISASI;
                        $nilai1 = $normal*$bobot;
                    }
                }
                $nilai = $nilai+$nilai1;
            }
            $data = array(
                'ID_RANKING'       => $baris_supp->ID_RANKING,
                'ID_SUPPLIER'      => $baris_supp->ID_SUPPLIER,
                'ID_TAHUN'         => $tahun,
                'NILAI_AKHIR'      => $nilai
            );
            $this->mranking->get_update($baris_supp->ID_RANKING,$data);
        }
        if ($kete == 'insert') {
            $this->session->set_flashdata("pesan", "<div class=\"alert alert-success\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Data berhasil di insert</div>");
            redirect(base_url().'petugas_supplier/detail/'.$supplier);  
        }else if($kete == 'update'){
            $this->session->set_flashdata("pesan", "<div class=\"alert alert-success\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Data berhasil diupdate</div>");
            redirect(base_url().'petugas_nilai/detail/'.$tahun.'/'.$supplier);
        } else {
            $this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Data berhasil dihapus</div>");
            redirect(base_url().'petugas_supplier/detail/'.$supplier);
        }
    }
}
