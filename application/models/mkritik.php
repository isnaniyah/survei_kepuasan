<?php
class Mkritik extends CI_Model {

    var $tabel = 'kritik_saran';

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

    function jumlah_all() {
        $this->db->from($this->tabel);
        $this->db->join('responden', 'kritik_saran.ID_RESPONDEN = responden.ID_RESPONDEN');
        $this->db->order_by('TANGGAL_MASUK', 'desc');
        return $this->db->get()->num_rows();
    }
    function get_all_desc($batas=null, $offset=null) {
        $this->db->from($this->tabel);
        $this->db->join('responden', 'kritik_saran.ID_RESPONDEN = responden.ID_RESPONDEN');
        $this->db->order_by('TANGGAL_MASUK', 'desc');
        if($batas != null){
           $this->db->limit($batas,$offset);
        }
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }

    function get_by_responden($id) {
        $this->db->from($this->tabel);
        $this->db->where('ID_KRITIK_SARAN', $id);
        $this->db->join('responden', 'kritik_saran.ID_RESPONDEN = responden.ID_RESPONDEN');
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }

    function get_by_tgl($batas=null, $offset=null,$tgl) {
        $this->db->from($this->tabel);
        $this->db->join('responden', 'kritik_saran.ID_RESPONDEN = responden.ID_RESPONDEN');
        $this->db->where('TANGGAL_MASUK', $tgl);
        if($batas != null){
           $this->db->limit($batas,$offset);
        }
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }

    function jumlah_tgl($tgl) {
        $this->db->from($this->tabel);
        $this->db->join('responden', 'kritik_saran.ID_RESPONDEN = responden.ID_RESPONDEN');
        $this->db->where('TANGGAL_MASUK', $tgl);
        return $this->db->get()->num_rows();
    }

    function get_byid($ID_KRITIK_SARAN) {
        $this->db->from($this->tabel);
        $this->db->where('ID_KRITIK_SARAN', $ID_KRITIK_SARAN);

        $query = $this->db->get();

        if ($query->num_rows() == 1) {
            return $query->result();
        }
    }

    function get_insert($data){
       $this->db->insert($this->tabel, $data);
       return TRUE;
    }

    function get_update($ID_KRITIK_SARAN,$data) {

        $this->db->where('ID_KRITIK_SARAN', $ID_KRITIK_SARAN);
        $this->db->update($this->tabel, $data);

        return TRUE;
    }
    function del($ID_KRITIK_SARAN) {
        $this->db->where('ID_KRITIK_SARAN', $ID_KRITIK_SARAN);
        $this->db->delete($this->tabel);
        if ($this->db->affected_rows() == 1) {

            return TRUE;
        }
        return FALSE;
    }
}
?>
