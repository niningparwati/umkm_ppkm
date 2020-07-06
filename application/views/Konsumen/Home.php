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
                <a href="<?=base_url()?>Konsumen/detailPromo/<?=$key->id_promo?>">
                  <img src="<?=base_url()?>assets/foto_promo/<?=$key->foto_promo?>" alt="Gambar - <?=$no++?>" width="1000" height="300">
                  <div class="carousel-caption">
                    <h3><?=$key->nama_promo?></h3>
                    <h2><span style="background: white"></span></h2>
                    <span style="color: black; background: white">
                      Kode Voucher : <b style="font-size: 18px"><?=$key->kode_promo?></b><br>
                    </span>
                  </div>
                </a>
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
                  <?php if (!empty($key->foto_banner)) { ?>
                    <img src="<?=base_url()?>assets/foto_banner/<?=$key->foto_banner?>" alt="Banner 1" style="height: 100px; width: 100%" />
                  <?php }else{ ?>
                    <img src="<?=base_url()?>assets/foto_produk/produk_default.png" alt="Banner 1" style="height: 100px; width: 100%" />
                  <?php } ?>
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
                        <h3 class="title"><center>
                          <?= substr($key->nama_produk, 0, 20) ?><?php if (strlen($key->nama_produk) > 20) { echo "..."; } ?>
                        </center></h3>
                        <div class="cart">
                          <div class="price" style="width: 50%">
                            <div class="vert">
                              <div class="price_new">Rp <?=number_format($key->harga_produk,0,',','.')?></div>
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

      <div class="clear"></div>
      <?php if (!empty($slide)) {?>
        <div class="container_12">
          <div class="grid_12">
            <br><br>
            <div id="demo1" class="carousel slide" data-ride="carousel">

              <!-- Indicators -->
              <ul class="carousel-indicators">
                <?php 
                $no=0;
                foreach ($slide as $key) {
                  ?>
                  <li data-target="#demo1" data-slide-to="<?=$no++?>" <?php if ($no == 0) { ?> class="active" <?php } ?>></li>
                <?php } ?>
              </ul>

              <!-- The slideshow -->
              <div class="carousel-inner">
                <?php $no=1; foreach ($slide as $key) { ?>
                  <div class="carousel-item <?php if ($no == 1) { ?> active  <?php } ?>" >
                    <a href="<?=$key->url?>">
                      <?php if (!empty($key->gambar)) {?>
                        <img src="<?=base_url()?>assets/gambar_slide/<?=$key->gambar?>" alt="Gambar - <?=$no++?>" width="1000" height="300">
                      <?php }else{ ?>
                        <img src="<?=base_url()?>assets/foto_produk/produk_default.png" alt="Gambar - <?=$no++?>" width="1000" height="300">
                      <?php } ?>
                      <div class="carousel-caption">
                        <span style="color: black; background: white; font-weight: bold; padding: 10px; font-size: 30px"><?=$key->judul?></span>
                      </div>
                    </a>
                  </div>
                <?php } ?>
              </div>

              <!-- Left and right controls -->
              <a class="carousel-control-prev" href="#demo1" data-slide="prev">
                <span class="carousel-control-prev-icon"></span>
              </a>
              <a class="carousel-control-next" href="#demo1" data-slide="next">
                <span class="carousel-control-next-icon"></span>
              </a>
            </div>
          </div>
        </div>
      <?php } ?>

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
                    <td style="width: 20%; border: none;">
                      <?php if (!empty($key->gambar)) { ?>
                        <a href="<?=base_url()?>Konsumen/detailInformasi/<?=$key->id_informasi?>"><img src="<?=base_url()?>assets/foto_informasi/<?=$key->gambar?>" style="width: 190px; height: 190px;" /></a>
                      <?php }else{ ?>
                        <a href="<?=base_url()?>Konsumen/detailInformasi/<?=$key->id_informasi?>"><img src="<?=base_url()?>assets/foto_informasi/informasi.png" style="width: 190px; height: 190px" /></a>
                      <?php } ?>
                    </td>
                    <td style="text-align: justify;border: none;">
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
