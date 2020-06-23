<body class="hold-transition login-page" style="background-image: url('<?php echo base_url()?>uploads/background2.jpg');background-repeat: no-repeat;background-attachment: fixed;background-size: cover;">
  <div class="register-box">
    <div class="register-logo">
      <a href="<?php echo base_url() ?>assets/index2.html"><b>UMKM </b>PPKM</a>
    </div>

    <div class="register-box-body">

       <p class="login-box-msg">Daftar sebagai UMKM</p>

       <form action="<?=$action?>" method="post">
        <div class="form-group">
        </div>
        <input type="hidden" name="level" value="UMKM">
          <div class="form-group has-feedback">
            <input type="text" class="form-control" placeholder="Username" name="username" required oninvalid="this.setCustomValidity('Username belum diisi')" oninput="setCustomValidity('')" >
          </div>
          <div class="form-group has-feedback">
            <input type="password" class="form-control" placeholder="Password" name="password" required oninvalid="this.setCustomValidity('Password belum diisi')" oninput="setCustomValidity('')" >
          </div>
          <div class="form-group has-feedback">
            <input type="text" class="form-control" placeholder="Nama Lengkap" name="nama" required oninvalid="this.setCustomValidity('Nama belum diisi')" oninput="setCustomValidity('')" >
          </div>
          <div class="form-group has-feedback">
            <input type="text" class="form-control" placeholder="Nama UMKM" name="namaumkm" required oninvalid="this.setCustomValidity('Nama belum diisi')" oninput="setCustomValidity('')" >
          </div>
          <div class="form-group has-feedback">
            <input type="email" class="form-control" placeholder="Email" name="email" required oninvalid="this.setCustomValidity('Email belum diisi')" oninput="setCustomValidity('')" >
          </div>
          <div class="form-group has-feedback">
            <textarea name="alamat" rows="3" cols="80" class="form-control" placeholder="Alamat"  required oninvalid="this.setCustomValidity('Alamat belum diisi')" oninput="setCustomValidity('')"></textarea>
          </div>
          <div class="form-group has-feedback">
            <input type="text" class="form-control" placeholder="Nomor Telp" name="nohp" required oninvalid="this.setCustomValidity('Nomor Telp belum diisi')" oninput="setCustomValidity('')" >
          </div>
          <div class="form-group has-feedback">
            <textarea name="deskripsi" rows="3" cols="80" class="form-control" placeholder="Deskripsi UMKM"  required oninvalid="this.setCustomValidity('Alamat belum diisi')" oninput="setCustomValidity('')"></textarea>
          </div>
          <div class="form-group has-feedback">
            <label for="">Kategori UMKM</label>
            <select class="form-control" name="idkategori">
              <?php foreach ($idkategori as $k) { ?>
              <option value="<?php echo $k->id_kategori_umkm ?>"><?php echo $k->nama_kategori_umkm ?></option>
            <?php } ?>
            </select>
          </div>

        <!-- /.col -->
        <div class="col-xs-12">
          <button type="submit" name="submit" class="btn btn-primary btn-block btn-flat">Register</button>
        </div><br><br>
        <center>Sudah Punya Akun? <a href="<?=base_url()?>LoginAU" class="text-center">Login</a></center>
                <center>Alternatif Register <a href="<?=base_url()?>Register/registAdmin" class="text-center">Admin</a> dan <a href="<?=base_url()?>Register/registerUMKM" class="text-center">UMKM</a></center>
        <!-- /.col -->

      </form>
  </div>
  <!-- /.form-box -->

</div>
<!-- /.register-box -->

<!-- jQuery 3 -->
<script src="<?php echo base_url() ?>assets/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo base_url() ?>assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="<?php echo base_url() ?>assets/plugins/iCheck/icheck.min.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' /* optional */
    });
  });
</script>

<script>
  $(document).ready(function() {
    $('#level').change(function(){
      const level = this.value;
      $.ajax({
        type : "POST",
        url : "<?= site_url('Register/set_level_user') ?>",
        dataType : "JSON",
        data : {level : level},
        success : function(data) {
          location.reload();
        }
      });
    })
  })
</script>
</body>
</html>
