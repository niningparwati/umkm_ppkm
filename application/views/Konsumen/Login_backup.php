<!--Sweet Alert -->
<?php if($this->session->flashdata('success')) { ?>
  <div class="success-flash" data-success="<?= $this->session->flashdata('success') ?>"></div>
<?php } else if ($this->session->flashdata('error')) { ?>
  <div class="error-flash" data-error="<?= $this->session->flashdata('error') ?>"></div>
<?php }else if ($this->session->flashdata('warning')) {?>
  <div class="warning-flash" data-warning="<?= $this->session->flashdata('warning') ?>"></div>
<?php } ?>
<!-- End Sweet Alert -->

<div class="clear"></div>

<section id="main" class="login entire_width">
  <div class="container_12">      
    <div id="content">
      <div class="grid_12">
        <h1 class="page_title">Masuk atau Daftar Akun</h1>
      </div><!-- .grid_12 -->

      <div class="grid_6 new_customers">
        <h2>Registrasi Akun</h2>
        <p>Jika Anda belum mempunyai akun, silahkan lakukan pendaftaran akun! <br>Dengan membuat sebuah akun pada aplikasi ini, akan mempermudah Anda dalam melakukan transaksi pembelian produk-produk UMKM dengan proses yang cepat.</p>
        <div class="clear"></div>
        <a href="<?=base_url()?>Konsumen/Register"><button class="account">Daftar Akun</button></a>
      </div><!-- .grid_6 -->

      <div class="grid_6">
        <form class="registed">
          <h2>Masuk</h2>

          <p>Jika sudah mempunyai akun, silahkan masuk dengan username dan password yang sudah terdaftar!</p>

          <div class="username">
            <strong>Username:</strong><sup class="surely">*</sup><br/>
            <input type="text" name="username"/>
          </div><!-- .email -->

          <div class="password">
            <strong>Password:</strong><sup class="surely">*</sup><br/>
            <input type="password" name="password" style="height: 33px; width: 255px; padding: 0 10px; border: 1px solid #ccc; color: #777; border-radius: 2px" class="form-control"/>
            <a class="forgot" href="#">Forgot Your Password?</a>
          </div><!-- .password -->

          <div class="remember">
            <input class="niceCheck" type="checkbox" name="Remember_password" />
            <span class="rem">Remember password</span>
          </div><!-- .remember -->

          <div class="submit">										
            <input type="submit" value="Masuk" />
          </div><!-- .submit -->
        </form><!-- .registed -->
      </div><!-- .grid_6 -->
    </div><!-- #content -->

    <div class="clear"></div>
  </div><!-- .container_12 -->
</section><!-- #main -->

<div class="clear"></div>