<?php
/**
 *
 */
class Login extends MY_Controller {
  function __construct() {
    parent::__construct();
    $this->data['username'] = $this->session->userdata('username');
    $this->data['id_role']  = $this->session->userdata('id_role');
    if (isset($this->data['username'], $this->data['id_role']))
    { 
      if ($this->data['id_role'] == 1) { 
          redirect('pengguna');
          exit();
      }elseif ($this->data['id_role'] == 2) { 
          redirect('kepaladesa');
          exit();
      } 
    }
    $this->load->model('Login_m'); 
    date_default_timezone_set("Asia/Jakarta"); 
  }

  
  public function index() {
    $this->data[ 'title' ] = 'Login | ' . $this->title;
    $this->data[ 'content' ] = 'login';
    $this->load->view('sign-in');
  }

  public function cek(){
      $username = $this->POST('username');
      $password = $this->POST('password');
      if($this->Login_m->cek_login($username,$password) == 0){
        $this->flashmsg('username tidak terdaftar!', 'danger');
        redirect('login');
        exit;
      }else if($this->Login_m->cek_login($username,$password) == 1){
        setcookie('username_temp', $username, time() + 5, "/");
        $this->flashmsg('Password Salah!', 'danger');
        redirect('login');
        exit;
      } 
    redirect('login');
  }


}

?>
