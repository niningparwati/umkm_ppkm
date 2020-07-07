<body class="hold-transition login-page">
  <div class="login-box">
    <div class="login-logo">
      <a href="#"><b>UMKM </b>Katalog</a>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
      <p class="login-box-msg">Login Sebagai UMKM atau Paguyuban</p>
      <?= $this->session->flashdata('notif')?>
      <form action="<?= $action ?>" method="post">
       <!--  <div class="form-group">
          <label>Login sebagai</label>
          <select class="form-control" name="level">
            <option value="UMKM">UMKM</option>
            <option value="Paguyuban">Paguyuban</option>
            <option value="Admin">Admin</option>
          </select>
        </div> -->
        <div class="form-group has-feedback">
          <input type="text" name="username" class="form-control" placeholder="Username" required oninvalid="this.setCustomValidity('Username belum diisi')" oninput="setCustomValidity('')">
          <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        </div>
        <div class="form-group has-feedback">
          <input type="password" name="password" class="form-control" placeholder="Password" required oninvalid="this.setCustomValidity('Passoword belum diisi')" oninput="setCustomValidity('')">
          <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        </div>
        <div class="row">
          <!-- /.col -->
          <div class="col-xs-12">
            <button type="submit" name="submit" class="btn btn-primary btn-block btn-flat">Login</button>
          </div>
          <!-- /.col -->
        </div>
      </form>


      <center>
        Belum Punya akun? <a href="<?= base_url()?>Register" class="text-center">Daftar</a>
      </center>

    </div>
    <!-- /.login-box-body -->
  </div>
  <!-- /.login-box -->

  <!-- jQuery 3 -->
  <script src="<?php echo base_url() ?>asset/bower_components/jquery/dist/jquery.min.js"></script>
  <!-- Bootstrap 3.3.7 -->
  <script src="<?php echo base_url() ?>asset/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
  <!-- iCheck -->
  <script src="<?php echo base_url() ?>asset/plugins/iCheck/icheck.min.js"></script>
  <script>
    $(function () {
      $('input').iCheck({
        checkboxClass: 'icheckbox_square-blue',
        radioClass: 'iradio_square-blue',
        increaseArea: '20%' /* optional */
      });
    });
  </script>
</body>
</html>
