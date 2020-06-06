<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
      <div class="pull-left image">
        <?php if (!$akun->foto_user) { ?>
        <img src="<?php echo base_url()?>assets/foto_user/user.png" class="user-image" alt="User Image">
      <?php } else { ?>
        <img src="<?php echo base_url()?>assets/foto_user/<?=$akun->foto_user ?>" class="user-image" alt="User Image">
      <?php } ?>
      </div>
      <div class="pull-left info">
        <p><?php echo $akun->nama_lengkap?></p>
        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
      </div>
    </div>

    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu" data-widget="tree">
      <li class="header">MAIN NAVIGATION</li>
      <li class="active">
        <a href="<?php echo base_url()?>Admin">
          <i class="fa fa-dashboard"></i> <span>Dashboard</span>
        </a>
      </li>
      <li class="treeview">
        <a href="#">
          <i class="fa fa-user-circle-o"></i>
          <span>Kelola Akun</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="<?php echo base_url()?>Admin/kelolaUMKM"><i class="fa fa-circle-o"></i> UMKM</a></li>
          <li><a href="<?php echo base_url()?>Admin/kelolaKonsumen"><i class="fa fa-circle-o"></i> Konsumen</a></li>
        </ul>
      </li>
      <li class="treeview">
        <a href="#">
          <i class="fa fa-ellipsis-v"></i>
          <span>Kelola Kategori</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="<?php echo base_url()?>Admin/kategoriUMKM"><i class="fa fa-circle-o"></i> Kategori UMKM</a></li>
          <li><a href="<?php echo base_url()?>Admin/kategoriProduk"><i class="fa fa-circle-o"></i> Kategori Produk</a></li>
        </ul>
      </li>
      <li>
        <a href="<?php echo base_url()?>Admin/kelolaProdukUMKM">
          <i class="fa fa-shopping-bag"></i> <span>Kelola Produk UMKM</span>
        </a>
      </li>
      <li class="treeview">
        <a href="#">
          <i class="fa fa-shopping-cart"></i>
          <span>Kelola Transaksi</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="<?php echo base_url()?>Admin/kelolaTransaksi"><i class="fa fa-circle-o"></i> Transaksi Produk</a></li>
          <li><a href="<?php echo base_url()?>Admin/kelolaTransaksiUMKM"><i class="fa fa-circle-o"></i> Transaksi UMKM</a></li>
        </ul>
      </li>
      <li>
        <a href="<?php echo base_url()?>Admin/kelolaInformasi">
          <i class="fa fa-info-circle"></i> <span>Kelola Informasi UMKM</span>
        </a>
      </li>
      <li>
        <a href="<?php echo base_url()?>Admin/kelolaMarket">
          <i class="fa fa-home"></i> <span>Kelola Market UMKM</span>
        </a>
      </li>
      <li>
        <a href="<?php echo base_url()?>Admin/kelolaPortofolio">
          <i class="fa fa-file-o"></i> <span>Kelola Portofolio UMKM</span>
        </a>
      </li>
      <li>
        <a href="<?php echo base_url()?>Admin/kelolaSlide">
          <i class="fa fa-slideshare"></i> <span>Kelola Slide UMKM</span>
        </a>
      </li>
      <li>
        <a href="<?php echo base_url()?>Admin/kelolaKontak">
          <i class="fa fa-phone"></i> <span>Kelola Kontak UMKM</span>
        </a>
      </li>
    </ul>
  </section>
  <!-- /.sidebar -->
</aside>
