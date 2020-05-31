<header class="main-header">
  <!-- Logo -->
  <a href="#" class="logo">
    <!-- mini logo for sidebar mini 50x50 pixels -->
    <span class="logo-mini"><b>UMKM</b></span>
    <!-- logo for regular state and mobile devices -->
    <span class="logo-lg"><b>UMKM</b> PPKM</span>
  </a>
  <!-- Header Navbar: style can be found in header.less -->
  <nav class="navbar navbar-static-top">
    <!-- Sidebar toggle button-->
    <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
      <span class="sr-only">Toggle navigation</span>
    </a>

    <div class="navbar-custom-menu">
      <ul class="nav navbar-nav">
        <li class="dropdown user user-menu">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <?php  if (!$akun->foto_user) { ?>
            <img src="<?php echo base_url()?>assets/foto_user/user.png" class="user-image" alt="User Image">
          <?php } else { ?>
            <img src="<?php echo base_url()?>assets/foto_user/<?= $akun->foto_user ?>" class="user-image" alt="User Image">
          <?php } ?>
            <span class="hidden-xs"><?php echo $akun->nama_lengkap?></span>
          </a>
          <ul class="dropdown-menu">
            <!-- User image -->
            <li class="user-header">
              <img src="<?php echo base_url()?>assets/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">

              <p>
                <?php echo $akun->nama_lengkap?> - <?php echo $akun->level?>
                <small>Member since <?php echo $akun->tanggal_join?></small>
              </p>
            </li>
            <li class="user-footer">
              <div class="pull-left">
                <a href="#" class="btn btn-default btn-flat">Profile</a>
              </div>
              <div class="pull-right">
                <a href="<?=base_url()?>LoginAU/logout" class="btn btn-default btn-flat">Sign out</a>
              </div>
            </li>
          </ul>
        </li>
        <!-- Control Sidebar Toggle Button -->
      </ul>
    </div>
  </nav>
</header>
