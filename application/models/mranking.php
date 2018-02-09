<?php
class Mranking extends CI_Model {

    var $tabel = 'nilai_akhir';

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
    function get_all_dropdown() {
        $this->db->from($this->tabel);
        $result = $this->db->get();
        $return = array();
        if ($result->num_rows() > 0) {
            foreach($result->result_array() as $row) {
                $return[$row['ID_RANKING']] = $row['ranking'];
            }
        }
    }
    function get_bypoli_periode($ID_POLI,$ID_PERIODE) {
        $this->db->from($this->tabel);
        $this->db->where('ID_POLI', $ID_POLI);
        $this->db->where('ID_PERIODE', $ID_PERIODE);

        $query = $this->db->get();

        if ($query->num_rows() >0) {
            return $query->result();
        }
    }

    function get_byperiode($ID_PERIODE) {
        $this->db->from($this->tabel);
        $this->db->where('ID_PERIODE', $ID_PERIODE);

        $query = $this->db->get();

        if ($query->num_rows() >0) {
            return $query->result();
        }
    }
    function get_bysortperiode($ID_PERIODE) {
        $this->db->from($this->tabel);
        $this->db->where('nilai_akhir.ID_PERIODE', $ID_PERIODE);
        $this->db->join('periode', 'nilai_akhir.ID_PERIODE = periode.ID_PERIODE');
        $this->db->join('poli', 'nilai_akhir.ID_POLI = poli.ID_POLI');
        $this->db->order_by('nilai_akhir.NILAI_AKHIR', 'asc');

        $query = $this->db->get();

        if ($query->num_rows() >0) {
            return $query->result();
        }
    }
    function get_byperiode_poli($ID_POLI, $ID_PERIODE) {
        $this->db->from($this->tabel);
        $this->db->where('nilai_akhir.ID_PERIODE', $ID_PERIODE);
        $this->db->where('nilai_akhir.ID_POLI', $ID_POLI);
        $this->db->join('periode', 'nilai_akhir.ID_PERIODE = periode.ID_PERIODE');
        $this->db->join('poli', 'nilai_akhir.ID_POLI = poli.ID_POLI');
        $this->db->order_by('nilai_akhir.NILAI_AKHIR', 'asc');

        $query = $this->db->get();

        if ($query->num_rows() >0) {
            return $query->result();
        }
    }

    function get_join_periode($ID_PERIODE) {
        $this->db->select('*');    
        $this->db->from('nilai_akhir');
        $this->db->join('periode', 'nilai_akhir.ID_PERIODE = periode.ID_PERIODE');
        $this->db->join('poli', 'nilai_akhir.ID_POLI = poli.ID_POLI');
        $this->db->where('nilai_akhir.ID_PERIODE', $ID_PERIODE);
        $this->db->order_by('nilai_akhir.NILAI_AKHIR', 'desc');

        $query = $this->db->get();

        if ($query->num_rows() >0) {
            return $query->result();
        }
    }

    function get_sort($ID_PERIODE) {
        $this->db->select('*');    
        $this->db->from('nilai_akhir');
        $this->db->join('periode', 'nilai_akhir.ID_PERIODE = periode.ID_PERIODE');
        $this->db->join('poli', 'nilai_akhir.ID_POLI = poli.ID_POLI');
        $this->db->where('nilai_akhir.ID_PERIODE', $ID_PERIODE);
        $this->db->order_by('nilai_akhir.NILAI_AKHIR', 'asc');

        $query = $this->db->get();

        if ($query->num_rows() >0) {
            return $query->result();
        }
    }

    function get_rank() {
        $this->db->select('*');    
        $this->db->from('nilai_akhir');
        $this->db->join('periode', 'nilai_akhir.ID_PERIODE = periode.ID_PERIODE');
        $this->db->join('poli', 'nilai_akhir.ID_POLI = poli.ID_POLI');
        $this->db->order_by('nilai_akhir.NILAI_AKHIR', 'desc');

        $query = $this->db->get();

        if ($query->num_rows() >0) {
            return $query->result();
        }
    }

    function get_byid($ID_RANKING) {
        $this->db->from($this->tabel);
        $this->db->where('ID_RANKING', $ID_RANKING);
        $query = $this->db->get();

        if ($query->num_rows() == 1) {
            return $query->result();
        }
    }

    function get_insert($data){
       $this->db->insert($this->tabel, $data);
       return TRUE;
    }

    function get_update($ID_RANKING,$data) {

        $this->db->where('ID_RANKING', $ID_RANKING);
        $this->db->update($this->tabel, $data);

        return TRUE;
    }
    function del($ID_PERIODE, $ID_POLI) {
        $this->db->where('ID_PERIODE', $ID_PERIODE);
        $this->db->where('ID_POLI', $ID_POLI);
        $this->db->delete($this->tabel);
        if ($this->db->affected_rows() == 1) {

            return TRUE;
        }
        return FALSE;
    }
    function del_periode($ID_PERIODE) {
        $this->db->where('ID_PERIODE', $ID_PERIODE);
        $this->db->delete($this->tabel);
        if ($this->db->affected_rows() == 1) {

            return TRUE;
        }
        return FALSE;
    }
    function hapus($ID_RANKING) {
        $this->db->where('ID_RANKING', $ID_RANKING);
        $this->db->delete($this->tabel);
        if ($this->db->affected_rows() == 1) {

            return TRUE;
        }
        return FALSE;
    }
}
?>
