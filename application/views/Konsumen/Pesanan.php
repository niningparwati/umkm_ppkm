<!--Sweet Alert -->
<?php if($this->session->flashdata('success_pesan')) { ?>
  <div class="success-flash" data-success="<?= $this->session->flashdata('success_pesan') ?>"></div>
<?php } else if ($this->session->flashdata('error_pesan')) { ?>
  <div class="error-flash" data-error="<?= $this->session->flashdata('error_pesan') ?>"></div>
<?php }else if ($this->session->flashdata('warning_pesan')) {?>
  <div class="warning-flash" data-warning="<?= $this->session->flashdata('warning_pesan') ?>"></div>
<?php } ?>
<!-- End Sweet Alert -->

<div class="clear"></div>

<section id="main" class="entire_width">
  <div class="container_12">
    <div class="grid_12">
      <?php if (!empty($menunggu_pembayaran)) {?>
        <h3 class="page_title" style="border-bottom: none;">Pesanan Menunggu Pembayaran</h3>
        <table class="cart_product">
          <tr>
            <th class="edit" style="background: #f7f7f7; text-align: center;color: black"><b>No</b></th>
            <th class="images" style="background: #f7f7f7;  text-align: center; color: black"><b>Nama Produk</b></th>
            <th class="bg price" style="background: #f7f7f7; text-align: center; color: black"><b>Total Harga</b></th>
            <th class="bg subtotal" style="background: #f7f7f7; text-align: center; color: black"><b>Ekspedisi Pengiriman</b></th>
            <th class="qty" style="background: #f7f7f7; text-align: center; color: black"><b>Ongkos Kirim</b></th>
            <th class="bg subtotal" style="background: #f7f7f7; text-align: center; color: black"><b>Alamat Pengiriman</b></th>
            <th class="bg subtotal" style="width: 120px; background: #f7f7f7; text-align: center; color: black"><b>Aksi</b></th>
          </tr>
          <form method="POST" action="<?=base_url()?>Konsumen/Checkout">

            <?php
            $no = 1;
            foreach ($menunggu_pembayaran as $key) {
              ?>
              <tr style="border-bottom: 1px solid black;">
                <td style="border: none;"><?=$no++?></td>
                <td class="images" style="vertical-align: middle; text-align: left;border: none;padding-left: 10px; padding-right: 10px">
                  <?php 
                  $produk = $this->M_konsumen->getProdukPesanan($key->id_transaksi);
                  foreach ($produk as $x) {
                    echo "<a href='".base_url()."Konsumen/detailProduk/".$x->id_produk."' style='text-decoration:none; color: #777777'>".substr($x->nama_produk, 0, 10) ?><?php if (strlen($x->nama_produk) > 10) { echo "..."; } echo "</a> <br>";
                  } ?>
                </td>
                <td class="qty" style="vertical-align: middle;border: none;padding-left: 10px; padding-right: 10px">Rp 
                  <?php if (!is_null($key->besar_diskon) AND $key->ongkos_kirim > 0 ) {?>
                    <?=number_format($key->total_harga+$key->ongkos_kirim-$key->besar_diskon,0,',','.')?>
                  <?php }elseif (!is_null($key->besar_diskon)) {?>
                    <?=number_format($key->total_harga-$key->besar_diskon,0,',','.')?>
                  <?php }elseif ($key->ongkos_kirim > 0) {?>
                    <?=number_format($key->total_harga+$key->ongkos_kirim,0,',','.')?>
                  <?php }else{ ?>
                    <?=number_format($key->total_harga,0,',','.')?>
                  <?php } ?>
                </td>
                <td class="qty" style="vertical-align: middle; border: none;padding-left: 10px; padding-right: 10px">
                  Rp <?=number_format($key->ongkos_kirim,0,',','.')?>
                </td>
                <td style="vertical-align: middle;border: none;padding-left: 10px; padding-right: 10px;padding-bottom: 30px">
                  <?=$key->ekspedisi_pengiriman."<br>".$key->estimasi_pengiriman?>
                </td>
                <td style="vertical-align: middle;border: none;word-wrap: break-word;padding-left: 10px; padding-right: 10px">
                  <?=$key->detail_alamat.", ".$key->kota.", ".$key->provinsi?>
                </td>
                <td style="width: 120px;vertical-align: middle;border: none;padding-left: 10px; padding-right: 10px">
                  <a href="<?=base_url()?>Konsumen/Pengiriman/<?=$key->id_transaksi?>" style="color: blue; text-decoration: none;">Lanjutkan Pembayaran</a>
                </td>
              </tr>
            <?php } ?>
          </form>
        </table>
      <?php }if (!empty($menunggu_konfirmasi)) {
        ?>
        <h3 class="page_title" style="border-bottom: none;">Pesanan Menunggu Konfirmasi</h3>
        <table class="cart_product">
          <tr>
            <th class="edit" style="background: #f7f7f7; text-align: center;color: black"><b>No</b></th>
            <th class="edit" style="background: #f7f7f7; text-align: center;color: black"><b>Tanggal Order</b></th>
            <th class="images" style="background: #f7f7f7;  text-align: center; color: black"><b>Nama Produk</b></th>
            <th class="bg price" style="background: #f7f7f7; text-align: center; color: black"><b>Total Harga</b></th>
            <th class="bg subtotal" style="background: #f7f7f7; text-align: center; color: black"><b>Ekspedisi Pengiriman</b></th>
            <th class="bg subtotal" style="background: #f7f7f7; text-align: center; color: black"><b>Alamat Pengiriman</b></th>
            <th class="bg subtotal" style="background: #f7f7f7; text-align: center; color: black"><b>Detail</b></th>
          </tr>
          <form method="POST" action="<?=base_url()?>Konsumen/Checkout">

            <?php
            $no = 1;
            foreach ($menunggu_konfirmasi as $key) {
              ?>
              <tr style="border-bottom: 1px solid black;">
                <td style="border: none;"><?=$no++?></td>
                <td style="border: none;padding-left: 10px; padding-right: 10px"><?php $time = strtotime($key->tanggal_transaksi); echo date('d F Y',$time); ?></td>
                <td class="images" style="vertical-align: middle;text-align: left;border: none;padding-left: 10px; padding-right: 10px">
                  <?php 
                  $produk = $this->M_konsumen->getProdukPesanan($key->id_transaksi);
                  foreach ($produk as $x) {
                    echo "<a href='".base_url()."Konsumen/detailProduk/".$x->id_produk."' style='text-decoration:none; color: #777777'>".substr($x->nama_produk, 0, 10) ?><?php if (strlen($x->nama_produk) > 10) { echo "..."; } echo "</a> <br>";
                  } ?>
                </td>
                <td class="qty" style="padding-top: 40px; border: none;padding-left: 10px; padding-right: 10px">Rp <?=number_format($key->total_harga,0,',','.')?></td>
                
                <td style="border: none;padding-left: 10px; padding-right: 10px;padding-bottom: 30px">
                  <?=$key->ekspedisi_pengiriman."<br>".$key->estimasi_pengiriman?> hari
                </td>
                <td style="border: none;padding: 10px;word-wrap: break-word;padding-left: 10px; padding-right: 10px; vertical-align: middle;">
                  <?=$key->detail_alamat.", ".$key->kota.", ".$key->provinsi?>
                </td>
                <td style="border: none;padding-bottom: 30px;padding-left: 10px; padding-right: 10px">
                  <a href="<?=base_url()?>Konsumen/DetailTransaksi/<?=$key->id_transaksi?>" style="text-decoration: none;">
                    <span style="margin: auto;padding: 10px 20px;background-color: #78c4cd;color:white;">Detail</span>
                  </a>
                </td>
              </tr>
            <?php } ?>
          </form>
        </table>
      <?php }if (!empty($diproses)) { ?>
        <h3 class="page_title" style="border-bottom: none;">Pesanan Sedang Diproses</h3>
        <table class="cart_product">
          <tr>
            <th class="edit" style="background: #f7f7f7; text-align: center;color: black"><b>No</b></th>
            <th class="images" style="background: #f7f7f7;  text-align: center; color: black"><b>Nama Produk</b></th>
            <th class="bg price" style="background: #f7f7f7; text-align: center; color: black"><b>Total Harga</b></th>
            <th class="bg price" style="background: #f7f7f7; text-align: center; color: black"><b>Diskon</b></th>
            <th class="qty" style="background: #f7f7f7; text-align: center; color: black"><b>Ongkos Kirim</b></th>
            <th class="bg subtotal" style="background: #f7f7f7; text-align: center; color: black"><b>Ekspedisi Pengiriman</b></th>
            <th class="bg subtotal" style="background: #f7f7f7; text-align: center; color: black"><b>Alamat Pengiriman</b></th>
            <th class="bg subtotal" style="background: #f7f7f7; text-align: center; color: black"><b>Detail</b></th>
          </tr>
          <form method="POST" action="<?=base_url()?>Konsumen/Checkout">

            <?php
            $no = 1;
            foreach ($diproses as $key) {
              ?>
              <tr style="border-bottom: 1px solid black;">
                <td style="border: none;"><?=$no++?></td>
                <td class="images" style="vertical-align: middle;text-align: left;border: none;padding-left: 10px; padding-right: 10px">
                  <?php 
                  $produk = $this->M_konsumen->getProdukPesanan($key->id_transaksi);
                  foreach ($produk as $x) {
                    echo "<a href='".base_url()."Konsumen/detailProduk/".$x->id_produk."' style='text-decoration:none; color: #777777'>".substr($x->nama_produk, 0, 10) ?><?php if (strlen($x->nama_produk) > 10) { echo "..."; } echo "</a> <br>";
                  } ?>
                </td>
                <td class="qty" style="padding-top: 40px;border: none;padding-left: 10px; padding-right: 10px">Rp <?=number_format($key->total_harga,0,',','.')?></td>
                <td class="qty" style="padding-top: 40px;border: none;padding-left: 10px; padding-right: 10px">
                  Rp <?=number_format($key->ongkos_kirim,0,',','.')?>
                </td>
                <td class="qty" style="padding-top: 40px;border: none;padding-left: 10px; padding-right: 10px">Rp 
                  <?php if (!is_null($key->besar_diskon)) {?>
                    <?=number_format($key->total_harga,0,',','.')?>
                  <?php }else{ ?>
                    0
                  <?php } ?>
                </td>
                <td style="border: none;padding-left: 10px; padding-right: 10px;padding-bottom: 30px;padding-bottom: 30px">
                  <?=$key->ekspedisi_pengiriman."<br>".$key->estimasi_pengiriman?> hari
                </td>
                <td style="border: none;padding: 10px;word-wrap: break-word;padding-left: 10px; padding-right: 10px; vertical-align: middle;">
                  <?=$key->detail_alamat.", ".$key->kota.", ".$key->provinsi?>
                </td>
                <td style="border: none;padding-bottom: 30px;padding-left: 10px; padding-right: 10px">
                  <a href="<?=base_url()?>Konsumen/DetailTransaksi/<?=$key->id_transaksi?>" style="text-decoration: none;">
                    <span style="margin: auto;padding: 10px 20px;background-color: #78c4cd;color:white;">Detail</span>
                  </a>
                </td>
              </tr>
            <?php } ?>
          </form>
        </table>
      <?php }if (!empty($dikirim)) { ?>
        <h3 class="page_title" style="border-bottom: none;">Pesanan Sedang Dikirim</h3>
        <table class="cart_product">
          <tr>
            <th class="edit" style="background: #f7f7f7; text-align: center;color: black"><b>No</b></th>
            <th class="images" style="background: #f7f7f7;  text-align: center; color: black"><b>Nama Produk</b></th>
            <th class="bg price" style="background: #f7f7f7; text-align: center; color: black"><b>Total Harga</b></th>
            <th class="bg price" style="background: #f7f7f7; text-align: center; color: black"><b>Diskon</b></th>
            <th class="qty" style="background: #f7f7f7; text-align: center; color: black"><b>Ongkos Kirim</b></th>
            <th class="bg subtotal" style="background: #f7f7f7; text-align: center; color: black"><b>Ekspedisi Pengiriman</b></th>
            <th class="bg subtotal" style="background: #f7f7f7; text-align: center; color: black"><b>Alamat Pengiriman</b></th>
            <th class="bg subtotal" style="background: #f7f7f7; text-align: center; color: black"><b>Nomor Resi</b></th>
            <th class="bg subtotal" style="background: #f7f7f7; text-align: center; color: black"><b>Aksi</b></th>
            <th class="bg subtotal" style="background: #f7f7f7; text-align: center; color: black"><b>Detail</b></th>
          </tr>
          <form method="POST" action="<?=base_url()?>Konsumen/Checkout">

            <?php
            $no = 1;
            foreach ($dikirim as $key) {
              ?>
              <tr style="border-bottom: 1px solid black;">
                <td style="border: none;"><?=$no++?></td>
                <td class="images" style="vertical-align: middle;text-align: left;border: none;padding-left: 10px; padding-right: 10px">
                  <?php 
                  $produk = $this->M_konsumen->getProdukPesanan($key->id_transaksi);
                  foreach ($produk as $x) {
                    echo "<a href='".base_url()."Konsumen/detailProduk/".$x->id_produk."' style='text-decoration:none; color: #777777'>".substr($x->nama_produk, 0, 10) ?><?php if (strlen($x->nama_produk) > 10) { echo "..."; } echo "</a> <br>";
                  } ?>
                </td>
                <td class="qty" style="padding-top: 40px; border: none;padding-left: 10px; padding-right: 10px">Rp <?=number_format($key->total_harga,0,',','.')?></td>
                <td class="qty" style="padding-top: 40px; border: none;padding-left: 10px; padding-right: 10px">Rp 
                  <?php if (!is_null($key->besar_diskon)) {?>
                    <?=number_format($key->total_harga,0,',','.')?>
                  <?php }else{ ?>
                    0
                  <?php } ?>
                </td>
                <td class="qty" style="padding-top: 40px;border: none;padding-left: 10px; padding-right: 10px">
                  Rp <?=number_format($key->ongkos_kirim,0,',','.')?>
                </td>
                <td style="border: none;padding-left: 10px; padding-right: 10px;padding-bottom: 30px">
                  <?=$key->ekspedisi_pengiriman."<br>".$key->estimasi_pengiriman?> hari
                </td>
                <td style="border: none;padding-left: 10px; padding-right: 10px;">
                  <?=$key->detail_alamat.", ".$key->kota.", ".$key->provinsi?>
                </td>
                <td style="width: 120px; border: none;padding-left: 10px; padding-right: 10px">
                  <?php 
                  $cek = $this->M_konsumen->getResi($key->id_transaksi);
                  foreach ($cek as $key) {
                    echo $key->no_resi."<br><br>";
                  }
                  ?>
                </td>
                <td style="border: none;padding-left: 10px; padding-right: 10px">
                  <a href="<?=base_url()?>Konsumen/terimaPesanan/<?=$key->id_transaksi?>" style="text-decoration: none;color: green">Konfirmasi <br>Pesanan Diterima</a>
                </td>
                <td style="border: none;padding-bottom: 30px;padding-left: 10px; padding-right: 10px">
                  <a href="<?=base_url()?>Konsumen/DetailTransaksi/<?=$key->id_transaksi?>" style="text-decoration: none;">
                    <span style="margin: auto;padding: 10px 20px;background-color: #78c4cd;color:white;">Detail</span>
                  </a>
                </td>
              </tr>
            <?php } ?>
          </form>
        </table>
      <?php }if (!empty($selesai)) {?>
        <h3 class="page_title" style="border-bottom: none;">Pesanan Selesai</h3>
        <table class="cart_product">
          <tr>
            <th class="edit" style="background: #f7f7f7; text-align: center;color: black"><b>No</b></th>
            <th class="edit" style="background: #f7f7f7; text-align: center;color: black"><b>Tanggal Order</b></th>
            <th class="images" style="background: #f7f7f7;  text-align: center; color: black"><b>Nama Produk</b></th>
            <th class="bg price" style="background: #f7f7f7; text-align: center; color: black"><b>Total Harga</b></th>
            <th class="edit" style="background: #f7f7f7; text-align: center;color: black"><b>Tanggal Diterima</b></th>
            <th class="bg subtotal" style="background: #f7f7f7; text-align: center; color: black"><b>Status Pesanan</b></th>
            <th class="bg subtotal" style="background: #f7f7f7; text-align: center; color: black"><b>Detail</b></th>
          </tr>
          <form method="POST" action="<?=base_url()?>Konsumen/Checkout">

            <?php
            $no = 1;
            foreach ($selesai as $key) {
              ?>
              <tr style="border-bottom: 1px solid black;">
                <td style="border: none;"><?=$no++?></td>
                <td style="border: none;padding-left: 10px; padding-right: 10px"><?php $time = strtotime($key->tanggal_transaksi); echo date('d F Y',$time); ?></td>
                <td class="images" style="vertical-align: middle;text-align: left;border: none;padding-left: 10px; padding-right: 10px">
                  <?php 
                  $produk = $this->M_konsumen->getProdukPesanan($key->id_transaksi);
                  foreach ($produk as $x) {
                    echo "<a href='".base_url()."Konsumen/detailProduk/".$x->id_produk."' style='text-decoration:none; color: #777777'>".substr($x->nama_produk, 0, 10) ?><?php if (strlen($x->nama_produk) > 10) { echo "..."; } echo "</a> <br>";
                  } ?>
                </td>
                <td class="qty" style="padding-top: 40px;border: none;padding-left: 10px; padding-right: 10px">Rp <?=number_format($key->total_harga,0,',','.')?></td>
                <td style="border: none;padding-left: 10px; padding-right: 10px"><?= tgl_indo($key->tanggal_terima) ?></td>
                <td style="border: none;padding-left: 10px; padding-right: 10px">
                  <span>Sudah Diterima</span>
                </td>
                <td style="border: none;padding-bottom: 30px;padding-left: 10px; padding-right: 10px">
                  <a href="<?=base_url()?>Konsumen/DetailTransaksi/<?=$key->id_transaksi?>" style="text-decoration: none;">
                    <span style="margin: auto;padding: 10px 20px;background-color: #78c4cd;color:white;">Detail</span>
                  </a>
                </td>
              </tr>
            <?php } ?>
          </form>
        </table>
      <?php }if(empty($menunggu_pembayaran) AND empty($menunggu_konfirmasi) AND empty($diproses) AND empty($dikirim) AND empty($selesai) ){ ?>
        <br><br>
        <center><h3>Anda belum melakukan transaksi. Silahkan checkout barang terlebih dahulu!</h3></center>
      <?php } ?>
    </div><!-- .grid_12 -->
    <div class="clear"></div>

  </div><!-- .container_12 -->
</section><!-- #main -->

<div class="clear"></div>

<!-- SHOW -->