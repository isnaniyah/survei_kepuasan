<?php
class Mperiode extends CI_Model {

    var $tabel = 'periode';

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
    function get_all_desc() {
        $this->db->from($this->tabel);
        $this->db->order_by('ID_PERIODE', 'desc');

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }
    function get_periode_byid($ID_PERIODE) {
        $this->db->from($this->tabel);
        $this->db->where('ID_PERIODE', $ID_PERIODE);

        $query = $this->db->get();

        if ($query->num_rows() == 1) {
            return $query->result();
        }
    }
    function get_periode_byisi($bulan, $tahun) {
        $this->db->from($this->tabel);
        $this->db->where('BULAN', $bulan);
        $this->db->where('TAHUN', $tahun);

        $query = $this->db->get();

        if ($query->num_rows() == 1) {
            return $query->result();
        }
    }
    function get_periode_by($ID_PERIODE) {
        $this->db->from($this->tabel);
        $this->db->where('ID_PERIODE', $ID_PERIODE);

        $query = $this->db->get();

        if ($query->num_rows() >0 ) {
            return $query->result();
        }
    }
    function get_periode_byidresponden($ID_RESPONDEN) {
        $this->db->from($this->tabel);
        $this->db->where('ID_RESPONDEN', $ID_RESPONDEN);

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }
    function get_insert($data){
       $this->db->insert($this->tabel, $data);
       return TRUE;
    }
    function get_update($ID_PERIODE,$data) {

        $this->db->where('ID_PERIODE', $ID_PERIODE);
        $this->db->update($this->tabel, $data);

        return TRUE;
    }
    function del($ID_PERIODE) {
        $this->db->where('ID_PERIODE', $ID_PERIODE);
        $this->db->delete($this->tabel);
        if ($this->db->affected_rows() == 1) {
            return TRUE;
        }
        return FALSE;
    }
    function search($ID_PERIODE){
        $cari=$this->db->query("select * from periode where ID_PERIODE like '%$ID_PERIODE%'  ");
        return $cari->result();
    }
}
