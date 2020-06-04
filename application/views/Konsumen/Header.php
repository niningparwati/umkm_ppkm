<!DOCTYPE HTML>
<body>
  <div class="container_12">
    <div id="top">
      <div class="grid_3">
        <div class="phone_top">
          <span>Call Us +777 (100) 1234</span>
        </div><!-- .phone_top -->
      </div><!-- .grid_3 -->

      <div class="grid_6">
        <div class="welcome" style="text-align: center;">
          Kamu dapat berbelanja produk UMKM sepuasnya!
        </div><!-- .welcome -->
      </div><!-- .grid_6 -->

      <div class="grid_3">
      </div><!-- .grid_3 -->
    </div><!-- #top -->

    <div class="clear"></div>

    <header id="branding">
      <div class="grid_3">
        <hgroup>
          <h1 id="site_logo"><a href="/" title=""><img src="<?=base_url()?>assets/konsumen/images/logo.png" alt="Online Store Theme Logo"/></a></h1>
          <h2 id="site_description">Online Store Theme</h2>
        </hgroup>
      </div><!-- .grid_3 -->
      
      <div class="grid_4" style="width: 300px"><br>
        <?php if ($this->session->userdata('id_konsumen')) { ?>
          <h2 id="site_description" style="font-size: 30px"><?= $this->session->userdata('nama_konsumen'); ?></h2>
        <?php }else{ ?>
          <form class="search">
            <input type="text" name="search" class="entry_form" value="" placeholder="Search entire store here..." hidden /> 
          </form>
        <?php } ?>
      </div><!-- .grid_3 -->

      <div class="grid_5">
        <?php if ($this->session->userdata('id_konsumen')) {?>
          <ul id="cart_nav">
            <li>
              <a class="cart_li" href="#" style="width: 80px">Keranjang</a>
              <ul class="cart_cont">
                <li class="no_border"><p>Produk yang disimpan</p></li>

                <?php 
                $id = $this->session->userdata('id_konsumen');
                $produk = $this->M_konsumen->keranjangByKonsumen($id);
                if (!is_null($produk)) {  // jika terdapat produk di keranjang
                  foreach ($produk as $key) { ?>
                    <form class="check_opt">
                      <li>
                        <div class="cont_cart" style="width: 25px; margin-top: 20px">
                          <input type="checkbox" name="" id="undefined" value="" tabindex="0">
                        </div>
                        <a href="<?=base_url()?>Konsumen/detailProduk/<?=$key->id_produk?>" class="prev_cart" style="width: 20%"><div class="cart_vert"><img src="<?=base_url()?>assets/foto_produk/<?=$key->foto_produk?>" alt="" title="" /></div></a>
                        <div class="cont_cart" style="width: 52%">
                          <h4><a href="<?=base_url()?>Konsumen/detailProduk/<?=$key->id_produk?>"><?=$key->nama_produk?></a></h4>
                          <div class="price"><?=$key->jumlah_barang?> x Rp <?=number_format($key->harga_produk,2,',','.')?><br>
                            <a title="add" class="plus" href="#"></a>
                          </div>
                        </div>
                        <!-- <a title="check" class="check" href="#"></a> -->
                        <a title="close" class="close" href="#"></a>
                        <div class="clear"></div>
                      </li>
                    </form>
                    <?php 
                  } }else{  ?>// jika tidak terdapat produk di keranjang
                  Belum ada produk yang ditambahkan
                <?php } ?>

                <li class="no_border">
                  <a href="/shopping_cart.html" class="view_cart">View shopping cart</a>
                  <a href="<?=base_url()?>Konsumen/Keranjang/<?=$this->session->userdata('id_konsumen');?>" class="checkout">Procced to Checkout</a>
                </li>
              </ul>
            </li>
          </ul>
        <?php } ?>

        <nav class="private">
          <?php if ($this->session->userdata('id_konsumen')) { ?>
            <ul>
              <li><a href="#">My Account</a></li>
              <li class="separator">|</li>
              <li><a href="<?=base_url()?>Konsumen/Logout">Logout</a></li>
            </ul>
          <?php }else{ ?>
            <ul>
              <li><a href="<?=base_url()?>Konsumen/index">Log In</a></li>
              <li class="separator">|</li>
              <li><a href="<?=base_url()?>Konsumen/Register">Sign Up</a></li>
            </ul>
          <?php } ?>
        </nav><!-- .private -->        
      </div><!-- .grid_6 -->
    </header><!-- #branding -->
  </div><!-- .container_12 -->

  <div class="clear"></div>

  <div id="block_nav_primary">
    <div class="container_12">
      <div class="grid_12">
        <nav class="primary">
          <ul>
            <li><a href="<?=base_url()?>Konsumen/Home">Home</a></li>
            <li><a href="<?=base_url()?>Konsumen/Umkm/semua">UMKM</a></li>
            <li><a href="<?=base_url()?>Konsumen/Produk/semua">Produk</a></li>
            <li><a href="<?=base_url()?>Konsumen/Informasi">Informasi UMKM</a></li>
            <li><a href="<?=base_url()?>Konsumen/About">Tentang Kami</a></li>
          </ul>
        </nav><!-- .primary -->
      </div><!-- .grid_12 -->
    </div><!-- .container_12 -->
  </div><!-- .block_nav_primary -->

  <!--Sweet Alert -->
  <?php if($this->session->flashdata('success')) { ?>
    <div class="success-flash" data-success="<?= $this->session->flashdata('success') ?>"></div>
  <?php } else if ($this->session->flashdata('error')) { ?>
    <div class="error-flash" data-error="<?= $this->session->flashdata('error') ?>"></div>
  <?php }else if ($this->session->flashdata('warning')) {?>
    <div class="warning-flash" data-warning="<?= $this->session->flashdata('warning') ?>"></div>
  <?php } ?>
<!-- End Sweet Alert -->