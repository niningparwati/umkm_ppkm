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
        <h1 class="page_title" style="text-align: center;">Registrasi Akun</h1>
      </div><!-- .grid_12 -->

      <div class="grid_12">
        <form class="registed" style="border: none;" method="POST" action="<?=base_url()?>Konsumen/prosesRegister">
          <div class="grid_5" style="padding-left: 25px">
            <div class="nama_lengkap">
              <strong>Nama Lengkap :</strong><sup class="surely">*</sup><br/>
              <input type="text" name="nama_konsumen" style="width: 100%" required/>
            </div>
            <div class="email">
              <strong>Email :</strong><sup class="surely">*</sup><br/>
              <input type="email" name="email" style="width: 100%" required />
            </div>
            <div class="no_telp">
              <strong>Nomor Telp :</strong><sup class="surely">*</sup><br/>
              <input type="text" name="no_telp" style="width: 100%" onkeyup="angka(this);" required />
            </div>
          </div>
          <div class="grid_5" style="padding-left: 25px">
            <div class="username">
              <strong>Username :</strong><sup class="surely">*</sup><br/>
              <input type="text" name="username" style="width: 100%" required />
            </div>
            <div class="password">
              <strong>Password :</strong><sup class="surely">*</sup><br/>
              <input type="password" name="password1" id="pw1" required style="height: 33px; width: 100%; padding: 0 10px; border: 1px solid #ccc; color: #777; border-radius: 2px" class="form-control"/>
            </div><br>
            <div class="password">
              <strong>Konfirmasi Password :</strong><sup class="surely">*</sup><br/>
              <input type="password" name="password2" id="pw2" required style="height: 33px; width: 100%; padding: 0 10px; border: 1px solid #ccc; color: #777; border-radius: 2px" class="form-control"/>
            </div>
          </div>
          <div class="grid_12">
            <br>
            <div class="remember" style="padding-left: 25px">
              <input type="checkbox" name="check" required />
              <span class="rem">Saya menyetujui <a href="#">Syarat & Ketentuan</a></span>
            </div>
            <div class="submit" style="padding-left: 40%">                    
              <input type="submit" name="submit" value="Daftar" />
            </div>
            <br>
          </div>
        </form>
      </div><!-- .grid_6 -->
    </div><!-- #content -->

    <div class="clear"></div>
  </div><!-- .container_12 -->

</div><!-- #content -->

<div class="clear"></div>
</div><!-- .container_12 -->

</section><!-- #main -->

<div class="clear"></div>

<script type="text/javascript">
  window.onload = function(){
    document.getElementById("pw1").onchange = validatePassword;
    document.getElementById("pw2").onchange = validatePassword;
  }

  function validatePassword(){
    var pass1 = document.getElementById("pw1").value;
    var pass2 = document.getElementById("pw2").value;
    if (pass1 != pass2) {
      document.getElementById("pw2").setCustomValidity("Password Tidak Sama, Coba Lagi");
    }else{
      document.getElementById("pw2").setCustomValidity('');
    }
  }

  function angka(e) {
    if (!/^[0-9]+$/.test(e.value)) {
      e.value = e.value.substring(0,e.value.length-1);
    }
  }
</script>