<?php 
class Penilai_m extends MY_Model
{

  function __construct()
  {
    parent::__construct();
    $this->data['primary_key'] = 'id_penilai';
    $this->data['table_name'] = 'penilai';
  }
}

 ?>
