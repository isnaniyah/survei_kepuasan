<?php
class Mresponden extends CI_Model {

    var $tabel = 'responden';
    private $primary="ID_RESPONDEN";

    function __construct() {
        parent::__construct();
    }
    function lihat($sampai,$dari){
        $this->db->from('responden');
        return $query = $this->db->get('',$sampai,$dari)->result();
        
    }
    function jumlah(){
        return $this->db->get('responden')->num_rows();
    }
    function get_responden_byid($id) {
        $this->db->from($this->tabel);
        $this->db->where('ID_RESPONDEN', $id);

        $query = $this->db->get();

        if ($query->num_rows() == 1) {
            return $query->result();
        }
    }
    function getby_name_time($name,$time) {
        $this->db->from($this->tabel);
        $this->db->where('NAMA', $name);
        $this->db->where('WAKTU_INPUT', $time);

        $query = $this->db->get();

        if ($query->num_rows() == 1) {
            return $query->result();
        }
    }

    function get_insert($data){
       $this->db->insert($this->tabel, $data);
       return TRUE;
    }

    function get_update($id,$data) {

        $this->db->where('ID_RESPONDEN', $id);
        $this->db->update($this->tabel, $data);

        return TRUE;
    }
    function del_responden($id) {
        $this->db->where('ID_RESPONDEN', $id);
        $this->db->delete($this->tabel);
        if ($this->db->affected_rows() == 1) {

            return TRUE;
        }
        return FALSE;
    }

    function get_all($periode=null, $poli=null){
        $this->db->select('*');
        $this->db->from('responden');
        $this->db->join('responden_pendidikan', 'responden.ID_PENDIDIKAN = responden_pendidikan.ID_PENDIDIKAN');
        $this->db->join('responden_pekerjaan', 'responden.ID_PEKERJAAN = responden_pekerjaan.ID_PEKERJAAN');
        $this->db->join('responden_tanggungan_biaya', 'responden.ID_TANGGUNGAN_BIAYA = responden_tanggungan_biaya.ID_TANGGUNGAN_BIAYA');
        $this->db->join('nilai_survei', 'responden.ID_RESPONDEN = nilai_survei.ID_RESPONDEN');
        $this->db->join('periode', 'nilai_survei.ID_PERIODE = periode.ID_PERIODE');
        $this->db->join('sub_kriteria', 'nilai_survei.ID_SUB = sub_kriteria.ID_SUB');
        $this->db->join('poli', 'nilai_survei.ID_POLI = poli.ID_POLI');
        $this->db->group_by('responden.ID_RESPONDEN');
        $this->db->order_by('poli.ID_POLI', 'asc');
        if ($periode != null) {
            if ($periode == "kosong") {
                $this->db->where('poli.ID_POLI', $poli);
            } elseif ($poli=="kosong") {
                $this->db->where('nilai_survei.ID_PERIODE', $periode);
            }else{
                $this->db->where('poli.ID_POLI', $poli);
                $this->db->where('nilai_survei.ID_PERIODE', $periode);
            }
        }
        return $this->db->get()->result(); 
    }

    function get_join_all($batas=null, $offset=null){
        $this->db->select('*');
        $this->db->from('responden');
        $this->db->join('responden_pendidikan', 'responden.ID_PENDIDIKAN = responden_pendidikan.ID_PENDIDIKAN');
        $this->db->join('responden_pekerjaan', 'responden.ID_PEKERJAAN = responden_pekerjaan.ID_PEKERJAAN');
        $this->db->join('responden_tanggungan_biaya', 'responden.ID_TANGGUNGAN_BIAYA = responden_tanggungan_biaya.ID_TANGGUNGAN_BIAYA');
        $this->db->join('nilai_survei', 'responden.ID_RESPONDEN = nilai_survei.ID_RESPONDEN');
        $this->db->join('periode', 'nilai_survei.ID_PERIODE = periode.ID_PERIODE');
        $this->db->join('sub_kriteria', 'nilai_survei.ID_SUB = sub_kriteria.ID_SUB');
        $this->db->join('poli', 'nilai_survei.ID_POLI = poli.ID_POLI');
        $this->db->order_by('responden.WAKTU_INPUT', 'desc');
        if($batas != null){
           $this->db->limit($batas,$offset);
        }
        return $this->db->get()->result();  
    }

    function get_all_byid($id){
        $this->db->select('*');
        $this->db->from('responden');
        $this->db->join('responden_pendidikan', 'responden.ID_PENDIDIKAN = responden_pendidikan.ID_PENDIDIKAN');
        $this->db->join('responden_pekerjaan', 'responden.ID_PEKERJAAN = responden_pekerjaan.ID_PEKERJAAN');
        $this->db->join('responden_tanggungan_biaya', 'responden.ID_TANGGUNGAN_BIAYA = responden_tanggungan_biaya.ID_TANGGUNGAN_BIAYA');
        $this->db->join('nilai_survei', 'responden.ID_RESPONDEN = nilai_survei.ID_RESPONDEN');
        $this->db->join('periode', 'nilai_survei.ID_PERIODE = periode.ID_PERIODE');
        $this->db->join('sub_kriteria', 'nilai_survei.ID_SUB = sub_kriteria.ID_SUB');
        $this->db->join('poli', 'nilai_survei.ID_POLI = poli.ID_POLI');
        $this->db->where('responden.ID_RESPONDEN', $id);
        return $this->db->get()->result();  
    }

    function get_alljoin($batas=null, $offset=null){
        $this->db->select('*');
        $this->db->from('responden');
        $this->db->join('responden_pendidikan', 'responden.ID_PENDIDIKAN = responden_pendidikan.ID_PENDIDIKAN');
        $this->db->join('responden_pekerjaan', 'responden.ID_PEKERJAAN = responden_pekerjaan.ID_PEKERJAAN');
        $this->db->join('responden_tanggungan_biaya', 'responden.ID_TANGGUNGAN_BIAYA = responden_tanggungan_biaya.ID_TANGGUNGAN_BIAYA');
        $this->db->join('nilai_survei', 'responden.ID_RESPONDEN = nilai_survei.ID_RESPONDEN');
        $this->db->join('periode', 'nilai_survei.ID_PERIODE = periode.ID_PERIODE');
        $this->db->join('sub_kriteria', 'nilai_survei.ID_SUB = sub_kriteria.ID_SUB');
        $this->db->join('poli', 'nilai_survei.ID_POLI = poli.ID_POLI');
        $this->db->group_by('responden.ID_RESPONDEN');
        $this->db->order_by('responden.WAKTU_INPUT', 'desc');
        if($batas != null){
           $this->db->limit($batas,$offset);
        }
        return $this->db->get()->result(); 
    }
    function jumlah_alljoin(){
        $this->db->select('*');
        $this->db->from('responden');
        $this->db->join('responden_pendidikan', 'responden.ID_PENDIDIKAN = responden_pendidikan.ID_PENDIDIKAN');
        $this->db->join('responden_pekerjaan', 'responden.ID_PEKERJAAN = responden_pekerjaan.ID_PEKERJAAN');
        $this->db->join('responden_tanggungan_biaya', 'responden.ID_TANGGUNGAN_BIAYA = responden_tanggungan_biaya.ID_TANGGUNGAN_BIAYA');
        $this->db->join('nilai_survei', 'responden.ID_RESPONDEN = nilai_survei.ID_RESPONDEN');
        $this->db->join('periode', 'nilai_survei.ID_PERIODE = periode.ID_PERIODE');
        $this->db->join('sub_kriteria', 'nilai_survei.ID_SUB = sub_kriteria.ID_SUB');
        $this->db->join('poli', 'nilai_survei.ID_POLI = poli.ID_POLI');
        $this->db->group_by('responden.ID_RESPONDEN');
        $this->db->order_by('responden.WAKTU_INPUT', 'desc');
        return $this->db->get()->num_rows(); 
    }

    function filter_poli($batas=null, $offset=null, $poli){
        $this->db->select('*');
        $this->db->from('responden');
        $this->db->join('responden_pendidikan', 'responden.ID_PENDIDIKAN = responden_pendidikan.ID_PENDIDIKAN');
        $this->db->join('responden_pekerjaan', 'responden.ID_PEKERJAAN = responden_pekerjaan.ID_PEKERJAAN');
        $this->db->join('responden_tanggungan_biaya', 'responden.ID_TANGGUNGAN_BIAYA = responden_tanggungan_biaya.ID_TANGGUNGAN_BIAYA');
        $this->db->join('nilai_survei', 'responden.ID_RESPONDEN = nilai_survei.ID_RESPONDEN');
        $this->db->join('periode', 'nilai_survei.ID_PERIODE = periode.ID_PERIODE');
        $this->db->join('sub_kriteria', 'nilai_survei.ID_SUB = sub_kriteria.ID_SUB');
        $this->db->join('poli', 'nilai_survei.ID_POLI = poli.ID_POLI');
        $this->db->group_by('responden.ID_RESPONDEN');
        $this->db->order_by('responden.WAKTU_INPUT', 'desc');
        $this->db->where('nilai_survei.ID_POLI', $poli);
        if($batas != null){
           $this->db->limit($batas,$offset);
        }
        return $this->db->get()->result(); 
    }
    function jumlah_poli($poli){
        $this->db->select('*');
        $this->db->from('responden');
        $this->db->join('responden_pendidikan', 'responden.ID_PENDIDIKAN = responden_pendidikan.ID_PENDIDIKAN');
        $this->db->join('responden_pekerjaan', 'responden.ID_PEKERJAAN = responden_pekerjaan.ID_PEKERJAAN');
        $this->db->join('responden_tanggungan_biaya', 'responden.ID_TANGGUNGAN_BIAYA = responden_tanggungan_biaya.ID_TANGGUNGAN_BIAYA');
        $this->db->join('nilai_survei', 'responden.ID_RESPONDEN = nilai_survei.ID_RESPONDEN');
        $this->db->join('periode', 'nilai_survei.ID_PERIODE = periode.ID_PERIODE');
        $this->db->join('sub_kriteria', 'nilai_survei.ID_SUB = sub_kriteria.ID_SUB');
        $this->db->join('poli', 'nilai_survei.ID_POLI = poli.ID_POLI');
        $this->db->group_by('responden.ID_RESPONDEN');
        $this->db->order_by('responden.WAKTU_INPUT', 'desc');
        $this->db->where('nilai_survei.ID_POLI', $poli);
        return $this->db->get()->num_rows(); 
    }

    function filter_periode($batas=null, $offset=null, $periode){
        $this->db->select('*');
        $this->db->from('responden');
        $this->db->join('responden_pendidikan', 'responden.ID_PENDIDIKAN = responden_pendidikan.ID_PENDIDIKAN');
        $this->db->join('responden_pekerjaan', 'responden.ID_PEKERJAAN = responden_pekerjaan.ID_PEKERJAAN');
        $this->db->join('responden_tanggungan_biaya', 'responden.ID_TANGGUNGAN_BIAYA = responden_tanggungan_biaya.ID_TANGGUNGAN_BIAYA');
        $this->db->join('nilai_survei', 'responden.ID_RESPONDEN = nilai_survei.ID_RESPONDEN');
        $this->db->join('periode', 'nilai_survei.ID_PERIODE = periode.ID_PERIODE');
        $this->db->join('sub_kriteria', 'nilai_survei.ID_SUB = sub_kriteria.ID_SUB');
        $this->db->join('poli', 'nilai_survei.ID_POLI = poli.ID_POLI');
        $this->db->group_by('responden.ID_RESPONDEN');
        $this->db->order_by('responden.WAKTU_INPUT', 'desc');
        $this->db->where('nilai_survei.ID_PERIODE', $periode);
        if($batas != null){
           $this->db->limit($batas,$offset);
        }
        return $this->db->get()->result(); 
    }
    function jumlah_periode($periode){
        $this->db->select('*');
        $this->db->from('responden');
        $this->db->join('responden_pendidikan', 'responden.ID_PENDIDIKAN = responden_pendidikan.ID_PENDIDIKAN');
        $this->db->join('responden_pekerjaan', 'responden.ID_PEKERJAAN = responden_pekerjaan.ID_PEKERJAAN');
        $this->db->join('responden_tanggungan_biaya', 'responden.ID_TANGGUNGAN_BIAYA = responden_tanggungan_biaya.ID_TANGGUNGAN_BIAYA');
        $this->db->join('nilai_survei', 'responden.ID_RESPONDEN = nilai_survei.ID_RESPONDEN');
        $this->db->join('periode', 'nilai_survei.ID_PERIODE = periode.ID_PERIODE');
        $this->db->join('sub_kriteria', 'nilai_survei.ID_SUB = sub_kriteria.ID_SUB');
        $this->db->join('poli', 'nilai_survei.ID_POLI = poli.ID_POLI');
        $this->db->group_by('responden.ID_RESPONDEN');
        $this->db->order_by('responden.WAKTU_INPUT', 'desc');
        $this->db->where('nilai_survei.ID_PERIODE', $periode);
        return $this->db->get()->num_rows(); 
    }

    function filter_poliperiode($batas=null, $offset=null, $poli, $periode){
        $this->db->select('*');
        $this->db->from('responden');
        $this->db->join('responden_pendidikan', 'responden.ID_PENDIDIKAN = responden_pendidikan.ID_PENDIDIKAN');
        $this->db->join('responden_pekerjaan', 'responden.ID_PEKERJAAN = responden_pekerjaan.ID_PEKERJAAN');
        $this->db->join('responden_tanggungan_biaya', 'responden.ID_TANGGUNGAN_BIAYA = responden_tanggungan_biaya.ID_TANGGUNGAN_BIAYA');
        $this->db->join('nilai_survei', 'responden.ID_RESPONDEN = nilai_survei.ID_RESPONDEN');
        $this->db->join('periode', 'nilai_survei.ID_PERIODE = periode.ID_PERIODE');
        $this->db->join('sub_kriteria', 'nilai_survei.ID_SUB = sub_kriteria.ID_SUB');
        $this->db->join('poli', 'nilai_survei.ID_POLI = poli.ID_POLI');
        $this->db->group_by('responden.NAMA');
        $this->db->order_by('responden.WAKTU_INPUT', 'desc');
        $this->db->where('poli.ID_POLI', $poli);
        $this->db->where('nilai_survei.ID_PERIODE', $periode);
        if($batas != null){
           $this->db->limit($batas,$offset);
        }
        return $this->db->get()->result(); 
    }
    function jumlah_poliperiode($poli, $periode){
        $this->db->select('*');
        $this->db->from('responden');
        $this->db->join('responden_pendidikan', 'responden.ID_PENDIDIKAN = responden_pendidikan.ID_PENDIDIKAN');
        $this->db->join('responden_pekerjaan', 'responden.ID_PEKERJAAN = responden_pekerjaan.ID_PEKERJAAN');
        $this->db->join('responden_tanggungan_biaya', 'responden.ID_TANGGUNGAN_BIAYA = responden_tanggungan_biaya.ID_TANGGUNGAN_BIAYA');
        $this->db->join('nilai_survei', 'responden.ID_RESPONDEN = nilai_survei.ID_RESPONDEN');
        $this->db->join('periode', 'nilai_survei.ID_PERIODE = periode.ID_PERIODE');
        $this->db->join('sub_kriteria', 'nilai_survei.ID_SUB = sub_kriteria.ID_SUB');
        $this->db->join('poli', 'nilai_survei.ID_POLI = poli.ID_POLI');
        $this->db->group_by('responden.NAMA');
        $this->db->order_by('responden.WAKTU_INPUT', 'desc');
        $this->db->where('poli.ID_POLI', $poli);
        $this->db->where('nilai_survei.ID_PERIODE', $periode);
        return $this->db->get()->num_rows(); 
    }
}
?>

