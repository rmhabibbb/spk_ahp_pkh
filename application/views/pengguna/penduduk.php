    <!-- Header -->
    <!-- Header -->
    <div class="header   pb-6 bg-gradient-gray" >
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">
            <div class="col-lg-6 col-7"> 
              <h6 class="h2 text-white d-inline-block mb-0">Data Penduduk</h6>
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li class="breadcrumb-item"><a href=" href="<?=base_url('pengguna')?>"><i class="fas fa-home"></i></a></li> 
                  <li class="breadcrumb-item active" aria-current="page">Data Penduduk</li>
                </ol>
              </nav>
            </div> 
            <div class="col-lg-6 col-5 text-right">
              <a href="#" data-toggle="modal" data-target="#exampleModal" class="btn btn-sm btn-neutral">Tambah Data Penduduk</a> 
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
              <h3 class="mb-0">Data Penduduk</h3>
            </div>
            <!-- Light table -->

            <div class="table-responsive py-4">
              <table class="table table-flush" id="datatable-basic">
                <thead class="thead-light">
                  <tr>  
                    <th>NIK</th>
                    <th>Nama Kepala Keluarga</th> 
                    <th>Jumlah Keluarga Ditanggung</th>  
                    <th>No. Telepon</th>  
                    <th>Alamat</th>  
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody class="list">

                 <?php $i = 1; foreach ($data as $row): ?> 
                  <tr> 
                    <td class="budget">
                      <?=$row->nik?>
                    </td>
                    <td>
                      <?=$row->nama_kk?>
                    </td>
                    <td>
                      <?=$row->jumlah_keluarga?>
                    </td>
                   <td>
                      <?=$row->no_tlp?>
                    </td>
                    
                    <td>
                      <?=$row->alamat?>
                    </td>
                    
                    <td class="text-right">
                      <a href="" data-toggle="modal" data-target="#edit-<?=$i?>">
                        <button type="button" class="btn btn-twitter btn-icon"> 
                          <span class="btn-inner--text">Edit</span>
                        </button>
                      </a>
                   
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
        <h5 class="modal-title" id="exampleModalLabel">Form Tambah Data Penduduk</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      
      <?= form_open_multipart('pengguna/data/') ?>
      <div class="modal-body">
            
            <div class="form-group">
                <label for="example-email-input" class="form-control-label">NIK</label>
                <input class="form-control" type="text" required name="nik" id="example-email-input">
            </div> 

            <div class="form-group">
                <label for="example-email-input" class="form-control-label">Nama Kepala Keluarga</label>
                <input class="form-control" type="text" required name="nama_kk" id="example-email-input">
            </div> 

            <div class="form-group">
                <label for="example-email-input" class="form-control-label">Jumlah Keluarga Ditanggung</label>
                <input class="form-control" type="number" min="0" required name="jumlah_keluarga" id="example-email-input">
            </div> 

            <div class="form-group">
                <label for="example-email-input" class="form-control-label">Nomor Telepon</label>
                <input class="form-control" type="text" required name="no_tlp" id="example-email-input">
            </div> 
            <div class="form-group">
                <label for="example-email-input" class="form-control-label">Alamat</label>
                <textarea class="form-control" required name="alamat"></textarea> 
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

<?php $i = 1; foreach ($data as $row): ?> 
<div class="modal fade" id="edit-<?=$i?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Form Edit Data Penduduk</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      
      <?= form_open_multipart('pengguna/data/') ?>
      <div class="modal-body">
        
          <input type="hidden" required name="nik_x"  value="<?=$row->nik?>"> 
             <div class="form-group">
                <label for="example-email-input" class="form-control-label">NIK</label>
                <input class="form-control" type="text" required name="nik" value="<?=$row->nik?>">
            </div> 

            <div class="form-group">
                <label for="example-email-input" class="form-control-label">Nama Kepala Keluarga</label>
                <input class="form-control" type="text" required name="nama_kk" value="<?=$row->nama_kk?>" >
            </div> 

            <div class="form-group">
                <label for="example-email-input" class="form-control-label">Jumlah Keluarga Ditanggung</label>
                <input class="form-control" type="number" min="0" required name="jumlah_keluarga" value="<?=$row->jumlah_keluarga?>">
            </div> 

            <div class="form-group">
                <label for="example-email-input" class="form-control-label">Nomor Telepon</label>
                <input class="form-control" type="text" required name="no_tlp" value="<?=$row->no_tlp?>">
            </div> 

            <div class="form-group">
                <label for="example-email-input" class="form-control-label">Alamat</label>
                <textarea class="form-control" required name="alamat"><?=$row->alamat?></textarea> 
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
                  
                  <form action="<?= base_url('pengguna/data')?>" method="Post" >  
                  <div class="modal-footer">

                   
                      <input type="hidden" value="<?=$row->nik?>" name="nik">  
                      <input type="submit" class="btn btn-white" name="delete" value="Ya!">
                     
                      <button type="button" class="btn btn-link text-white ml-auto" data-dismiss="modal">Close</button>
                  </div>
                </form>
          </div>
  </div>
</div>
<?php endforeach; ?>