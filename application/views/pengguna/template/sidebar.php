 
  <nav class="sidenav navbar navbar-vertical  fixed-left  navbar-expand-xs navbar-light bg-white" id="sidenav-main">
    <div class="scrollbar-inner">
      <!-- Brand -->
      <div class="sidenav-header d-flex align-items-center">
        <a class="navbar-brand" href="<?=base_url('pengguna')?>">
           <b>SPK - AHP</b>
            
        </a>
        <div class="ml-auto">
          <!-- Sidenav toggler -->
          <div class="sidenav-toggler d-none d-xl-block" data-action="sidenav-unpin" data-target="#sidenav-main">
            <div class="sidenav-toggler-inner">
              <i class="sidenav-toggler-line"></i>
              <i class="sidenav-toggler-line"></i>
              <i class="sidenav-toggler-line"></i>
            </div>
          </div>
        </div>
      </div>
      <div class="navbar-inner">
        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="sidenav-collapse-main">
          <!-- Nav items -->
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link <?php if($index == 1){ echo 'active'; } ?>" href="<?=base_url('pengguna/')?>">
                <i class="fas fa-home text-black"></i>
                <span class="nav-link-text">Home</span>
              </a>
            </li>
             <li class="nav-item">
              <a class="nav-link <?php if($index == 10){ echo 'active'; } ?>" href="<?=base_url('pengguna/data')?>">
                <i class="ni ni-books text-black"></i>
                <span class="nav-link-text">Data Penduduk</span>
              </a>
            </li>
          </ul>
 
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link <?php if($index == 3){ echo 'active'; } ?>" href="<?=base_url('pengguna/kriteria')?>">
                <i class="ni ni-ungroup text-black"></i>
                <span class="nav-link-text">Kriteria</span>
              </a>
            </li>

            <li class="nav-item">
              <a class="nav-link <?php if($index == 4){ echo 'active'; } ?>" href="<?=base_url('pengguna/alternatif')?>">
                <i class="ni ni-hat-3 text-black"></i>
                <span class="nav-link-text">Alternatif</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link <?php if($index == 5){ echo 'active'; } ?>" href="<?=base_url('pengguna/penilaian')?>">
                <i class="ni ni-paper-diploma text-black"></i>
                <span class="nav-link-text">Penilaian</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link <?php if($index == 6){ echo 'active'; } ?>" href="<?=base_url('pengguna/ranking')?>">
                <i class="ni ni-trophy text-black"></i>
                <span class="nav-link-text">Ranking</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link <?php if($index == 7){ echo 'active'; } ?>" href="<?=base_url('pengguna/laporan')?>">
                <i class="ni ni-book-bookmark text-black"></i>
                <span class="nav-link-text">Laporan</span>
              </a>
            </li>
           
            
          </ul>
         
          <hr class="my-3">
          <!-- Heading -->
          <h6 class="navbar-heading p-0 text-muted">
            <span class="docs-normal"></span>
          </h6>
          <!-- Navigation -->
          <ul class="navbar-nav mb-md-3">
             <li class="nav-item">
              <a class="nav-link <?php if($index == 8){ echo 'active'; } ?>" href="<?=base_url('pengguna/akun')?>"  >
                <i class="ni ni-badge text-black"></i>
                <span class="nav-link-text">Kelola Pengguna</span>
              </a>
            </li> 
             <li class="nav-item">
              <a class="nav-link <?php if($index == 9){ echo 'active'; } ?>" href="<?=base_url('pengguna/profile')?>"  >
                <i class="ni ni-circle-08 text-black"></i>
                <span class="nav-link-text">Profil saya</span>
              </a>
            </li> 
            <li class="nav-item">
              <a class="nav-link active active-pro" href="<?=base_url('logout')?>">
                <i class="ni ni-button-power text-dark"></i>
                <span class="nav-link-text">Logout</span>
              </a>
            </li>
          </ul>

        </div>
      </div>
    </div>
  </nav>