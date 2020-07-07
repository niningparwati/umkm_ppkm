<!--Sweet Alert -->
<?php if($this->session->flashdata('success_keranjang')) { ?>
  <div class="success-flash" data-success="<?= $this->session->flashdata('success_keranjang') ?>"></div>
<?php } else if ($this->session->flashdata('error_keranjang')) { ?>
  <div class="error-flash" data-error="<?= $this->session->flashdata('error_keranjang') ?>"></div>
<?php }else if ($this->session->flashdata('warning_keranjang')) {?>
  <div class="warning-flash" data-warning="<?= $this->session->flashdata('warning_keranjang') ?>"></div>
<?php } ?>
<!-- End Sweet Alert -->

<div class="clear"></div>

<section id="main" class="entire_width" style="margin-top:30px">
  <div class="container_12">
   <div class="grid_12">
    <h1 class="page_title" style="border-bottom: none;">Keranjang Belanja</h1>
    <?php
    $cek1 = $this->M_konsumen->cekIdTransaksi($this->session->userdata('id_konsumen'));  // cek produk di tabel transaksi status menunggu konfirmasi

    if (!empty($produk)) {
      ?>
      <table class="cart_product">
       <tr>
        <th class="edit" style="background: #f7f7f7; text-align: center;color: black"><b>Pilih</b></th>
        <th class="images" style="background: #f7f7f7;  text-align: center; color: black"><b>Gambar Produk</b></th>
        <th class="bg name" style="background: #f7f7f7;  text-align: center; color: black"><b>Nama Produk</b></th>
        <th class="bg price" style="background: #f7f7f7; text-align: center; color: black"><b>Harga Produk</b></th>
        <th class="qty" style="background: #f7f7f7; text-align: center; color: black"><b>Jumlah Produk</b></th>
        <th class="bg subtotal" style="background: #f7f7f7; text-align: center; color: black"><b>Subtotal</b></th>
        <th class="bg subtotal" style="background: #f7f7f7; text-align: center; color: black"><b>Hapus</b></th>
      </tr>
      <form method="POST" action="<?=base_url()?>Konsumen/Checkout">

        <?php
        foreach ($produk as $key) {
          $cek = $this->M_konsumen->getKeranjang($key->id_keranjang); // mengambil data produk di keranjang
          $jml = $cek->jumlah_barang;
          $stok = $this->M_konsumen->produkById($cek->id_produk)->stok; // mengecek stok produk yang tersedia
          if ($jml > $stok) {
            $data = array(
              'jumlah_barang' => $stok
            );
            $this->M_konsumen->updateKeranjang($data, $key->id_keranjang);  // mengupdate jumlah produk yang dimasukan ke dalam keranjang
            // print_r($data);
          }
          ?>
          <tr id="<?=$key->id_produk?>" style="border-bottom: 1px solid black;">
            <td style="border: none;"><input type="checkbox" name="keranjang[]" id="undefined" value="<?=$key->id_keranjang?>" tabindex="0" style="margin-top: 20px" checked="checked" ></td>
            <td class="images" style="border: none;"><a href="<?=base_url()?>Konsumen/detailProduk/<?=$key->id_produk?>">
              <?php if (!empty($key->foto_produk)) { ?>
                <img src="<?=base_url()?>assets/foto_produk/<?=$key->foto_produk?>" alt="Product Slide 1" style="width: 100px; height: 100px">
              <?php }else{ ?>
                <img src="<?=base_url()?>assets/foto_produk/produk_default.png" alt="Product Slide 1" style="width: 100px; height: 100px">
              <?php } ?>
            </a></td>
            <td class="qty" style="color: black;border: none;vertical-align: middle;"><a style="color: black;" href="<?=base_url()?>Konsumen/detailProduk/<?=$key->id_produk?>"><b><?=$key->nama_produk?></b></a></td>
            <td class="qty" style="color: black;border: none;vertical-align: middle;">Rp <?=number_format($key->harga_produk,0,',','.')?></td>
            <td class="qty" style="color: black;border: none;vertical-align: middle;">
              <a href="<?=base_url()?>Konsumen/kurangiBarang/<?=$key->id_keranjang?>"><img src="<?=base_url()?>assets/konsumen/images/primary-minus.png" style="width: 18px; padding-right: 10px"></a>
              <?=$key->jumlah_barang?>
              <a href="<?=base_url()?>Konsumen/tambahBarang/<?=$key->id_keranjang?>"><img src="<?=base_url()?>assets/konsumen/images/primary-plus.png" style="width: 18px; padding-left: 10px"></a>
            </td>
            <td class="qty" style="color: black; border: none;vertical-align: middle;">
              <?php
              $jml = $key->jumlah_barang;
              $hrg = $key->harga_produk;
              $total = $jml*$hrg;
              echo 'Rp '.number_format($total,0,',','.');
              ?>
            </td>
            <td class="qty" style="border: none;vertical-align: middle;">
              <!-- MODAL HAPUS PRODUK-->
              <a href="#" title="Hapus Barang" onclick="hapusProduk(<?=$key->id_produk?>)"><img src="<?=base_url()?>assets/konsumen/images/trash.png" style="width: 20px;"></a>
              <!-- <div>
              </div> -->
              <!-- MODAL -->

            </td>
          </tr>
        <?php } ?>
        <tr>
         <td colspan="7" class="cart_but" style="border: none;">
          <button class="update" name="submit" type="submit" style="background: #59b7c2; color: #404040"><img src="<?=base_url()?>assets/konsumen/images/bg_cart_nav.png"> <b>Checkout Barang</b></button>
        </td>
      </tr>
    </form>
  </table>
</div><!-- .grid_12 -->
<?php } else{ ?>
  <br><br>
  <center><h5>Belum ada produk yang Anda masukan ke dalam keranjang!</h5></center>
<?php } ?>

<div class="clear"></div>

</div><!-- .container_12 -->
</section><!-- #main -->

<div class="clear"></div>

<script type="text/javascript">

  function hapusProduk(id) {
    var id = id;

    Swal.fire({
      title: 'Hapus Produk!',
      text: "Hapus dari keranjang?",
      icon: 'warning',
      showCancelButton: true,
      cancelButtonText: "Tidak",
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Ya!'
    }).then((result) => {
      if (result.value) {
        location.href = '<?=base_url()?>Konsumen/hapusProduk/'+id
      }
    })
  }
</script>
