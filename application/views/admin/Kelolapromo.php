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
        <li class="active"> Kelola Promo Umum</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Data Promo Umum</h3>
          <br><br>
          <a href="<?= base_url()?>Admin/tambahPromo">
            <button class="btn btn-primary">
                <div><i class="fa fa-fw fa-plus"></i>Tambah Promo Umum</div>
            </button>
          </a>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <table id="dataTable" class="table table-bordered table-striped">
            <thead>
            <tr>
              <th>No.</th>
              <th>Nama Promo</th>
              <th>Kode Promo</th>
              <th>Besar Promo</th>
              <th>Minimal Belanja</th>
              <th>Maksimum Potongan</th>
              <th>Status Promo</th>
              <th>Foto Promo</th>
              <th>Berlaku Sampai</th>
              <th>Aksi</th>
            </tr>
            </thead>
            <tbody>
              <?php
             $n = 1;
             foreach ($promo as $s): ?>
            <tr>
              <td><?php echo $n++ ?></td>
              <td><?php echo $s->nama_promo ?></td>
              <td><?php echo $s->kode_promo ?></td>
              <td><?php echo $s->besar_promo ?></td>
              <td><?php echo $s->minimal_belanja ?></td>
              <td><?php echo $s->maksimum_potongan ?></td>
              <td><?php echo $s->status_promo ?></td>
              <td> <img src="<?=base_url()?>assets/foto_promo/<?php echo $s->foto_promo ?>" width="200px" alt=""> </td>
              <td><?php echo $s->berlaku_sampai ?></td>
              <td>
                <a href="<?=base_url()?>Admin/pilihPromo/<?php echo $s->id_promo ?>">
                  <button class="btn btn-warning">
                      <div><i class="fa fa-fw fa-pencil"></i>Edit</div>
                  </button>
                </a>
                <a class="btn btn-danger" data-toggle="modal" href="#" data-target="#hapus<?php echo $s->id_promo?>">
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

  <?php $this->load->view('admin/Footer') ?>
</div>
<!-- ./wrapper -->


<!-- ini bagian buka hapus -->
<?php foreach ($promo as $s) { ?>
<div class="modal fade" id="hapus<?=$s->id_promo?>" tabindex="-1" role="dialog" aria-hidden="true" aria-labelledby="ExampleModalLabel">
<div class="modal-dialog" role="document">
 <div class="modal-content">
   <div class="modal-header">
     <h4 class="modal-title" id="ExampleModalLabel">Konfirmasi Hapus</h4>
     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
       <span aria-hidden="true">&times;</span>
     </button>
   </div>
   <div class="modal-body">
     <p>Anda Yakin Akan Menghapus <?= $s->nama_promo ?>?</p>
   </div>
   <div class="modal-footer justify-content-between">
     <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Tidak</button>
     <a href="<?= site_url()?>Admin/hapusPromo/<?= $s->id_promo ?>" class="btn btn-danger">Iya</a>
   </div>
 </div>
 <!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<?php } ?>
