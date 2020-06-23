<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">

   <!-- Content Wrapper. Contains page content -->
   <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Tambah Produk
        <small>Preview</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Forms</a></li>
        <li class="active">General Elements</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <!-- form start -->
            <?= $this->session->flashdata('notif')?>
            <form role="form" id="tambah" action="<?= $action?>" method="post" enctype="multipart/form-data">
              <div class="box-body">
                <div class="row">
                  <div class="col-md-6">
                      <div class="form-group">
                        <label for="namaProduk">Nama Produk</label>
                        <!-- <input type="text" name="nama_produk" id="nama_produk" class="form-control" required> -->
                        <input type="text" class="form-control" id="nama_produk" name="nama_produk" value="<?php echo set_value('nama_produk'); ?>">
                        <?php echo form_error('nama_produk'); ?>
                      </div>
                      <div class="form-group">
                        <label for="stokProduk">Stok Produk</label>
                        <input type="number" min="0" name="stok" class="form-control" value="<?php echo set_value('stok'); ?>">
                        <?php echo form_error('stok'); ?>
                      </div>
                      <div class="form-group">
                        <label for="fotoProduk">Foto Produk</label>
                        <input type="file" name="foto_produk" class="form-control">
                      </div>
                  </div>
                  <div class="col-md-6">
                      <div class="form-group">
                        <label for="keterangan">Deskripsi Produk</label>
                        <div class="form-group">
                            <textarea name="deskripsi_produk" class="form-control"><?php echo set_value('deskripsi_produk'); ?></textarea>
                        <?php echo form_error('deskripsi_produk'); ?>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="harga">Harga</label>
                        <input type="text" class="form-control uang" id="rupiah" name="harga" value="<?php echo set_value('harga'); ?>" >
                        <?php echo form_error('harga'); ?>
                      </div>
                      <div class="form-group">
                        <label for="kategori">Kategori</label>
                        <select class="form-control" name="id_kategori">
                          <option value="" selected disabled>==PILIH==</option>
                          <?php foreach($kategori as $key){ ?>
                            <option value="<?=$key->id_kategori_produk?>"><?=$key->nama_kategori_produk?></option>
                          <?php  } ?>
                        </select>
                         <?php echo form_error('id_kategori'); ?>
                      </div>
                  </div>                  
                </div>
              
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <a href="<?= base_url()?>UMKM/Produk" class="btn btn-danger"><i class="fa fa-fw fa-arrow-left"></i>Kembali</a> 
                <button type="submit"  class="btn btn-primary pull-right">Simpan</button>
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
<script type="text/javascript">

  var rupiah = document.getElementById('rupiah');
  rupiah.addEventListener('keyup', function(e){
      // tambahkan 'Rp.' pada saat form di ketik
      // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
      rupiah.value = formatRupiah(this.value, 'Rp. ');
    });

  /* Fungsi formatRupiah */
  function formatRupiah(angka, prefix){
    var number_string = angka.replace(/[^,\d]/g, '').toString(),
    split       = number_string.split(','),
    sisa        = split[0].length % 3,
    rupiah        = split[0].substr(0, sisa),
    ribuan        = split[0].substr(sisa).match(/\d{3}/gi);

      // tambahkan titik jika yang di input sudah menjadi angka ribuan
      if(ribuan){
        separator = sisa ? '.' : '';
        rupiah += separator + ribuan.join('.');
      }

      rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
      return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
    }
  </script>


  </html>