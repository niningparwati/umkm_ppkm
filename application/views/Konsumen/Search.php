  <div class="clear"></div>

  <section id="main" class="home">
    <div class="container_12">
      <div class="clear"></div>

      <h3>Hasil Pencarian dari <mark>'<?= $_GET['search'] ?>'</mark> :</h3>
      <hr>

        <div class="carousel">
          <div>
            <div class="grid_10">
              <h2>Produk UMKM</h2>
            </div><!-- .grid_10 -->

            <div class="grid_2">
              <!-- <a id="next_c1" class="next arows" href="<?=base_url()?>Konsumen/Produk/semua"><span>Next</span></a> -->
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
              }else {
              ?>
                <li style="height:auto;"><p>Hasil pencarian tidak ditemukan</p></li>
              <?php
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
              <!-- <a id="next_c2" class="next arows" href="<?=base_url()?>Konsumen/Umkm/semua/0"><span>Next</span></a> -->
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
            }else {
              ?>
              <li style="height:auto;"><p>Hasil pencarian tidak ditemukan</p></li>
              <?php
            }
            ?>
          </ul><!-- #list_product2 -->
        </div><!-- .list_carousel -->
      </div><!-- .carousel -->
        <div class="clear"></div>

      </div><!-- .container_12 -->
    </section><!-- #main -->

    <div class="clear"></div>
