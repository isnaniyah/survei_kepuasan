<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pengawas_log extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('mlog');
        $this->load->model('muser');
        $this->load->helper('form','url');
    }

    public function index()
    {
        $data['title'] = 'Log aktifitas admin'; 
        
        $data['qadmin'] = $this->muser->get_all();
        $data['admin'] = "";
        $data['tgl'] = null;
        $jumlah= $this->mlog->jumlah();

        $config['base_url'] = base_url().'/pengawas_log/index';
        $config['total_rows'] = $jumlah;
        $config['per_page'] = 10;
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = '&laquo; First';
        $config['first_tag_open'] = '<li class="prev page">';
        $config['first_tag_close'] = '</li>';
 
        $config['last_link'] = 'Last &raquo;';
        $config['last_tag_open'] = '<li class="next page">';
        $config['last_tag_close'] = '</li>';
 
        $config['next_link'] = 'Next &rarr;';
        $config['next_tag_open'] = '<li class="next page">';
        $config['next_tag_close'] = '</li>';
 
        $config['prev_link'] = '&larr; Prev';
        $config['prev_tag_open'] = '<li class="prev page">';
        $config['prev_tag_close'] = '</li>';
 
        $config['cur_tag_open'] = '<li class="current"><a href="">';
        $config['cur_tag_close'] = '</a></li>';
 
        $config['num_tag_open'] = '<li class="page">';
        $config['num_tag_close'] = '</li>';

        $dari = $this->uri->segment('3');
        $data['qlog'] = $this->mlog->get_all($config['per_page'],$dari);

        $data['jumlah_data'] = $jumlah;
        $data['nomer'] = $dari;
        $this->pagination->initialize($config); 
        $data['page']=$this->pagination->create_links();
        $this->load->view('pengawas/vlog',$data);
    }

    public function filter($tgl=null, $admin=null){
        $data['title'] = 'Log aktifitas admin'; 
        $admin = $this->input->get('admin');
        $tgl = $this->input->get('tgl');
        $dari=$this->input->get('per_page');
        $config['base_url'] = base_url().'pengawas_log/filter/?tgl='.$tgl.'&admin='.$admin;
        
        $config['page_query_string'] = TRUE;
        $config['per_page'] = 10;
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = '&laquo; First';
        $config['first_tag_open'] = '<li class="prev page">';
        $config['first_tag_close'] = '</li>';
 
        $config['last_link'] = 'Last &raquo;';
        $config['last_tag_open'] = '<li class="next page">';
        $config['last_tag_close'] = '</li>';
 
        $config['next_link'] = 'Next &rarr;';
        $config['next_tag_open'] = '<li class="next page">';
        $config['next_tag_close'] = '</li>';
 
        $config['prev_link'] = '&larr; Prev';
        $config['prev_tag_open'] = '<li class="prev page">';
        $config['prev_tag_close'] = '</li>';
 
        $config['cur_tag_open'] = '<li class="current"><a href="">';
        $config['cur_tag_close'] = '</a></li>';
 
        $config['num_tag_open'] = '<li class="page">';
        $config['num_tag_close'] = '</li>';

        if ($tgl==null && $admin =="null") {
            redirect(base_url().'pengawas_log');
        } elseif($tgl==null && $admin !="null"){
            $jumlah= $this->mlog->jumlah_admin($admin);
            $data['qlog'] = $this->mlog->filter_admin($config['per_page'],$dari,$admin);
        } elseif ($tgl!=null && $admin =="null") {
            $jumlah= $this->mlog->jumlah_tgl($tgl);
            $data['qlog'] = $this->mlog->filter_tgl($config['per_page'],$dari,$tgl);
        } else{
            $jumlah= $this->mlog->jumlah_tgl_admin($tgl,$admin);
            $data['qlog'] = $this->mlog->filter_tgl_admin($config['per_page'],$dari,$tgl, $admin);
        }
        $config['total_rows'] = $jumlah;
        $data['admin'] = $admin;
        $data['tgl'] = $tgl;
        $data['qadmin'] = $this->muser->get_all();
        $data['jumlah_data'] = $jumlah;
        $data['nomer'] = $dari;
        $this->pagination->initialize($config); 
        $data['page']=$this->pagination->create_links();
        $this->load->view('pengawas/vlog',$data);
    }
}