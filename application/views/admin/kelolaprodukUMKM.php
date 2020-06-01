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
        Kelola Produk UMKM
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"> Kelola Produk UMKM</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Data Produk UMKM</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr>
              <th>No.</th>
              <th>Nama Produk</th>
              <th>Foto Produk</th>
              <th>Deskripsi Produk</th>
              <th>Harga Produk</th>
              <th>ID UMKM</th>
              <th>Kategori</th>
            </tr>
            </thead>
            <tbody>
              <?php
              $n = 1;
              foreach ($produk as $p): ?>
            <tr>
              <td><?php echo $n++ ?></td>
              <td><?php  echo $p->nama_produk ?></td>
              <td><img src="<?=base_url()?>assets/foto_produk/<?=$p->foto_produk?>" width="120px" alt=""></td>
              <td><?php echo $p->deskripsi_produk ?></td>
              <td>Rp <?php echo $p->harga_produk ?>,00</td>
              <td><?php echo $p->id_umkm ?></td>
              <td><?php echo $p->id_kategori_produk ?></td>
            </tr>
          <?php endforeach; ?>
          </tbody>
          </table>
        </div>
        <!-- /.box-body -->
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <?php $this->load->view('admin/footer') ?>
</div>
<!-- ./wrapper -->
