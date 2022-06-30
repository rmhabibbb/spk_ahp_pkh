<?php 
class Alternatif_m extends MY_Model
{

  function __construct()
  {
    parent::__construct();
    $this->data['primary_key'] = 'id_alternatif';
    $this->data['table_name'] = 'alternatif';
  }
}

 ?>
