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
        Kelola Slide
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"> Kelola Slide</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Data Slide</h3>
          <br><br>
          <a href="<?= base_url()?>Admin/Edit/<?// $value->id_user ?>">
            <button class="btn btn-primary">
                <div><i class="fa fa-fw fa-plus"></i>Tambah Slide</div>
            </button>
          </a>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr>
              <th>No.</th>
              <th>Judul Slide</th>
              <th>Deskripsi Slide</th>
              <th>Gambar Slide</th>
              <th>URL</th>
              <th>Status</th>
              <th>ID Admin</th>
              <th>Aksi</th>
            </tr>
            </thead>
            <tbody>
            <tr>
              <td>Trident</td>
              <td>Internet
                Explorer 4.0
              </td>
              <td>1</td>
              <td>2</td>
              <td>3</td>
              <td>4</td>
              <td>5</td>
              <td>
                <a href="<?= base_url()?>Admin/Edit/<?// $value->id_user ?>">
                  <button class="btn btn-warning">
                      <div><i class="fa fa-fw fa-pencil"></i>Edit</div>
                  </button>
                </a>
                <a class="btn btn-danger" data-toggle="modal" href="#" data-target="#hapus<? //$value->id_user?>">
                    <i class="fa fa-fw fa-trash"></i> Hapus
                </a>
              </td>
            </tr>
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
