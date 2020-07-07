<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->

      <section class="content">
        <div class="row">
          <div class="col-xs-12">
            <div class="box">
              <div class="box-header">
                <h3 class="box-title">Data Transaksi Selesai</h3><br><br>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                <?= $this->session->flashdata('notif')?>
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th style="text-align: center; width: 5%">No.</th>
                      <th style="text-align: center; width: 15%">Tgl Transaksi</th>
                      <th style="text-align: center; width: 15%">Konsumen</th>
                      <th style="text-align: center; width: 15%">Total Bayar</th>
                      <th style="text-align: center; width: 10%">Status Transaksi</th>
                      <th style="text-align: center; width: 10%">Status Pengiriman</th>
                      <th style="text-align: center; width: 17%">Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                    $no = 1;
                    foreach ($transaksi as $value) {?>
                      <tr>
                        <td style="text-align: center;"><?= $no++ ?></td>
                        <td><?= $value->tanggal_transaksi ?></td>
                        <td><?= $value->nama_konsumen ?></td>
                        <td style="text-align: center;">Rp <?= number_format($value->total) ?></td>
                        <td><b><?= $value->status ?></b></td>
                        <td style="text-align: center;">
                          <center>
                           
                             <?php
                              if ($value->status_pengiriman=="belum_dikirim") {
                                ?>
                                   <small class="label bg-red"><?php echo $value->status_pengiriman; ?></small>
                            <?php }else{ ?>
                                  <small class="label bg-green"><?php echo $value->status_pengiriman; ?></small>
                            <?php } ?>
                          </center>
                           
                        </td>
                        <td>
                          <center>

                    <a href="<?php echo base_url(); ?>UMKM/detail_transaksi/<?php echo $value->id_transaksi ?>/<?php echo $value->id_pengiriman ?>/<?php echo $back ?>" class="btn btn-sm btn-primary">Detail</a>

                   
                  </center>
                        </td>
                    </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
</div>
<!-- /.content-wrapper -->

  <!-- Add the sidebar's background. This div must be placed
   immediately after the control sidebar -->
   <div class="control-sidebar-bg"></div>
 </div>
 <!-- ./wrapper -->

</body>
</html>