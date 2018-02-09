<?php
class Muser extends CI_Model {

    var $tabel = 'user';

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

    function get_byid($USERNAME) {
        $this->db->from($this->tabel);
        $this->db->where('USERNAME', $USERNAME);

        $query = $this->db->get();

        if ($query->num_rows() == 1) {
            return $query->result();
        }
    }

    function get_insert($data){
       $this->db->insert($this->tabel, $data);
       return TRUE;
    }

    function get_update($USERNAME,$data) {

        $this->db->where('USERNAME', $USERNAME);
        $this->db->update($this->tabel, $data);

        return TRUE;
    }
    function del($USERNAME) {
        $this->db->where('USERNAME', $USERNAME);
        $this->db->delete($this->tabel);
        if ($this->db->affected_rows() == 1) {

            return TRUE;
        }
        return FALSE;
    }
}
?>
