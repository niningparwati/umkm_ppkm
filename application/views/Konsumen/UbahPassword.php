<!--Sweet Alert -->
<?php if($this->session->flashdata('success_pass')) { ?>
  <div class="success-flash" data-success="<?= $this->session->flashdata('success_pass') ?>"></div>
<?php } else if ($this->session->flashdata('error_pass')) { ?>
  <div class="error-flash" data-error="<?= $this->session->flashdata('error_pass') ?>"></div>
<?php }else if ($this->session->flashdata('warning_pass')) {?>
  <div class="warning-flash" data-warning="<?= $this->session->flashdata('warning_pass') ?>"></div>
<?php } ?>
<!-- End Sweet Alert -->

<div class="clear"></div>
<section id="main" class="login entire_width">
  <div class="container_12">      
    <div id="content">
      <div class="grid_12">
        <h3 class="page_title" style="text-align: center;">Ubah Password</h3>
      </div><!-- .grid_12 -->

      <!-- <div class="grid_12"> -->
        <form class="registed" style="border: none;" method="POST" action="<?=base_url()?>Konsumen/ProsesUbahPassword">
          <div class="grid_12" style="margin-left: 20px">
            <div class="grid_6" style="margin: 0px">
              <div class="nama_lengkap">
                <strong>Username :</strong><br/>
                <input type="text" name="username" style="width: 90%" required/>
              </div>
              <div class="email">
                <strong>Email :</strong><br/>
                <input type="email" name="email" style="width: 90%" required />
              </div>
            </div>
            <div class="grid_6" style="margin: 0px">
              <div class="password">
                <strong>Password Baru:</strong><br/>
                <input type="password" name="password1" id="pw1" required style="height: 33px; width: 90%; padding: 0 10px; border: 1px solid #ccc; color: #777; border-radius: 2px" class="form-control"/>
              </div><br>
              <div class="password">
                <strong>Konfirmasi Password Baru:</strong><br/>
                <input type="password" name="password2" id="pw2" required style="height: 33px; width: 90%; padding: 0 10px; border: 1px solid #ccc; color: #777; border-radius: 2px" class="form-control"/>
              </div>
            </div>
          </div>
          <div class="grid_12">
            <br>
            <div class="submit" style="padding-left: 42%; padding-right: 42%">                    
              <input type="submit" name="submit" value="Daftar" />
            </div>
            <br>
          </div>
        </form>



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