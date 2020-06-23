<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">

   <!-- Content Wrapper. Contains page content -->
   <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Edit Promo       
      </h1>
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
            <form role="form" id="tambah"  action="<?= $action?>/<?= $promo->id_promo?>" method="post" enctype="multipart/form-data">
              <div class="box-body">
                <div class="row">
                  <div class="col-md-6">
                      <div class="form-group">
                        <label for="namaProduk">Nama Promo</label>
                        <input type="text" class="form-control" id="nama_promo" name="nama_promo" value="<?=$promo->nama_promo?>">
                        <?php echo form_error('nama_promo'); ?>
                      </div>
                      <div class="form-group">
                        <label for="stokProduk">Kode Promo</label>
                        <input type="text" name="kode_promo" class="form-control" value="<?=$promo->kode_promo?>">
                        <?php echo form_error('kode_promo'); ?>
                      </div>
                      <div class="form-group">
                        <label for="stokProduk">Besar Promo (%)</label>
                        <input type="number" min="1" name="besar_promo" class="form-control" value="<?=$promo->besar_promo?>">
                        <?php echo form_error('besar_promo'); ?>
                      </div>
                       <div class="form-group">
                        <label for="exampleInputEmail1">Berlaku Sampai *Bulan/Tanggal/Tahun</label>
                        <input type="date" name="berlaku_sampai" class="form-control" id="Tanggal"  value="<?=$promo->berlaku_sampai?>">
                          <?php echo form_error('berlaku_sampai'); ?>
                      </div>
                  </div>   
                  <div class="col-md-6">                    
                       <div class="form-group">
                        <label for="harga">Minimal Belanja</label>
                        <input type="text" class="form-control uang" id="rupiah" name="minimal_belanja" value="<?=$promo->minimal_belanja?>" >
                        <?php echo form_error('minimal_belanja'); ?>
                      </div>
                        <div class="form-group">
                        <label for="harga">Maksimal Potongan</label>
                        <input type="text" class="form-control uang" id="rupiah2" name="maksimum_potongan" value="<?=$promo->maksimum_potongan?>" >
                        <?php echo form_error('maksimum_potongan'); ?>
                      </div>
                      <div class="form-group">
                        <label for="fotoProduk">Foto Promo *optional</label>
                        <?php if ($promo->foto_promo) { ?>
                            <input name="foto_old" type="hidden" value="<?=$promo->foto_promo?>">
                            <input type="file" name="foto_promo" class="form-control"> <br><br>
                            <img src="<?= base_url()?>assets/foto_promo/<?=$promo->foto_promo?>" width='100px'>
                          <?php }else{?>
                            
                            <input type="file" name="foto_promo" class="form-control"><br>
                            <b>(foto promo belum ada. silahkan tambahkan foto)</b>
                          <?php } ?>

                      </div>
                  </div>   
                </div>
              
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <a href="<?= base_url()?>UMKM/Promo/<?= $id_umkm ?>" class="btn btn-danger"><i class="fa fa-fw fa-arrow-left"></i>Kembali</a> 
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

<script type="text/javascript">

  var rupiah2 = document.getElementById('rupiah2');
  rupiah2.addEventListener('keyup', function(e){
      // tambahkan 'Rp.' pada saat form di ketik
      // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
      rupiah2.value = formatRupiah(this.value, 'Rp. ');
    });

  /* Fungsi formatRupiah */
  function formatRupiah2(angka2, prefix){
    var number_string2 = angka2.replace(/[^,\d]/g, '').toString(),
    split2       = number_string2.split(','),
    sisa2        = split2[0].length % 3,
    rupiah2      = split2[0].substr(0, sisa2),
    ribuan2      = split2[0].substr(sisa2).match(/\d{3}/gi);

      // tambahkan titik jika yang di input sudah menjadi angka ribuan
      if(ribuan2){
        separator2 = sisa2 ? '.' : '';
        rupiah2 += separator2 + ribuan2.join('.');
      }

      rupiah2 = split2[1] != undefined ? rupiah2 + ',' + split2[1] : rupiah2;
      return prefix == undefined ? rupiah2 : (rupiah2 ? 'Rp. ' + rupiah2 : '');
    }
  </script>

  </html>