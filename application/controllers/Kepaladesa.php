<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Kepaladesa extends MY_Controller
{

  function __construct()
  {
    parent::__construct();
  
        $this->data['username'] = $this->session->userdata('username');
        $this->data['id_role']  = $this->session->userdata('id_role'); 
          if (!$this->data['username'] || ($this->data['id_role'] != 2))
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
      $this->data['content'] = 'kepaladesa/dashboard';
      $this->template($this->data,'kepaladesa');
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
    $this->data['content'] = 'kepaladesa/laporan';
    $this->template($this->data,'kepaladesa');
  
}


// PROFIL
  public function profile(){
    if ($this->POST('save')) {
      if ($this->login_m->get_num_row(['username' => $this->POST('username')]) != 0 && $this->POST('username') != $this->POST('usernamex')) { 
        $this->flashmsg2('username telah digunakan!', 'warning');
        redirect('kepaladesa/profile/');
        exit();  
      }

        if ($this->login_m->update($this->POST('usernamex'),['username' => $this->POST('username')])) {
          $user_session = [
            'username' => $this->POST('username')
          ];
          $this->session->set_userdata($user_session);

          $this->flashmsg2('Berhasil!', 'success');
          redirect('kepaladesa/profile/');
          exit();  
        }else{
          $this->flashmsg2('Gagal, Coba lagi!', 'warning');
          redirect('kepaladesa/profile/');
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
        redirect('kepaladesa/profile/');
        exit();  
      }

      $data = [ 
        'password' => md5($this->POST('passwordnew')) 
      ];
      if ($this->login_m->update($this->data['profil']->username, $data)) {
        $this->flashmsg2('Password berhasil diganti!', 'success');
        redirect('kepaladesa/profile/');
        exit();  
      }else{
        $this->flashmsg2('Gagal, Coba lagi!', 'warning');
        redirect('kepaladesa/profile/');
        exit();  
      } 
    }

    $this->data['index'] = 9;
    $this->data['content'] = 'kepaladesa/profile';
    $this->template($this->data,'kepaladesa');
  }
  public function proses_edit_profil(){
    if ($this->POST('edit')) {
      
      


      
    } 
    elseif ($this->POST('edit2')) { 
      
      
      $this->login_m->update($this->data['username'],$data);
  
      $this->flashmsg('PASSWORD BARU TELAH TERSIMPAN!', 'success');
      redirect('kepaladesa/profil');
      exit();    
    }   
    else{ 
      redirect('kepaladesa/profil');
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
