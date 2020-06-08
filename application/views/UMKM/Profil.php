<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">

   <!-- Content Wrapper. Contains page content -->
   <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Profil
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Forms</a></li>
        <li class="active">General Elements</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <!-- form start -->

            <div class="box-body">
              <div class="row">
                <?= $this->session->flashdata('notif')?>
                <div class="col-md-4">
                  <?php if ($profil->foto_user) { ?>
                    <img src="<?= base_url()?>assets/foto_user/<?= $profil->foto_user ?>" style="width: 300px; height: 300px"><br>
                  <?php }else{ ?>
                    <img src="<?= base_url()?>assets/foto_user/user.png ?>" style="width: 300px; height: 300px"><br>
                  <?php } ?>
                </div>
                <div class="col-md-6">
                  <div class="row">
                    <div class="col-md-4"><b>Nama User</b></div>
                    <div class="col-md-8"><?= $profil->nama_lengkap ?></div>
                  </div>
                  <div class="row"><br></div>
                  <div class="row">
                    <div class="col-md-4"><b>Tanggal Lahir</b></div>
                    <div class="col-md-8"><?php $time = strtotime($profil->tanggal_lahir); echo date('d F Y',$time); ?></div>
                  </div>
                  <div class="row"><br></div>
                  <div class="row">
                    <div class="col-md-4"><b>Email</b></div>
                    <div class="col-md-8"><?= $profil->email ?></div>
                  </div>
                  <div class="row"><br></div>
                  <div class="row">
                    <div class="col-md-4"><b>Username</b></div>
                    <div class="col-md-8"><?= $profil->username ?></div>
                  </div>
                  <div class="row"><br></div>
                  <div class="row">
                    <div class="col-md-4"><b>Nama UMKM</b></div>
                    <div class="col-md-8"><?= $profil->nama_umkm ?></div>
                  </div>
                  <div class="row"><br></div>
                  <div class="row">
                    <div class="col-md-4"><b>Kategori UMKM</b></div>
                    <div class="col-md-8"><?= $profil->nama_kategori_umkm ?></div>
                  </div>
                  <div class="row"><br></div>
                  <div class="row">
                    <div class="col-md-4"><b>No.Tlp UMKM</b></div>
                    <div class="col-md-8"><?= $profil->nomor_telp_umkm ?></div>
                  </div>
                  <div class="row"><br></div>
                  <div class="row">
                    <div class="col-md-4"><b>Alamat UMKM</b></div>
                    <div class="col-md-8"><?= $profil->alamat_umkm ?></div>
                  </div>
                   <div class="row"><br></div>
                   <div class="row">
                    <div class="col-md-4"><b>Kota/Kabupaten</b></div>
                    <div class="col-md-8"><?= $profil->kota_asal ?></div>
                  </div>
                   <div class="row"><br></div>
                   <div class="row">
                    <div class="col-md-4"><b>Provinsi</b></div>
                    <div class="col-md-8"><?= $profil->provinsi_asal ?></div>
                  </div>
                  <div class="row"><br></div>
                </div>
              </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
              <a href="<?= base_url()?>UMKM/Dashboard/" class="btn btn-danger"><i class="fa fa-fw fa-arrow-left"></i>Kembali</a>
              <a href="<?= base_url()?>UMKM/EditProfil"><button type="submit" name="submit" class="btn btn-primary pull-right">Edit</button></a>
            </div>
          </div>
        </div>
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>

</body>
</html>