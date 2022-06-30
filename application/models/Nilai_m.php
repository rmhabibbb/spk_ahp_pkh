<?php 
class Nilai_m extends MY_Model
{

  function __construct()
  {
    parent::__construct();
    $this->data['primary_key'] = 'id_nilai';
    $this->data['table_name'] = 'nilai';
  }
}

 ?>
