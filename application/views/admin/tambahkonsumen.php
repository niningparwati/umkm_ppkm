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
        Kelola Akun
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"> Kelola Akun</li>
        <li class="active"> Tambah Konsumen</li>
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
              <h3 class="box-title">Tambah Konsumen</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="<?=base_url()?>Admin/createKonsumen" method="post" enctype="multipart/form-data">
              <div class="box-body">
                <div class="form-group">
                  <?php echo form_error('username'); ?>
                  <label for="exampleInputEmail1">Username</label>
                  <input type="text" name="username" class="form-control" placeholder="Masukan Username">
                </div>
                <div class="form-group">
                    <?php echo form_error('password'); ?>
                  <label for="exampleInputEmail1">Password</label>
                  <input type="password" name="password" class="form-control" placeholder="Masukan Password">
                </div>
                <div class="form-group">
                    <?php echo form_error('email'); ?>
                  <label for="exampleInputEmail1">Email</label>
                  <input type="email" name="email" class="form-control" placeholder="Masukan Email">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Foto Profil</label>
                <input type="file" name="foto" class="form-control" value="">
                </div>
                <div class="form-group">
                    <?php echo form_error('nohp'); ?>
                  <label for="exampleInputEmail1">Nomor Telepon</label>
                  <input type="text" name="nohp" class="form-control" placeholder="Masukan Nomor Telepon">
                </div>
                <div class="form-group">
                    <?php echo form_error('jk'); ?>
                  <label for="exampleInputEmail1">Jenis Kelamin</label><br>
                  <input type="radio" name="jk" value="perempuan"> Perempuan <p>    </p>
                  <input type="radio" name="jk" value="laki-laki"> Laki-laki
                </div>
                <div class="form-group">
                    <?php echo form_error('tgll'); ?>
                  <label for="exampleInputEmail1">Tanggal Lahir</label>
                  <input type="date" name="tgll" class="form-control">
                </div>
                <div class="form-group">
                    <?php echo form_error('status'); ?>
                  <label for="exampleInputEmail1">Status Konsumen</label><br>
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
