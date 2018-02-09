<?php
class Mnilai extends CI_Model {

    var $tabel = 'nilai';

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
    function get_detail_supplier($ID_SUPPLIER) {
        $this->db->from($this->tabel);
        $this->db->where('ID_SUPPLIER', $ID_SUPPLIER);
        $this->db->group_by('ID_TAHUN');

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }

    function get_bysupplier($ID_SUPPLIER) {
        $this->db->from($this->tabel);
        $this->db->where('ID_SUPPLIER', $ID_SUPPLIER);

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }
    function get_bysubtahun($ID_SUB, $ID_TAHUN) {
        $this->db->from($this->tabel);
        $this->db->where('ID_SUB', $ID_SUB);
        $this->db->where('ID_TAHUN', $ID_TAHUN);

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }

    function get_bytahun($ID_TAHUN,$ID_SUPPLIER) {
        $this->db->from($this->tabel);
        $this->db->where('ID_SUPPLIER', $ID_SUPPLIER);
        $this->db->where('ID_TAHUN',$ID_TAHUN);

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }

    function get_tahun($ID_TAHUN) {
        $this->db->from($this->tabel);
        $this->db->where('ID_TAHUN',$ID_TAHUN);

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }

    function get_byid($ID_NILAI) {
        $this->db->from($this->tabel);
        $this->db->where('ID_NILAI', $ID_NILAI);

        $query = $this->db->get();

        if ($query->num_rows() == 1) {
            return $query->result();
        }
    }

    function get_insert($data){
       $this->db->insert($this->tabel, $data);
       return TRUE;
    }

    function get_update($ID_NILAI,$data) {

        $this->db->where('ID_NILAI', $ID_NILAI);
        $this->db->update($this->tabel, $data);

        return TRUE;
    }
    function del($ID_TAHUN, $ID_SUPPLIER) {
        $this->db->where('ID_TAHUN', $ID_TAHUN);
        $this->db->where('ID_SUPPLIER', $ID_SUPPLIER);
        $this->db->delete($this->tabel);
        if ($this->db->affected_rows() == 1) {

            return TRUE;
        }
        return FALSE;
    }
}
?>
