<?php
class Mpoli extends CI_Model {

    var $tabel = 'poli';

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
    
    function get_byid($ID_POLI) {
        $this->db->from($this->tabel);
        $this->db->where('ID_POLI', $ID_POLI);

        $query = $this->db->get();

        if ($query->num_rows() == 1) {
            return $query->result();
        }
    }

    function get_insert($data){
       $this->db->insert($this->tabel, $data);
       return TRUE;
    }

    function get_update($ID_POLI,$data) {

        $this->db->where('ID_POLI', $ID_POLI);
        $this->db->update($this->tabel, $data);

        return TRUE;
    }
    function del($ID_POLI) {
        $this->db->where('ID_POLI', $ID_POLI);
        $this->db->delete($this->tabel);
        if ($this->db->affected_rows() == 1) {

            return TRUE;
        }
        return FALSE;
    }
}
?>
