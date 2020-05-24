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
              <h3 class="box-title">Data Kontak</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form">
              <div class="box-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">Alamat</label>
                  <textarea name="alamat" rows="8" cols="80" class="form-control"></textarea>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Email</label>
                  <input type="email" name="email" class="form-control" placeholder="Masukan email">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Telepon</label>
                  <input type="number" name="notlp" class="form-control" placeholder="Masukan nomor telepon">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Website</label>
                  <input type="url" name="website" class="form-control" placeholder="Masukan website">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Facebook</label>
                  <input type="text" name="fb" class="form-control" placeholder="Masukan facebook">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Instagram</label>
                  <input type="text" name="ig" class="form-control" placeholder="Masukan instagram">
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
