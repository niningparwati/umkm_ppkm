<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->

      <section class="content">
        <div class="row">
          <div class="col-xs-12">
            <div class="box">
              <div class="box-header">
                <h3 class="box-title">Data Transaksi Dana Sudah Dikirim</h3><br><br>
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

                    <?php
                      if ($value->status_pengiriman=="belum_dikirim") {
                        ?>
                       
                        <a href="#" data-toggle="modal" data-target="#confirm-delete2<?php echo $value->id_transaksi ?>" class="btn btn-sm btn-danger"> <i class="fa fa-chek"></i>Kirim</a>

                        <div class="modal in" id="confirm-delete2<?php echo $value->id_transaksi ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2" aria-hidden="true">
                           <div class="modal-dialog">
                              <div class="modal-content">
                                 <div class="modal-header">
                                    Konfirmasi Pengiriman
                                 </div>
                                 <div class="modal-body">
                                  <form action="<?php echo base_url(); ?>UMKM/set_dikirim/<?php echo $value->id_pengiriman ?>/<?php echo $value->id_transaksi ?>">
                                    <div class="form-group">
                                      <label>Masukkan Nomor Resi</label>&nbsp<textarea style="font-size: 40px" class="form-control" name="resi"></textarea>
                                    </div>
                                  
                                  <b>*Pastikan Nomor Resi Sudah Benar Sebelum Mengkonfirmasi</b><br>
                                    Apakah yakin mengirim pesanan ini sekarang?
                                 </div>
                                 <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                    <a href="#" data-toggle="modal" data-target="#kirim<?php echo $value->id_transaksi ?>" class="btn btn-sm btn-success"> <i class="fa fa-chek"></i>Konfirmasi</a>
                                </div>
                              </div>
                           </div>
                        </div>
                         <div class="modal in" id="kirim<?php echo $value->id_transaksi ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                     <div class="modal-dialog">
                                        <div class="modal-content">
                                           <div class="modal-header">
                                              Konfirmasi Pengiriman Pesanan
                                           </div>
                                           <div class="modal-body">
                                              Apakah yakin mengkonfirmasi Pengiriman Pesanan Ini?
                                           </div>
                                           <div class="modal-footer">
                                              <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                              <button type="submit" class="btn btn-success">KONFIRMASI</button>
                                              </div>
                                        </div>
                                     </div>
                          </div>
                          </form>
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
                                                   Apakah yakin Anda sudah menerima dana sesuai tagihan pesanan ini?
                                                </div>
                                                <div class="modal-footer">
                                                   <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                                   <a href="<?php echo base_url() ?>UMKM/set_selesai/<?php echo $value->id_pengiriman ?>/<?php echo $value->id_transaksi ?>" class="btn btn-success btn-ok" >Set Selesai</a>
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