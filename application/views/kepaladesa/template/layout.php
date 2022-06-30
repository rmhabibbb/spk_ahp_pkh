<?php
$data =[ 
  'index' => $index
];
$this->load->view('kepaladesa/template/header',$data);
$this->load->view('kepaladesa/template/sidebar',$data);
$this->load->view('kepaladesa/template/navbar');
$this->load->view($content);
$this->load->view('kepaladesa/template/footer');
 ?>
