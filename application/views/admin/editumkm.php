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
        <li class="active"> Edit UMKM</li>
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
              <h3 class="box-title">Edit UMKM</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="<?=base_url()?>Admin/updateUMKM" method="post" enctype="multipart/form-data">
              <div class="box-body">
                <div class="form-group">
                  <input type="hidden" name="iduser" value="<?php echo $umkm->id_user ?>">
                  <label for="exampleInputEmail1">Username</label>
                  <input type="text" name="username" class="form-control" placeholder="Masukan Username" value="<?php echo $umkm->username ?>">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Password</label>
                  <input type="password" name="password" class="form-control" placeholder="Masukan Password" value="<?php echo $umkm->password ?>" disabled>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Email</label>
                  <input type="email" name="email" class="form-control" placeholder="Masukan Email" value="<?php echo $umkm->email ?>">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Nama UMKM</label>
                  <input type="hidden" name="idumkm" value="<?php echo $umkm->id_umkm ?>">
                  <input type="text" name="namaumkm" class="form-control" placeholder="Masukan Nama UMKM" value="<?php echo $umkm->nama_umkm ?>">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Alamat UMKM</label>
                  <textarea name="alamat" rows="8" cols="80" class="form-control" placeholder="Masukan Alamat"><?php echo $umkm->alamat_umkm ?></textarea>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Deskripsi UMKM</label><br>
                  <textarea class="form-control" name="deskripsi" rows="8" cols="80" placeholder="Masukan Deskripsi"><?php echo $umkm->deskripsi_umkm ?></textarea>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Nomor Telepon</label>
                  <input type="text" name="nohp" class="form-control" placeholder="Masukan Nomor Telepon" value="<?php echo $umkm->nomor_telp_umkm ?>">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Tanggal Pendaftaran</label>
                  <input type="text" name="tgl" class="form-control" value="<?php echo $umkm->tanggal_join?>">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Kategori UMKM</label>
                  <select class="form-control" name="idkategori">
                    <option value="<?php echo $umkm->id_kategori_umkm ?>"><?php echo $umkm->nama_kategori_umkm ?></option>
                    <?php foreach ($kategori as $k): ?>
                    <option value="<?php echo $k->id_kategori_umkm ?>"><?php echo $k->nama_kategori_umkm ?></option>
                    <?php endforeach; ?>
                  </select>
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
