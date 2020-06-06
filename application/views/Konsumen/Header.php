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
            <!-- <li> -->
              <a class="cart_li" href="<?=base_url()?>Konsumen/Keranjang" style="width: 80px">Keranjang</a>
            <!-- </li> -->
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