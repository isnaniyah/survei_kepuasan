<?php
class Mperhitungan extends CI_Model {

    var $tabel = 'nilai_perhitungan';

    function __construct() {
        parent::__construct();
    }
    function get_all() {
        $this->db->from($this->tabel);

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }
    function get_survei_byid($ID_NILAI_PERHITUNGAN) {
        $this->db->from($this->tabel);
        $this->db->where('ID_NILAI_PERHITUNGAN', $ID_NILAI_PERHITUNGAN);

        $query = $this->db->get();

        if ($query->num_rows() == 1) {
            return $query->result();
        }
    }
    function get_survei_by($ID_NILAI_PERHITUNGAN) {
        $this->db->from($this->tabel);
        $this->db->where('ID_NILAI_PERHITUNGAN', $ID_NILAI_PERHITUNGAN);

        $query = $this->db->get();

        if ($query->num_rows() >0 ) {
            return $query->result();
        }
    }
    function get_servqual($ID_POLI, $ID_PERIODE) {
        $this->db->from($this->tabel);
        $this->db->where('ID_POLI', $ID_POLI);
        $this->db->where('ID_PERIODE', $ID_PERIODE);
        $this->db->join('sub_kriteria', 'nilai_perhitungan.ID_SUB = sub_kriteria.ID_SUB');
        $this->db->join('kriteria', 'sub_kriteria.ID_KRITERIA = kriteria.ID_KRITERIA');
        $this->db->order_by('nilai_perhitungan.NILAI_SERVQUAL', 'asc');

        $query = $this->db->get();

        if ($query->num_rows() >0 ) {
            return $query->result();
        }
    }
    function get_hitung_periode( $ID_PERIODE) {
        $this->db->from($this->tabel);
        $this->db->where('ID_PERIODE', $ID_PERIODE);
        $this->db->join('poli', 'nilai_perhitungan.ID_POLI = poli.ID_POLI');
        $this->db->join('sub_kriteria', 'nilai_perhitungan.ID_SUB = sub_kriteria.ID_SUB');
        $this->db->join('kriteria', 'sub_kriteria.ID_KRITERIA = kriteria.ID_KRITERIA');
        $this->db->order_by('sub_kriteria.ID_SUB', 'asc');

        $query = $this->db->get();

        if ($query->num_rows() >0 ) {
            return $query->result();
        }
    }
    function get_servqual_periode($ID_PERIODE) {
        $this->db->from($this->tabel);
        $this->db->where('ID_PERIODE', $ID_PERIODE);
        $this->db->join('poli', 'nilai_perhitungan.ID_POLI = poli.ID_POLI');
        $this->db->join('sub_kriteria', 'nilai_perhitungan.ID_SUB = sub_kriteria.ID_SUB');
        $this->db->join('kriteria', 'sub_kriteria.ID_KRITERIA = kriteria.ID_KRITERIA');
        $this->db->order_by('nilai_perhitungan.NILAI_SERVQUAL', 'asc');

        $query = $this->db->get();

        if ($query->num_rows() >0 ) {
            return $query->result();
        }
    }

    function by_sub_periode($sub, $periode) {
        $this->db->from($this->tabel);
        $this->db->where('ID_SUB', $sub);
        $this->db->where('ID_PERIODE', $periode);

        $query = $this->db->get();

        if ($query->num_rows() >0 ) {
            return $query->result();
        }
    }

    function by_periode($periode) {
        $this->db->from($this->tabel);
        $this->db->where('ID_PERIODE', $periode);

        $query = $this->db->get();

        if ($query->num_rows() >0 ) {
            return $query->result();
        }
    }
    function by_periode_poli($periode, $poli) {
        $this->db->from($this->tabel);
        $this->db->where('ID_PERIODE', $periode);
        $this->db->where('ID_POLI', $poli);

        $query = $this->db->get();

        if ($query->num_rows() >0 ) {
            return $query->result();
        }
    }
    function by_periode_poli_sub($periode, $poli, $sub) {
        $this->db->from($this->tabel);
        $this->db->where('ID_PERIODE', $periode);
        $this->db->where('ID_POLI', $poli);
        $this->db->where('ID_SUB', $sub);

        $query = $this->db->get();

        if ($query->num_rows() >0 ) {
            return $query->result();
        }
    }
    function get_insert($data){
       $this->db->insert($this->tabel, $data);
       return TRUE;
    }
    function get_update($ID_NILAI_PERHITUNGAN,$data) {

        $this->db->where('ID_NILAI_PERHITUNGAN', $ID_NILAI_PERHITUNGAN);
        $this->db->update($this->tabel, $data);

        return TRUE;
    }
    function del($ID_NILAI_PERHITUNGAN) {
        $this->db->where('ID_NILAI_PERHITUNGAN', $ID_NILAI_PERHITUNGAN);
        $this->db->delete($this->tabel);
        if ($this->db->affected_rows() == 1) {
            return TRUE;
        }
        return FALSE;
    }
    function search($ID_NILAI_PERHITUNGAN){
        $cari=$this->db->query("select * from survei_responden where ID_NILAI_PERHITUNGAN like '%$ID_NILAI_PERHITUNGAN%'  ");
        return $cari->result();
    }
}
