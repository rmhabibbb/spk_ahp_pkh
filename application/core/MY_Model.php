<?php

class MY_Model extends CI_Model
{
	protected $data = [];

	public function __construct()
	{
		parent::__construct();
	}

	public function affected_rows()
	{
		return $this->db->affected_rows();
	}

	public function get($cond = '')
	{
		if (is_array($cond))
			$this->db->where($cond);
		if (is_string($cond) && strlen($cond) > 3)
			$this->db->where($cond);

		$query = $this->db->get($this->data['table_name']);

		return $query->result();
	}

	public function get_by_order($ref, $order, $cond = '')
	{
		if (is_array($cond))
			$this->db->where($cond);
		if (is_string($cond) && strlen($cond) > 3)
			$this->db->where($cond);

		$this->db->order_by($ref, $order);
		$query = $this->db->get($this->data['table_name']);

		return $query->result();
	}

	public function get_by_order_limit($ref, $order, $cond = '')
	{
		if (is_array($cond))
			$this->db->where($cond);

		$this->db->order_by($ref, $order);
		$this->db->limit(1);
		$query = $this->db->get($this->data['table_name']);

		return $query->row();
	}

	public function get_by_order_any_limit($ref, $order, $number, $cond = '')
	{
		if (is_array($cond))
			$this->db->where($cond);

		$this->db->order_by($ref, $order);
		$this->db->limit($number);
		$query = $this->db->get($this->data['table_name']);

		return $query->result();
	}

	public function get_row($cond)
	{
		$this->db->where($cond);
		$query = $this->db->get($this->data['table_name']);

		return $query->row();
	}

	public function get_num_row($cond)
	{
		$this->db->where($cond);
		$query = $this->db->get($this->data['table_name']);

		return $query->num_rows();
	}

	public function insert($data)
	{
		return $this->db->insert($this->data['table_name'], $data);
	}

	public function update($pk, $data)
	{
		$this->db->where($this->data['primary_key'], $pk);
		return $this->db->update($this->data['table_name'], $data);
	}

	public function update_where($cond, $data)
	{
		$this->db->where($cond);
		return $this->db->update($this->data['table_name'], $data);
	}

	public function delete($pk)
	{
		$this->db->where($this->data['primary_key'], $pk);
		return $this->db->delete($this->data['table_name']);
	}

	public function delete_by($cond)
	{
		$this->db->where($cond);
		return $this->db->delete($this->data['table_name']);
	}

	public function getOrdered($order = 'ASC')
	{
		$query = $this->db->query('SELECT * FROM ' . $this->data['table_name'] . ' ORDER BY ' . $this->data['primary_key'] . ' ' . $order);
		return $query->result();
	}

	public function getDataLike($like)
	{
		$this->db->select('*');
		$this->db->like($like);
		$query = $this->db->get($this->data['table_name']);
		return $query->result();
	}

	public function getDataLike2($like,$cond = '')
	{
		$this->db->select('*');
		$this->db->like($like);
		if (is_array($cond))
			$this->db->where($cond);
		if (is_string($cond) && strlen($cond) > 3)
			$this->db->where($cond);
		
		$query = $this->db->get($this->data['table_name']);
		return $query->result();
	}

	public function getDataJoin($tables, $jcond)
	{
		$this->db->select('*');
		for ($i = 0; $i < count($tables); $i++)
			$this->db->join($tables[$i], $jcond[$i]);
		return $this->db->get($this->data['table_name'])->result();
	}

	public function getJSON($url)
	{
		$content = file_get_contents($url);
		$data = json_decode($content);
		return $data;
	}

	public function validate($conf)
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules($conf);
		return $this->form_validation->run();
	}

	public function required_input($input_names)
	{
		$rules = [];
		foreach ($input_names as $input)
		{
			$rules []= [
				'field'		=> $input,
				'label'		=> ucfirst($input),
				'rules'		=> 'required'
			];
		}

		return $this->validate($rules);
	}

	public function flashmsg($msg, $type = 'success')
	{
		return $this->session->set_flashdata('msg', '<div class="alert alert-'.$type.'">'.$msg.'</div>');
	}

	public function get_col($col)
	{
		$query = $this->db->query('SELECT '.$col.' FROM ' . $this->data['table_name']);
		return $query->result();
	}

	public function group_subunsur($p){

		$this->db->where('unsur' , $p);
		$this->db->select('kode ,sub_unsur');
		$this->db->group_by('sub_unsur');  
		return $this->db->get('kegiatan')->result();
 		
	}

	public function cekemail($email){
		$this->db->where('email' , $email);
		$query = $this->db->get($this->data['table_name']);
 
		$output = "";
		if ($email != $this->session->userdata('email')) {
			if ( $query->num_rows() != 0  ) {
		  		$output .= '<i style="color:red">Email telah digunakan!</i>';
		  	}
		}
	  	
	  	return $output;
	}

	public function cekemail2($email){
		$this->db->where('email' , $email);
		$query = $this->db->get($this->data['table_name']);
 
		$output = "";
		if ($email != $this->session->userdata('email')) {
			if ( $query->num_rows() != 0  ) {
		  		$output .= '<i style="color:red">Email is already used!</i>';
		  	}
		}
	  	
	  	return $output;
	}

	public function cekpasslama($email,$pass){
		$this->db->where('email' , $email);
		$query = $this->db->get($this->data['table_name'])->row();
 
		$output = "";
	  	if ( $query->password != md5($pass)  ) {
	  		$output .= '<i style="color:red">Password Salah!</i>';
	  	}
	  	return $output;
	}

	public function cekpasslama2($email,$pass){
		$this->db->where('email' , $email);
		$query = $this->db->get($this->data['table_name'])->row();
 
		$output = "";
	  	if ( $query->password != md5($pass)  ) {
	  		$output .= '<i style="color:red">Wrong Password!</i>';
	  	}
	  	return $output;
	}
	public function cek_password_length($password)
        {

		  $output = "";
          if (strlen($password) < 8 ) {
            $output .= '<i style="color:red">Minimal 8 Karakter!</i>';
          }
          return $output;
        }

    public function cek_password_length2($password)
        {

		  $output = "";
          if (strlen($password) < 8 ) {
            $output .= '<i style="color:red">Minimum 8 Characters!</i>';
          }
          return $output;
        }


	
        public function cek_passwords($password,$confirm_password){
        	 $output = ""; 
            if ( $password != $confirm_password) {
            $output .= '<i style="color:red">Kata sandi baru tidak sama !</i>';
          }
          return $output;
        }

        public function cek_passwords2($password,$confirm_password){
        	 $output = ""; 
            if ( $password != $confirm_password) {
            $output .= '<i style="color:red">Passwords are not the same!</i>';
          }
          return $output;
        }
 
  
}

/* End of file MY_Model.php */
/* Location: ./application/core/MY_Model.php */
