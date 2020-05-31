<header class="main-header">
  <!-- Logo -->
  <a href="index2.html" class="logo">
    <!-- mini logo for sidebar mini 50x50 pixels -->
    <span class="logo-mini"><?= $level ?></span>
    <!-- logo for regular state and mobile devices -->
    <span class="logo-lg"><b><?= $level ?></b></span>
  </a>
  <!-- Header Navbar: style can be found in header.less -->
  <nav class="navbar navbar-static-top">
    <!-- Sidebar toggle button-->
    <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
      <span class="sr-only">Toggle navigation</span>
    </a>

    <div class="navbar-custom-menu">
      <ul class="nav navbar-nav">
        <!-- User Account: style can be found in dropdown.less -->
        <li class="dropdown user user-menu">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">

            <?php 
           if ($this->session->userdata('level')=='UMKM') {
                if (!$foto) { ?>
                <img src="<?php echo base_url()?>assets/foto_user/user.png" class="user-image" alt="User Image">
              <?php } else { ?>
                <img src="<?php echo base_url()?>assets/foto_user/<?= $foto ?>" class="user-image" alt="User Image">
              <?php } }?>
              <span class="hidden-xs"><?= $nama ?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <?php 
               if ($this->session->userdata('level')=='UMKM') {
                  if (!$foto) { ?>
                    <img src="<?php echo base_url()?>assets/foto_user/user.png" class="img-circle" alt="User Image">
                  <?php } else { ?>
                    <img src="<?php echo base_url()?>assets/foto_user/<?= $foto ?>" class="img-circle" alt="User Image">
                  <?php } }?>
              <p>
                <?= $nama ?> ( <?= $id_user ?> )
                <small><?= $email ?></small>
              </p>
            </li>

            <!-- Menu Footer-->
            <li class="user-footer">
              <div class="pull-left">
                <?php if ($this->session->userdata('level')=='Admin') {?>
              <?php }elseif($this->session->userdata('level')=='UMKM'){ ?>
                <a href="<?= base_url()?>UMKM/Profil" class="btn btn-default btn-flat">Profile</a>
              <?php } ?>
              </div>
              <div class="pull-right">
                <a href="<?= base_url()?>LoginAU/logout" class="btn btn-default btn-flat">Sign out</a>
              </div>
            </li>
          </ul>
        </li>
      </ul>
    </div>
  </nav>
</header>