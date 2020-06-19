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
        Kelola Slide
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"> Kelola Slide</li>
        <li class="active"> Tambah Slide</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Tambah Slide</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="<?=base_url()?>Admin/createSlide" method="post" enctype="multipart/form-data">
              <div class="box-body">
                <div class="form-group">
                   <?php echo form_error('judul') ?>
                  <label for="exampleInputEmail1">Judul Slide</label>
                  <input type="text" name="judul" class="form-control" placeholder="Masukan Judul">
                </div>
                <div class="form-group">
                  <?php echo form_error('deskripsi') ?>
                  <label for="exampleInputEmail1">Deskripsi Slide</label><br>
                  <textarea class="form-control" name="deskripsi" rows="8" cols="80" placeholder="Masukan Deskripsi"></textarea>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Gambar Slide</label>
                  <input type="file" name="gambar" class="form-control">
                </div>
                <div class="form-group">
                  <?php echo form_error('url') ?>
                  <label for="exampleInputEmail1">URL Slide</label>
                  <input type="text" name="url" class="form-control" placeholder="Masukan URL/Link">
                </div>
                <div class="form-group">
                  <?php echo form_error('status') ?>
                  <label for="exampleInputEmail1">Status Slide</label><br>
                  <input type="radio" name="status" value="aktif"> aktif <p>    </p>
                  <input type="radio" name="status" value="tidak aktif"> tidak aktif
                </div>
              </div>
              <!-- /.box-body -->

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
