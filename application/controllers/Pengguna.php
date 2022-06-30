<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Pengguna extends MY_Controller
{

  function __construct()
  {
    parent::__construct();
  
        $this->data['username'] = $this->session->userdata('username');
        $this->data['id_role']  = $this->session->userdata('id_role'); 
          if (!$this->data['username'] || ($this->data['id_role'] != 1))
          {
            $this->flashmsg('<i class="glyphicon glyphicon-remove"></i> Anda harus login terlebih dahulu', 'danger');
            redirect('login');
            exit;
          }  
    
    $this->load->model('login_m');  
    $this->load->model('Alternatif_m');    
    $this->load->model('Kriteria_m');         
    $this->load->model('Nilai_m');      
    $this->load->model('MPKriteria_m');   
    $this->load->model('IR_m');           
    $this->load->model('Penilaian_m');         
    $this->load->model('Data_m');           
    
    $this->data['profil'] = $this->login_m->get_row(['username' =>$this->data['username'] ]);   
     
    date_default_timezone_set("Asia/Jakarta");


  }

public function index()
{    
      $this->data['index'] = 1;
      $this->data['content'] = 'pengguna/dashboard';
      $this->template($this->data,'pengguna');
}


public function danabantuan()
{     

  if ($this->POST('add')) { 
        
 
     
    $data = [
      'nama' => $this->POST('nama'), 
      'jumlah_penerima' => $this->POST('jumlah_penerima'), 
      'keterangan' => $this->POST('keterangan'), 
      'tanggal' => date('Y-m-d H:i:s'), 
      'status' => 0
    ];

    if ($this->DanaBantuan_m->insert($data)) {
      $id = $this->db->insert_id();
      $this->flashmsg2('Dana Bantuan berhasil dibuat', 'success');
      redirect('pengguna/danabantuan/'.$id);
      exit();  
    }else{
      $this->flashmsg2('Gagal, Coba lagi!', 'warning');
      redirect('pengguna/danabantuan/');
      exit();  
    }
  }elseif ($this->POST('add_koperasi')) { 
        
 
     
    $data = [
      'id_danabantuan' => $this->POST('id_danabantuan'), 
      'nama_koperasi' => $this->POST('nama'), 
      'alamat' => $this->POST('alamat'),  
      'kontak' => $this->POST('kontak'),  
      'username' => $this->POST('username'),  
      'status' => 0 
    ];

    if ($this->Koperasi_m->insert($data)) {
      $id = $this->db->insert_id();
      $this->flashmsg2('Koperasi berhasil ditambah', 'success');
      redirect('pengguna/danabantuan/'.$this->POST('id_danabantuan'));
      exit();  
    }else{
      $this->flashmsg2('Gagal, Coba lagi!', 'warning');
      redirect('pengguna/danabantuan/'.$this->POST('id_danabantuan'));
      exit();  
    }
  } elseif ($this->POST('selesai')) { 
        
  
    if ($this->DanaBantuan_m->update($this->POST('id'),['status' => 1])) { 
      $this->flashmsg2('Berhasil ke tahap penggunaan', 'success');
      redirect('pengguna/danabantuan/'.$this->POST('id'));
      exit();  
    }else{
      $this->flashmsg2('Gagal, Coba lagi!', 'warning');
      redirect('pengguna/danabantuan/'.$this->POST('id'));
      exit();  
    }
  } 
  elseif ($this->POST('delete')) {
    if ($this->DanaBantuan_m->delete($this->POST('id'))) {
      $this->flashmsg2('Dana Bantuan berhasil dihapus.', 'success');
      redirect('pengguna/danabantuan/');
      exit();  
    }else{
      $this->flashmsg2('Gagal, Coba lagi!', 'warning');
      redirect('pengguna/danabantuan/');
      exit();  
    }
  }elseif ($this->POST('delete_koperasi')) {
    if ($this->Koperasi_m->delete($this->POST('id_koperasi'))) {
      $this->flashmsg2('Koperasi berhasil dihapus.', 'success');
      redirect('pengguna/danabantuan/'.$this->POST('id_danabantuan'));
      exit();  
    }else{
      $this->flashmsg2('Gagal, Coba lagi!', 'warning');
      redirect('pengguna/danabantuan/'.$this->POST('id_danabantuan'));
      exit();  
    }
  }
  elseif ($this->uri->segment(3)) {
    $id = $this->uri->segment(3);
    $this->data['danabantuan'] = $this->DanaBantuan_m->get_row(['id_danabantuan' => $id]);
    $this->data['list_koperasi'] = $this->Koperasi_m->get(['id_danabantuan' => $id]);
    $this->data['index'] = 2  ;
    $this->data['content'] = 'pengguna/detaildb';
    $this->template($this->data,'pengguna');
  }
  else {
    $this->data['danabantuan'] = $this->DanaBantuan_m->get_by_order('tanggal', 'desc' ,[]);
    $this->data['index'] = 2  ;
    $this->data['content'] = 'pengguna/danabantuan';
    $this->template($this->data,'pengguna');
  }
}
 
public function kriteria()
{     

  if ($this->POST('add')) {  
     
    $data = [
      'nama_kriteria' => $this->POST('nama') ,
      'inisial' => $this->POST('inisial') 
    ];

    if ($this->Kriteria_m->insert($data)) {
      $id = $this->db->insert_id();

      $list_kriteria = $this->Kriteria_m->get();

      foreach ($list_kriteria as $k) {
        if ($k->id_kriteria == $id) {
          $nilai = 1;
        }else {
          $nilai = 0;
        }
        $data = [
          'id_kriteria' => $id,
          'id_kriteria_2' => $k->id_kriteria,
          'nilai' => $nilai
        ];
        $this->MPKriteria_m->insert($data);
      }

      foreach ($list_kriteria as $k) {

        if ($this->MPKriteria_m->get_num_row(['id_kriteria' => $k->id_kriteria, 'id_kriteria_2' => $id]) == 0) {
          if ($k->id_kriteria != $id) {
               $data = [
                'id_kriteria' => $k->id_kriteria,
                'id_kriteria_2' => $id,
                'nilai' => 0
              ];
              $this->MPKriteria_m->insert($data);
            } 
           
          }
      }
        

      $this->flashmsg2('Kriteria berhasil ditambah', 'success');
      redirect('pengguna/kriteria/');
      exit();  
    }else{
      $this->flashmsg2('Gagal, Coba lagi!', 'warning');
      redirect('pengguna/kriteria/');
      exit();  
    }
  }


  elseif ($this->POST('setmp')) {
    $list_kriteria = $this->Kriteria_m->get();


    foreach ($list_kriteria as $a) {
      foreach ($list_kriteria as $b) {
        $this->MPKriteria_m->update_where(['id_kriteria' => $a->id_kriteria, 'id_kriteria_2' => $b->id_kriteria],['nilai' => $this->POST('mp-'.$a->id_kriteria.'-'.$b->id_kriteria)]);
      }
    }

    $this->flashmsg2('Matrik Perbadingan Kriteria berhasil disimpan, <a href="#rasio">Cek Perhitungan Rasio Konsistensi</a>', 'success');
      redirect('pengguna/kriteria/');
      exit();  
  }

 

  elseif ($this->POST('edit')) {
    if ($this->Kriteria_m->update($this->POST('id_kriteria'), ['nama_kriteria' => $this->POST('nama'),
      'inisial' => $this->POST('inisial') ] ) ) {
      $this->flashmsg2('Kriteria berhasil dihapus.', 'success');
      redirect('pengguna/kriteria/');
      exit();  
    }else{
      $this->flashmsg2('Gagal, Coba lagi!', 'warning');
      redirect('pengguna/kriteria/');
      exit();  
    }
  }

 

  elseif ($this->POST('delete')) {
    if ($this->Kriteria_m->delete($this->POST('id_kriteria'))) {
      $this->flashmsg2('Kriteria berhasil dihapus.', 'success');
      redirect('pengguna/kriteria/');
      exit();  
    }else{
      $this->flashmsg2('Gagal, Coba lagi!', 'warning');
      redirect('pengguna/kriteria/');
      exit();  
    }
  }
  
  
  else {
    $this->data['list_kriteria'] = $this->Kriteria_m->get();




    $this->data['index'] = 3  ;
    $this->data['content'] = 'pengguna/kriteria';
    $this->template($this->data,'pengguna');
  }
}


public function akun()
{     

  if ($this->POST('add')) { 
        
    if ($this->login_m->get_num_row(['username' => $this->POST('username')]) != 0) {
      $this->flashmsg2('username telah digunakan!', 'warning');
      redirect('pengguna/akun/');
      exit();  
    }

     
    $data = [
      'username' => $this->POST('username'), 
      'role' => $this->POST('role'),
      'password' => md5($this->POST('password')) 
    ];

    if ($this->login_m->insert($data)) {
      $this->flashmsg2('Akun berhasil ditambah', 'success');
      redirect('pengguna/akun/');
      exit();  
    }else{
      $this->flashmsg2('Gagal, Coba lagi!', 'warning');
      redirect('pengguna/akun/');
      exit();  
    }
  }
  elseif ($this->POST('edit')) { 
        
    if ($this->login_m->get_num_row(['username' => $this->POST('username')]) != 0 && $this->POST('username_x') != $this->POST('username')) {
      $this->flashmsg2('username telah digunakan!', 'warning');
      redirect('pengguna/akun/');
      exit();  
    }

   
    $data = [
      'username' => $this->POST('username') 
    ];
    
    

    if ($this->login_m->update($this->POST('username_x'),$data)) {
      $this->flashmsg2('Akun berhasil diedit.', 'success');
      redirect('pengguna/akun/');
      exit();  
    }else{
      $this->flashmsg2('Gagal, Coba lagi!', 'warning');
      redirect('pengguna/akun/');
      exit();  
    }
  }
  elseif ($this->POST('edit2')) { 
        
    if ($this->POST('password') != $this->POST('password2')) {
      $this->flashmsg2('Konfirmasi password tidak sama!', 'warning');
      redirect('pengguna/akun/');
      exit();  
    }

   
    $data = [
      'password' => md5($this->POST('password') )
    ];
    
    

    if ($this->login_m->update($this->POST('username'),$data)) {
      $this->flashmsg2('Password '.$this->POST('username'). ' berhasil diganti.', 'success');
      redirect('pengguna/akun/');
      exit();  
    }else{
      $this->flashmsg2('Gagal, Coba lagi!', 'warning');
      redirect('pengguna/akun/');
      exit();  
    }
  }
  elseif ($this->POST('delete')) {
    if ($this->login_m->delete($this->POST('username'))) {
      $this->flashmsg2('Akun berhasil dihapus.', 'success');
      redirect('pengguna/akun/');
      exit();  
    }else{
      $this->flashmsg2('Gagal, Coba lagi!', 'warning');
      redirect('pengguna/akun/');
      exit();  
    }
  }
  else {
    $this->data['users'] = $this->login_m->get(['username !=' => $this->data['username']  ]);
    $this->data['index'] = 8;
    $this->data['content'] = 'pengguna/users';
    $this->template($this->data,'pengguna');
  }
}

public function alternatif()
{     

  if ($this->POST('add')) { 
        
  
    $data = [
      'nik' => $this->POST('nik') 
    ];

    if ($this->Alternatif_m->insert($data)) {
      $this->flashmsg2('Alternatif berhasil ditambah', 'success');
      redirect('pengguna/alternatif/');
      exit();  
    }else{
      $this->flashmsg2('Gagal, Coba lagi!', 'warning');
      redirect('pengguna/alternatif/');
      exit();  
    }
  }
  elseif ($this->POST('edit')) { 
        
 

   
    $data = [
      'keterangan' => $this->POST('keterangan'),  
      'nama_alternatif' => $this->POST('nama')
    ];
    
    

    if ($this->Alternatif_m->update($this->POST('id_alternatif'),$data)) {
      $this->flashmsg2('Alternatif berhasil diedit.', 'success');
      redirect('pengguna/alternatif/');
      exit();  
    }else{
      $this->flashmsg2('Gagal, Coba lagi!', 'warning');
      redirect('pengguna/alternatif/');
      exit();  
    }
  }
 
  elseif ($this->POST('delete')) {
    if ($this->Alternatif_m->delete($this->POST('id_alternatif'))) {
      $this->flashmsg2('Alternatif berhasil dihapus.', 'success');
      redirect('pengguna/alternatif/');
      exit();  
    }else{
      $this->flashmsg2('Gagal, Coba lagi!', 'warning');
      redirect('pengguna/alternatif/');
      exit();  
    }
  }
  else {
    $this->data['alternatif'] = $this->Alternatif_m->get();
    $this->data['data'] = $this->Data_m->get();
    $this->data['index'] = 4;
    $this->data['content'] = 'pengguna/alternatif';
    $this->template($this->data,'pengguna');
  }
}


public function data()
{     

  if ($this->POST('add')) { 
    
    if ($this->Data_m->get_num_row(['nik' => $this->POST('nik')]) != 0) {
      $this->flashmsg2('NIK telah digunakan!', 'warning');
      redirect('pengguna/data/');
      exit(); 
    }
  
    $data = [
      'nik' => $this->POST('nik'),  
      'nama_kk' => $this->POST('nama_kk'),
      'jumlah_keluarga' => $this->POST('jumlah_keluarga'),
      'alamat' => $this->POST('alamat'),
      'no_tlp' => $this->POST('no_tlp')
    ];

    if ($this->Data_m->insert($data)) {
      $this->flashmsg2('Data Penduduk berhasil ditambah', 'success');
      redirect('pengguna/data/');
      exit();  
    }else{
      $this->flashmsg2('Gagal, Coba lagi!', 'warning');
      redirect('pengguna/data/');
      exit();  
    }
  }
  elseif ($this->POST('edit')) { 
     if ($this->Data_m->get_num_row(['nik' => $this->POST('nik')]) != 0 && $this->POST('nik') != $this->POST('nik_x') ) {
      $this->flashmsg2('NIK telah digunakan!', 'warning');
      redirect('pengguna/data/');
      exit(); 
    }   
 

   
    $data = [
      'nik' => $this->POST('nik'),  
      'nama_kk' => $this->POST('nama_kk'),
      'jumlah_keluarga' => $this->POST('jumlah_keluarga'),
      'alamat' => $this->POST('alamat'),
      'no_tlp' => $this->POST('no_tlp')
    ];
    
    

    if ($this->Data_m->update($this->POST('nik_x'),$data)) {
      $this->flashmsg2('Data Penduduk berhasil diedit.', 'success');
      redirect('pengguna/data/');
      exit();  
    }else{
      $this->flashmsg2('Gagal, Coba lagi!', 'warning');
      redirect('pengguna/data/');
      exit();  
    }
  }
 
  elseif ($this->POST('delete')) {
    if ($this->Data_m->delete($this->POST('nik'))) {
      $this->flashmsg2('Data Penduduk berhasil dihapus.', 'success');
      redirect('pengguna/data/');
      exit();  
    }else{
      $this->flashmsg2('Gagal, Coba lagi!', 'warning');
      redirect('pengguna/data/');
      exit();  
    }
  }
  else {
    $this->data['data'] = $this->Data_m->get();
    $this->data['index'] = 10;
    $this->data['content'] = 'pengguna/penduduk';
    $this->template($this->data,'pengguna');
  }
}
 

public function penilaian()
{     

  if ($this->POST('inputnilai')) { 
        
    $i = 0; 
    $nilai = $this->POST('kriteria');
    $list_kriteria = $this->Kriteria_m->get();

    foreach ($list_kriteria as $k) { 
        
         $data = [   
            'id_alternatif ' => $this->POST('id_alternatif'),  
            'id_kriteria  ' => $k->id_kriteria,  
            'nilai  ' => $nilai[$i]
          ];
          $this->Penilaian_m->insert($data);
          $i++;
    

    }

    

    $this->flashmsg2('Penilaian berhasil diinput', 'success');
    redirect('pengguna/penilaian/');
    exit();  
  } 
  if ($this->POST('editnilai')) { 
        
    $this->Penilaian_m->delete_by(['id_alternatif' => $this->POST('id_alternatif')]);
    $i = 0; 
    $nilai = $this->POST('kriteria');
    $list_kriteria = $this->Kriteria_m->get();

    foreach ($list_kriteria as $k) {
     
         $data = [  
            'id_alternatif ' => $this->POST('id_alternatif'),  
            'id_kriteria  ' => $k->id_kriteria,  
            'nilai  ' => $nilai[$i]
          ];
          $this->Penilaian_m->insert($data);
          $i++;
     
    }

    

    $this->flashmsg2('Penilaian berhasil diedit', 'success');
    redirect('pengguna/penilaian/');
    exit();  
  } 
  elseif ($this->POST('deletenilai')) {
    if ($this->Penilaian_m->delete_by(['id_alternatif' => $this->POST('id_alternatif')])) {
      $this->flashmsg2('Penilaian berhasil dihapus.', 'success');
      redirect('pengguna/penilaian/' );
      exit();  
    }else{
      $this->flashmsg2('Gagal, Coba lagi!', 'warning');
      redirect('pengguna/penilaian/' );
      exit();  
    }
  }
 
  else{ 
 
    $this->data['list_alternatif'] = $this->Alternatif_m->get();
    $this->data['list_kriteria'] = $this->Kriteria_m->get();
    $this->data['index'] = 5  ;
    $this->data['content'] = 'pengguna/penilaian';
    $this->template($this->data,'pengguna');
  } 
}

public function ranking()
{     
  
    
    $ahp = $this->Penilaian_m->ahp(); 
    $this->data['rank'] = $ahp['rank'];
    
    $this->data['list_alternatif'] = $this->Alternatif_m->get();
    $this->data['list_kriteria'] = $this->Kriteria_m->get();
    $this->data['index'] = 6  ;
    $this->data['content'] = 'pengguna/ranking';
    $this->template($this->data,'pengguna');
  
}

public function laporan()
{     
  
 
    $ahp = $this->Penilaian_m->ahp(); 

    $this->data['rank'] = $ahp['rank'];
    $this->data['prioo'] = $ahp['prioo'];
    $this->data['hasil'] = $ahp['hasil'];
    $this->data['mp'] = $ahp['mp'];

     
    $this->data['eigen'] = $ahp['eigen'];
    $this->data['nilai_awal'] = $ahp['nilai_awal'];

    $this->data['list_alternatif'] = $this->Alternatif_m->get();
    $this->data['list_kriteria'] = $this->Kriteria_m->get();
    $this->data['index'] = 7  ;
    $this->data['content'] = 'pengguna/laporan';
    $this->template($this->data,'pengguna');
  
}


// PROFIL
  public function profile(){
    if ($this->POST('save')) {
      if ($this->login_m->get_num_row(['username' => $this->POST('username')]) != 0 && $this->POST('username') != $this->POST('usernamex')) { 
        $this->flashmsg2('username telah digunakan!', 'warning');
        redirect('pengguna/profile/');
        exit();  
      }

        if ($this->login_m->update($this->POST('usernamex'),['username' => $this->POST('username')])) {
          $user_session = [
            'username' => $this->POST('username')
          ];
          $this->session->set_userdata($user_session);

          $this->flashmsg2('Berhasil!', 'success');
          redirect('pengguna/profile/');
          exit();  
        }else{
          $this->flashmsg2('Gagal, Coba lagi!', 'warning');
          redirect('pengguna/profile/');
          exit();  
        } 
       

    } 

    if ($this->POST('gpw')) { 

      $cek = 0;
      $msg = ''; 
      if (md5($this->POST('passwordold')) != $this->data['profil']->password) {
        $msg = $msg . 'Password lama salah! <br>';
        $cek++;
      }

      if ($this->POST('passwordnew') != $this->POST('passwordnew2')) {
        $msg = $msg . 'Password baru tidak sama!';
        $cek++;
      }

      if ($cek != 0) {

        $this->flashmsg2($msg, 'warning');
        redirect('pengguna/profile/');
        exit();  
      }

      $data = [ 
        'password' => md5($this->POST('passwordnew')) 
      ];
      if ($this->login_m->update($this->data['profil']->username, $data)) {
        $this->flashmsg2('Password berhasil diganti!', 'success');
        redirect('pengguna/profile/');
        exit();  
      }else{
        $this->flashmsg2('Gagal, Coba lagi!', 'warning');
        redirect('pengguna/profile/');
        exit();  
      } 
    }

    $this->data['index'] = 9;
    $this->data['content'] = 'pengguna/profile';
    $this->template($this->data,'pengguna');
  }
  public function proses_edit_profil(){
    if ($this->POST('edit')) {
      
      


      
    } 
    elseif ($this->POST('edit2')) { 
      
      
      $this->login_m->update($this->data['username'],$data);
  
      $this->flashmsg('PASSWORD BARU TELAH TERSIMPAN!', 'success');
      redirect('pengguna/profil');
      exit();    
    }   
    else{ 
      redirect('pengguna/profil');
      exit();
    } 
  }  
 
  public function cekusername(){ echo $this->login_m->cekusername($this->input->post('username')); } 
  public function cekpasslama(){ echo $this->login_m->cekpasslama2($this->data['username'],$this->input->post('password')); } 
  public function cekpass(){ echo $this->login_m->cek_password_length2($this->input->post('password')); }
  public function cekpass2(){ echo $this->login_m->cek_passwords2($this->input->post('password'),$this->input->post('password2')); }
// PROFIL
 
}

 ?>
