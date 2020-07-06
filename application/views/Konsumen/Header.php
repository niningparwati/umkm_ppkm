<body>
  <div class="container_12">
    <div id="top">
    </div><!-- #top -->
    <div class="clear"></div>
    <header id="branding">
      <div class="grid_3">
        <hgroup>
          <h1 id="site_logo"><a href="<?=base_url()?>Konsumen/Home" title=""><img src="<?=base_url()?>assets/konsumen/ppkm/PPKMmart.png" style="width: 150px" /></a></h1>
        </hgroup>
      </div><!-- .grid_3 -->

      <div class="grid_5">
        <center>
        <form class="search" style="margin-top:30px;" method="get" action="<?=base_url()?>Konsumen/Home">
          <div class="input-group">
            <input type="text" name="search" value="<?= (isset($_GET['search']))?$_GET['search']:'' ?>" placeholder="Search entire store here...." style="width:80%"/>
            <div class="input-group-btn">
              <button class="btn btn-primary" type="submit">
                <i class="fa fa-search" aria-hidden="true"></i>
              </button>
            </div>
          </div>
        </form>
        </center>
      </div><!-- .grid_3 -->

      <!-- <div class="grid_2">
        <form class="search">


        </form>
      </div> -->

      <div class="grid_4">
        <nav class="private">
          <?php if ($this->session->userdata('id_konsumen')) { ?>
            <p style="padding-right: 10px">
              Selamat datang, <span style="font-size: 20px;"><?= $this->session->userdata('nama_konsumen'); ?></span>
            </p>
          <?php } ?>
          <ul>
            <?php if ($this->session->userdata('id_konsumen')) {?>
              <li><a href="<?=base_url()?>Konsumen/Profil">Profil</a></li>
              <li class="separator">|</li>
              <li  class="<?php echo ($this->uri->segment(1) == 'Konsumen' AND $this->uri->segment(2) == 'Informasi') ? 'curent' : ''; ?>"><a href="<?=base_url()?>Konsumen/Keranjang">Keranjang</a></li>
              <li class="separator">|</li>
              <li><a href="<?=base_url()?>Konsumen/Pesanan">Pesanan</a></li>
              <li class="separator">|</li>
              <li><a href="#" onclick="logoutConfirm()">Log Out</a></li>
            <?php } ?>
            <?php if (!$this->session->userdata('id_konsumen')) {?>
              <li><a href="<?=base_url()?>Konsumen/index">Masuk</a></li>
              <li class="separator">|</li>
              <li><a href="<?=base_url()?>Konsumen/Register">Daftar</a></li>
            <?php } ?>
          </ul>
        </nav><!-- .private -->
      </div><!-- .grid_6 -->

      <div class="clear"></div>
    </header><!-- #branding -->
  </div><!-- .container_12 -->

  <div class="clear"></div>

  <div id="block_nav_primary">
    <div class="container_12">
      <div class="grid_12">
        <nav class="primary">
          <a class="menu-select" href="#">Catalog</a>
          <ul>
            <li class="<?php echo ( ($this->uri->segment(1) == 'Konsumen' AND $this->uri->segment(2) == 'Home') OR ($this->uri->segment(1) == 'Konsumen' AND $this->uri->segment(2) == 'detailPromo') ) ? 'curent' : ''; ?>"><a href="<?=base_url()?>Konsumen/Home">Beranda</a></li>
            <li class="<?php echo ( ($this->uri->segment(1) == 'Konsumen' AND $this->uri->segment(2) == 'Umkm' AND $this->uri->segment(3) == 'semua') OR ($this->uri->segment(1) == 'Konsumen' AND $this->uri->segment(2) == 'detailUmkm') ) ? 'curent' : ''; ?>"><a href="<?=base_url()?>Konsumen/Umkm/semua/0">UMKM</a></li>
            <li  class="<?php echo ( ($this->uri->segment(1) == 'Konsumen' AND $this->uri->segment(2) == 'Produk' AND $this->uri->segment(3) == 'semua') OR ($this->uri->segment(1) == 'Konsumen' AND $this->uri->segment(2) == 'detailProduk') ) ? 'curent' : ''; ?>"><a href="<?=base_url()?>Konsumen/Produk/semua">Produk</a></li>
            <li  class="<?php echo ( ($this->uri->segment(1) == 'Konsumen' AND $this->uri->segment(2) == 'Informasi') OR ($this->uri->segment(1) == 'Konsumen' AND $this->uri->segment(2) == 'detailInformasi') ) ? 'curent' : ''; ?>"><a href="<?=base_url()?>Konsumen/Informasi">Informasi UMKM</a></li>
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

<script type="text/javascript">

  function logoutConfirm() {
    Swal.fire({
      title: 'Attention!',
      text: "Are you sure want to log out?",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Logout!'
    }).then((result) => {
      if (result.value) {
        location.href = '<?=base_url()?>Konsumen/Logout'
      }
    })
  }
</script>
