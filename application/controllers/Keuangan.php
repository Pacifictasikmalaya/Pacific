<?php 

class Keuangan extends CI_Controller
{
  function __construct(){
    parent::__construct();
    check_login();
    $this->load->model(array('Model_keuangan'));
  }
  
  function ledger($rowno=0){

    $bank       = "";
    $dari       = "";
    $sampai     = "";


    if($this->input->post('submit') != NULL ){

      $bank     = $this->input->post('bank');
      $dari     = $this->input->post('dari');
      $sampai   = $this->input->post('sampai');
      $data     = array(
        'bank'       => $bank,
        'dari'       => $dari,
        'sampai'     => $sampai
      );
      $this->session->set_userdata($data);
    }else{
      if($this->session->userdata('bank') != NULL){
        $bank = $this->session->userdata('bank');
      }
      if($this->session->userdata('dari') != NULL){
        $dari = $this->session->userdata('dari');
      }
      if($this->session->userdata('sampai') != NULL){
        $sampai = $this->session->userdata('sampai');
      }
    }
    // Row per page
    $rowperpage = 10;
    // Row position
    if($rowno != 0){
      $rowno = ($rowno-1) * $rowperpage;
    }
    // All records count
    $allcount     = $this->Model_keuangan->getrecordledger($bank,$dari,$sampai);
    // Get records
    $users_record = $this->Model_keuangan->getdataledger($rowno,$rowperpage,$bank,$dari,$sampai);
    // Pagination Configuration
    $config['base_url']         = base_url().'keuangan/ledger';
    $config['use_page_numbers'] = TRUE;
    $config['total_rows']       = $allcount;
    $config['per_page']         = $rowperpage;

    $config['first_link']       = 'First';
    $config['last_link']        = 'Last';
    $config['next_link']        = 'Next';
    $config['prev_link']        = 'Prev';
    $config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
    $config['full_tag_close']   = '</ul></nav></div>';
    $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
    $config['num_tag_close']    = '</span></li>';
    $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
    $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
    $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
    $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
    $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
    $config['prev_tagl_close']  = '</span>Next</li>';
    $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
    $config['first_tagl_close'] = '</span></li>';
    $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
    $config['last_tagl_close']  = '</span></li>';
    // Initialize
    $this->pagination->initialize($config);
    $data['pagination'] 				= $this->pagination->create_links();
    $data['result']     				= $users_record;
    $data['row']        				= $rowno;
    $data['dari']       				= $dari;
    $data['sampai']     				= $sampai;
    $data['bank']       				= $bank;
    $data['lbank']              = $this->Model_keuangan->getBank()->result();
    $this->template->load('template/template','keuangan/ledger',$data);
  }

  function ledger_input()
  {
    $data['coa']    = $this->Model_keuangan->coa()->result();
    $data['lbank']  = $this->Model_keuangan->getBank()->result();
    $this->load->view('keuangan/ledger_input',$data);
    
  }

  function ledger_edit()
  {
    $nobukti        = $this->input->post('nobukti');
    $data['coa']    = $this->Model_keuangan->coa()->result();
    $data['lbank']  = $this->Model_keuangan->getBank()->result();
    $data['ledger'] = $this->Model_keuangan->getLedger($nobukti)->row_array();
    $this->load->view('keuangan/ledger_edit',$data);
    
  }

  function view_templedger()
  {
    $data['data']    = $this->Model_keuangan->view_templedger()->result();
    $this->load->view('keuangan/ledger_temp',$data);
    
  }

  function insertledger_temp()
  {
    $this->Model_keuangan->insertledger_temp();
  }

  function insertledger()
  {
    $this->Model_keuangan->insertledger();
  }

  function updateledger()
  {
    $this->Model_keuangan->updateledger();
  }

  function hapusledger()
  {
    $nobukti = $this->uri->segment(3);
    $this->Model_keuangan->hapusledger($nobukti);
  }

  function saldoledger($rowno=0)
  {
    // Search text
    $tanggal          = "";
    $bank             = "";
    $bulan            = "";
    $tahun            = "";
    if($this->input->post('submit') != NULL ){
      $tanggal   = $this->input->post('tanggal');
      $bank      = $this->input->post('bank');
      $bulan     = $this->input->post('bulan');
      $tahun     = $this->input->post('tahun');
      $data 	= array(
        'tanggal'	=> $tanggal,
        'bank'    => $bank,
        'bulan'   => $bulan,
        'tahun'   => $tahun
      );
      $this->session->set_userdata($data);
    }else{

      if($this->session->userdata('tanggal') != NULL){
        $tanggal = $this->session->userdata('tanggal');
      }
      if($this->session->userdata('bank') != NULL){
        $bank = $this->session->userdata('bank');
      }
      if($this->session->userdata('bulan') != NULL){
        $bulan = $this->session->userdata('bulan');
      }
      if($this->session->userdata('tahun') != NULL){
        $tahun = $this->session->userdata('tahun');
      }
    }
    // Row per page
    $rowperpage = 10;
    // Row position
    if($rowno != 0){
      $rowno = ($rowno-1) * $rowperpage;
    }
    // All records count
    $allcount 	  = $this->Model_keuangan->getrecordSaldoledgerCount($tanggal,$bank,$bulan,$tahun);
    // Get records
    $users_record = $this->Model_keuangan->getDataSaldoledger($rowno,$rowperpage,$tanggal,$bank,$bulan,$tahun);
    // Pagination Configuration
    $config['base_url'] 					= base_url().'keuangan/saldoledger';
    $config['use_page_numbers'] 	= TRUE;
    $config['total_rows'] 				= $allcount;
    $config['per_page'] 					= $rowperpage;
    $config['first_link']       	= 'First';
    $config['last_link']        	= 'Last';
    $config['next_link']        	= 'Next';
    $config['prev_link']        	= 'Prev';
    $config['full_tag_open']    	= '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
    $config['full_tag_close']   	= '</ul></nav></div>';
    $config['num_tag_open']     	= '<li class="page-item"><span class="page-link">';
    $config['num_tag_close']    	= '</span></li>';
    $config['cur_tag_open']     	= '<li class="page-item active"><span class="page-link">';
    $config['cur_tag_close']    	= '<span class="sr-only">(current)</span></span></li>';
    $config['next_tag_open']    	= '<li class="page-item"><span class="page-link">';
    $config['next_tagl_close']  	= '<span aria-hidden="true">&raquo;</span></span></li>';
    $config['prev_tag_open']    	= '<li class="page-item"><span class="page-link">';
    $config['prev_tagl_close']  	= '</span>Next</li>';
    $config['first_tag_open']   	= '<li class="page-item"><span class="page-link">';
    $config['first_tagl_close'] 	= '</span></li>';
    $config['last_tag_open']    	= '<li class="page-item"><span class="page-link">';
    $config['last_tagl_close']  	= '</span></li>';
    // Initialize
    $this->pagination->initialize($config);
    $data['pagination']           = $this->pagination->create_links();
    $data['result'] 		          = $users_record;
    $data['row'] 			          	= $rowno;
    $data['tanggal']	            = $tanggal;
    $data['bank']                 = $bank;
    // Load view
    //$data['cabang'] 		          = $this->Model_cabang->view_cabang()->result();
    //$data['cb'] 				          = $this->session->userdata('cabang');
    $data['lbank']                = $this->Model_keuangan->getBank()->result();
    $data['tahun']                = date("Y");
    $data['bulan']                = array("","Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
    $data['bln']                  = $bulan;
    $data['thn']                  = $tahun;
    $this->template->load('template/template','keuangan/saldoawalledger',$data);
  }

  function inputsaldoawalledger(){
    $data['lbank']     = $this->Model_keuangan->getBank()->result();
    $data['tahun']     = date("Y");
    $data['bulan']     = array("","Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
    $this->load->view('keuangan/saldoawalledger_input',$data);
  }
  
  function getdetailsaldo()
  {
    $bulan    = $this->input->post('bulan');
    $tahun    = $this->input->post('tahun');
    $bank     = $this->input->post('bank');
    $ceksaldo = $this->Model_keuangan->ceksaldo($bulan,$tahun,$bank)->num_rows();
    $cekall   = $this->Model_keuangan->ceksaldoall($bank)->num_rows();
    $ceknow   = $this->Model_keuangan->ceksaldoSkrg($bulan,$tahun,$bank)->num_rows();
    if(empty($ceksaldo) && !empty($cekall) || !empty($ceknow))
    {
      echo "1";
    }else{
      $saldo  = $this->Model_keuangan->getdetailsaldo($bulan,$tahun,$bank)->row_array();
      $mutasi = $this->Model_keuangan->getMutasi($bulan,$tahun,$bank)->row_array();
      $saldoawal = $saldo['jumlah'] + $mutasi['kredit']-$mutasi['debet'];
      echo $saldoawal;
    }

  }

  function insertsaldoawalledger()
  {
    $this->Model_keuangan->insertsaldoawalledger();
  }

  function cekdata(){

    $cek = $this->Model_keuangan->cekdata()->num_rows();
    echo $cek;

  }
  
  function hapussaldoawalledger()
  {
    $id = $this->uri->segment(3);
    $this->Model_keuangan->hapussaldoawalledger($id);
  }
  
  function hapus_templedger()
  {
    $this->Model_keuangan->hapus_templedger();
  }
  

  function insertmutasicabang()
  {
    $this->Model_keuangan->insertmutasicabang();
  }

  function updatemutasicabang()
  {
    $this->Model_keuangan->updatemutasicabang();
  }
}