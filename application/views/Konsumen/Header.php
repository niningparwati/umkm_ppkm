<body>
  <div class="container_12">
    <div id="top">
    </div><!-- #top -->
    <div class="clear"></div>
    <header id="branding">
      <div class="grid_3">
        <hgroup>
          <h1 id="site_logo"><a href="<?=base_url()?>Konsumen/Home" title=""><img src="<?=base_url()?>assets/konsumen/ppkm/PPKMmart.png" style="width: 230px" /></a></h1>
        </hgroup>
      </div><!-- .grid_3 -->

      <div class="grid_5">
        <center>
          <form class="search" style="margin-top:30px;" method="get" action="<?=base_url()?>Konsumen/Home">
            <div class="input-group">
              <input type="text" name="search" value="<?= (isset($_GET['search']))?$_GET['search']:'' ?>" placeholder="Cari Produk atau UMKM disini..." style="width:80%"/>
              <div class="input-group-btn">
                <button class="btn btn-primary" type="submit">
                  <i class="fa fa-search" aria-hidden="true"></i>
                </button>
              </div>
            </div>
          </form>
        </center>
      </div><!-- .grid_3 -->

      <div class="grid_4">
        <nav class="private">
          <?php if ($this->session->userdata('id_konsumen')) { ?>
            <p style="padding-right: 10px; text-align: right;">
              Selamat datang, <span style="font-size: 14px; font-weight: bold;"><?= $this->session->userdata('nama_konsumen'); ?></span>
            </p>
          <?php } ?>
          <ul>
            <?php if ($this->session->userdata('id_konsumen')) {?>
              <li class="<?php echo ($this->uri->segment(1) == 'Konsumen' AND $this->uri->segment(2) == 'Profil') ? 'curent' : ''; ?>"><a href="<?=base_url()?>Konsumen/Profil">Profil</a></li>
              <li class="separator">|</li>
              <li class="<?php echo ($this->uri->segment(1) == 'Konsumen' AND $this->uri->segment(2) == 'Keranjang') ? 'curent' : ''; ?>"><a href="<?=base_url()?>Konsumen/Keranjang">Keranjang</a></li>
              <li class="separator">|</li>
              <li class="<?php echo ($this->uri->segment(1) == 'Konsumen' AND $this->uri->segment(2) == 'Pesanan') ? 'curent' : ''; ?>"><a href="<?=base_url()?>Konsumen/Pesanan">Pesanan</a></li>
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
        <br>
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

  <script type="text/javascript">
    $(function(){
        $('.primary .menu-select').toggle(function(){
          $('.primary > ul').slideDown('slow');
        	$(this).addClass('minus');
        }, function(){
          	$('.primary > ul').slideUp('slow');
          	$(this).removeClass('minus');
        });

        $('.primary .parent > a').toggle(function(){
            $(this).next('ul.sub').slideDown('slow');
          	$(this).parent('.parent').addClass('minus');}
              , function(){
          	$(this).next('ul.sub').slideUp('slow');
          	$(this).parent('.parent').removeClass('minus');
        });
    });

    function logoutConfirm() {
      Swal.fire({
        title: 'Perhatian!',
        text: "Apakah anda yakin ingin keluar?",
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
