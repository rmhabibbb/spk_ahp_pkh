 
    <!-- Header -->
    <!-- Header -->
    <div class="header   pb-6 bg-gradient-gray" >
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">
            <div class="col-lg-6 col-7">  
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li class="breadcrumb-item"><a   href="<?=base_url('penilai')?>"><i class="fas fa-home"></i></a></li> 
                  <li class="breadcrumb-item active" aria-current="page"><a   href="<?=base_url('pengguna/penilaian')?>">Penilaian</a></li>
             
                </ol>
              </nav>
            </div> 
            <div class="col-lg-6 col-5 text-right"> 
              <a href="#" data-toggle="modal" data-target="#exampleModal" class="btn btn-sm btn-neutral">Input Penilaian</a> 
              
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
              <h3 class="mb-0"></h3>
            </div>
            <!-- Light table -->
            <div class="card-body">
              
               <div class="table-responsive py-4">
              <table class="table table-flush" id="datatable-basic">
                <thead class="thead-light">
                  <tr>  
                    <th>ID alternatif</th>
                    <th>Keterangan alternatif</th>   
                    <th>Action</th> 
                  </tr>
                </thead>
                <tbody class="list">

                 <?php $i = 1; foreach ($list_alternatif as $row): ?> 
                 <?php if ($this->Penilaian_m->get_num_row(['id_alternatif' => $row->id_alternatif]) != 0) { ?>
                   
                  <?php $penduduk = $this->Data_m->get_row(['nik' => $row->nik]) ?>
                  <tr> 
                    <td>
                      <?=$row->id_alternatif?>
                    </td> 
                    <td>
                      [<?=$penduduk->nik?>] <?=$penduduk->nama_kk?>
                    </td> 
                    
 
                    <td class="text-right">
                      <a href="" data-toggle="modal" data-target="#edit-<?=$row->id_alternatif?>">
                        <button type="button" class="btn btn-twitter btn-icon"> 
                          <span class="btn-inner--text">Lihat Nilai</span>
                        </button>
                      </a>
                      <a href="" data-toggle="modal" data-target="#delete2-<?=$row->id_alternatif?>">
                        <button type="button" class="btn btn-instagram btn-icon"> 
                          <span class="btn-inner--text">Hapus</span>
                        </button>
                      </a>
                       
                    </td> 
                  </tr>
                  <?php } endforeach; ?>
                </tbody>
              </table>
            </div>
  
            </div>
          </div>
        </div>
      </div>
  


<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Form Input Nilai</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      
      <?= form_open_multipart('pengguna/penilaian/') ?>
      <div class="modal-body">
          
            <div class="form-group">
                <label for="example-email-input" class="form-control-label">Nama alternatif</label>
                 <select class="form-control" name="id_alternatif" required>
                    <option value="">Pilih alternatif</option>
                    <?php  foreach ($list_alternatif as $k): ?> 
                    <?php if ($this->Penilaian_m->get_num_row(['id_alternatif' => $k->id_alternatif]) == 0) { ?>

                      <?php $penduduk = $this->Data_m->get_row(['nik' => $k->nik]) ?>
                      <option value="<?=$k->id_alternatif?>">[<?=$penduduk->nik?>] <?=$penduduk->nama_kk?></option>
                    <?php } endforeach; ?>
                  </select>
            </div> 
 
                            <table class="table table-bordered">
                             
                              <?php $i= 1; foreach ($list_kriteria as $row): ?>   
 
                                <tr>
                                    <th><?=$row->nama_kriteria?></th>
                                    <td>
                                        <select class="form-control"  required name="kriteria[]"> 
                                                <option value="">- Pilih -</option> 
                                                <option value="0">0</option>  
                                                <option value="25">25</option>  
                                                <option value="50">50</option>  
                                                <option value="75">75</option>  
                                                <option value="100">100</option>  
                                         </select> 
                                    </td>
                                </tr> 
                                <?php   endforeach; ?>
                              
                            </table>
                                
            
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <input type="submit" class="btn btn-primary" name="inputnilai" value="Submit"> 
      </div>
      </form>
    </div>
  </div>
</div> 



<?php $i = 1; foreach ($list_alternatif as $row): ?> 

<div class="modal fade" id="edit-<?=$row->id_alternatif?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Form Edit Nilai</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      
      <?= form_open_multipart('pengguna/penilaian/') ?>
      <div class="modal-body">
          
            <div class="form-group">
                <label for="example-email-input" class="form-control-label">Nama alternatif</label>
                  <?php $penduduk = $this->Data_m->get_row(['nik' => $row->nik]) ?>
                 <input type="text" class="form-control" readonly value="[<?=$penduduk->nik?>] <?=$penduduk->nama_kk?>">
                 <input type="hidden" class="form-control" name="id_alternatif" value="<?=$row->id_alternatif?>">
            </div> 
 
                            <table class="table table-bordered">
                             
                              <?php $i= 1; foreach ($list_kriteria as $k): ?>   

                                <?php 
 
                                 $nilai = $this->Penilaian_m->get_row(['id_alternatif' => $row->id_alternatif, 'id_kriteria' => $k->id_kriteria])->nilai;
                                ?>
                                <tr>
                                    <th><?=$k->nama_kriteria?></th>
                                    <td>
                                        <select class="form-control"  required name="kriteria[]"> 
                                                
                                                <option value="<?=$nilai?>"><?=$nilai?></option> 
                                                <option value="0">0</option>  
                                                <option value="25">25</option>  
                                                <option value="50">50</option>  
                                                <option value="75">75</option>  
                                                <option value="100">100</option>  
                                         </select> 
                                    </td>
                                </tr>
 
                                <?php   endforeach; ?>
                              
                            </table>
                                
            
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <input type="submit" class="btn btn-primary" name="editnilai" value="Submit"> 
      </div>
      </form>
    </div>
  </div>
</div> 


<div class="modal fade" id="delete2-<?=$row->id_alternatif?>" tabindex="-1" role="dialog" aria-labelledby="modal-notification" aria-hidden="true">
    <div class="modal-dialog modal-danger modal-dialog-centered modal-" role="document">
        <div class="modal-content bg-gradient-danger"> 
              
                  <div class="modal-body">
                    
                      <div class="py-3 text-center">
                          <i class="ni ni-bell-55 ni-3x"></i>
                          <h4 class="heading mt-4"> Hapus Penilaian ini? </h4> 
                      </div>
                      
                  </div>
                  
                  <form action="<?= base_url('pengguna/penilaian')?>" method="Post" >  
                  <div class="modal-footer">
 
                
                   
                      <input type="hidden" value="<?=$row->id_alternatif?>" name="id_alternatif">  
                      <input type="submit" class="btn btn-white" name="deletenilai" value="Ya!">
                     
                      <button type="button" class="btn btn-link text-white ml-auto" data-dismiss="modal">Close</button>
                  </div>
                </form>
          </div>
  </div>
</div>
<?php endforeach; ?>

 


<div class="modal fade" id="selesai" tabindex="-1" role="dialog" aria-labelledby="modal-notification" aria-hidden="true">
    <div class="modal-dialog modal-danger modal-dialog-centered modal-" role="document">
        <div class="modal-content bg-gradient-green"> 
              
                  <div class="modal-body">
                    
                      <div class="py-3 text-center">
                          <i class="ni ni-bell-55 ni-3x"></i>
                          <h4 class="heading mt-4"> Tahap Penilaian Selesai  ? </h4> 
                      </div>
                      
                  </div>
                  
                  <form action="<?= base_url('penilai/danabantuan')?>" method="Post" >  
                  <div class="modal-footer">

                  <input type="hidden" name="id" value="<?=$danabantuan->id_danabantuan?>">
                
                     
                      <input type="submit" class="btn btn-white" name="selesai" value="Ya!">
                     
                      <button type="button" class="btn btn-link text-white ml-auto" data-dismiss="modal">Close</button>
                  </div>
                </form>
          </div>
  </div>
</div>
 