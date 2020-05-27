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
        <li class="active"> Tambah UMKM</li>
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
              <h3 class="box-title">Tambah UMKM</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="<?=base_url()?>Admin/createUMKM" method="post" enctype="multipart/form-data">
              <div class="box-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">Username</label>
                  <input type="text" name="username" class="form-control" placeholder="Masukan Username">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Password</label>
                  <input type="password" name="password" class="form-control" placeholder="Masukan Password">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Email</label>
                  <input type="email" name="email" class="form-control" placeholder="Masukan Email">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Nama UMKM</label>
                  <input type="text" name="namaumkm" class="form-control" placeholder="Masukan Nama UMKM">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Alamat UMKM</label>
                  <textarea name="alamat" rows="8" cols="80" class="form-control" placeholder="Masukan Alamat"></textarea>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Deskripsi UMKM</label><br>
                  <textarea class="form-control" name="deskripsi" rows="8" cols="80" placeholder="Masukan Deskripsi"></textarea>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Nomor Telepon</label>
                  <input type="text" name="nohp" class="form-control" placeholder="Masukan Nomor Telepon">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Kategori UMKM</label>
                  <select class="form-control" name="idkategori">
                    <?php foreach ($kategori as $k): ?>
                    <option value="<?php echo $k->id_kategori_umkm ?>"><?php echo $k->nama_kategori_umkm ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Status UMKM</label><br>
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
