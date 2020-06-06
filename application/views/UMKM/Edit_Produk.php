<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">

   <!-- Content Wrapper. Contains page content -->
   <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Edit Produk
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
            <form role="form" id="edit" action="<?= $action?>/<?= $product->id_produk?>" method="post" enctype="multipart/form-data" >
              <div class="box-body">
                <div class="row">
                  <div class="col-md-4">
                       <div class="form-group">
                        <label for="fotoProduk">Foto Produk</label><br>
                        <?php if ($product->foto_produk) { ?>
                          <img src="<?= base_url()?>assets/foto_produk/<?=$product->foto_produk?>" width='300px'><br><br>
                          <input name="foto_old" type="hidden" value="<?=$product->foto_produk?>">
                          <input type="file" name="foto_produk" class="form-control">
                        <?php }else{?>
                          <br>
                          <b>(foto produk belum ada. silahkan tambahkan foto)</b><br><br>
                          <input type="file" name="foto_produk" class="form-control">
                        <?php } ?>
                      </div>
                  </div>
                  <div class="col-md-8">
                      <div class="form-group">
                          <label for="namaProduk">Nama Produk</label>
                          <input type="text" name="nama_produk" class="form-control" value="<?=$product->nama_produk?>" required>
                        </div>

                         <div class="form-group">
                          <label for="stok">Stok</label>
                          <input type="number" name="stok" min="0" class="form-control" value="<?=$product->stok?>" required>
                        </div>
                     
                         <div class="form-group">
                            <label for="keterangan">Deskripsi Produk</label>
                            <div class="form-group">
                                <textarea name="deskripsi_produk" class="form-control" required="required">
                                  <?=$product->deskripsi_produk?>
                                </textarea>
                            </div>
                          </div>
                        <div class="form-group">
                          <label for="harga">Harga</label>
                          <!-- <input type="text" name="harga" class="form-control" value="<?=$product->harga?>" required> -->
                          <input type="text" class="form-control uang" id="rupiah" value="<?=$product->harga_produk?>" name="harga" required>
                        </div>
                        <div class="form-group">
                                  <label for="kategori">Kategori Produk</label>
                                  <select class="form-control" name="id_kategori" required="required">
                                    <option value="" selected disabled>==PILIH==</option>
                                    <?php foreach($kategori as $key){ ?>
                                      <option value="<?=$key->id_kategori_produk?>"  <?php if($key->id_kategori_produk==$product->id_kategori_produk) echo "selected" ?>> <?=$key->nama_kategori_produk?> </option>
                                    <?php  } ?>
                                  </select>
                        </div>
                  </div>
                </div>
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <a href="<?= base_url()?>UMKM/Produk" class="btn btn-danger"><i class="fa fa-fw fa-arrow-left"></i>Kembali</a>
                <input name="id_umkm" type="hidden" value="<?=$product->id_umkm?>">
                <a class="btn btn-primary pull-right" data-toggle="modal" href="#" data-target="#editData">Update</a>
              </div>
            </form>
          </div>
        </div>
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>

  <div class="modal fade" id="editData" tabindex="-1" role="dialog" aria-hidden="true" aria-labelledby="ExampleModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="ExampleModalLabel">Konfirmasi Edit</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>Anda yakin ingin mengubah data produk UMKM?</p>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Tidak</button>
          <button type="submit" class="btn btn-primary" form="edit">Iya</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->

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