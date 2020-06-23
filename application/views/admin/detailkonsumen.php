<?php $this->load->view('admin/Head') ?>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
  <?php $this->load->view('admin/Header') ?>
  <!-- Left side column. contains the logo and sidebar -->
  <?php $this->load->view('admin/Sidebar') ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Kelola Akun
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"> Kelola Akun</li>
        <li class="active"> Kelola Konsumen</li>
        <li class="active"> Detail Konsumen</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="row">
        <div class="col-md-3">

          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">
              <center>
                <?php  if (!$konsumen->foto_konsumen) { ?>
                <img src="<?php echo base_url()?>assets/foto_user/user.png" class="user-image" alt="User Image" width="70px">
              <?php } else { ?>
                <img src="<?php echo base_url()?>assets/foto_user/<?= $konsumen->foto_konsumen ?>" class="user-image" alt="User Image" width="70px">
              <?php } ?>
              </center>
              <h3 class="profile-username text-center"><?php echo $konsumen->username_konsumen ?></h3>

              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <b>Email</b> <a class="pull-right"><?php echo $konsumen->email_konsumen ?></a>
                </li>
                <li class="list-group-item">
                  <b>Nomor Telepon</b> <a class="pull-right"><?php echo $konsumen->nomor_telp_konsumen ?></a>
                </li>
                <li class="list-group-item">
                  <b>Jenis Kelamin</b> <a class="pull-right"><?php echo $konsumen->jenis_kelamin ?></a>
                </li>
                <li class="list-group-item">
                  <b>Tanggal Lahir</b> <a class="pull-right"><?php echo $konsumen->tanggal_lahir ?></a>
                </li>
                <li class="list-group-item">
                  <b>Tanggal Daftar</b> <a class="pull-right"><?php echo $konsumen->tanggal_join ?></a>
                </li>
                <li class="list-group-item">
                  <b>Status</b> <a class="pull-right"><?php echo $konsumen->status_konsumen ?></a>
                </li>
              </ul>

              <a href="<?=base_url()?>Admin/kelolaKonsumen" class="btn btn-danger btn-block"><b>Kembali</b></a>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

      </div>
      <!-- /.row -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php $this->load->view('admin/Footer') ?>
</div>
