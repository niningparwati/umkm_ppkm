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
            <th class="close" style="background: #f7f7f7; text-align: center; color: black"><b>Aksi</b></th>
          </tr>
          <form method="POST" action="<?=base_url()?>Konsumen/Checkout">

            <?php
            $no = 1;
            foreach ($menunggu_pembayaran as $key) {
              ?>
              <tr>
                <td><?=$no++?></td>
                <td class="images">
                  <?php 
                  $produk = $this->M_konsumen->getProdukPesanan($key->id_transaksi);
                  foreach ($produk as $x) {
                    echo $x->nama_produk." ( ".$x->jumlah_produk." produk)<br>";
                  } ?>
                </td>
                <td class="qty" style="color: black;padding-top: 40px">Rp <?=number_format($key->total_harga,2,',','.')?></td>
                <td class="qty" style="padding-top: 40px; color: black">
                  Rp <?=number_format($key->ongkos_kirim,2,',','.')?>
                </td>
                <td>
                  <?=$key->ekspedisi_pengiriman."<br>".$key->estimasi_pengiriman?>
                </td>
                <td>
                  <?=$key->detail_alamat.", ".$key->kota.", ".$key->provinsi?>
                </td>
                <td style="width: 120px">
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
            <th class="images" style="background: #f7f7f7;  text-align: center; color: black"><b>Nama Produk</b></th>
            <th class="bg price" style="background: #f7f7f7; text-align: center; color: black"><b>Total Harga</b></th>
            <th class="bg subtotal" style="background: #f7f7f7; text-align: center; color: black"><b>Ekspedisi Pengiriman</b></th>
            <th class="qty" style="background: #f7f7f7; text-align: center; color: black"><b>Ongkos Kirim</b></th>
            <th class="bg subtotal" style="background: #f7f7f7; text-align: center; color: black"><b>Alamat Pengiriman</b></th>
            <th class="close" style="background: #f7f7f7; text-align: center; color: black"><b>Nomor Resi</b></th>
          </tr>
          <form method="POST" action="<?=base_url()?>Konsumen/Checkout">

            <?php
            $no = 1;
            foreach ($menunggu_konfirmasi as $key) {
              ?>
              <tr>
                <td><?=$no++?></td>
                <td class="images">
                  <?php 
                  $produk = $this->M_konsumen->getProdukPesanan($key->id_transaksi);
                  foreach ($produk as $x) {
                    echo $x->nama_produk." (".$x->jumlah_produk.")<br>";
                  } ?>
                </td>
                <td class="qty" style="color: black;padding-top: 40px">Rp <?=number_format($key->total_harga,2,',','.')?></td>
                <td class="qty" style="padding-top: 40px; color: black">
                  Rp <?=number_format($key->ongkos_kirim,2,',','.')?>
                </td>
                <td>
                  <?=$key->ekspedisi_pengiriman."<br>".$key->estimasi_pengiriman?>
                </td>
                <td>
                  <?=$key->detail_alamat.", ".$key->kota.", ".$key->provinsi?>
                </td>
                <td style="width: 120px">
                  <?php 
                  if ($key->resi) {
                    echo $key->resi;
                  }else{
                    echo "belum ada nomor resi";
                  }?>
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
            <th class="bg subtotal" style="background: #f7f7f7; text-align: center; color: black"><b>Ekspedisi Pengiriman</b></th>
            <th class="qty" style="background: #f7f7f7; text-align: center; color: black"><b>Ongkos Kirim</b></th>
            <th class="bg subtotal" style="background: #f7f7f7; text-align: center; color: black"><b>Alamat Pengiriman</b></th>
            <th class="close" style="background: #f7f7f7; text-align: center; color: black"><b>Nomor Resi</b></th>
          </tr>
          <form method="POST" action="<?=base_url()?>Konsumen/Checkout">

            <?php
            $no = 1;
            foreach ($diproses as $key) {
              ?>
              <tr>
                <td><?=$no++?></td>
                <td class="images">
                  <?php 
                  $produk = $this->M_konsumen->getProdukPesanan($key->id_transaksi);
                  foreach ($produk as $x) {
                    echo $x->nama_produk." (".$x->jumlah_produk.")<br>";
                  } ?>
                </td>
                <td class="qty" style="color: black;padding-top: 40px">Rp <?=number_format($key->total_harga,2,',','.')?></td>
                <td class="qty" style="padding-top: 40px; color: black">
                  Rp <?=number_format($key->ongkos_kirim,2,',','.')?>
                </td>
                <td>
                  <?=$key->ekspedisi_pengiriman."<br>".$key->estimasi_pengiriman?>
                </td>
                <td>
                  <?=$key->detail_alamat.", ".$key->kota.", ".$key->provinsi?>
                </td>
                <td style="width: 120px">
                  <?php 
                  if ($key->resi) {
                    echo $key->resi;
                  }else{
                    echo "belum ada nomor resi";
                  }?>
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
            <th class="bg subtotal" style="background: #f7f7f7; text-align: center; color: black"><b>Ekspedisi Pengiriman</b></th>
            <th class="qty" style="background: #f7f7f7; text-align: center; color: black"><b>Ongkos Kirim</b></th>
            <th class="bg subtotal" style="background: #f7f7f7; text-align: center; color: black"><b>Alamat Pengiriman</b></th>
            <th class="close" style="background: #f7f7f7; text-align: center; color: black"><b>Nomor Resi</b></th>
            <th class="close" style="background: #f7f7f7; text-align: center; color: black"><b>Aksi</b></th>
          </tr>
          <form method="POST" action="<?=base_url()?>Konsumen/Checkout">

            <?php
            $no = 1;
            foreach ($dikirim as $key) {
              ?>
              <tr>
                <td><?=$no++?></td>
                <td class="images">
                  <?php 
                  $produk = $this->M_konsumen->getProdukPesanan($key->id_transaksi);
                  foreach ($produk as $x) {
                    echo $x->nama_produk." ( ".$x->jumlah_produk." produk )<br>";
                  } ?>
                </td>
                <td class="qty" style="color: black;padding-top: 40px">Rp <?=number_format($key->total_harga,2,',','.')?></td>
                <td class="qty" style="padding-top: 40px; color: black">
                  Rp <?=number_format($key->ongkos_kirim,2,',','.')?>
                </td>
                <td>
                  <?=$key->ekspedisi_pengiriman."<br>".$key->estimasi_pengiriman?>
                </td>
                <td>
                  <?=$key->detail_alamat.", ".$key->kota.", ".$key->provinsi?>
                </td>
                <td style="width: 120px">
                  <?php 
                  if ($key->resi) {
                    echo $key->resi;
                  }else{
                    echo "belum ada nomor resi";
                  }?>
                </td>
                <td>
                  <a href="<?=base_url()?>Konsumen/terimaPesanan/<?=$key->id_transaksi?>" style="text-decoration: none;color: green">Pesanan Diterima</a>
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
            <th class="images" style="background: #f7f7f7;  text-align: center; color: black"><b>Nama Produk</b></th>
            <th class="bg price" style="background: #f7f7f7; text-align: center; color: black"><b>Total Harga</b></th>
            <th class="bg subtotal" style="background: #f7f7f7; text-align: center; color: black"><b>Ekspedisi Pengiriman</b></th>
            <th class="qty" style="background: #f7f7f7; text-align: center; color: black"><b>Ongkos Kirim</b></th>
            <th class="bg subtotal" style="background: #f7f7f7; text-align: center; color: black"><b>Alamat Pengiriman</b></th>
            <th class="close" style="background: #f7f7f7; text-align: center; color: black"><b>Nomor Resi</b></th>
            <th class="close" style="background: #f7f7f7; text-align: center; color: black"><b>Status</b></th>
          </tr>
          <form method="POST" action="<?=base_url()?>Konsumen/Checkout">

            <?php
            $no = 1;
            foreach ($selesai as $key) {
              ?>
              <tr>
                <td><?=$no++?></td>
                <td class="images">
                  <?php 
                  $produk = $this->M_konsumen->getProdukPesanan($key->id_transaksi);
                  foreach ($produk as $x) {
                    echo $x->nama_produk." ( ".$x->jumlah_produk." produk )<br>";
                  } ?>
                </td>
                <td class="qty" style="color: black;padding-top: 40px">Rp <?=number_format($key->total_harga,2,',','.')?></td>
                <td class="qty" style="padding-top: 40px; color: black">
                  Rp <?=number_format($key->ongkos_kirim,2,',','.')?>
                </td>
                <td>
                  <?=$key->ekspedisi_pengiriman."<br>".$key->estimasi_pengiriman?>
                </td>
                <td>
                  <?=$key->detail_alamat.", ".$key->kota.", ".$key->provinsi?>
                </td>
                <td style="width: 120px">
                  <?php 
                  if ($key->resi) {
                    echo $key->resi;
                  }else{
                    echo "belum ada nomor resi";
                  }?>
                </td>
                <td>
                  <span style="color: red">Sudah Diterima</span>
                </td>
              </tr>
            <?php } ?>
          </form>
        </table>
      <?php } else{ ?>
        <br><br>
        <center><h5>Belum ada produk yang Anda masukan ke dalam keranjang!</h5></center>
      <?php } ?>
    </div><!-- .grid_12 -->
    <div class="clear"></div>

  </div><!-- .container_12 -->
</section><!-- #main -->

<div class="clear"></div>