<?php
class Msurvei extends CI_Model {

    var $tabel = 'nilai_survei';

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
    function get_survei_byid($ID_SURVEI) {
        $this->db->from($this->tabel);
        $this->db->where('ID_SURVEI', $ID_SURVEI);

        $query = $this->db->get();

        if ($query->num_rows() == 1) {
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
    
    function get_survei_by($ID_SURVEI) {
        $this->db->from($this->tabel);
        $this->db->where('ID_SURVEI', $ID_SURVEI);

        $query = $this->db->get();

        if ($query->num_rows() >0 ) {
            return $query->result();
        }
    }
    function get_survei_byperiode($periode) {
        $this->db->from($this->tabel);
        $this->db->where('ID_PERIODE', $periode);

        $query = $this->db->get();

        if ($query->num_rows() >0 ) {
            return $query->result();
        }
    }
    function get_all_byidresponden($ID_RESPONDEN) {
        $this->db->select('*');
        $this->db->from('nilai_survei');
        $this->db->join('responden', 'responden.ID_RESPONDEN = nilai_survei.ID_RESPONDEN');
        $this->db->join('periode', 'nilai_survei.ID_PERIODE = periode.ID_PERIODE');
        $this->db->join('sub_kriteria', 'nilai_survei.ID_SUB = sub_kriteria.ID_SUB');
        $this->db->join('poli', 'nilai_survei.ID_POLI = poli.ID_POLI');
        $this->db->where('responden.ID_RESPONDEN', $ID_RESPONDEN);
        return $this->db->get()->result();
    }
    function get_all_join($periode) {
        $this->db->select('*');
        $this->db->from('nilai_survei');
        $this->db->join('responden', 'responden.ID_RESPONDEN = nilai_survei.ID_RESPONDEN');
        $this->db->join('periode', 'nilai_survei.ID_PERIODE = periode.ID_PERIODE');
        $this->db->join('sub_kriteria', 'nilai_survei.ID_SUB = sub_kriteria.ID_SUB');
        $this->db->join('poli', 'nilai_survei.ID_POLI = poli.ID_POLI');
        $this->db->where('periode.ID_PERIODE', $periode);
        return $this->db->get()->result();
    }
    function get_insert($data){
       $this->db->insert($this->tabel, $data);
       return TRUE;
    }
    function get_update($ID_SURVEI,$data) {

        $this->db->where('ID_SURVEI', $ID_SURVEI);
        $this->db->update($this->tabel, $data);

        return TRUE;
    }
    function del($ID_SURVEI) {
        $this->db->where('ID_SURVEI', $ID_SURVEI);
        $this->db->delete($this->tabel);
        if ($this->db->affected_rows() == 1) {
            return TRUE;
        }
        return FALSE;
    }
    function search($ID_SURVEI){
        $cari=$this->db->query("select * from survei_responden where ID_SURVEI like '%$ID_SURVEI%'  ");
        return $cari->result();
    }
}
