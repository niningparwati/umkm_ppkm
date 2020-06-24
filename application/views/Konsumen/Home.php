  <div class="clear"></div>

  <?php if (!empty($promo)) {?>
    <div class="container_12">
      <div class="grid_12">
        <div id="demo" class="carousel slide" data-ride="carousel">

          <!-- Indicators -->
          <ul class="carousel-indicators">
            <?php 
            $no=0;
            foreach ($promo as $key) {
              ?>
              <li data-target="#demo" data-slide-to="<?=$no++?>" <?php if ($no == 0) { ?> class="active" <?php } ?>></li>
            <?php } ?>
          </ul>

          <!-- The slideshow -->
          <div class="carousel-inner">
            <?php $no=1; foreach ($promo as $key) { ?>
              <div class="carousel-item <?php if ($no == 1) { ?> active  <?php } ?>" >
                <img src="<?=base_url()?>assets/foto_promo/<?=$key->foto_promo?>" alt="Gambar - <?=$no++?>" width="1000" height="300">
                <div class="carousel-caption">
                  <h3><?=$key->nama_promo?></h3>
                  <h2><span style="background: white"><?=$key->kode_promo?></span></h2>
                  <p style="color: black;">
                    <?php if ($key->id_umkm) {
                      $nama_umkm = $this->M_konsumen->umkmById($key->id_umkm)->nama_umkm;
                    } ?>
                    <?php if (!empty($key->minimal_belanja) AND !empty($key->maksimum_potongan)) { ?>

                      Voucher diskon sebesar <?=$key->besar_promo?>% <?php if(!empty($key->id_umkm)) { ?> hanya untuk pembelian produk di <?=$nama_umkm?> <?php } ?> . Berlaku untuk transaksi dengan minimal pembelian Rp <?= number_format($key->minimal_belanja,2,',','.') ?> dengan maksimum diskon yang dapat digunakan sebesar Rp <?= number_format($key->maksimum_potongan,2,',','.') ?>. Voucher diskon hanya berlaku sampai <?= tgl_indo($key->berlaku_sampai) ?> .

                    <?php }elseif (!empty($key->minimal_belanja)) { ?>

                     Voucher diskon sebesar <?=$key->besar_promo?>% <?php if(!empty($key->id_umkm)) { ?> hanya untuk pembelian produk di <?=$key->nama_umkm?> <?php } ?> . Berlaku untuk transaksi dengan minimal pembelian Rp <?= number_format($key->minimal_belanja,2,',','.') ?> . Voucher diskon hanya berlaku sampai <?= tgl_indo($key->berlaku_sampai) ?> .

                   <?php }elseif (!empty($key->maksimum_potongan)) { ?>

                     Voucher diskon sebesar <?=$key->besar_promo?>% <?php if(!empty($key->id_umkm)) { ?> hanya untuk pembelian produk di <?=$key->nama_umkm?> <?php } ?> . Maksimum diskon yang dapat digunakan sebesar Rp <?= number_format($key->maksimum_potongan,2,',','.') ?>. Voucher diskon hanya berlaku sampai <?= tgl_indo($key->berlaku_sampai) ?> .

                   <?php }else{ ?>

                    Voucher diskon sebesar <?=$key->besar_promo?>% <?php if(!empty($key->id_umkm)) { ?> hanya untuk pembelian produk di <?=$key->nama_umkm?> <?php } ?> . Voucher diskon hanya berlaku sampai <?= tgl_indo($key->berlaku_sampai) ?> .

                  <?php } ?>
                </p>
              </div>
            </div>
          <?php } ?>
        </div>

        <!-- Left and right controls -->
        <a class="carousel-control-prev" href="#demo" data-slide="prev">
          <span class="carousel-control-prev-icon"></span>
        </a>
        <a class="carousel-control-next" href="#demo" data-slide="next">
          <span class="carousel-control-next-icon"></span>
        </a>
      </div>
    </div>
  </div>
<?php } ?>
<div class="clear"></div>

<section id="main" class="home">
  <div class="container_12">
    <div class="clear"></div>

    <?php if (!empty($banner)) { ?>
      <div id="top_button">
        <?php foreach ($banner as $key) { ?>
          <div class="grid_4">
            <?php if (!empty($key->id_umkm)) {?>
              <a href="<?=base_url()?>Konsumen/detailUmkm/<?=$key->id_umkm?>/semua" class="button_block best_price">
              <?php }else{ ?>
                <a href="#" class="button_block best_price">
              <?php } ?>
              <img src="<?=base_url()?>assets/foto_banner/<?=$key->foto_banner?>" alt="Banner 1" style="height: 100px; width: 100%" />
            </a><!-- .best_price -->
          </div><!-- .grid_4 -->
        <?php } ?>
        <div class="clear"></div>
      </div><!-- #top_button -->
    <?php } ?>
    <div class="carousel">
      <div>
        <div class="grid_10">
          <h2>Produk UMKM</h2>
        </div><!-- .grid_10 -->

        <div class="grid_2">
          <a id="next_c1" class="next arows" href="<?=base_url()?>Konsumen/Produk/semua"><span>Next</span></a>
        </div><!-- .grid_2 -->
      </div><!-- .c_header -->

      <div class="list_carousel">

        <ul id="list_product" class="list_product">
          <?php 
          if (!empty($produk)) {
            foreach ($produk as $key) {
              ?>
              <a href="<?=base_url()?>Konsumen/detailProduk/<?=$key->id_produk?>">
                <li class="">
                  <div class="grid_3 product">
                    <div class="prev">
                      <?php if (!empty($key->foto_produk)) {?>
                        <img src="<?=base_url()?>assets/foto_produk/<?=$key->foto_produk?>" style="width: 250px; height: 250px" />
                      <?php }else{ ?>
                        <img src="<?=base_url()?>assets/foto_produk/produk_default.png" style="width: 250px; height: 250px" />
                      <?php } ?>
                    </div><!-- .prev -->
                    <h3 class="title"><center><?=$key->nama_produk?></center></h3>
                    <div class="cart">
                      <div class="price" style="width: 50%">
                        <div class="vert">
                          <div class="price_new">Rp <?=number_format($key->harga_produk,2,',','.')?></div>
                        </div>
                      </div>
                      <div style="color: #2e9f9a;">
                        <span style="padding-left: 10px">Stok : <br></span>
                        <span style="padding-left: 10px"><?=$key->stok?> produk</span>
                      </div>
                    </div><!-- .cart -->
                  </div><!-- .grid_3 -->
                </li>
              </a>
              <?php 
            } 
          } 
          ?>
        </ul><!-- #list_product --> 
      </div><!-- .list_carousel -->
    </div><!-- .carousel -->

    <div class="carousel">
      <div>
        <div class="grid_10">
          <br><br><br>
          <h2>UMKM</h2>
        </div><!-- .grid_10 -->

        <div class="grid_2">
          <br><br><br>
          <a id="next_c2" class="next arows" href="<?=base_url()?>Konsumen/Umkm/semua/0"><span>Next</span></a>
        </div><!-- .grid_2 -->
      </div><!-- .c_header -->

      <div class="list_carousel">
        <ul id="list_product2" class="list_product">
          <?php
          if (!empty($umkm)) {
           foreach ($umkm as $key) {
             ?>
             <li class="">
              <div class="grid_3 product">

                <div class="prev" style="padding-bottom: 0px">
                  <a href="<?=base_url()?>Konsumen/detailUmkm/<?=$key->id_umkm?>/semua">
                    <?php if (!empty($key->foto_user)) {?>
                      <img src="<?=base_url()?>assets/foto_user/<?=$key->foto_user?>" style="width: 250px; height: 250px" />
                    <?php }else{ ?>
                      <img src="<?=base_url()?>assets/foto_umkm/store.png?>" style="width: 250px; height: 250px" />
                    <?php } ?>
                  </a>
                </div><!-- .prev -->
                <h3 class="title" style="border-bottom: none;padding-bottom: 0px"><center><?=$key->nama_umkm?></center></h3>
                <?php $jml = $this->M_konsumen->jmlProdukByUmkm($key->id_umkm)->jumlah ?>
                <center>memiliki <?=$jml?> jenis produk</center>
              </div><!-- .grid_3 -->
            </li>
            <?php 
          }
        }
        ?>
      </ul><!-- #list_product2 -->
    </div><!-- .list_carousel -->
  </div><!-- .carousel -->

  <div id="content_bottom">
    <div  class="container_12">
      <div class="grid_10">
        <br><br><br>
        <h2>INFORMASI</h2>
      </div><!-- .grid_10 -->

      <div class="grid_2">
        <br><br><br>
        <a id="next_c2" class="next arows" href="<?=base_url()?>Konsumen/Informasi"><span>Next</span></a>
      </div><!-- .grid_2 -->

      <?php 
      if (!empty($informasi)) {
        foreach ($informasi as $key) {
          ?>
          <div class="grid_12">
            <table style="border: none;">
              <!-- <tr> -->
                <td style="width: 20%">
                  <?php if (!empty($key->gambar)) { ?>
                    <a href="<?=base_url()?>Konsumen/detailInformasi/<?=$key->id_informasi?>"><img src="<?=base_url()?>assets/foto_informasi/<?=$key->gambar?>" style="width: 190px; height: 190px;" /></a>
                  <?php }else{ ?>
                    <a href="<?=base_url()?>Konsumen/detailInformasi/<?=$key->id_informasi?>"><img src="<?=base_url()?>assets/foto_informasi/informasi.png" style="width: 190px; height: 190px" /></a>
                  <?php } ?>
                </td>
                <td style="text-align: justify;">
                  <article class="post" style="margin-left: 20px; margin-right: 20px">
                    <h2 class="title_article"><a href="<?=base_url()?>Konsumen/detailInformasi/<?=$key->id_informasi?>"><?=$key->judul_informasi?></a></h2>
                    <div class="content_article">
                      <?php if (strlen($key->isi_informasi) > 250) { ?>
                        <p><?= substr($key->isi_informasi,0,250) ?> ... </p>
                      <?php }else{ ?>
                        <p><?=$key->isi_informasi?></p>
                      <?php } ?>
                    </div><!-- .content_article -->
                    <div class="footer_article">
                      <span><span>Oleh : <a href="<?=base_url()?>Konsumen/detailUmkm/<?=$key->id_umkm?>/semua" style="text-decoration: none;"><?=$key->nama_umkm?></a></span>
                    </div>
                  </article>
                </td>
                <!-- </tr> -->
              </table>
            </div>
          </div><!-- .c_header -->
          <?php 
        }
      }
      ?>

      <div class="clear"></div>
    </div><!-- #content_bottom -->
    <div class="clear"></div>

  </div><!-- .container_12 -->
</section><!-- #main -->

<div class="clear"></div>
