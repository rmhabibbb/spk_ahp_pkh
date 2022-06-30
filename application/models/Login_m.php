<?php

class Login_m extends MY_Model{
	public function __construct(){
		parent::__construct();
		$this->data['table_name'] 	= 'akun';
    	$this->data['primary_key']	= 'username';
	}
	
	public function cek_login($username,$password){
		$user_data = $this->get_row(['username'=>$username]);
		if(isset($user_data)){
			if ($user_data->password == md5($password)) {

				 
				$user_session = [
					'username'	=> $user_data->username, 
					'id_role'	=> $user_data->role 
				]; 
				
				$this->db->where($this->data['primary_key'], $username);
		 		$this->db->update($this->data['table_name'], ['last_login' => date('Y-m-d H:i:s')]);
				$this->session->set_userdata($user_session);
				return 2;
			}else {
				return 1;
			}
		}
		return 0;
	}
}