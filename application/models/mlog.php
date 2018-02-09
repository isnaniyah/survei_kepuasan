<?php
class Mlog extends CI_Model {

    var $tabel = 'log';

    function __construct() {
        parent::__construct();
    }
	function get_all($batas=null, $offset=null) {
        $this->db->from($this->tabel);
        $this->db->order_by('WAKTU', 'desc');
        if($batas != null){
           $this->db->limit($batas,$offset);
        }

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        }
	}
    function jumlah() {
        $this->db->from($this->tabel);
        $this->db->order_by('WAKTU', 'desc');

        return $this->db->get()->num_rows();
    }
    
    function get_byid($ID_LOG) {
        $this->db->from($this->tabel);
        $this->db->where('ID_LOG', $ID_LOG);

        $query = $this->db->get();

        if ($query->num_rows() == 1) {
            return $query->result();
        }
    }

    function filter_admin($batas=null, $offset=null,$admin) {
        $this->db->from($this->tabel);
        $this->db->where('USERNAME', $admin);
        $this->db->order_by('WAKTU', 'desc');
        if($batas != null){
           $this->db->limit($batas,$offset);
        }
        return $this->db->get()->result();
    }

    function jumlah_admin($admin) {
        $this->db->from($this->tabel);
        $this->db->where('USERNAME', $admin);
        $this->db->order_by('WAKTU', 'desc');
        return $this->db->get()->num_rows();
    }

    function filter_tgl($batas=null, $offset=null,$tgl) {
        $this->db->from($this->tabel);
        $this->db->where('WAKTU <=', $tgl.' 23:59:59');
        $this->db->where('WAKTU >=', $tgl.' 00:00:00');
        $this->db->order_by('WAKTU', 'desc');
        if($batas != null){
           $this->db->limit($batas,$offset);
        }
        return $this->db->get()->result();
    }

    function jumlah_tgl($tgl) {
        $this->db->from($this->tabel);
        $this->db->where('WAKTU <=', $tgl.' 23:59:59');
        $this->db->where('WAKTU >=', $tgl.' 00:00:00');
        $this->db->order_by('WAKTU', 'desc');
        return $this->db->get()->num_rows();
    }

    function filter_tgl_admin($batas=null, $offset=null,$tgl, $admin) {
        $this->db->from($this->tabel);
        $this->db->where('USERNAME', $admin);
        $this->db->where('WAKTU <=', $tgl.' 23:59:59');
        $this->db->where('WAKTU >=', $tgl.' 00:00:00');
        $this->db->order_by('WAKTU', 'desc');
        if($batas != null){
           $this->db->limit($batas,$offset);
        }

        return $this->db->get()->result();
    }
    function jumlah_tgl_admin($tgl, $admin) {
        $this->db->from($this->tabel);
        $this->db->where('USERNAME', $admin);
        $this->db->where('WAKTU <=', $tgl.' 23:59:59');
        $this->db->where('WAKTU >=', $tgl.' 00:00:00');
        $this->db->order_by('WAKTU', 'desc');

        return $this->db->get()->num_rows();
    }

    function get_insert($data){
       $this->db->insert($this->tabel, $data);
       return TRUE;
    }

    function get_update($ID_LOG,$data) {

        $this->db->where('ID_LOG', $ID_LOG);
        $this->db->update($this->tabel, $data);

        return TRUE;
    }
    function del($ID_LOG) {
        $this->db->where('ID_LOG', $ID_LOG);
        $this->db->delete($this->tabel);
        if ($this->db->affected_rows() == 1) {

            return TRUE;
        }
        return FALSE;
    }
}
?>
