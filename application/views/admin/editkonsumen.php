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
        <li class="active"> Edit Konsumen</li>
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
              <h3 class="box-title">Edit Konsumen</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="<?=base_url()?>Admin/updateKonsumen" method="post" enctype="multipart/form-data">
              <div class="box-body">
                <div class="form-group">
                  <input type="hidden" name="idkonsumen" value="<?php echo $konsumen->id_konsumen ?>">
                  <label for="exampleInputEmail1">Username</label>
                  <input type="text" name="username" class="form-control" placeholder="Masukan Username" value="<?php echo $konsumen->username_konsumen ?>">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Password</label>
                  <input type="password" name="password" class="form-control" placeholder="Masukan Password" value="<?php echo $konsumen->password_konsumen ?>" disabled>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Email</label>
                  <input type="email" name="email" class="form-control" placeholder="Masukan Email" value="<?php echo $konsumen->email_konsumen ?>">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Foto Profil</label><br>
                  <img src="<?=base_url()?>uploads/foto_konsumen/<?php echo $konsumen->foto_konsumen ?>" width="200px" alt="">
                <input type="file" name="foto" class="form-control" value="">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Nomor Telepon</label>
                  <input type="text" name="nohp" class="form-control" placeholder="Masukan Nomor Telepon" value="<?php echo $konsumen->nomor_telp_konsumen?>">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Jenis Kelamin</label><br>
                  <?php if($konsumen->jenis_kelamin == 'perempuan'){ ?>
                  <input type="radio" name="jk" value="perempuan" checked> Perempuan <p>    </p>
                  <input type="radio" name="jk" value="laki-laki"> Laki-laki
                <?php }else{ ?>
                  <input type="radio" name="jk" value="perempuan"> Perempuan <p>    </p>
                  <input type="radio" name="jk" value="laki-laki" checked> Laki-laki
                <?php } ?>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Tanggal Lahir</label>
                  <input type="date" name="tgll" class="form-control" value="<?php echo $konsumen->tanggal_lahir ?>">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Status Konsumen</label><br>
                  <?php if ($konsumen->status_konsumen == 'aktif') { ?>
                  <input type="radio" name="status" value="aktif" checked> aktif <p>    </p>
                  <input type="radio" name="status" value="tidak aktif"> tidak aktif
                <?php }else{ ?>
                  <input type="radio" name="status" value="aktif"> aktif <p>    </p>
                  <input type="radio" name="status" value="tidak aktif" checked> tidak aktif
                <?php } ?>
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
