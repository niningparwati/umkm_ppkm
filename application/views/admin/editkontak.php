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
        Kelola Kontak
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Kelola Kontak</li>
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
              <h3 class="box-title">Edit Kontak</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="<?=base_url()?>Admin/updateKontak" method="POST">
              <div class="box-body">
                <div class="form-group">
                  <input type="hidden" name="idkontak" value="<?php echo $kontak->id_kontak ?>">
                  <label for="exampleInputEmail1"><i class="fa fa-map-pin"></i> Alamat</label>
                  <textarea name="alamat" rows="8" cols="80" class="form-control"><?php echo $kontak->alamat ?></textarea>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1"><i class="fa fa-envelope-o"></i> Email</label>
                  <input type="email" name="email" class="form-control" placeholder="Masukan email" value="<?php echo $kontak->email ?>">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1"><i class="fa fa-phone"></i> Telepon</label>
                  <input type=text" name="notlp" class="form-control" placeholder="Masukan nomor telepon" value="<?php echo $kontak->telepon ?>">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1"><i class="fa fa-globe"></i> Website</label>
                  <input type="text" name="website" class="form-control" placeholder="Masukan website" value="<?php echo $kontak->website ?>">
                </div>
                <div class="form-group">
                  <i class="fa fa-facebook"></i>
                  <label for="exampleInputEmail1"> Facebook</label>
                  <input type="text" name="fb" class="form-control" placeholder="Masukan facebook" value="<?php echo $kontak->facebook ?>">
                </div>
                <div class="form-group">
                  <i class="fa fa-instagram"></i>
                  <label for="exampleInputEmail1"> Instagram</label>
                  <input type="text" name="ig" class="form-control" placeholder="Masukan instagram" value="<?php echo $kontak->instagram ?>">
                </div>
              </div>
              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
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
