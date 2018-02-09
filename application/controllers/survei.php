<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Survei extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('msurvei');
        $this->load->model('mresponden');
        $this->load->model('mpoli');
        $this->load->model('mperiode');
        $this->load->model('mperhitungan');
        $this->load->model('msub');
        $this->load->model('mranking');
        $this->load->helper('form','url');
    }

	public function index()
	{
		$data['title'] = 'Data Responden';
	   	$jumlah= $this->mresponden->jumlah();
		$config['base_url'] = base_url().'/admin_responden';
		$config['total_rows'] = $jumlah;
		$config['per_page'] = 10;
		$dari = $this->uri->segment('3');
		$data['qresponden'] = $this->mresponden->get_alljoin($config['per_page'],$dari);
		$data['qpoli'] = $this->mpoli->get_all();
		$this->pagination->initialize($config); 
		$this->load->view('admin/vresponden',$data);
	}

    public function form(){
    	//ambil variabel URL
		$mau_ke					= $this->uri->segment(3);
		$poli				= $this->uri->segment(4);
		$responden			= $this->uri->segment(5);
        //print $mau_ke;

		//ambil variabel
		$ID_RESPONDEN       = addslashes($this->input->post('ID_RESPONDEN'));
		$ID_POLI        	= addslashes($this->input->post('ID_POLI'));

		if ($mau_ke == "add") {
		    $data['title'] = 'Tambah Data';
		    $data['aksi'] = 'aksi_add';
		    $data['qsub']=$this->msub->get_sub_aktif();
		    $data['qresponden']=$this->mresponden->get_responden_byid($responden);
		    $data['qpoli']=$this->mpoli->get_byid($poli);
            $this->load->view('responden/vformsurvei',$data);
		} else if ($mau_ke == "aksi_add") {
			date_default_timezone_set("Asia/Bangkok");
			switch(date("F")) {
		        case 'January':     $bulan="Januari";     break; 
		        case 'February':    $bulan="Februari";    break; 
		        case 'March':       $bulan="Maret";       break; 
		        case 'April':       $bulan="April";       break; 
		        case 'May':         $bulan="Mei";         break; 
		        case 'June':        $bulan="Juni";        break; 
		        case 'July':        $bulan="Juli";        break;
		        case 'August':      $bulan="Agustus";     break;
		        case 'September':   $bulan="September";   break;
		        case 'October':     $bulan="Oktober";     break;
		        case 'November':    $bulan="November";    break;
		        case 'Desember':    $bulan="Desember";    break; }
			$tahun = date("Y");

			$periode = $this->mperiode->get_periode_byisi($bulan,$tahun);
			if (empty($periode)) {
				$dataperiode = array(
					'BULAN' => $bulan,
					'TAHUN' => $tahun
					);
				$this->mperiode->get_insert($dataperiode);
				$periode2 = $this->mperiode->get_periode_byisi($bulan,$tahun);
				foreach ($periode2 as $key) {
					$ID_PERIODE = $key->ID_PERIODE;
				}
			}else{
				foreach ($periode as $key) {
					$ID_PERIODE = $key->ID_PERIODE;
				}
			}
			foreach($_POST['ID_SUB'] as $key => $val){
	            $data = array(
	                'ID_RESPONDEN'      => $ID_RESPONDEN,
	                'ID_POLI'           => $ID_POLI,
	                'ID_SUB'         	=> $_POST['ID_SUB'][$key],
	                'ID_PERIODE'      	=> $ID_PERIODE,
	                'NILAI_PERSEPSI'    => $_POST['NILAI_PERSEPSI'][$key],
	                'NILAI_HARAPAN'		=> $_POST['NILAI_HARAPAN'][$key]
	            );
	            $this->msurvei->get_insert($data);
        	}
            redirect(base_url().'survei/hitung_nilai_servqual/'.$ID_PERIODE.'/'.$ID_POLI.'/'.$ID_RESPONDEN);
        }
    }


    public function hitung_nilai_servqual($periode, $poli, $responden){
    	$qsurvei = $this->msurvei->by_periode_poli($periode, $poli);
    	$qsub = $this->msub->get_all();
    	if (empty($qsurvei)) {
    		$qdata = $this->mperhitungan->by_periode_poli($periode, $poli);
    		if (!empty($qdata)) {
    			foreach ($qdata as $key) {
    				$idperhitungan = $key->ID_NILAI_PERHITUNGAN;
    			}
    			$this->mperhitungan->del($idperhitungan);
    		}
    	}else{
	    	foreach ($qsub as $key) {
	    		$total_harapan = 0;
	    		$total_persepsi = 0;
	    		$jumlah_persepsi = 0;
	    		$jumlah_harapan = 0;
	    		foreach ($qsurvei as $row) {
	    			if ($key->ID_SUB == $row->ID_SUB) {
	    				$total_harapan = $total_harapan + $row->NILAI_HARAPAN;
	    				$total_persepsi = $total_persepsi + $row->NILAI_PERSEPSI;
	    				$jumlah_persepsi = $jumlah_persepsi+1;
	    				$jumlah_harapan = $jumlah_harapan+1;
	    			}
	    		}
	    		if ($total_harapan != 0) {
	    			$RATA_RATA_HARAPAN = $total_harapan / $jumlah_harapan;
		    		$RATA_RATA_PERSEPSI = $total_persepsi / $jumlah_persepsi;
		    		$NILAI_SERVQUAL = $RATA_RATA_PERSEPSI - $RATA_RATA_HARAPAN;
		            $batas_bawah = -5;
		            $batas_atas = 5;
		            $NILAI_MATRIKS = ($NILAI_SERVQUAL - $batas_bawah)/($batas_atas - $batas_bawah);
	    			$qperhitungan = $this->mperhitungan->by_periode_poli_sub($periode,$poli,$key->ID_SUB);
	    			if (empty($qperhitungan)) {
			    		$data = array(
				            'ID_POLI'           => $poli,
				            'ID_SUB'         	=> $key->ID_SUB,
				            'ID_PERIODE'      	=> $periode,
				            'RATA_HARAPAN' 		=> $RATA_RATA_HARAPAN,
				            'RATA_PERSEPSI'		=> $RATA_RATA_PERSEPSI,
				            'NILAI_SERVQUAL'	=> $NILAI_SERVQUAL,
				            'NILAI_MATRIKS'		=> $NILAI_MATRIKS
				        );
				        $this->mperhitungan->get_insert($data);
				    } else {
				    	foreach ($qperhitungan as $rowdata) {
				    		$ID_NILAI_PERHITUNGAN = $rowdata->ID_NILAI_PERHITUNGAN;
				    	}
				    	$data = array(
				            'RATA_HARAPAN' 		=> $RATA_RATA_HARAPAN,
				            'RATA_PERSEPSI'		=> $RATA_RATA_PERSEPSI,
				            'NILAI_SERVQUAL'	=> $NILAI_SERVQUAL,
				            'NILAI_MATRIKS'		=> $NILAI_MATRIKS
				        );
				        $this->mperhitungan->get_update($ID_NILAI_PERHITUNGAN, $data);
				    }
	    		}
	    	}
	    }
	    redirect(base_url().'survei/hitung_normalisasi/'.$periode.'/'.$poli.'/'.$responden);
    }
	
	public function hitung_normalisasi($periode, $poli, $responden){
        $qdata = $this->mperhitungan->by_periode($periode);
        if (empty($qdata)) {
        	$this->mranking->del_periode($periode);
        	redirect(base_url().'survei/hitung_v/'.$periode.'/'.$poli.'/'.$responden);
        }else{
	        foreach($qdata as $baris){
	            $banding=$baris->NILAI_MATRIKS;
	            $qket = $this->msub->get_sub_byid($baris->ID_SUB);
	            foreach ($qket as $row) {
	                if ($row->JENIS_KRITERIA == 'Benefit') {
	                    $ket = 'benefit';
	                }else {
	                    $ket = 'cost';
	                }
	            }
	            if ($ket=='benefit') {
	                $qsub = $this->mperhitungan->by_sub_periode($baris->ID_SUB, $baris->ID_PERIODE);
	                foreach ($qsub as $row) {
	                    if ($row->NILAI_MATRIKS > $banding) {
	                        $banding = $row->NILAI_MATRIKS;
	                    }
	                }
	                $nilaim=$baris->NILAI_MATRIKS;
	                $NILAI_NORMALISASI = $nilaim/$banding;
	            }else{
	                $qsub = $this->mperhitungan->by_sub_periode($baris->ID_SUB, $baris->ID_PERIODE);
	                foreach ($qsub as $row) {
	                    if ($row->NILAI_MATRIKS < $banding) {
	                        $banding = $row->NILAI_MATRIKS;
	                    }
	                }
	                $nilaim=$baris->NILAI_MATRIKS;
	                $NILAI_NORMALISASI = $banding/$nilaim;
	            }
	            $data = array(
	                'NILAI_NORMALISASI'=> $NILAI_NORMALISASI
	            );
	            $this->mperhitungan->get_update($baris->ID_NILAI_PERHITUNGAN,$data);
	        }
		    if (empty($this->mranking->get_bypoli_periode($poli, $periode))) {
		    	redirect(base_url().'survei/insert_v/'.$periode.'/'.$poli.'/'.$responden);
		    }else{
		    	redirect(base_url().'survei/hitung_v/'.$periode.'/'.$poli.'/'.$responden);
		    }
	    }
    }
    public function insert_v($periode, $poli, $responden){
            $data = array(
                'ID_POLI'      		=> $poli,
                'ID_PERIODE'   		=> $periode,
                'JUMLAH_PERBAIKAN'  => '0',
                'NILAI_AKHIR'  		=> '0'
            );
            $this->mranking->get_insert($data);
            redirect(base_url().'survei/hitung_v/'.$periode.'/'.$poli.'/'.$responden);
    }
    public function hitung_v($periode, $poli, $responden){
        $qpoli = $this->mranking->get_byperiode($periode);
        foreach ($qpoli as $data_poli) {
            $qdata = $this->mperhitungan->by_periode_poli($periode, $data_poli->ID_POLI);
            if (empty($qdata)) {
            	$this->mranking->del($periode, $data_poli->ID_POLI);
            } else{
	            $nilai=0;
	            $jumlah_perbaikan=0;
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
	                if ($baris->NILAI_SERVQUAL < 0) {
	                	$jumlah_perbaikan++;
	                }
	            }
	            $data = array(
	                'ID_POLI'		=> $data_poli->ID_POLI,
	                'ID_PERIODE'	=> $periode,
	                'JUMLAH_PERBAIKAN'	=> $jumlah_perbaikan,
	                'NILAI_AKHIR'	=> $nilai
	            );
	            $this->mranking->get_update($data_poli->ID_RANKING,$data);
        	}
        }
        if ($responden == "delete_responden") {
        	$this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Data berhasil dihapus</div>");
        	redirect(base_url().'admin_responden');  	
        }else{
	        $data['ID_RESPONDEN']= $responden;
	        $data['ID_POLI']= $poli;
	        $data['title']= "Kritik & Saran";
	        $data['aksi']= "aksi_add";
	        $data['qpoli']= $this->mpoli->get_byid($poli);
	        $data['qresponden']= $this->mresponden->get_responden_byid($responden);
	        $this->load->view('responden/vformkritik',$data);	
        }
    }
    public function hitung_ulang($tujuan){
    	$periode = $this->mperiode->get_all();
    	foreach ($periode as $per) {
    		$qdata = $this->mperhitungan->by_periode($per->ID_PERIODE);
    		if (!empty($qdata)) {
	    		foreach($qdata as $baris){
		            $banding=$baris->NILAI_MATRIKS;
		            $qket = $this->msub->get_sub_byid($baris->ID_SUB);
		            foreach ($qket as $row) {
		                if ($row->JENIS_KRITERIA == 'Benefit') {
		                    $ket = 'benefit';
		                }else {
		                    $ket = 'cost';
		                }
		            }
		            if ($ket=='benefit') {
		                $qsub = $this->mperhitungan->by_sub_periode($baris->ID_SUB, $baris->ID_PERIODE);
		                foreach ($qsub as $row) {
		                    if ($row->NILAI_MATRIKS > $banding) {
		                        $banding = $row->NILAI_MATRIKS;
		                    }
		                }
		                $nilaim=$baris->NILAI_MATRIKS;
		                $NILAI_NORMALISASI = $nilaim/$banding;
		            }else{
		                $qsub = $this->mperhitungan->by_sub_periode($baris->ID_SUB, $baris->ID_PERIODE);
		                foreach ($qsub as $row) {
		                    if ($row->NILAI_MATRIKS < $banding) {
		                        $banding = $row->NILAI_MATRIKS;
		                    }
		                }
		                $nilaim=$baris->NILAI_MATRIKS;
		                $NILAI_NORMALISASI = $banding/$nilaim;
		            }
		            $data = array(
		                'NILAI_NORMALISASI'=> $NILAI_NORMALISASI
		            );
		            $this->mperhitungan->get_update($baris->ID_NILAI_PERHITUNGAN,$data);
		        }
		        $qpoli = $this->mranking->get_byperiode($per->ID_PERIODE);
	        	foreach ($qpoli as $data_poli) {
		            $qdata = $this->mperhitungan->by_periode_poli($per->ID_PERIODE, $data_poli->ID_POLI);
		            $nilai=0;
		            $jumlah_perbaikan=0;
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
		                if ($baris->NILAI_SERVQUAL < 0) {
		                	$jumlah_perbaikan++;
		                }
		            }
		            $data = array(
		                'ID_POLI'		=> $data_poli->ID_POLI,
		                'ID_PERIODE'	=> $per->ID_PERIODE,
		                'JUMLAH_PERBAIKAN'	=> $jumlah_perbaikan,
		                'NILAI_AKHIR'	=> $nilai
		            );
		            $this->mranking->get_update($data_poli->ID_RANKING,$data);
	       		}
	    	}
    	}
    	if($tujuan=="delete_poli") {
        	$this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Data berhasil dihapus $ket</div>");
        	redirect(base_url().'admin_poli');
        }else{
        	$this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Data berhasil dihapus</div>");
        	redirect(base_url().'admin_kriteria');
        }
    }

	public function detail($id){
        $data['title'] = 'Detail Responden';
        $data['qresponden'] = $this->mresponden->get_all_byid($id);
        $data2['qsurvei'] = $this->msurvei->get_all_byidresponden($id);
        $data2['ID_RESPONDEN'] = $id;
        $this->load->view('admin/vdetresponden',$data);
        $this->load->view('admin/vsurvei',$data2);
    }

 	public function filter($filter=null){
 		if ($filter==null) {
 			$data['title'] = 'Data Responden';
	 	 	$filter = $this->input->get('ID_POLI');			
			$dari = $this->uri->segment('3');
			$data['qresponden'] = $this->mresponden->filter_poli($filter);
			$data['filter'] = $filter;
			$qpoli = $this->mpoli->get_byid($filter);
			$jumlah=0;
			foreach ($data['qresponden'] as $row) {
				$jumlah++;
			}
			$config['base_url'] = base_url().'admin_responden/filter/'.$filter;
			$config['per_page'] = 5;
			$this->pagination->initialize($config); 
			$data['qpoli']=$this->mpoli->get_byid($filter);
			$data['qperiode']=$this->mperiode->get_all();
			$this->load->view('admin/vresponden_poli',$data);
 		}else{
 			$data['title'] = 'Data Responden';
			$filter = $this->uri->segment(3);
	 	 	$periode = $this->input->get('ID_PERIODE');
			$dari = $this->uri->segment('4');
			$data['qresponden'] = $this->mresponden->filter_poliperiode($filter,$periode);
			$data['filter'] = $filter;
			$data['periode'] = $periode;
			$jumlah=0;
			foreach ($data['qresponden'] as $row) {
				$jumlah++;
			}
			$config['base_url'] = base_url().'admin_responden/filter/'.$filter;
			$config['per_page'] = 5;
			
			$qpoli = $this->mpoli->get_byid($filter);
			$data['qperiode']=$this->mperiode->get_all();
			foreach ($qpoli as $key) {
				$data['poli'] = $key->NAMA;
			}
			$this->pagination->initialize($config); 
			$this->load->view('admin/vresponden_poli',$data);
 		}
 	}
	public function search() {
		$ID_RESPONDEN = addslashes($this->input->post('ID_RESPONDEN'));
	    $data['title'] = 'Daftar Penilaian poli';
	    $data['qsurvei'] = $this->msurvei->get_all();
	    $data['qresponden'] = $this->mresponden->get_sort($ID_RESPONDEN);
		$this->load->view('admin/vresponden',$data);
	}

}