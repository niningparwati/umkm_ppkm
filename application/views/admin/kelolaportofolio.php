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
        Kelola Portofolio
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"> Kelola Portofolio</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Data Portofolio</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <table id="dataTable" class="table table-bordered table-striped">
            <thead>
            <tr>
              <th>No.</th>
              <th>Judul Portofolio</th>
              <th>File Portofolio</th>
              <th>Tempat</th>
              <th>Tanggal</th>
              <th>ID UMKM</th>
              <th>Keterangan</th>
            </tr>
            </thead>
            <tbody>
              <?php
              $n = 1;
              foreach ($portofolio as $p): ?>
            <tr>
              <td><?php echo $n++ ?></td>
              <td><?php echo $p->judul_portofolio ?></td>
              <td> <img src="<?php echo base_url()?>assets/foto_portofolio/<?php echo $p->foto_portofolio ?>" width="150px" alt=""> </td>
              <td><?php echo $p->alamat ?></td>
              <td><?php echo $p->tanggal ?></td>
              <td><?php echo $p->nama_umkm ?></td>
              <td><?php echo $p->keterangan ?></td>
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
