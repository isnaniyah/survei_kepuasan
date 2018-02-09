<?php
class Msub extends CI_Model {

    var $tabel = 'sub_kriteria';

    function __construct() {
        parent::__construct();
    }
    function get_all() {
        $this->db->from($this->tabel);
        $this->db->order_by("STATUS", "asc");

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }
    function getall() {
        $this->db->from($this->tabel);

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }

    function get_sub_aktif() {
        $this->db->from($this->tabel);
        $this->db->where("STATUS", "Aktif");

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }
    function get_sub_byid($ID_SUB) {
        $this->db->from($this->tabel);
        $this->db->where('ID_SUB', $ID_SUB);

        $query = $this->db->get();

        if ($query->num_rows() == 1) {
            return $query->result();
        }
    }
    function get_sub_by($ID_SUB) {
        $this->db->from($this->tabel);
        $this->db->where('ID_SUB', $ID_SUB);

        $query = $this->db->get();

        if ($query->num_rows() >0 ) {
            return $query->result();
        }
    }
    function get_sub_byidkriteria($ID_KRITERIA) {
        $this->db->from($this->tabel);
        $this->db->where('ID_KRITERIA', $ID_KRITERIA);
        $this->db->order_by("STATUS", "asc");

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }
    function get_sub_byidkriteria_bystatus($ID_KRITERIA) {
        $this->db->from($this->tabel);
        $this->db->where('ID_KRITERIA', $ID_KRITERIA);
        $this->db->where('STATUS', "Aktif");

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }
    function get_insert($data){
       $this->db->insert($this->tabel, $data);
       return TRUE;
    }
    function get_update($ID_SUB,$data) {

        $this->db->where('ID_SUB', $ID_SUB);
        $this->db->update($this->tabel, $data);

        return TRUE;
    }
    function del($ID_SUB) {
        $this->db->where('ID_SUB', $ID_SUB);
        $this->db->delete($this->tabel);
        if ($this->db->affected_rows() == 1) {
            return TRUE;
        }
        return FALSE;
    }
    function search($ID_SUB){
        $cari=$this->db->query("select * from sub_kriteria where ID_SUB like '%$ID_SUB%'  ");
        return $cari->result();
    }
}
