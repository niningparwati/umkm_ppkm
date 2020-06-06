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
        <li class="active"> Kelola UMKM</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Data Kelola UMKM</h3>
          <br><br>
          <a href="<?= base_url()?>Admin/tambahUMKM">
            <button class="btn btn-primary">
                <div><i class="fa fa-fw fa-plus"></i>Tambah UMKM</div>
            </button>
          </a>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <table id="dataTable" class="table table-bordered table-striped">
            <thead>
            <tr>
              <th>No.</th>
              <th>Nama UMKM</th>
              <th>Alamat</th>
              <th>Status</th>
              <th>Aksi</th>
            </tr>
            </thead>
            <tbody>
              <?php
              $n = 1;
              foreach ($umkm as $u): ?>
            <tr>
              <td><?php echo $n++ ?></td>
              <td><?php echo $u->nama_umkm ?></td>
              <td><?php echo $u->alamat_umkm ?></td>
              <td><?php echo $u->status?></td>
              <td>
                <?php if ($u->status == 'aktif'){ ?>
                  <a class="btn btn-default" href="<?=base_url()?>Admin/updateTdkAktifUMKM/<?=$u->id_umkm?>">
                      <i class="fa fa-fw fa-minus-square"></i> Non Aktif
                  </a>
                <?php }else if($u->status == 'tidak aktif'){?>
                <a class="btn btn-info" href="<?=base_url()?>Admin/updateAktifUMKM/<?=$u->id_umkm?>">
                    <i class="fa fa-fw fa-check-square"></i> Aktif
                </a>
              <?php }else{?>
                <a class="btn btn-info" href="<?=base_url()?>Admin/updateAktifUMKM/<?=$u->id_umkm?>">
                    <i class="fa fa-fw fa-check-square"></i> Aktif
                </a>
              <?php  } ?>

                <a href="<?= base_url()?>Admin/pilihUMKM/<?=$u->id_umkm ?>" class="btn btn-success">
                      <div><i class="fa fa-fw fa-eye"></i>Detail</div>
                </a>
                <a href="<?= base_url()?>Admin/editUMKM/<?=$u->id_umkm ?>" class="btn btn-warning">
                      <div><i class="fa fa-fw fa-pencil"></i>Edit</div>
                </a>
                <a class="btn btn-danger" data-toggle="modal" href="#" data-target="#hapus<?=$u->id_umkm?>">
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
<?php foreach ($umkm as $s) { ?>
<div class="modal fade" id="hapus<?=$s->id_umkm?>" tabindex="-1" role="dialog" aria-hidden="true" aria-labelledby="ExampleModalLabel">
<div class="modal-dialog" role="document">
 <div class="modal-content">
   <div class="modal-header">
     <h4 class="modal-title" id="ExampleModalLabel">Konfirmasi Hapus</h4>
     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
       <span aria-hidden="true">&times;</span>
     </button>
   </div>
   <div class="modal-body">
     <p>Anda Yakin Akan Menghapus <?= $s->nama_umkm ?>?</p>
   </div>
   <div class="modal-footer justify-content-between">
     <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Tidak</button>
     <a href="<?= site_url()?>Admin/hapusUMKM/<?= $s->id_umkm ?>" class="btn btn-danger">Iya</a>
   </div>
 </div>
 <!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<?php } ?>
