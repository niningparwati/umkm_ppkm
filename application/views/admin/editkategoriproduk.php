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
        Kategori Produk
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"> Kategori Produk</li>
        <li class="active"> Edit Kategori Produk</li>
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
              <h3 class="box-title">Edit Kategori Produk</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="<?=base_url()?>Admin/updateKategoriProduk" method="POST">
              <div class="box-body">
                <div class="form-group">
                  <input type="hidden" name="id_kategori_produk" value="<?php echo $kategori->id_kategori_produk ?>">
                  <label for="exampleInputEmail1">Nama Kategori</label>
                  <input type="text" name="nama" class="form-control" placeholder="Nama Kategori" value="<?php echo $kategori->nama_kategori_produk ?>">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Keterangan</label>
                  <textarea name="keterangan" rows="8" cols="80" class="form-control"><?php echo $kategori->keterangan ?></textarea>
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
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <?php $this->load->view('admin/footer') ?>
</div>
<!-- ./wrapper -->

<!-- ini bagian buka hapus -->
<?php foreach ($kategori as $s) { ?>
<div class="modal fade" id="hapus<?=$s->id_kategori_produk?>" tabindex="-1" role="dialog" aria-hidden="true" aria-labelledby="ExampleModalLabel">
<div class="modal-dialog" role="document">
 <div class="modal-content">
   <div class="modal-header">
     <h4 class="modal-title" id="ExampleModalLabel">Konfirmasi Hapus</h4>
     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
       <span aria-hidden="true">&times;</span>
     </button>
   </div>
   <div class="modal-body">
     <p>Anda Yakin Akan Menghapus <?= $s->nama_kategori_produk ?>?</p>
   </div>
   <div class="modal-footer justify-content-between">
     <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Tidak</button>
     <a href="<?= site_url()?>Admin/hapusKategoriProduk/<?= $s->id_kategori_produk ?>" class="btn btn-danger">Iya</a>
   </div>
 </div>
 <!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<?php } ?>
