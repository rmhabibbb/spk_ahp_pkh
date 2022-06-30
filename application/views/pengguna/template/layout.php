<?php
$data =[ 
  'index' => $index
];
$this->load->view('pengguna/template/header',$data);
$this->load->view('pengguna/template/sidebar',$data);
$this->load->view('pengguna/template/navbar');
$this->load->view($content);
$this->load->view('pengguna/template/footer');
 ?>
