<!--Sweet Alert -->
<?php if($this->session->flashdata('success_daftar')) { ?>
  <div class="success-flash" data-success="<?= $this->session->flashdata('success_daftar') ?>"></div>
<?php } else if ($this->session->flashdata('error_daftar')) { ?>
  <div class="error-flash" data-error="<?= $this->session->flashdata('error_daftar') ?>"></div>
<?php }else if ($this->session->flashdata('warning_daftar')) {?>
  <div class="warning-flash" data-warning="<?= $this->session->flashdata('warning_daftar') ?>"></div>
<?php } ?>
<!-- End Sweet Alert -->

<div class="clear"></div>
<section id="main" class="login entire_width">
  <div class="container_12">      
    <div id="content">
      <div class="grid_12">
        <h1 class="page_title" style="text-align: center;">Registrasi Akun</h1>
      </div><!-- .grid_12 -->

      <!-- <div class="grid_12"> -->
        <form class="registed" style="border: none;" method="POST" action="<?=base_url()?>Konsumen/prosesRegister">
          <div class="grid_12" style="margin-left: 20px">
            <div class="grid_6" style="margin: 0px">
              <div class="nama_lengkap">
                <strong>Nama Lengkap :</strong><br/>
                <input type="text" name="nama_konsumen" style="width: 90%" required/>
              </div>
              <div class="email">
                <strong>Email :</strong><br/>
                <input type="email" name="email" style="width: 90%" required />
              </div>
              <div class="no_telp">
                <strong>Nomor Telp :</strong><br/>
                <input type="text" name="no_telp" style="width: 90%" onkeyup="angka(this);" required />
              </div>
            </div>
            <div class="grid_6" style="margin: 0px">
              <div class="username">
                <strong>Username :</strong><br/>
                <input type="text" name="username" style="width: 90%" required />
              </div>
              <div class="password">
                <strong>Password :</strong><br/>
                <input type="password" name="password1" id="pw1" required style="height: 33px; width: 90%; padding: 0 10px; border: 1px solid #ccc; color: #777; border-radius: 2px" class="form-control"/>
              </div><br>
              <div class="password">
                <strong>Konfirmasi Password :</strong><br/>
                <input type="password" name="password2" id="pw2" required style="height: 33px; width: 90%; padding: 0 10px; border: 1px solid #ccc; color: #777; border-radius: 2px" class="form-control"/>
              </div>
            </div>
          </div>
          <div class="grid_12">
            <br>
            <div class="remember" style="padding-left: 10px">
              <input type="checkbox" name="check" required />
              <span class="rem">Saya menyetujui <a data-dynamic="true" href="#" onclick="showModalSK()">Syarat & Ketentuan</a></span>
            </div>
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

  function showModalSK() {
    Swal.fire(
      'Syarat dan Ketentuan?',
      'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis quis ultricies purus, at vehicula neque. Cras vestibulum velit et finibus dictum. Mauris laoreet tincidunt tellus nec sodales. Nulla facilisi. Donec fermentum rhoncus molestie. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Cras varius sapien nisl, eu feugiat lacus auctor ac. Sed pellentesque efficitur leo, eget semper sapien feugiat molestie. Vestibulum in accumsan leo. Vivamus molestie libero elit, ut posuere leo vestibulum a. Cras imperdiet hendrerit nibh, non posuere augue rhoncus luctus. Nulla facilisi. Fusce euismod porta diam. Vivamus laoreet tempus nisi, a egestas mi rhoncus ut.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis quis ultricies purus, at vehicula neque. Cras vestibulum velit et finibus dictum. Mauris laoreet tincidunt tellus nec sodales. Nulla facilisi. Donec fermentum rhoncus molestie. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Cras varius sapien nisl, eu feugiat lacus auctor ac. Sed pellentesque efficitur leo, eget semper sapien feugiat molestie. Vestibulum in accumsan leo. Vivamus molestie libero elit, ut posuere leo vestibulum a. Cras imperdiet hendrerit nibh, non posuere augue rhoncus luctus. Nulla facilisi. Fusce euismod porta diam. Vivamus laoreet tempus nisi, a egestas mi rhoncus ut.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis quis ultricies purus, at vehicula neque. Cras vestibulum velit et finibus dictum. Mauris laoreet tincidunt tellus nec sodales. Nulla facilisi. Donec fermentum rhoncus molestie. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Cras varius sapien nisl, eu feugiat lacus auctor ac. Sed pellentesque efficitur leo, eget semper sapien feugiat molestie. Vestibulum in accumsan leo. Vivamus molestie libero elit, ut posuere leo vestibulum a. Cras imperdiet hendrerit nibh, non posuere augue rhoncus luctus. Nulla facilisi. Fusce euismod porta diam. Vivamus laoreet tempus nisi, a egestas mi rhoncus ut.',
      'info'
      )
  }
</script>