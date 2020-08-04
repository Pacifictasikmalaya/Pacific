<?php 

class Model_keuangan extends CI_Model
{
  function getBank($cabang="")
  {
    if($cabang!=""){
      $this->db->where('kode_cabang',$cabang);
    }
    return $this->db->get('master_bank');
  }

  function getWhereBank($bank)
  {
    if($bank!=""){
      $bank = "WHERE master_bank.kode_bank = '".$bank."' ";
    }
    return $this->db->query("SELECT * FROM master_bank "
      .$bank
      ." ");
  }

  function view_templedger()
  {
    $noref    = $this->input->post('noref');
    return $this->db->query("SELECT * FROM ledger_temp 
      INNER JOIN coa ON coa.kode_akun=ledger_temp.kode_akun
      INNER JOIN master_bank ON master_bank.kode_bank=ledger_temp.bank
      WHERE no_ref = '$noref' ");
  }
  
  function cekdata()
  {
    $noref    = $this->input->post('noref');
    return $this->db->query("SELECT * FROM ledger_temp WHERE no_ref = '$noref' ");
  }

  function hapus_templedger()
  {
    $id    = $this->input->post('id');
    $this->db->delete('ledger_temp',array('id'=>$id));

  }

  function ledger($bank="",$dari,$sampai)
  {
    if($bank !='')
    {
      $this->db->where('bank',$bank);
    }


    $this->db->where('tgl_ledger >=',$dari);
    $this->db->where('tgl_ledger <=',$sampai);
    $this->db->join('coa','ledger_bank.kode_akun = coa.kode_akun','left');
    $this->db->join('master_bank','ledger_bank.bank = master_bank.kode_bank');
    $this->db->order_by('tgl_ledger','asc');
    return $this->db->get('ledger_bank');
  }

  public function getDataLedger($rowno,$rowperpage,$bank="",$dari="",$sampai="")
  {

    $this->db->select('*');
    $this->db->from('ledger_bank');
    $this->db->join('coa','ledger_bank.kode_akun = coa.kode_akun','left');
    $this->db->join('master_bank','ledger_bank.bank = master_bank.kode_bank');
    $this->db->order_by('tgl_ledger,pelanggan','DESC');
    
    // $this->db->where('left(kontrabon.no_kontrabon,1) !=','T');
    if($dari !=  ''){
      $this->db->where('tgl_ledger >=', $dari);
    }
    if($sampai !=  ''){
      $this->db->where('tgl_ledger <=', $sampai);
    }
    
    if($bank !='')
    {
      $this->db->where('bank',$bank);
    }

    $this->db->limit($rowperpage, $rowno);
    $query = $this->db->get();
    return $query->result_array();
  }

    // Select total records
  public function getrecordLedger($bank="",$dari="",$sampai="")
  {

    $this->db->select('count(*) as allcount');
    $this->db->from('ledger_bank');
    $this->db->join('coa','ledger_bank.kode_akun = coa.kode_akun','left');
    $this->db->join('master_bank','ledger_bank.bank = master_bank.kode_bank');
    $this->db->order_by('tgl_ledger,pelanggan','DESC');
    // $this->db->where('left(kontrabon.no_kontrabon,1) !=','T');
    if($dari !=  ''){
      $this->db->where('tgl_ledger >=', $dari);
    }
    if($sampai !=  ''){
      $this->db->where('tgl_ledger <=', $sampai);
    }
    
    if($bank !='')
    {
      $this->db->where('bank',$bank);
    }
    $query  = $this->db->get();
    $result = $query->result_array();
    return $result[0]['allcount'];
  }

  function coa()
  {
    return $this->db->get('coa');
  }

  function insertledger()
  {
    $nobukti    = $this->input->post('nobukti');
    
    $tgl        = $this->input->post('tglledger');
    $noref      = $this->input->post('noref');
    $pelanggan  = $this->input->post('pelanggan');
    $keterangan = $this->input->post('keterangan');
    $akun       = $this->input->post('kodeakun');
    $jumlah     = str_replace(".","",$this->input->post('jumlah'));
    $jumlah     = str_replace(",",".",$jumlah);
    $status_dk  = $this->input->post('debetkredit');
    $bank       = $this->input->post('lbank');


    $ledger_temp = $this->db->query("SELECT * FROM ledger_temp")->result();
    foreach ($ledger_temp as $dt) {

      $cabang         = "PST";
      $tanggal        = explode("-",$tgl);
      $tahun          = substr($tanggal[0],2,2);
      $qledger        = "SELECT no_bukti FROM ledger_bank WHERE LEFT(no_bukti,7) = 'LR$cabang$tahun' ORDER BY no_bukti DESC LIMIT 1 ";
      $ceknolast      = $this->db->query($qledger)->row_array();
      $nobuktilast    = $ceknolast['no_bukti'];
      $nobukti        = buatkode($nobuktilast,'LR'.$cabang.$tahun,4);

      echo $nobukti;
      $dataledger = array(
        'no_bukti'        => $nobukti,
        'no_ref'          => $dt->no_ref,
        'bank'            => $dt->bank,
        'tgl_ledger'      => $tgl,
        'pelanggan'       => $dt->pelanggan,
        'keterangan'      => $dt->keterangan,
        'kode_akun'       => $dt->kode_akun,
        'jumlah'          => $dt->jumlah,
        'status_dk'       => $dt->status_dk,
        'status_validasi' => 1
      );
      $this->db->delete('ledger_temp',array('id'=>$dt->id));
      $insertledger = $this->db->insert('ledger_bank',$dataledger);

    }
    
    $this->db->truncate('ledger_temp');

    if($insertledger)
    {
      $this->session->set_flashdata('msg',
        '<div class="alert bg-green alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <i class="material-icons" style="float:left; margin-right:10px">check</i> Data Berhasil Disimpan !
        </div>');
      redirect('keuangan/ledger');
    }

  }

  function insertledger_temp()
  {
    $noref      = $this->input->post('noref');
    
    $pelanggan  = $this->input->post('pelanggan');
    $keterangan = $this->input->post('keterangan');
    $akun       = $this->input->post('kodeakun');
    $bank       = $this->input->post('lbank');
    $jumlah     = str_replace(".","",$this->input->post('jumlah'));
    $jumlah     = str_replace(",",".",$jumlah);
    $status_dk  = $this->input->post('debetkredit');
    
    $dataledgertemp = array(
      'no_ref'          => $noref,
      'pelanggan'       => $pelanggan,
      'keterangan'      => $keterangan,
      'jumlah'          => $jumlah,
      'kode_akun'       => $akun,
      'bank'            => $bank,
      'status_dk'       => $status_dk
    );

    $inserttemp = $this->db->insert('ledger_temp',$dataledgertemp);
  }

  function getLedger($nobukti)
  {
    return $this->db->get_where('ledger_bank',array('no_bukti'=>$nobukti));
  }

  function updateledger()
  {
    $nobukti    = $this->input->post('nobukti');
    
    $tgl        = $this->input->post('tglledger');
    $noref      = $this->input->post('noref');
    $pelanggan  = $this->input->post('pelanggan');
    $keterangan = $this->input->post('keterangan');
    $akun       = $this->input->post('kodeakun');
    $jumlah     = str_replace(".","",$this->input->post('jumlah'));
    $jumlah     = str_replace(",",".",$jumlah);
    $status_dk  = $this->input->post('debetkredit');
    $bank       = $this->input->post('lbank');
    

    $dataledger = array(
      'no_ref'          => $noref,
      'bank'            => $bank,
      'tgl_ledger'      => $tgl,
      'pelanggan'       => $pelanggan,
      'keterangan'      => $keterangan,
      'kode_akun'       => $akun,
      'jumlah'          => $jumlah,
      'status_dk'       => $status_dk,
      'status_validasi' => 1
    );

    $update = $this->db->update('ledger_bank',$dataledger,array('no_bukti'=>$nobukti));
    if($update)
    {
      $this->session->set_flashdata('msg',
        '<div class="alert bg-green alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <i class="material-icons" style="float:left; margin-right:10px">check</i> Data Berhasil Di Update !
        </div>');
      redirect('keuangan/ledger');
    }

  }

  function hapusledger($nobukti)
  {
    $hapus = $this->db->delete('ledger_bank',array('no_bukti'=>$nobukti));
    if($hapus)
    {
      $this->session->set_flashdata('msg',
        '<div class="alert bg-green alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <i class="material-icons" style="float:left; margin-right:10px">check</i> Data Berhasil Di Hapus !
        </div>');
      redirect('keuangan/ledger');
    }
  }

  function rekapledger($bank,$dari,$sampai)
  {
    if($bank !='')
    {
      $this->db->where('bank',$bank);
    }
    $this->db->where('tgl_ledger >=',$dari);
    $this->db->where('tgl_ledger <=',$sampai);
    $this->db->select('ledger_bank.kode_akun,nama_akun,
      SUM(IF(status_dk="D",jumlah,0)) as debet,
      SUM(IF(status_dk="K",jumlah,0)) as kredit');
    $this->db->from('ledger_bank');
    $this->db->join('coa','ledger_bank.kode_akun = coa.kode_akun');
    $this->db->group_by('ledger_bank.kode_akun');
    return $this->db->get();
  }
  

  public function getDataSaldoledger($rowno,$rowperpage,$tanggal="",$bank="",$bulan="",$tahun="")
  {
    $this->db->select('kode_saldoawalledger,tanggal,bulan,tahun,jumlah,saldoawal_ledger.kode_bank,nama_bank');
    $this->db->from('saldoawal_ledger');
    $this->db->join('master_bank','saldoawal_ledger.kode_bank = master_bank.kode_bank');
    $this->db->order_by('tanggal','desc');
    if($tanggal != ''){
      $this->db->where('tanggal', $tanggal);
    }
    if($bank != ''){
      $this->db->where('saldoawal_ledger.kode_bank', $bank);
    }

    if($bulan != ''){
      $this->db->where('bulan', $bulan);
    }

    if($tahun != ''){
      $this->db->where('tahun', $tahun);
    }
    $this->db->limit($rowperpage, $rowno);
    $query = $this->db->get();
    return $query->result_array();
  }

    // Select total records
  public function getrecordSaldoledgerCount($tanggal="",$bank="",$bulan="",$tahun="")
  {
    $this->db->select('count(*) as allcount');
    $this->db->from('saldoawal_ledger');
    $this->db->join('master_bank','saldoawal_ledger.kode_bank = master_bank.kode_bank');
    if($tanggal != ''){
      $this->db->where('tanggal', $tanggal);
    }
    if($bank != ''){
      $this->db->where('saldoawal_ledger.kode_bank', $bank);
    }
    if($bulan != ''){
      $this->db->where('bulan', $bulan);
    }
    if($tahun != ''){
      $this->db->where('tahun', $tahun);
    }
    $query  = $this->db->get();
    $result = $query->result_array();
    return $result[0]['allcount'];
  }

  function ceksaldo($bulan,$tahun,$bank)
  {
    if($bulan == 1){
      $bulan = 12;
      $tahun = $tahun - 1;
    }else{
      $bulan = $bulan - 1;
      $tahun = $tahun;
    }
    return $this->db->get_where('saldoawal_ledger',array('bulan'=>$bulan,'tahun'=>$tahun,'kode_bank'=>$bank));
  }

  function ceksaldoSkrg($bulan,$tahun,$bank)
  {
    return $this->db->get_where('saldoawal_ledger',array('bulan'=>$bulan,'tahun'=>$tahun,'kode_bank'=>$bank));
  }

  function ceksaldoall($bank)
  {
    return $this->db->get_where('saldoawal_ledger',array('kode_bank'=>$bank));
  }

  function getdetailsaldo($bulan,$tahun,$bank)
  {
    if($bulan == 1){
      $bulan = 12;
      $tahun = $tahun - 1;
    }else{
      $bulan = $bulan - 1;
      $tahun = $tahun;
    }
    $saldo 	= $this->db->get_where('saldoawal_ledger',array('bulan'=>$bulan,'tahun'=>$tahun,'kode_bank'=>$bank));
    return $saldo;
  }
  
  function getMutasi($bulan,$tahun,$bank)
  {
    if($bulan == 1){
      $bulan = 12;
      $tahun = $tahun - 1;
    }else{
      $bulan = $bulan - 1;
      $tahun = $tahun;
    }

    $query = "SELECT 
    SUM(IF(status_dk='K',jumlah,0)) as kredit,
    SUM(IF(status_dk='D',jumlah,0)) as debet
    FROM ledger_bank
    WHERE MONTH(tgl_ledger)='$bulan' AND YEAR(tgl_ledger)='$tahun' AND bank='$bank'";
    return $this->db->query($query);
  }


  function insertsaldoawalledger()
  {
    $kodesaldo  = $this->input->post('kode_saldoawal');
    $tanggal 		= $this->input->post('tanggal');
    $bank 		  = $this->input->post('bank2');
    $bulan 			= $this->input->post('bulan');
    $tahun 			= $this->input->post('tahun');
    $jumlah 		= str_replace(".","",$this->input->post('jumlah'));
    $jumlah 		= str_replace(",",".",$jumlah);
    $id_admin   = $this->session->userdata('id_user');
    $data = array(
     'kode_saldoawalledger' => $kodesaldo,
     'tanggal'					 => $tanggal,
     'bulan'						 => $bulan,
     'tahun'						 => $tahun,
     'jumlah'			     => $jumlah,
     'kode_bank'			   => $bank,
     'id_admin'				 => $id_admin
   );
    $cek            = $this->db->get_where('saldoawal_ledger',array('kode_saldoawalledger'=>$kode_saldoawal))->num_rows();
    $cekbulan       = $this->db->get_where('saldoawal_ledger',array('bulan'=>$bulan,'tahun'=>$tahun,'kode_bank'=>$bank))->num_rows();
    if(empty($cek) && empty($cekbulan))
    {
      $simpansaldo   = $this->db->insert('saldoawal_ledger',$data);
      if($simpansaldo)
      {
        $this->session->set_flashdata('msg',
          '<div class="alert bg-green alert-dismissible" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <i class="material-icons" style="float:left; margin-right:10px">check</i> Data Berhasil Disimpan !
          </div>');
        redirect('keuangan/saldoledger');
      }

    }else{
      $this->session->set_flashdata('msg',
        '<div class="alert bg-red alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <i class="material-icons" style="float:left; margin-right:10px">check</i> Data Sudah Ada !
        </div>');
      redirect('keuangan/saldoledger');
    }
  }
  
  function hapussaldoawalledger($kodesaldoawal){
    $hapus = $this->db->delete('saldoawal_ledger',array('kode_saldoawalledger'=>$kodesaldoawal));
    if($hapus){
     $this->session->set_flashdata('msg',
       '<div class="alert bg-green alert-dismissible" role="alert">
       <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
       <i class="material-icons" style="float:left; margin-right:10px">check</i> Data Berhasil di Hapus !
       </div>');
     redirect('keuangan/saldoledger');
   }else{
     $this->session->set_flashdata('msg',
       '<div class="alert bg-red alert-dismissible" role="alert">
       <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
       <i class="material-icons" style="float:left; margin-right:10px">check</i> Data Gagal di Hapus !
       </div>');
     redirect('keuangan/saldoledger');
   }
 }

 function getSaldoAwalLedger($bank,$dari){
  $tanggal = explode("-",$dari);
  $bulan 	 = $tanggal[1];
  $tahun 	 = $tanggal[0];
  $this->db->select('jumlah');
  $this->db->from('saldoawal_ledger');
  $this->db->where('MONTH(tanggal)',$bulan);
  $this->db->where('YEAR(tanggal)',$tahun);
  $this->db->where('kode_bank',$bank);
  return $this->db->get();
}

function insertmutasicabang()
{
  $nobukti    = $this->input->post('nobukti');
  $tgl        = $this->input->post('tanggal');
  $keterangan = $this->input->post('keterangan');
  $akun       = $this->input->post('kodeakun');
  $jumlah     = str_replace(".","",$this->input->post('jumlah'));
  $jumlah     = str_replace(",",".",$jumlah);
  $status_dk  = $this->input->post('debetkredit');
  $bank       = $this->input->post('bank');
  $cabang     = $this->session->userdata('cabang');
  if(empty($nobukti)){
      //Nobukti Ledger
    $cabang         = $cabang;
    $tanggal        = explode("-",$tgl);
    $tahun          = substr($tanggal[0],2,2);
    $qledger        = "SELECT no_bukti FROM ledger_bank WHERE LEFT(no_bukti,7) ='LR$cabang$tahun'ORDER BY no_bukti DESC LIMIT 1 ";
    $ceknolast      = $this->db->query($qledger)->row_array();
    $nobuktilast    = $ceknolast['no_bukti'];
    $nobukti        = buatkode($nobuktilast,'LR'.$cabang.$tahun,4);
  }else{
    $nobukti        = $nobukti;
  }

  $dataledger = array(
    'no_bukti'        => $nobukti,
    'bank'            => $bank,
    'tgl_ledger'      => $tgl,
    'keterangan'      => $keterangan,
    'kode_akun'       => $akun,
    'jumlah'          => $jumlah,
    'status_dk'       => $status_dk,
    'status_validasi' => 1
  );

  $insertledger = $this->db->insert('ledger_bank',$dataledger);
  if($insertledger)
  {
    $this->session->set_flashdata('msg',
      '<div class="alert bg-green alert-dismissible" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <i class="material-icons" style="float:left; margin-right:10px">check</i> Data Berhasil Disimpan !
      </div>');
    redirect('kaskecil/mutasibank');
  }
}

function updatemutasicabang()
{
  $nobukti    = $this->input->post('nobukti');
  $tgl        = $this->input->post('tanggal');
  $keterangan = $this->input->post('keterangan');
  $akun       = $this->input->post('kodeakun');
  $jumlah     = str_replace(".","",$this->input->post('jumlah'));
  $jumlah     = str_replace(",",".",$jumlah);
  $status_dk  = $this->input->post('debetkredit');
  $bank       = $this->input->post('bank');


  $dataledger = array(
    'bank'            => $bank,
    'tgl_ledger'      => $tgl,
    'keterangan'      => $keterangan,
    'kode_akun'       => $akun,
    'jumlah'          => $jumlah,
    'status_dk'       => $status_dk,
    'status_validasi' => 1
  );

  $update = $this->db->update('ledger_bank',$dataledger,array('no_bukti'=>$nobukti));
  if($update)
  {
    $this->session->set_flashdata('msg',
      '<div class="alert bg-green alert-dismissible" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <i class="material-icons" style="float:left; margin-right:10px">check</i> Data Berhasil Di Update !
      </div>');
    redirect('kaskecil/mutasibank');
  }

}

}