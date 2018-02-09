<?php
class Mkriteria extends CI_Model {

    var $tabel = 'kriteria';

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
    function get_kriteria_byid($ID_KRITERIA) {
        $this->db->from($this->tabel);
        $this->db->where('ID_KRITERIA', $ID_KRITERIA);

        $query = $this->db->get();

        if ($query->num_rows() == 1) {
            return $query->result();
        }
    }
    function get_insert($data){
       $this->db->insert($this->tabel, $data);
       return TRUE;
    }
    function get_update($ID_KRITERIA,$data) {

        $this->db->where('ID_KRITERIA', $ID_KRITERIA);
        $this->db->update($this->tabel, $data);

        return TRUE;
    }
    function del($ID_KRITERIA) {
        $this->db->where('ID_KRITERIA', $ID_KRITERIA);
        $this->db->delete($this->tabel);
        if ($this->db->affected_rows() == 1) {
            return TRUE;
        }
        return FALSE;
    }
    function search($ID_KRITERIA){
        $cari=$this->db->query("select * from kriteria where ID_KRITERIA like '%$ID_KRITERIA%'  ");
        return $cari->result();
    }
}
