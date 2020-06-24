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
        Kelola Promo
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"> Kelola Promo</li>
        <li class="active"> Edit Promo</li>
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
              <h3 class="box-title">Edit Promo</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="<?=base_url()?>Admin/updatePromo" method="post" enctype="multipart/form-data">
              <div class="box-body">
                <div class="form-group">
                  <input type="hidden" name="idpromo" value="<?php echo $promo->id_promo?>">
                   <?php echo form_error('namapromo') ?>
                  <label for="exampleInputEmail1">Nama Promo</label>
                  <input type="text" name="namapromo" class="form-control" placeholder="Masukan Nama Promo" value="<?php echo $promo->nama_promo ?>">
                </div>
                <div class="form-group">
                   <?php echo form_error('kodepromo') ?>
                  <label for="exampleInputEmail1">Kode Promo</label>
                  <input type="text" name="kodepromo" class="form-control" placeholder="Masukan Kode Promo" value="<?php echo $promo->kode_promo ?>">
                </div>
                <div class="form-group">
                   <?php echo form_error('besarpromo') ?>
                  <label for="exampleInputEmail1">Besar Promo</label>
                  <input type="text" name="besarpromo" class="form-control" placeholder="Masukan Besar Promo %" value="<?php echo $promo->besar_promo ?>">
                </div>
                <div class="form-group">
                   <?php echo form_error('minimal') ?>
                  <label for="exampleInputEmail1">Minimal Belanja</label>
                  <input type="text" name="minimal" class="form-control" placeholder="Masukan Minimal Belanja" value="<?php echo $promo->minimal_belanja ?>">
                </div>
                <div class="form-group">
                   <?php echo form_error('maksimum') ?>
                  <label for="exampleInputEmail1">Maksimum Potongan</label>
                  <input type="text" name="maksimum" class="form-control" placeholder="Masukan Maksimum Potongan" value="<?php echo $promo->maksimum_potongan ?>">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Foto Promo</label><br>
                  <img src="<?php echo base_url()?>assets/foto_promo/<?php echo $promo->foto_promo ?>" width="100px"><br>
                  <input type="file" name="foto" class="form-control">
                </div>
                <div class="form-group">
                  <?php echo form_error('berlaku_sampai') ?>
                  <label for="exampleInputEmail1">Berlaku Sampai</label>
                  <input type="date" name="berlaku_sampai" class="form-control" placeholder="Masukan Berlaku Sampai" value="<?php echo $promo->berlaku_sampai ?>">
                </div>
                <div class="form-group">
                  <?php echo form_error('status') ?>
                  <label for="exampleInputEmail1">Status Promo</label><br>
                  <?php if ($promo->status_promo == 'aktif') { ?>
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

  <?php $this->load->view('admin/Footer') ?>
</div>
<!-- ./wrapper -->
