 
<div class="header   pb-6 bg-gradient-gray" >
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">
            <div class="col-lg-6 col-7">  
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li class="breadcrumb-item"><a   href="<?=base_url('pengguna')?>"><i class="fas fa-home"></i></a></li> 
                  <li class="breadcrumb-item active" aria-current="page"><a   href="<?=base_url('pengguna/ranking')?>">Ranking</a></li> 
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
          <div class="card">
            <!-- Card header -->
            <div class="card-header border-0"> 
            </div>
            <!-- Light table -->
            <div class="card-body">
             
              <center>
                
              <div id="container2" style="width: 80%"></div>
              </center>
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
        </div>
      </div>
   