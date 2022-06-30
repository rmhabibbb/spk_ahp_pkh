 
<div class="header   pb-6 bg-gradient-gray" >
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">
            <div class="col-lg-6 col-7">  
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li class="breadcrumb-item"><a   href="<?=base_url('kepaladesa')?>"><i class="fas fa-home"></i></a></li> 
                  <li class="breadcrumb-item active" aria-current="page"><a   href="<?=base_url('kepaladesa/laporan')?>">Laporan</a></li> 
                  <li class="breadcrumb-item active" aria-current="page">Metode AHP</li>
                </ol>
              </nav>
            </div> 
            <div class="col-lg-6 col-5 text-right">
            
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

          <?php if ($this->Alternatif_m->get_num_row([]) == 0) { ?>
          
          <div class="card">
            <div class="card-header border-0"  >
              <h3 class="mb-0"><center>Tidak ada alternatif</center></h3>
            </div>
          </div>

          <?php  }else{ ?> 
          <div class="card">
            <!-- Card header -->

            

            <div class="card-header border-0" style="padding-bottom: 0">
              <h3 class="mb-0">Bobot Kriteria</h3>
            </div>
            <!-- Light table -->
            <div class="card-body" style="padding-top: 0"> 
               <div class="table-responsive py-4">
                  <table class="table table-flush">
                    <thead class="thead-light">
                      <tr>  
                        <th>Kriteria</th> 
                        <th>Bobot</th>   
                      </tr>
                    </thead>
                    <tbody class="list">
                    <?php $i = 0 ; foreach ($list_kriteria as $k): ?>

                   
                         <tr>
                            <td><?php  
                                echo $k->nama_kriteria; 
                            ?></td> 
                            <td><?=$prioo[$i++]?></td>
                          </tr> 



                    <?php endforeach; ?>
                    </tbody>
                  </table>
                </div>
 
            </div>
          </div>


          <?php $i = 0 ; foreach ($list_kriteria as $k): ?>
           
            <div class="card">
                              <!-- Card header -->
                              <div class="card-header border-0" style="padding-bottom: 0">
                                <h3 class="mb-0"><?=$k->nama_kriteria?></h3>
                              </div>
                              <!-- Light table -->
                              <div class="card-body" style="padding-top: 0"> 
                                <div class="table-responsive py-4">
                                <table class="table table-flush">
                                  <thead class="thead-light">
                                    <tr>  
                                      <th>ID Alternatif</th>
                                      <th>Keterangan Alternatif</th>  
                                      <th>Nilai</th>   
                                    </tr>
                                  </thead>
                                  <tbody class="list">

                                     <?php foreach ($list_alternatif as $row): ?> 
                                         <?php

                                         if ($this->Penilaian_m->get_num_row(['id_alternatif' => $row->id_alternatif, 'id_kriteria' => $k->id_kriteria]) != 0) {
                                                $x = $this->Penilaian_m->get_row(['id_alternatif' => $row->id_alternatif, 'id_kriteria' => $k->id_kriteria])->nilai ;
                                              }else{
                                                $x = 0;
                                              }
                                           ?>
                                           
                                        <?php $penduduk = $this->Data_m->get_row(['nik' => $row->nik]) ?>
                                          <tr> 
                                            <td>
                                              <?=$row->id_alternatif?>
                                            </td> 
                                            <td>
                                              [<?=$penduduk->nik?>] <?=$penduduk->nama_kk?>
                                            </td>  
                                            <th>
                                              <?=$x?>
                                            </th>
                                          </tr>
                                          <?php  endforeach; ?>
                                    </tbody>
                                  </table>
                              </div>
                              <h3 class="mb-0">- Matrik Perbandingan Alternatif</h3>
                              <div class="table-responsive py-4">
                                <table class="table table-flush">
                                  <thead class="thead-light">
                                    <tr>  
                                      <th>Alternatif</th>

                                     <?php foreach ($list_alternatif as $row): ?> 

                                        <?php $penduduk = $this->Data_m->get_row(['nik' => $row->nik]) ?>
                                        <th>[<?=$penduduk->nik?>] <?=$penduduk->nama_kk?></th>
                                     <?php  endforeach; ?> 
                                    </tr>
                                  </thead>
                                  <tbody class="list">

                                     <?php $z =0; foreach ($list_alternatif as $row): ?> 
                                          <tr>
                                            <?php $penduduk = $this->Data_m->get_row(['nik' => $row->nik]) ?>
                                        <th>[<?=$penduduk->nik?>] <?=$penduduk->nama_kk?></th>
                                            <?php 
                                              for ($l=0; $l < sizeof($mp[$i]['nilai'][$z]) ; $l++) { 
                                                echo "<td>".$mp[$i]['nilai'][$z][$l]."</td>";
                                              }
                                            ?>
                                          </tr>
                                      <?php $z++;  endforeach; ?>

                                      <tr>
                                        <th>Jumlah</th>
                                        <?php 
                                          for ($l=0; $l < sizeof($mp[$i]['nilai']) ; $l++) { 
                                            echo "<th>".$mp[$i]['sum'][$l]."</th>";
                                          }
                                        ?>
                                      </tr>
                                    </tbody>
                                  </table>
                              </div>

                              <h3 class="mb-0">- Bobot Alternatif</h3>
                              <div class="table-responsive py-4">
                                <table class="table table-flush">
                                  <thead class="thead-light">
                                    <tr>  
                                      <th>Alternatif</th>

                                     <?php foreach ($list_alternatif as $row): ?> 
                                        <?php $penduduk = $this->Data_m->get_row(['nik' => $row->nik]) ?>
                                        <th>[<?=$penduduk->nik?>] <?=$penduduk->nama_kk?></th>
                                     <?php  endforeach; ?> 
                                      <th>Jumlah</th>
                                      <th>Bobot</th>
                                    </tr>
                                  </thead>
                                  <tbody class="list">

                                     <?php $z =0; foreach ($list_alternatif as $row): ?> 
                                          <tr>
                                           <?php $penduduk = $this->Data_m->get_row(['nik' => $row->nik]) ?>
                                        <th>[<?=$penduduk->nik?>] <?=$penduduk->nama_kk?></th>
                                            <?php 
                                              for ($l=0; $l < sizeof($mp[$i]['nilai'][$z]) ; $l++) { 
                                                echo "<td>".round($eigen[$i]['nilai'][$z][$l],4)."</td>";
                                              }
                                            ?>
                                            <th><?=round($eigen[$i]['jum'][$z],4)?></th>
                                            <th><?=round($eigen[$i]['eigen'][$z],4)?></th>
                                            <th></th>
                                          </tr>
                                      <?php $z++;  endforeach; ?>

                                      
                                    </tbody>
                                  </table>
                              </div>
                   
                              </div>
                            </div>
         
          <?php endforeach; ?>

          <div class="card">
            <!-- Card header -->
            <div class="card-header border-0" style="padding-bottom: 0">
              <h3 class="mb-0"> Hasil Akhir Penentuan Alternatif Terbaik</h3>
            </div>
            <!-- Light table -->
            <div class="card-body" style="padding-top: 0"> 
               <div class="table-responsive py-4">
                  <table class="table table-flush">
                    <thead class="thead-light">
                      <tr>  
                        <th></th>
                        <?php $i = 1 ; foreach ($list_kriteria as $k): ?>

                      
                         <th>K<?=$i++?></th>
                     



                    <?php endforeach; ?>
                    <th>Jumlah</th>
                      </tr>
                    </thead>
                    <tbody class="list">
                     <?php $j = 0; foreach ($list_alternatif as $row): ?> 
                
                   <?php $penduduk = $this->Data_m->get_row(['nik' => $row->nik]) ?> 
                  <tr>  
                    <td>
                     [<?=$penduduk->nik?>] <?=$penduduk->nama_kk?>
                    </td>  
                    <?php 
                      $x = 0;
                        for ($z=0; $z < sizeof($eigen); $z++) {  
                          $x = $x + ($eigen[$z]['eigen'][$j]*$prioo[$z]);
                          echo "<td>". round($eigen[$z]['eigen'][$j]*$prioo[$z],4) .'</td>';
                          
                        }  
                        $j++; 
                        echo "<th>". round($x,4) . "</th>";
                    ?>
                  </tr>
                  <?php   endforeach; ?>
                    </tbody>
                  </table>
                </div>
 
            </div>
          </div>

          <div class="card">
            <!-- Card header -->
            <div class="card-header border-0">
              <h3 class="mb-0">Perankingan Alternatif Terbaik</h3>
            </div>
            <!-- Light table -->
            <div class="card-body"> 
               <div class="table-responsive py-4">
              <table class="table table-flush" id="datatable-buttons">
                <thead class="thead-light">
                  <tr>  
                    <th>Rank</th>
                    <th>NIK</th>
                    <th>Nama Kepala Keluarga</th> 
                    <th>Jumlah Keluarga Ditanggung</th>  
                    <th>No. Telepon</th>  
                    <th>Alamat</th>  
                    <th>Nilai</th>   
                  </tr>
                </thead>
                <tbody class="list">

                 <?php $i = 1; foreach ($rank as $row): ?>  
                 <?php $d = $this->Data_m->get_row(['nik' => $row['nama_alternatif']]); ?>
                  <tr>  
                    <th>
                      <?=$i++?>
                    </th> 
                    <th>
                      <?=$row['nama_alternatif']?>
                    </th> 

                    <th>
                      <?=$d->nama_kk?>
                    </th> 
                    <td>
                      <?=$d->jumlah_keluarga?>
                    </td>
                   <td>
                      <?=$d->no_tlp?>
                    </td>
                    
                    <td>
                      <?=$d->alamat?>
                    </td>
                    <th>
                      <?= round($row['nilai_akhir'],4) ?>
                    </th>   
 
                  </tr>
                  <?php  endforeach; ?>
                </tbody>
              </table>
            </div>
 
            </div>
          </div>

        <?php } ?>
        </div>
      </div>
  
 