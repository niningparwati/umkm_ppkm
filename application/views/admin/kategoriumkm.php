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
        Kategori UMKM
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"> Kategori UMKM</li>
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
              <h3 class="box-title">Tambah Kategori UMKM</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="<?=base_url()?>Admin/createKategoriUMKM" method="POST">
              <div class="box-body">
                <?php echo form_error('nama'); ?>
                <div class="form-group">
                  <label for="exampleInputEmail1">Nama Kategori</label>
                  <input type="text" class="form-control" name="nama" placeholder="Nama Kategori">
                </div>
                <?php echo form_error('keterangan'); ?>
                <div class="form-group">
                  <label for="exampleInputEmail1">Keterangan</label>
                  <textarea name="keterangan" rows="8" cols="80" class="form-control"></textarea>
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
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Data Kategori UMKM</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <table id="dataTable" class="table table-bordered table-striped">
            <thead>
            <tr>
              <th>No.</th>
              <th>Nama Kategori</th>
              <th>Keterangan</th>
              <th>Aksi</th>
            </tr>
            </thead>
            <tbody>
              <?php
              $n = 1;
              foreach ($kategori as $k): ?>
            <tr>
              <td><?php echo $n++ ?></td>
              <td><?php echo $k->nama_kategori_umkm ?></td>
                  <td><?php echo $k->keterangan ?></td>
              <td>
                <a href="<?= base_url()?>Admin/pilihKategoriUMKM/<?=$k->id_kategori_umkm ?>">
                  <button class="btn btn-warning">
                      <div><i class="fa fa-fw fa-pencil"></i>Edit</div>
                  </button>
                </a>
                <a class="btn btn-danger" data-toggle="modal" href="#" data-target="#hapus<?=$k->id_kategori_umkm?>">
                    <i class="fa fa-fw fa-trash"></i> Hapus
                </a>
              </td>
            </tr>
          <?php endforeach; ?>
          </tbody>
          </table>
        </div>
        <!-- /.box-body -->
        <script type="text/javascript">
          $('#dataTable').DataTable();
        </script>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <?php $this->load->view('admin/footer') ?>
</div>
<!-- ./wrapper -->

<!-- ini bagian buka hapus -->
<?php foreach ($kategori as $s) { ?>
<div class="modal fade" id="hapus<?=$s->id_kategori_umkm?>" tabindex="-1" role="dialog" aria-hidden="true" aria-labelledby="ExampleModalLabel">
<div class="modal-dialog" role="document">
 <div class="modal-content">
   <div class="modal-header">
     <h4 class="modal-title" id="ExampleModalLabel">Konfirmasi Hapus</h4>
     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
       <span aria-hidden="true">&times;</span>
     </button>
   </div>
   <div class="modal-body">
     <p>Anda Yakin Akan Menghapus <?= $s->nama_kategori_umkm ?>?</p>
   </div>
   <div class="modal-footer justify-content-between">
     <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Tidak</button>
     <a href="<?= site_url()?>Admin/hapusKategoriUMKM/<?= $s->id_kategori_umkm ?>" class="btn btn-danger">Iya</a>
   </div>
 </div>
 <!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<?php } ?>
