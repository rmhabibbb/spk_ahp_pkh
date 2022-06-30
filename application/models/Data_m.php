<?php 
class Data_m extends MY_Model
{

  function __construct()
  {
    parent::__construct();
    $this->data['primary_key'] = 'nik';
    $this->data['table_name'] = 'data_penduduk';
  }
}

 ?>
