<div class="clear"></div>

<section id="main" class="entire_width">
  <div class="container_12">
   <div class="grid_12">
    <h1 class="page_title" style="border-bottom: none;">Keranjang Belanja</h1>
    <?php 
    $cek1 = $this->M_konsumen->cekIdTransaksi($this->session->userdata('id_konsumen'));  // cek produk di tabel transaksi status menunggu konfirmasi

    if (!is_null($produk)) {
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
          <tr>
            <td style="border: none;"><input type="checkbox" name="keranjang[]" id="undefined" value="<?=$key->id_keranjang?>" tabindex="0" style="margin-top: 20px"></td>
            <td class="images" style="border: none;"><a href="<?=base_url()?>Konsumen/detailProduk/<?=$key->id_produk?>">
              <?php if (!empty($key->foto_produk)) { ?>
                <img src="<?=base_url()?>assets/foto_produk/<?=$key->foto_produk?>" alt="Product Slide 1" style="width: 100px; height: 100px">
              <?php }else{ ?>
                <img src="<?=base_url()?>assets/foto_produk/produk_default.png" alt="Product Slide 1" style="width: 100px; height: 100px">
              <?php } ?>
            </a></td>
            <td class="qty" style="color: black; border: none;vertical-align: middle;"><b><?=$key->nama_produk?></b></td>
            <td class="qty" style="color: black;padding-top: 40px; border: none;vertical-align: middle;">Rp <?=number_format($key->harga_produk,0,',','.')?></td>
            <td class="qty" style="padding-top: 40px; color: black;border: none;vertical-align: middle;">
              <a href="<?=base_url()?>Konsumen/kurangiBarang/<?=$key->id_keranjang?>"><img src="<?=base_url()?>assets/konsumen/images/primary-minus.png" style="width: 18px; padding-right: 10px"></a>
              <?=$key->jumlah_barang?>
              <a href="<?=base_url()?>Konsumen/tambahBarang/<?=$key->id_keranjang?>"><img src="<?=base_url()?>assets/konsumen/images/primary-plus.png" style="width: 18px; padding-left: 10px"></a>
            </td>
            <td class="qty" style="border: none;vertical-align: middle;">
              <?php 
              $jml = $key->jumlah_barang;
              $hrg = $key->harga_produk;
              $total = $jml*$hrg;
              echo 'Rp '.number_format($total,0,',','.');
              ?>
            </td>
            <td class="close" style="border: none;vertical-align: middle;">
              <!-- MODAL HAPUS PRODUK-->
              <div style="margin-left: 10px">
                <a data-dynamic="true" href="#" onclick="hapusProduk(<?=$key->id_produk?>)"><img src="<?=base_url()?>assets/konsumen/images/trash.png" style="width: 20px; margin-top: 35px;"></a>
                <!-- <label class="modal1-open modal1-label close1" for="modal1-open"> -->
                  <!-- <img src="<?=base_url()?>assets/konsumen/images/trash.png" style="width: 20px; margin-top: 35px;"> -->
                  <!-- </label> -->
                <!-- <input type="radio" name="modal1" value="open" id="modal1-open" class="modal1-radio">

                <div class="modal1">
                  <label class="modal1-label overlay"><input type="radio" name="modal1" value="close1" class="modal1-radio"/></label>
                  <div class="content1" style="height: 150px">
                    <div class="top1">
                      <b>Anda yakin produk ini akan dihapus dari keranjang?</b>
                      <label class="modal1-label close-btn1">
                        <input type="radio" name="modal1" value="close1" class="modal1-radio"/>
                      </label>
                    </div>
                    <div class="footer1">
                      <table>
                        <tr>
                          <td style="border: none;">
                            <a href="<?=base_url()?>Konsumen/Keranjang/<?=$this->session->userdata('id_konsumen')?>"><button type="button" style="padding: 8px; background: #7b808a" class="btn1 btn-default pull-left1" data-dismiss="modal1-label">Tidak</button></a>
                          </td>
                          <td style="border: none;">
                            <a href="<?=base_url()?>Konsumen/hapusProduk/<?=$key->id_produk?>"><button type="button" style="padding: 8px;margin-left: 300px; width: 50px; text-align: center; background: #DD4B39" class="btn1 btn-default pull-right" data-dismiss="modal1">Ya</button></a>
                          </td>
                        </tr>
                      </table>
                      <br><br>
                    </div>
                  </div>
                </div> -->
              </div>
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

<!-- <script type="text/javascript">
  function hapusProduk(id) {
    swal({
      title: "Hapus Produk",
      text: "Yakin produk ini akan dihapus dari keranjang?",
      type: warning,
      showCancelButton : true,
      confirmButtonColor: "#DD6B55",
      confirmButtonText: "Ya",
      closeOnConfirm: false
      ),
    function(isConfirm){
      alert(isConfirm);
      alert(id);
      swal("Berhasil!", "Produk berhasil dihapus dari keranjang", "success");
    });
  }
</script> -->