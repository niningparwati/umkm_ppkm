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
        <li class="active"> Kelola UMKM</li>
        <li class="active"> Detail UMKM</li>
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
                <?php  if (!$umkm->foto_user) { ?>
                <img src="<?php echo base_url()?>assets/foto_user/user.png" class="user-image" alt="User Image" width="70px">
              <?php } else { ?>
                <img src="<?php echo base_url()?>assets/foto_user/<?= $umkm->foto_user ?>" class="user-image" alt="User Image" width="70px">
              <?php } ?>
              </center>
              <h3 class="profile-username text-center"><?php echo $umkm->nama_umkm ?></h3>

              <p class="text-muted text-center"><?php echo $umkm->nama_kategori_umkm ?></p>

              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <b>Username</b> <a class="pull-right"><?php echo $umkm->username ?></a>
                </li>
                <li class="list-group-item">
                  <b>Email</b> <a class="pull-right"><?php echo $umkm->email ?></a>
                </li>
                <li class="list-group-item">
                  <b>Alamat</b><br><br>
                  <textarea class="form-control" rows="4" cols="80"><?php echo $umkm->alamat_umkm ?></textarea>
                </li>
                <li class="list-group-item">
                  <b>Deskripsi</b><br><br>
                  <textarea class="form-control" rows="4" cols="80"><?php echo $umkm->deskripsi_umkm ?></textarea>
                </li>
                <li class="list-group-item">
                  <b>Nomor Telepon</b> <a class="pull-right"><?php echo $umkm->nomor_telp_umkm ?></a>
                </li>
                <li class="list-group-item">
                  <b>Tanggal Daftar</b> <a class="pull-right"> <?php echo $umkm->tanggal_join ?></a>
                </li>
                <li class="list-group-item">
                  <b>Nama Kategori</b> <a class="pull-right"><?php echo $umkm->nama_kategori_umkm ?></a>
                </li>
                <li class="list-group-item">
                  <b>Status</b> <a class="pull-right"><?php echo $umkm->status?></a>
                </li>
              </ul>

              <a href="<?=base_url()?>Admin/kelolaUMKM" class="btn btn-danger btn-block"><b>Kembali</b></a>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#activity" data-toggle="tab">Produk</a></li>
              <li><a href="#timeline" data-toggle="tab">Market</a></li>
              <li><a href="#settings" data-toggle="tab">Portofolio</a></li>
              <li><a href="#informasi" data-toggle="tab">Informasi</a></li>
            </ul>
            <div class="tab-content">
              <div class="active tab-pane" id="activity">
                <!-- Post -->
                <?php foreach ($produk as $p): ?>
                  <div class="post">
                    <h5> <b>ID Produk <?php echo $p->id_produk?></b> </h5>
                    <div class="row">
                      <div class="col-md-3" style="float:left">
                        <img src="<?php echo base_url()?>assets/foto_produk/<?php echo $p->foto_produk ?>" width="120px" alt="">
                      </div>
                      <p> <b><?php echo $p->nama_produk ?></b><br>
                        <span style="color:red">Rp <?php echo $p->harga_produk ?>,00</span><br>
                        <?php echo $p->deskripsi_produk ?>
                      </p><br>
                    </div>

                  </div>
                <?php endforeach; ?>
                <!-- /.post -->

              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="timeline">
                <!-- The timeline -->
                <ul class="timeline timeline-inverse">
                  <!-- timeline time label -->
                  <?php foreach ($market as $m): ?>
                    <li class="time-label">
                          <span class="bg-red">
                            Market <?php echo $m->id_market ?>
                          </span>
                    </li>
                    <!-- /.timeline-label -->
                    <!-- timeline item -->
                    <li>
                      <i class="fa fa-map-pin bg-yellow"></i>

                      <div class="timeline-item">
                        <span class="time"><i class="fa fa-user-o"></i> UMKM <?php echo $m->id_umkm ?></span>

                        <h3 class="timeline-header"><a href="#">Market <?php echo $m->id_market ?></a></h3>

                        <div class="timeline-body">
                        <?php echo $m->alamat_market?><br>
                        <a href="#"><?php echo $m->link_market   ?></a>
                        </div>
                      </div>
                    </li>
                    <!-- END timeline item -->
                  <?php endforeach; ?>
                </ul>
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="settings">
                  <ul class="timeline timeline-inverse">
                    <!-- timeline time label -->
                      <li class="time-label">
                            <span class="bg-red">
                              Portofolio <?php echo $umkm->nama_umkm ?>
                            </span>
                      </li>
                      <!-- /.timeline-label -->
                      <?php foreach ($portofolio as $p): ?>
                      <!-- timeline item -->
                      <li>
                        <i class="fa fa-star bg-yellow"></i>

                        <div class="timeline-item">
                          <span class="time"><i class="fa fa-time-o"></i> <?php echo $p->tanggal ?></span>

                          <h3 class="timeline-header"><a href="#">Portofolio <?php echo $p->id_portofolio ?></a></h3>

                          <div class="timeline-body">
                            <b><?php echo $p->judul_portofolio?></b>
                            <br>
                          <center> <img src="<?php echo base_url()?>assets/foto_portofolio/<?php echo $p->foto_portofolio?>" width="150px" alt=""> </center>
                          Keterangan : <a href="#"><?php echo $p->keterangan   ?></a>
                        </div>
                        </div>
                      </li>
                    <?php endforeach; ?>
                  </ul>
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="informasi">
                <!-- Post -->
                <?php foreach ($informasi as $i): ?>
                <div class="post">
                  <div class="user-block">
                    <?php  if (!$umkm->foto_user) { ?>
                    <img class="img-circle img-bordered-sm" src="<?php echo base_url()?>assets/foto_user/user.png" class="user-image" alt="User Image">
                    <?php } else { ?>
                    <img class="img-circle img-bordered-sm" src="<?php echo base_url()?>assets/foto_user/<?= $umkm->foto_user ?>" class="user-image" alt="User Image">
                    <?php } ?>
                        <span class="username">
                          <a href="#"><?php echo $i->judul_informasi ?></a>
                          <a href="#" class="pull-right btn-box-tool"><i class="fa fa-times"></i></a>
                        </span>
                    <?php if ($i->status_informasi = 'aktif') {?>
                      <span class="description">Dipublikasi</span>
                    <?php  }else{ ?>
                        <span class="description">Tidak dipublikasi</span>
                    <?php } ?>
                  </div>
                  <!-- /.user-block -->
                  <p>
                    <?php echo $i->isi_informasi ?>
                  </p>
                <img src="<?php echo base_url()?>assets/foto_informasi/<?php echo $i->gambar ?>" width="150px" alt="">
                </div>
              <?php endforeach; ?>
                <!-- /.post -->
              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php $this->load->view('admin/Footer') ?>
</div>
