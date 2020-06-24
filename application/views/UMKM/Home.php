<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small> <?= $nama ?></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
          <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3><?= $jumlahMenungguDikirim->jumlahpengiriman ?></h3>

              <p>MENUNGGU PENGIRIMAN</p>
            </div>
            <div class="icon">
              <i class="fa fa-clock-o"></i>
            </div>
           
          </div>
        </div>

         <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3><?= $jumlahDikirim->jumlahdikirim?></h3>

              <p>TRANSAKSI DIKIRIM</p>
            </div>
            <div class="icon">
              <i class="fa fa-truck"></i>
            </div>
           
          </div>
        </div>

          <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3><?= $jumlahSelesai->jumlahselesai?></h3>

              <p>TRANSAKSI SELESAI</p>
            </div>
            <div class="icon">
              <i class="fa fa-dropbox"></i>
            </div>
           
          </div>
        </div>

        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3><?= $jumlahProduk->jumlahproduk ?></h3>

              <p>PRODUK UMKM</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
           
          </div>
        </div>
       
        <!-- ./col -->
      </div>
      <!-- /.row -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  

  
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->


</body>
</html>
