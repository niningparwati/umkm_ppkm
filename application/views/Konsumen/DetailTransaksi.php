<!--Sweet Alert -->
<?php if($this->session->flashdata('success_checkout')) { ?>
  <div class="success-flash" data-success="<?= $this->session->flashdata('success_checkout') ?>"></div>
<?php } else if ($this->session->flashdata('error_checkout')) { ?>
  <div class="error-flash" data-error="<?= $this->session->flashdata('error_checkout') ?>"></div>
<?php }else if ($this->session->flashdata('warning_checkout')) {?>
  <div class="warning-flash" data-warning="<?= $this->session->flashdata('warning_checkout') ?>"></div>
<?php } ?>
<!-- End Sweet Alert -->

<div class="clear"></div>

<section id="main" class="entire_width">
  <div class="container_12">
    <div class="grid_12">
     <table style="border:none; text-align: right;">
      <form action="<?=base_url()?>Konsumen/inputDiskon/<?=$transaksi->id_transaksi?>" method="POST">
        <tr>
          <td style="border: none;text-align: left;font-size: 30px; width: 60%">Detail Transaksi</td>
          <td style="border: none;">
            <?php if ($alamat->status=='menunggu pembayaran' OR $alamat->status=='menunggu konfirmasi' OR $alamat->status=='diproses' OR $alamat->status=='dikirim' ) {
              echo "Status transaksi : <span style='color:blue'>".$alamat->status."</span>";
            }else{ 
              echo "Status transaksi : <span style='color:red'>selesai</span>";
            } ?>
          </td>
        </tr>
      </form>
    </table>
    <table class="cart_product">
      <tr>
        <th class="bg name" style="text-align: center;font-weight: bold;color: black">Gambar Produk</th>
        <th class="bg name" style="text-align: center;font-weight: bold;color: black">Nama Produk</th>
        <th class="bg price" style="text-align: center;font-weight: bold;color: black">Harga Produk</th>
        <th class="bg name" style="text-align: center;font-weight: bold;color: black">Jumlah Produk</th>
        <th colspan="2" class="bg subtotal" style="text-align: center;font-weight: bold;color: black">Subtotal</th>
      </tr>
      <!-- <form method="POST" action="<?=base_url()?>Konsumen/Transaksi"> -->
        <?php
        foreach ($produk as $key) {
          ?>
          <tr>
            <td class="images" style="border: none; vertical-align: middle;">
              <a href="<?=base_url()?>Konsumen/detailProduk/<?=$key->id_produk?>">
                <?php if (!empty($key->foto_produk)) { ?>
                  <img src="<?=base_url()?>assets/foto_produk/<?=$key->foto_produk?>" alt="Product Slide 1">
                <?php }else{ ?>
                  <img src="<?=base_url()?>assets/foto_produk/produk_default.png" alt="Product Slide 1">
                <?php } ?>
              </a>  
            </td>
            <td class="qty" style="border: none; vertical-align: middle;word-wrap: break-word;">
              <a href="<?=base_url()?>Konsumen/detailProduk/<?=$key->id_produk?>" style="text-decoration: none; color: black"><?=$key->nama_produk?></a>
            </td>
            <td class="qty" style="border: none; vertical-align: middle;">Rp <?=number_format($key->harga_produk,0,',','.')?></td>
            <td class="qty" style="padding-top: 30px; border: none; vertical-align: middle;">
              <?=$key->jumlah_produk?>
            </td>
            <td class="qty" colspan="2" style="border: none; vertical-align: middle;">
              <?php 
              $jml = $key->jumlah_produk;
              $hrg = $key->harga_produk;
              $total = $jml*$hrg;
              echo 'Rp '.number_format($total,0,',','.');
              ?>
            </td>
          </tr>
        <?php } ?>
        <tr>
          <td colspan="3" style="text-align: justify;border: none;">
            Tanggal transaksi : <?= tgl_indo($alamat->tanggal_transaksi) ?> <br><br>
            <?php if ($alamat->tanggal_terima != '0000-00-00') {?>
              Diterima pada : <?=tgl_indo($alamat->tanggal_terima)?> <br><br>
            <?php }if (!empty($alamat->provinsi) OR !empty($alamat->kota) OR !empty($alamat->detail_alamat)) { ?>
              Alamat Pengiriman : <br>
              <?php if (!empty($alamat->detail_alamat)){ echo $alamat->detail_alamat.", "; } ?>
              <?php if (!empty($alamat->kota)){ echo $alamat->kota.", "; } ?>
              <?php if (!empty($alamat->provinsi)){ echo $alamat->provinsi; } ?>
            <?php } ?>
          </td>
          <td style="text-align: right;border: none;">
            <?php if (!is_null($transaksi->besar_diskon) AND !is_null($alamat->ongkos_kirim)) { ?>

              Total Harga &nbsp  <br>
              Diskon &nbsp <br>
              Ongkos kirim<br><br>
              <b style="font-size: 20px">Total Bayar</b> <br><br>

            <?php }elseif(!is_null($transaksi->besar_diskon)){ ?>

              Total Harga &nbsp <br>
              Diskon &nbsp <br>
              Ongkos kirim  <br><br>
              <b style="font-size: 20px">Total Bayar</b> <br><br>

            <?php }elseif(!is_null($alamat->ongkos_kirim)) { ?>
              Total Harga  <br>
              Diskon<br>
              <b style="font-size: 20px">Total Bayar </b> <br><br>
            <?php }else{ ?>
              <b style="font-size: 20px">Total Bayar </b> <br><br>
            <?php }?>
          </td>
          <td style="text-align: left;border: none;">
            <?php if (!is_null($transaksi->besar_diskon) AND !is_null($alamat->ongkos_kirim)) { ?>

              &nbsp: &nbsp Rp <?=number_format($totalHarga,0,',','.')?> <br>
              &nbsp: &nbsp Rp <?= number_format($transaksi->besar_diskon,0,',','.') ?><br>
              &nbsp: &nbsp Rp <?=number_format($alamat->ongkos_kirim,0,',','.')?> <br><br>
              <?php $total = $alamat->total_harga+$alamat->ongkos_kirim-$transaksi->besar_diskon ?>
              &nbsp: &nbsp <b style="font-size: 20px">Rp <?=number_format($total,0,',','.')?></b> <br><br>

            <?php }elseif(!is_null($transaksi->besar_diskon)){ ?>

              &nbsp: &nbsp Rp <?=number_format($totalHarga,0,',','.')?> <br>
              &nbsp: &nbsp Rp <?= number_format($transaksi->besar_diskon,0,',','.') ?><br>
              &nbsp: &nbsp Rp 0 <br><br>
              <?php $total = $alamat->total_harga-$transaksi->besar_diskon ?>
              &nbsp: &nbsp <b style="font-size: 20px">Rp <?=number_format($total,0,',','.')?></b> <br><br>

            <?php }elseif(!is_null($alamat->ongkos_kirim)) { ?>
              &nbsp: &nbsp Rp <?=number_format($totalHarga,0,',','.')?> <br>
              &nbsp: &nbsp Rp 0<br>
              &nbsp: &nbsp Rp <?=number_format($alamat->ongkos_kirim,0,',','.')?> <br><br>
              <?php $total = $alamat->total_harga+$alamat->ongkos_kirim ?>
              &nbsp: &nbsp <b style="font-size: 20px">Rp <?=number_format($total,0,',','.')?></b> <br><br>
            <?php }else{ ?>
              &nbsp: &nbsp <b style="font-size: 20px">Rp <?=number_format($alamat->total_harga,0,',','.')?></b> <br><br>
            <?php }?>
          </td>
        </tr>
        <!-- </form> -->
      </table>
    </div><!-- .grid_12 -->

    <div class="clear"></div>


    <div class="clear"></div>

  </div><!-- #content_bottom -->
  <div class="clear"></div>

</div><!-- .container_12 -->
</section><!-- #main -->

<div class="clear"></div>
