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
        Kelola Informasi
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"> Kelola Informasi</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Data Informasi</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <table id="dataTable" class="table table-bordered table-striped">
            <thead>
            <tr>
              <th>No.</th>
              <th>Judul Informasi</th>
              <th>Detail Informasi</th>
              <th>Gambar Informasi</th>
              <th>Status</th>
              <th>ID UMKM</th>
            </tr>
            </thead>
            <tbody>
              <?php
              $n = 1;
              foreach ($informasi as $i) { ?>
            <tr>
              <td><?php echo $n++ ?></td>
              <td><?php echo $i->judul_informasi ?></td>
              <td><?php echo $i->isi_informasi ?></td>
              <td> <img src="<?php echo base_url()?>assets/foto_informasi/<?php echo $i->gambar ?>" alt="Gambar informasi" width="150px"> </td>
              <td><?php echo $i->status_informasi ?></td>
              <td><?php echo $i->nama_umkm ?></td>
            </tr>
          <?php } ?>
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
