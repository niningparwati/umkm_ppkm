<body>
  <div class="container_12">
    <div id="top">
      <div class="grid_3 ">
        <div class="phone_top">
          <!-- <span>Call Us +777 (100) 1234</span> -->
        </div><!-- .phone_top -->
      </div><!-- .grid_3 -->

      <div class="grid_6">
        <div class="welcome">
     <!--      Welcome visitor you can <a href="<?=base_url()?>Konsumen/index">login</a> or <a href="<?=base_url()?>Konsumen/Register">create an account</a>. -->
        </div><!-- .welcome -->
      </div><!-- .grid_6 -->

      <div class="grid_3">
        <div class="valuta">
          <!-- <ul>
            <li class="curent"><a href="#">$</a></li>
            <li><a href="#">&#8364;</a></li>
            <li><a href="#">&#163;</a></li>
          </ul> -->
        </div><!-- .valuta -->

        <div class="lang">
          <!-- <ul>
            <li class="curent"><a href="#">EN</a></li>
            <li><a href="#">FR</a></li>
            <li><a href="#">GM</a></li>
          </ul> -->
        </div><!-- .lang -->
      </div><!-- .grid_3 -->
    </div><!-- #top -->

    <div class="clear"></div>

    <header id="branding">
      <div class="grid_3">
        <hgroup>
          <h1 id="site_logo" ><a href="/" title=""><img src="<?=base_url()?>assets/konsumen/images/logo.png" alt="Online Store Theme Logo"/></a></h1>
          <h2 id="site_description">Online Store Theme</h2>
        </hgroup>
      </div><!-- .grid_3 -->

      <div class="grid_3">
        <form class="search">
          <!-- <input type="text" name="search" class="entry_form" value="" placeholder="Search entire store here..."/> -->
          <?php if ($this->session->userdata('id_konsumen')) { ?>
            <center><h3><?= $this->session->userdata('nama_konsumen'); ?></h3></center>
          <?php } ?>
        </form>
      </div><!-- .grid_3 -->

      <div class="grid_6">
        <ul id="cart_nav">
        </ul>

        <nav class="private">
          <ul>

            <?php if ($this->session->userdata('id_konsumen')) {?>
              <li><a href="<?=base_url()?>Konsumen/Profil">Profil</a></li>
              <li class="separator">|</li>
              <li  class="<?php echo ($this->uri->segment(1) == 'Konsumen' AND $this->uri->segment(2) == 'Informasi') ? 'curent' : ''; ?>"><a href="<?=base_url()?>Konsumen/Keranjang">Keranjang</a></li>
              <li class="separator">|</li>
              <li><a href="<?=base_url()?>Konsumen/Pesanan">Pesanan</a></li>
              <li class="separator">|</li>
              <li><a href="<?=base_url()?>Konsumen/Logout">Log Out</a></li>
            <?php } ?>
            <?php if (!$this->session->userdata('id_konsumen')) {?>
              <li><a href="<?=base_url()?>Konsumen/index">Masuk</a></li>
              <li class="separator">|</li>
              <li><a href="<?=base_url()?>Konsumen/Register">Daftar</a></li>
            <?php } ?>
          </ul>
        </nav><!-- .private -->
      </div><!-- .grid_6 -->
    </header><!-- #branding -->
  </div><!-- .container_12 -->

  <div class="clear"></div>

  <div id="block_nav_primary">
    <div class="container_12">
      <div class="grid_12">
        <nav class="primary">
          <a class="menu-select" href="#">Catalog</a>
          <ul>
            <li class="<?php echo ($this->uri->segment(1) == 'Konsumen' AND $this->uri->segment(2) == 'Home') ? 'curent' : ''; ?>"><a href="<?=base_url()?>Konsumen/Home">Beranda</a></li>
            <li class="<?php echo ($this->uri->segment(1) == 'Konsumen' AND $this->uri->segment(2) == 'Umkm' AND $this->uri->segment(3) == 'semua') ? 'curent' : ''; ?>"><a href="<?=base_url()?>Konsumen/Umkm/semua/0">UMKM</a></li>
            <li  class="<?php echo ($this->uri->segment(1) == 'Konsumen' AND $this->uri->segment(2) == 'Produk' AND $this->uri->segment(3) == 'semua') ? 'curent' : ''; ?>"><a href="<?=base_url()?>Konsumen/Produk/semua">Produk</a></li>
            <li  class="<?php echo ($this->uri->segment(1) == 'Konsumen' AND $this->uri->segment(2) == 'Informasi') ? 'curent' : ''; ?>"><a href="<?=base_url()?>Konsumen/Informasi">Informasi UMKM</a></li>
            <!-- <li><a href="<?=base_url()?>Konsumen/About">Tentang Kami</a></li> -->
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