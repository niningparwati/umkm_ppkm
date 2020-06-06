<?php if ($level == 'Admin') { ?>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <?php if ($level == 'Paguyuban') {
            if (!$foto) { ?>
              <img src="<?php echo base_url()?>assets/foto_paguyuban/paguyuban.png" class="img-circle" alt="User Image">
              <?php } else { ?>
                <img src="<?php echo base_url()?>assets/foto_paguyuban/paguyuban.png ?>" class="img-circle" alt="User Image">
              <?php }
              }elseif ($level != 'Paguyuban') {
              if (!$foto) { ?>
              <img src="<?php echo base_url()?>assets/foto_user/user.png" class="img-circle" alt="User Image">
            <?php } else { ?>
              <img src="<?php echo base_url()?>assets/foto_user/<?= $foto ?>" class="img-circle" alt="User Image">
            <?php }} ?>
        </div>
        <div class="pull-left info">
          <p><?= $nama ?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
            <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
            </button>
          </span>
        </div>
      </form>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li >
          <a href="<?= base_url()?>Dashboard"><i class="fa fa-dashboard"></i> <span>Dashboard </span></a>
        </li>
        <li class="active treeview">
          <a href="#">
            <i class="fa fa-user"></i> <span>Kelola User</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class=" nav-link 'active':''"><a href="<?php echo base_url()?>Admin"><i class="fa fa-circle-o"></i> Admin</a></li>
            <li><a href="<?php echo base_url()?>Admin/Paguyuban"><i class="fa fa-circle-o"></i> Paguyuban</a></li>
            <li><a href="<?php echo base_url()?>Admin/UMKM"><i class="fa fa-circle-o"></i> UMKM</a></li>
          </ul>
        </li>
        <li >
          <a href="<?php echo base_url()?>Admin/Produk"><i class="fa fa-bitbucket-square "></i> <span>Kelola Produk</span></a>
        </li>
        <li >
          <a href="<?php echo base_url()?>Admin/Portofolio"><i class="fa fa-newspaper-o"></i> <span>Kelola Portofolio</span></a>
        </li>
        <li >
          <a href="<?php echo base_url()?>Admin/Informasi"><i class="fa fa-book"></i> <span>Kelola Informasi UMKM</span></a>
        </li>
        <li >
          <a href="<?php echo base_url()?>Admin/Slide"><i class="fa fa-book"></i> <span>Kelola Slide</span></a>
        </li>
        <li >
          <a href="<?php echo base_url()?>Admin/Kontak"><i class="fa fa-book"></i> <span>Kelola Kontak</span></a>
        </li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

<?php  }elseif ($level == 'Paguyuban') { ?>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <?php 
          if ($this->session->userdata('level')=='Paguyuban') {
            if (!$foto) { ?>
              <img src="<?php echo base_url()?>assets/foto_paguyuban/paguyuban.png" class="user-image" alt="User Image">
            <?php } else { ?>
              <img src="<?php echo base_url()?>assets/foto_paguyuban/<?= $foto ?>" class="user-image" alt="User Image">
            <?php } 
          }elseif ($this->session->userdata('level')!='Paguyuban') {
            if (!$foto) { ?>
              <img src="<?php echo base_url()?>assets/foto_user/user.png" class="user-image" alt="User Image">
            <?php } else { ?>
              <img src="<?php echo base_url()?>assets/foto_user/<?= $foto ?>" class="user-image" alt="User Image">
            <?php } }?>
          </div>
          <div class="pull-left info">
            <p><?= $nama ?></p>
            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
          </div>
        </div>
        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
          <div class="input-group">
            <input type="text" name="q" class="form-control" placeholder="Search...">
            <span class="input-group-btn">
              <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
              </button>
            </span>
          </div>
        </form>
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
          <li class="header">MAIN NAVIGATION</li>
          <li >
            <a href="<?= base_url()?>Dashboard"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a>
          </li>
          <li >
            <a href="<?php echo base_url()?>Paguyuban/UMKM"><i class="fa fa-user "></i> <span>Kelola UMKM</span></a>
          </li>
          <li >
            <a href="<?php echo base_url()?>Paguyuban/Kategori"><i class="fa fa-check-square-o"></i> <span>Kategori Produk</span></a>
          </li>
          <li >
            <a href="<?php echo base_url()?>Paguyuban/ProdukUMKM"><i class="fa fa-bitbucket-square"></i> <span>Produk UMKM</span></a>
          </li>
          <li >
            <a href="<?php echo base_url()?>Paguyuban/Informasi"><i class="fa fa-book"></i> <span>Kelola Informasi UMKM</span></a>
          </li>
        </ul>
      </section>
      <!-- /.sidebar -->
    </aside>
  <?php  }elseif ($level == 'UMKM') { ?>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
      <!-- sidebar: style can be found in sidebar.less -->
      <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
          <div class="pull-left image">
            <?php if (!$foto) { ?>
              <img src="<?php echo base_url()?>assets/foto_user/user.png" class="img-circle" alt="User Image">
            <?php } else { ?>
              <img src="<?php echo base_url()?>assets/foto_user/<?= $foto ?>" class="img-circle" alt="User Image">
            <?php } ?>
          </div>
          <div class="pull-left info">
            <p><?= $nama ?></p>
            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
          </div>
        </div>
        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
          <div class="input-group">
            <input type="text" name="q" class="form-control" placeholder="Search...">
            <span class="input-group-btn">
              <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
              </button>
            </span>
          </div>
        </form>
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
          <li class="header">MAIN NAVIGATION</li>
          <li >
            <a href="<?= base_url()?>UMKM/Dashboard"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a>
          </li>
            <li >
            <a href="<?php echo base_url()?>UMKM/Transaksi/<?= $id_umkm?>"><i class="fa fa-shopping-cart"></i> <span>Kelola Transaksi</span></a>
          </li>
          <li >
            <a href="<?php echo base_url()?>UMKM/Produk/<?= $id_umkm?>"><i class="fa fa-cube"></i> <span>Kelola Produk</span></a>
          </li>
          <li >
            <a href="<?= base_url()?>UMKM/TampilPortofolio/<?= $id_umkm?>"><i class="fa fa-star-o"></i> <span>Kelola Portofolio</span></a>
          </li>
          <li >
            <a href="<?php echo base_url()?>UMKM/Market/<?= $id_umkm?>"><i class="fa fa-area-chart"></i> <span>Kelola Market</span></a>
          </li>
          <li >
            <a href="<?php echo base_url()?>UMKM/Informasi/<?= $id_umkm ?>"><i class="fa fa-align-justify"></i> <span>Kelola Informasi</span></a>
          </li>
           <li >
            <a href="<?php echo base_url()?>UMKM/Galeri/<?= $id_umkm ?>"><i class="fa fa-photo"></i> <span>Kelola Galeri Foto</span></a>
          </li>
        </ul>
      </section>
      <!-- /.sidebar -->
    </aside>
    <?php } ?>