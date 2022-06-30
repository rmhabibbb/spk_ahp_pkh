    <!-- Header -->
    <!-- Header -->
    <div class="header   pb-6 bg-gradient-gray" >
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">
            <div class="col-lg-6 col-7">  
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li class="breadcrumb-item"><a href=" href="<?=base_url('penilai')?>"><i class="fas fa-home"></i></a></li> 
                  <li class="breadcrumb-item active" aria-current="page">Kelola Kriteria</li>
                </ol>
              </nav>
            </div> 
            <div class="col-lg-6 col-5 text-right">
              <a href="#" data-toggle="modal" data-target="#exampleModal" class="btn btn-sm btn-neutral">Tambah Kriteria</a> 
            </div>
          </div>
        </div>
        <?= $this->session->flashdata('msg2') ?>
      </div>
    </div>
    <!-- Page content -->
    <div class="container-fluid mt--6">
      <div class="row">
        <div class="col">
          <div class="card">
            <!-- Card header -->
            <div class="card-header border-0">
              <h3 class="mb-0">Kelola Kriteria</h3>
            </div>
            <!-- Light table -->

            <div class="table-responsive py-4">
              <table class="table table-flush" id="datatable-basic">
                <thead class="thead-light">
                  <tr>  
                    <th>No.</th>
                    <th>Nama Kriteria</th> 
                    <th>Inisial</th>  
                    <th>Action</th>  
                  </tr>
                </thead>
                <tbody class="list">

                 <?php $i = 1; foreach ($list_kriteria as $row): ?> 
                  <tr> 
                    <td>
                      <?=$i++?>
                    </td> 
                    <td>
                      <?=$row->nama_kriteria?>
                    </td>  
                    <td>
                      <?=$row->inisial?>
                    </td>  
                    
                    <td class="text-right">
                      <a href="" data-toggle="modal" data-target="#edit-<?=$row->id_kriteria?>">
                        <button type="button" class="btn btn-twitter btn-icon"> 
                          <span class="btn-inner--text">Edit</span>
                        </button>
                      </a>
                      <a href="" data-toggle="modal" data-target="#delete2-<?=$row->id_kriteria?>">
                        <button type="button" class="btn btn-instagram btn-icon"> 
                          <span class="btn-inner--text">Hapus</span>
                        </button>
                      </a>
 
                    </td>
                  </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div> 
          </div>

          <?php if (sizeof($list_kriteria) > 1) { ?>
          <div class="card" id="mp">
            <!-- Card header -->
            <div class="card-header border-0">
              <h3 class="mb-0">Matrik Perbandingan Kriteria</h3>
            </div>
            <!-- Light table -->
            <form action="<?=base_url('pengguna/kriteria')?>" method="POST">
            <div class="table-responsive py-4">
              <table class="table table-flush" id="datatable-basic">
                <thead class="thead-light">
                  <tr>   
                    <th>Nama Kriteria</th>  
                    <?php $i = 1; foreach ($list_kriteria as $row): ?> 
                      <th><?=$row->inisial?></th>
                    <?php endforeach; ?>
                  </tr>
                </thead>
                <tbody class="list">

                 <?php $i = 1; foreach ($list_kriteria as $row): ?> 
                  <tr> 
                 
                    <td>
                      <?=$row->inisial?>
                    </td>   
                    <?php foreach ($list_kriteria as $row2): ?> 
                      <?php $mp = $this->MPKriteria_m->get_row(['id_kriteria' => $row->id_kriteria, 'id_kriteria_2' => $row2->id_kriteria]); ?>
                      <td>
                        <?php if ($row->id_kriteria == $row2->id_kriteria) { ?>

                        <input type="hidden" name="mp-<?=$row->id_kriteria?>-<?=$row2->id_kriteria?>"  value="<?=$mp->nilai?>" >
                        <?php  echo $mp->nilai;
                        }else { ?> 
                        <input type="number" name="mp-<?=$row->id_kriteria?>-<?=$row2->id_kriteria?>"  class="form-control" style="width: 80px" value="<?=$mp->nilai?>" step="any" required>
                        <?php  }  ?> 
                      </td>   
                    <?php endforeach; ?>
                    
                  </tr>
                  <?php endforeach; ?>
                  <tr>
                      <th>Jumlah</th>

                      <?php $i = 1; foreach ($list_kriteria as $row): ?> 
                        <?php $sum = $this->MPKriteria_m->get_sum($row->id_kriteria)->sum; ?>
                        <td><?=$sum?></td>
                      <?php endforeach; ?>
                    </tr>
                </tbody>
              </table>
            </div> 
            <center>
              
            <input type="submit" name="setmp" class="btn bg-gradient-primary text-white" value="Simpan ">
            </center>
            <br>
            </form>
          </div>

          <div class="card">
            <!-- Card header -->
            <div class="card-header border-0">
              <h3 class="mb-0">Matriks Nilai Bobot Kriteria</h3>
            </div>
            <!-- Light table -->

            <div class="table-responsive py-4">
              <table class="table table-flush" id="datatable-basic">
                <thead class="thead-light">
                  <tr>   
                    <th>Nama Kriteria</th>  
                    <?php $i = 1; foreach ($list_kriteria as $row): ?> 
                      <th><?=$row->inisial?></th>
                    <?php endforeach; ?>
                    <th>Jumlah</th>
                    <th>Bobot</th>
                  </tr>
                </thead>
                <tbody class="list">
                  <?php 
                      for ($i=0; $i < sizeof($list_kriteria) ; $i++) { 
                          $jj[$i]  = 0;
                      }

                      for ($i=0; $i < sizeof($list_kriteria) ; $i++) { 
                          $prioo[$i]  = 0;
                      }
                    ?>
                 <?php  $i=0;  $prio = 0; foreach ($list_kriteria as $row): ?> 
                  <tr> 
                 
                    <td>
                      <?=$row->inisial?>
                    </td>   
                    <?php
                     $jum = 0; 
                     $j = 0;
                     foreach ($list_kriteria as $row2): ?> 
                      <?php $sum = $this->MPKriteria_m->get_sum($row2->id_kriteria)->sum; ?>
                      <?php $mp = $this->MPKriteria_m->get_row(['id_kriteria' => $row->id_kriteria, 'id_kriteria_2' => $row2->id_kriteria]); ?>
                      <td>
                         <?php 

                          $x = $mp->nilai/$sum;
                          $jum = $jum +  $x;
                          $jj[$j] = $jj[$j] +  $x;  
                          
                          echo round($x,3);
                          $j++;
                         ?>
                      </td>   
                    <?php endforeach; ?>
                    <td>
                      <?=round($jum,3)?>
                    </td>
                    <td>
                      <?php 

                      $prioo[$i] = $jum/sizeof($list_kriteria);
                      $prio += $jum/sizeof($list_kriteria); 
                      $i++;
                      ?>
                      <?=round($jum/sizeof($list_kriteria),3)?>
                    </td>
                  </tr>
                  <?php endforeach; ?>
                  <tr>
                    <th>Jumlah</th>
                    <?php 
                      for ($i=0; $i < sizeof($list_kriteria) ; $i++) { 
                        echo '<td>'. round($jj[$i],3) .'</td>';
                      }
                    ?>
                    <td></td>
                    <td><?=round($prio,3)?></td>
                  </tr>
                </tbody>
              </table>
            </div> 
          </div>

          <div class="card">
            <!-- Card header -->
            <div class="card-header border-0">
              <h3 class="mb-0">Matriks Penjumlahan Setiap Baris Kriteria</h3>
            </div>
            <!-- Light table -->

            <div class="table-responsive py-4">
              <table class="table table-flush" id="datatable-basic">
                <thead class="thead-light">
                  <tr>   
                    <th>Nama Kriteria</th>  
                    <?php $i = 1; foreach ($list_kriteria as $row): ?> 
                      <th><?=$row->inisial?></th>
                    <?php endforeach; ?>
                    <th>Jumlah</th> 
                  </tr>
                </thead>
                <tbody class="list"> 
                 <?php 
                   for ($i=0; $i < sizeof($list_kriteria) ; $i++) { 
                          $jpb[$i]  = 0;
                      }
                      $j = 0;
                  $prio = 0; foreach ($list_kriteria as $row): ?> 
                  <tr> 
                 
                    <td>
                      <?=$row->inisial?>
                    </td>   

                    <?php
                     $jum = 0;  $i=0;
                     foreach ($list_kriteria as $row2): ?> 
                      <?php $sum = $this->MPKriteria_m->get_sum($row2->id_kriteria)->sum; ?>
                      <?php $mp = $this->MPKriteria_m->get_row(['id_kriteria' => $row->id_kriteria, 'id_kriteria_2' => $row2->id_kriteria]); ?>
                      <td>
                         <?php 
                          $x =  $mp->nilai * $prioo[$i];
                          $jum += $x;
                          echo  round($x,3) ;
                          $i++;
                         ?>
                      </td>   
                    <?php endforeach; ?>
                    <td> 
                      <?=round($jum,3)?>
                    </td>
                     
                  </tr>
                  <?php $jpb[$j] = $jum ; $j++ ?>
                  <?php endforeach; ?>
                  
                </tbody>
              </table>
            </div> 
          </div>

          <div class="card" id="rasio">
            <!-- Card header -->
            <div class="card-header border-0">
              <h3 class="mb-0">Perhitungan Rasio Konsistensi</h3>
            </div>
            <!-- Light table -->

            <div class="table-responsive py-4">
              <table class="table table-flush" id="datatable-basic">
                <thead class="thead-light">
                  <tr>   
                    <th>Nama Kriteria</th>   
                    <th>Jumlah Per Baris </th> 
                    <th>Prioritas</th>
                    <th>Hasil</th>  
                  </tr>
                </thead>
                <tbody class="list"> 
                 <?php $i=0; $jumlahhasil = 0; foreach ($list_kriteria as $row): ?> 
                  <tr> 
                 
                    <td>
                      <?=$row->nama_kriteria?>
                    </td>   
                   
                    <td> 
                        <?php 
                       
                          echo round($jpb[$i],3); 
                       ?>
                    </td>
                    <td> 
                       <?php 
                       
                          echo round($prioo[$i],3);
                         
                       ?>
                    </td>
                    <td> 
                       <?php 
                          $jumlahhasil += ($jpb[$i]+$prioo[$i]);
                          echo round($jpb[$i]+$prioo[$i],3);
                           $i++;
                       ?>
                    </td>
                     
                  </tr>
                  <?php endforeach; ?>
                  
                </tbody>
              </table>
            </div> 
            <div class="table-responsive py-4">
              <table class="table table-flush" id="datatable-basic">
               <tr>
                  <th>Principe Eigen Vector (λ maks)</th>
                  <th><?php echo (round($jumlahhasil/sizeof($list_kriteria),5))?></th>
                </tr>
                <tr>
                  <th>Consistency Index</th>
                  <th><?php
                   $ci = ($jumlahhasil/sizeof($list_kriteria)-sizeof($list_kriteria))/(sizeof($list_kriteria)-1);
                   echo (round($ci,5))?></th>
                </tr>
                <tr>
                  <th>Consistency Ratio</th>
                  <th><?php 

                  $ir = $this->IR_m->get_row(['jumlah' => sizeof($list_kriteria)])->nilai; 
                  if (sizeof($list_kriteria) > 2) {
                    $cr = ($ci/$ir);
                  }else{
                    $cr = 0;
                  }
                  echo (round($cr,2))?></th>
                </tr>

              </table>
              <?php if ($cr > 0.1) { ?>
              <div class="alert alert-warning alert-dismissible fade show" role="alert"> 
                <span class="alert-text"><strong>Nilai Consistency Ratio melebihi dari 0.1!</strong> Input ulang matrik perbandingan ->> <a href="#mp">Input</a>!!!</span>
                 
              </div>
               <?php  }else{  ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert"> 
                <span class="alert-text"><strong>Nilai Consistency Ratio kurang dari 0.1</strong>  </span>
                 
              </div>
               <?php  }  ?>
            </div> 
          </div>

          <?php  } ?>


        </div>
      </div>
  


<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Form Tambah Kriteria</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      
      <?= form_open_multipart('pengguna/kriteria/') ?>
      <div class="modal-body">
          
            <div class="form-group">
                <label for="example-email-input" class="form-control-label">Nama Kriteria</label>
                <input class="form-control" type="text" required name="nama" >
            </div>   
            <div class="form-group">
                <label for="example-email-input" class="form-control-label">Inisial</label>
                <input class="form-control" type="text" required name="inisial" >
            </div>   
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <input type="submit" class="btn btn-primary" name="add" value="Submit"> 
      </div>
      </form>
    </div>
  </div>
</div>

<?php $i = 1; foreach ($list_kriteria as $row): ?> 
<div class="modal fade" id="edit-<?=$row->id_kriteria?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Form Edit Kriteria</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      
      <?= form_open_multipart('pengguna/kriteria/') ?>
      <div class="modal-body">
         
          <input type="hidden" required name="id_kriteria"  value="<?=$row->id_kriteria?>"> 
   
            <div class="form-group">
                <label for="example-email-input" class="form-control-label">Nama Kriteria</label>
                <input class="form-control" type="text" required name="nama" value="<?=$row->nama_kriteria?>" >
            </div>   
             <div class="form-group">
                <label for="example-email-input" class="form-control-label">Inisial</label>
                <input class="form-control" type="text" required name="inisial" value="<?=$row->inisial?>" >
            </div>   
    
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <input type="submit" class="btn btn-primary" name="edit" value="Submit"> 
      </div>
      </form>
    </div>
  </div>
</div>
 

<div class="modal fade" id="delete2-<?=$row->id_kriteria?>" tabindex="-1" role="dialog" aria-labelledby="modal-notification" aria-hidden="true">
    <div class="modal-dialog modal-danger modal-dialog-centered modal-" role="document">
        <div class="modal-content bg-gradient-danger"> 
              
                  <div class="modal-body">
                    
                      <div class="py-3 text-center">
                          <i class="ni ni-bell-55 ni-3x"></i>
                          <h4 class="heading mt-4"> Hapus Kriteria ini? </h4> 
                      </div>
                      
                  </div>
                  
                  <form action="<?= base_url('pengguna/kriteria')?>" method="Post" >  
                  <div class="modal-footer">

                   
                      <input type="hidden" value="<?=$row->id_kriteria?>" name="id_kriteria">  
                      <input type="submit" class="btn btn-white" name="delete" value="Ya!">
                     
                      <button type="button" class="btn btn-link text-white ml-auto" data-dismiss="modal">Close</button>
                  </div>
                </form>
          </div>
  </div>
</div>
<?php endforeach; ?>