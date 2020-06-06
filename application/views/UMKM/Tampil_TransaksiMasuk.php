<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->

      <section class="content">
        <div class="row">
          <div class="col-xs-12">
            <div class="box">
              <div class="box-header">
                <h3 class="box-title">Data Transaksi</h3><br><br>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                <?= $this->session->flashdata('notif')?>
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th style="text-align: center; width: 5%">No.</th>
                      <th style="text-align: center; width: 15%">Tgl Transaksi</th>
                      <th style="text-align: center;">Konsumen</th>
                      <th style="text-align: center; width: 15%">Total Tagihan</th>
                      <th style="text-align: center; width: 15%">Status</th>
                      <th style="text-align: center">Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                    $no = 1;
                    foreach ($transaksi as $value) {?>
                      <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $value->tanggal_transaksi ?></td>
                        <td><?= $value->nama_konsumen ?></td>
                        <td><?= $value->total_harga ?></td>
                        <td>
                          <center>
                             <?php
                              if ($value->status=="diproses") {
                                ?>
                                   <small class="label pull-right bg-red">perlu <?php echo $value->status; ?></small>
                            <?php }elseif ($value->status=="dana dikirim"){ ?>
                                  <small class="label pull-right bg-yellow"><?php echo $value->status; ?></small>
                            <?php }else{ ?>
                                  <small class="label pull-right bg-green"><?php echo $value->status; ?></small>
                            <?php } ?>
                          </center>
                           
                        </td>
                        <td>
                          <center>

                    <a href="<?php echo base_url(); ?>UMKM/detail_transaksi/<?php echo $value->id_transaksi ?>" class="btn btn-sm btn-primary">Detail</a>

                    <?php
                      if ($value->status=="diproses") {
                        ?>
                       
                        <a href="#" data-toggle="modal" data-target="#confirm-delete2<?php echo $value->id_transaksi ?>" class="btn btn-sm btn-danger"> <i class="fa fa-chek"></i>Kirim</a>

                        <div class="modal in" id="confirm-delete2<?php echo $value->id_transaksi ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2" aria-hidden="true">
                           <div class="modal-dialog">
                              <div class="modal-content">
                                 <div class="modal-header">
                                    Konfirmasi Pengiriman
                                 </div>
                                 <div class="modal-body">
                                  <form>
                                    <div class="form-group">
                                      <label>Masukkan Nomor Resi</label>&nbsp<textarea style="font-size: 40px" class="form-control" name="resi"></textarea>
                                    </div>
                                  </form>
                                  <b>*Pastikan Nomor Resi Sudah Benar Sebelum Mengkonfirmasi</b><br>
                                    Apakah yakin mengirim pesanan ini sekarang?
                                 </div>
                                 <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                      <a href="<?php echo base_url(); ?>UMKM/set_dikirim/<?php echo $value->id_transaksi ?>" class="btn btn-sm btn-danger">Kirim Sekarang</a>
                                    </div>
                              </div>
                           </div>
                        </div>
                        <?php
                      }elseif($value->status=="dana dikirim"){
                        ?>
                       <a href="#" data-toggle="modal" data-target="#confirm-dana<?php echo $value->id_transaksi ?>" class="btn btn-sm btn-warning"> <i class="fa fa-chek"></i> Dana Diterima</a>
                                       <div class="modal in" id="confirm-dana<?php echo $value->id_transaksi ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                          <div class="modal-dialog">
                                             <div class="modal-content">
                                                <div class="modal-header">
                                                   Konfirmasi Pesanan Selesai
                                                </div>
                                                <div class="modal-body">
                                                   Apakah yakin Anda sudah menerima dana dan pesanan ini selesai?
                                                </div>
                                                <div class="modal-footer">
                                                   <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                                   <a href="<?php echo base_url() ?>UMKM/set_selesai/<?php echo $value->id_transaksi ?>" class="btn btn-success btn-ok" >Set Selesai</a>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                        <?php
                      }
                    ?>
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