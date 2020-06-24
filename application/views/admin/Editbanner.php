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
        Kelola Banner
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"> Kelola Banner</li>
        <li class="active"> Edit Banner</li>
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
              <h3 class="box-title">Edit Banner</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="<?=base_url()?>Admin/updateBanner" method="post" enctype="multipart/form-data">
              <div class="box-body">
                <div class="form-group">
                  <input type="hidden" name="id_banner" value="<?php echo $banner->id_banner ?>">
                   <?php echo form_error('namabanner') ?>
                  <label for="exampleInputEmail1">Nama Banner</label>
                  <input type="text" name="namabanner" class="form-control" placeholder="Masukan Judul" value="<?php echo $banner->nama_banner ?>">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">ID UMKM</label><br>
                  <select class="form-control" name="idumkm">
                    <?php if ($banner->id_umkm == NULL) { ?>
                      <option value="NULL" >Diisi oleh admin </option>
                    <?php }else if ($banner->id_umkm != NULL){ ?>
                      <option value="<?php echo $banner->id_umkm ?>"><?php echo $banner->id_umkm; ?></option>
                    <?php } ?>
                    <option value="NULL">--PILIH UMKM--</option>
                    <?php foreach ($umkm as $u) { ?>
                    <option value="<?php echo $u->id_umkm?>"><?php echo $u->id_umkm.' - '.$u->nama_umkm ?></option>
                  <?php } ?>
                  </select>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Foto Banner</label><br><br>
                  <img src="<?php echo base_url()?>assets/foto_banner/<?php echo $banner->foto_banner ?>" width="300px">
                  <input type="file" name="foto" class="form-control">
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

  <?php $this->load->view('admin/Footer') ?>
</div>
<!-- ./wrapper -->
