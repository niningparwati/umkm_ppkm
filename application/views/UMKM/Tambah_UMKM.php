<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">

   <!-- Content Wrapper. Contains page content -->
   <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Tambah Produk
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-6">
          <!-- general form elements -->
          <div class="box box-primary">
            <!-- form start -->
            <form role="form" action="<?= $action?>" method="post" enctype="multipart/form-data">
              <div class="box-body">
                <div class="form-group">
                  <div class="form-group">
                    <label for="namaProduk">Nama Produk</label>
                    <input type="text" name="nama_produk" class="form-control" id="Nama Produk" >
                  </div>
                  <label for="fotoProduk">Foto produk</label>
                  <input type="file" name="foto" id="Foto">
                </div>             
                <div class="form-group">
                  <label for="keterangan">Keterangan</label>
                  <textarea name="keterangan" class="form-control" id="Keterangan"></textarea>
                </div>
                <div class="form-group">
                  <label for="hargaProduk">Harga</label>
                  <input type="text" name="harga" class="form-control" id="Harga">
                </div>
              </div>
              <div class="form-group">
                <label style="color: grey">Kategori</label>
                <select class="form-control select2" id="level" name="level">
                  <option value="">Paguyuban</option>
                  <option value="" >UMKM</option>
                  <option value="" >Admin</option>
                </select>
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <a href="<?= base_url()?>Admin" class="btn btn-danger"><i class="fa fa-fw fa-arrow-left"></i>Kembali</a>
                <button type="submit" name="submit" class="btn btn-primary pull-right">Update</button>
              </div>
            </form>
          </div>
        </div>
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>

</body>
</html>