    <!-- Header -->
    <!-- Header -->
    <div class="header   pb-6 bg-gradient-gray" >
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">
            <div class="col-lg-6 col-7"> 
              <h6 class="h2 text-white d-inline-block mb-0">Alternatif</h6>
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li class="breadcrumb-item"><a href=" href="<?=base_url('pengguna')?>"><i class="fas fa-home"></i></a></li> 
                  <li class="breadcrumb-item active" aria-current="page">Alternatif</li>
                </ol>
              </nav>
            </div> 
            <div class="col-lg-6 col-5 text-right">
              <a href="#" data-toggle="modal" data-target="#exampleModal" class="btn btn-sm btn-neutral">Tambah Alternatif</a> 
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
              <h3 class="mb-0">Data Alternatif</h3>
            </div>
            <!-- Light table -->

            <div class="table-responsive py-4">
              <table class="table table-flush" id="datatable-basic">
                <thead class="thead-light">
                  <tr>  
                    <th>ID Alternatif</th>
                    <th>NIK</th>  
                    <th>Nama Kepala Keluarga</th>  
                    <th>Jumlah Keluarga Ditanggung</th> 
                    <th>Nomor Telepon</th>  
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody class="list">

                 <?php $i = 1; foreach ($alternatif as $row): ?> 
                 <?php $penduduk = $this->Data_m->get_row(['nik' => $row->nik]) ?>
                  <tr> 
                    <td class="budget">
                      <?=$row->id_alternatif?>
                    </td>
                    <td>
                      <b><?=$row->nik?></b>
                    </td>
                    <td>
                      <?=$penduduk->nama_kk?>
                    </td>
                    <td>
                      <?=$penduduk->jumlah_keluarga?>
                    </td>
                    <td>
                      <?=$penduduk->no_tlp?>
                    </td>
                    
                    <td class="text-right">
                     
                   
                      <a href="" data-toggle="modal" data-target="#delete-<?=$i++?>">
                        <button type="button" class="btn btn-instagram btn-icon"> 
                          <span class="btn-inner--text">Delete</span>
                        </button>
                      </a>
                    </td>
                  </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div> 
          </div>
        </div>
      </div>
  


<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Form Tambah Alternatif</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      
      <?= form_open_multipart('pengguna/alternatif/') ?>
      <div class="modal-body">
         
            <div class="form-group">
                <label for="example-email-input" class="form-control-label">Data Penduduk</label>

                <select class="form-control" name="nik" required>
                  <option value="">Pilih</option>
                  <?php foreach ($data as $d) {  
                    if ($this->Alternatif_m->get_num_row(['nik' => $d->nik]) == 0) {  ?>
                     <option value="<?=$d->nik?>">[<?=$d->nik?>] <?=$d->nama_kk?></option>
                  <?php  } } ?>
                </select> 
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

<?php $i = 1; foreach ($alternatif as $row): ?> 
<div class="modal fade" id="edit-<?=$i?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Form Edit Alternatif</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      
      <?= form_open_multipart('pengguna/alternatif/') ?>
      <div class="modal-body">
        
          <input type="hidden" required name="id_alternatif"  value="<?=$row->id_alternatif?>"> 
          
            <div class="form-group">
                <label for="example-email-input" class="form-control-label">Nama Alternatif</label>
                <input class="form-control" type="text" required name="nama" id="example-email-input" value="<?=$row->nama_alternatif?>">
            </div> 
            <div class="form-group">
                <label for="example-password-input" class="form-control-label">Keterangan</label>
                <textarea class="form-control" name="keterangan"><?=$row->keterangan?></textarea>
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
 

<div class="modal fade" id="delete-<?=$i++?>" tabindex="-1" role="dialog" aria-labelledby="modal-notification" aria-hidden="true">
    <div class="modal-dialog modal-danger modal-dialog-centered modal-" role="document">
        <div class="modal-content bg-gradient-danger"> 
              
                  <div class="modal-body">
                    
                      <div class="py-3 text-center">
                          <i class="ni ni-bell-55 ni-3x"></i>
                          <h4 class="heading mt-4"> Hapus Alternatif ini? </h4> 
                      </div>
                      
                  </div>
                  
                  <form action="<?= base_url('pengguna/alternatif')?>" method="Post" >  
                  <div class="modal-footer">

                   
                      <input type="hidden" value="<?=$row->id_alternatif?>" name="id_alternatif">  
                      <input type="submit" class="btn btn-white" name="delete" value="Ya!">
                     
                      <button type="button" class="btn btn-link text-white ml-auto" data-dismiss="modal">Close</button>
                  </div>
                </form>
          </div>
  </div>
</div>
<?php endforeach; ?>