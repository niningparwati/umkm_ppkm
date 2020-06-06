  <?php $this->load->view('admin/head') ?>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
  <?php $this->load->view('admin/header') ?>
  <!-- Left side column. contains the logo and sidebar -->
  <?php $this->load->view('admin/sidebar') ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Kelola Profil
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Edit Profil</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-8">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Data Profil</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
             <?php echo form_open_multipart('Admin/updateProfil', array('method' => 'POST')); ?>
              <div class="box-body">
                <input type="hidden" name="iduser" value="<?php echo $akun->id_user ?>">
                <label for="exampleInputEmail1"><i class="fa fa-photo"></i> Foto Profil</label>
                <center>
                  <?php  if (!$akun->foto_user) { ?>
                  <img src="<?php echo base_url()?>assets/foto_user/user.png" class="user-image" alt="User Image" width="70px">
                <?php } else { ?>
                  <img src="<?php echo base_url()?>assets/foto_user/<?= $akun->foto_user ?>" class="user-image" alt="User Image" width="70px">
                <?php } ?>
                <br>
                <input type="file" name="fotouser">
                </center>
                <div class="form-group">
                  <label for="exampleInputEmail1"><i class="fa fa-user"></i> Nama Lengkap</label>
                  <input type="text" name="namalengkap" class="form-control" placeholder="Masukan nama lengkap" value="<?php echo $akun->nama_lengkap ?>">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1"><i class="fa fa-calendar"></i> Tanggal Lahir</label>
                  <input type="date" name="tgllahir" class="form-control"  value="<?php echo $akun->tanggal_lahir ?>">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1"><i class="fa fa-envelope-o"></i> Email</label>
                  <input type="email" name="email" class="form-control" placeholder="Masukan email" value="<?php echo $akun->email ?>" >
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1"><i class="fa fa-map-pin"></i> Alamat</label>
                  <textarea name="alamat" rows="8" cols="80" class="form-control" ><?php echo $akun->alamat_admin ?></textarea>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1"><i class="fa fa-phone"></i> Telepon</label>
                  <input type="text" name="notlp" class="form-control" placeholder="Masukan nomor telepon" value="<?php echo $akun->nomor_telp_admin ?>" >
                </div>
              </div>
              <div class="box-footer">
                <input type="submit" value="Submit" class="btn btn-primary">
              </div>
            </form>
          </div>
        </div>
        </div>

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <?php $this->load->view('admin/footer') ?>
</div>
<!-- ./wrapper -->
