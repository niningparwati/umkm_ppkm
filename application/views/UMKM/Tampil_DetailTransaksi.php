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
                <div class="tombol">
									<a href="<?php echo base_url(); ?>UMKM/<?= $back ?>/<?php echo $id_umkm ?>"><button type="submit" class="btn btn-primary"> <i class="fa fa-arrow-left"></i> Back</button></a>
								</div>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
              
								<div class="nav-tabs-custom">
									<ul class="nav nav-tabs pull-left">
										<li class="active"><a href="#tab_1-1" data-toggle="tab"><b>Detail Pesanan</b></a></li>
										<li><a href="#tab_2-2" data-toggle="tab"><b>Detail Konsumen</b></a></li>
									</ul>
									<div class="tab-content">
										<div class="tab-pane active" id="tab_1-1">
											<table class="table table-bordered">
													<thead>
													<th style="text-align: center;">No.</th>
													<th style="text-align: center;">Nama Produk</th>
													<th style="text-align: center;">Harga</th>
													<th style="text-align: center;">Jumlah Beli</th>
                          <th style="text-align: center;">Total</th>
												</thead>
												<tbody>
													<?php
														$no = 1;
														$total_item = 0;
                            $grad_total = 0;
                    									foreach ($detail_transaksi as $key => $value) {
                    								?>
                    									<tr>
                    										<td style="text-align: center;"><?= $no++; ?></td>
                    										<td style="text-align: center;"><?= $value->nama_produk; ?></td>
                    										<td style="text-align: center;"><?= "Rp ".number_format($value->harga_produk,2); ?></td>
                    										<td style="text-align: center;"><?= $value->jumlah_produk; ?></td>
                                        <td style="text-align: center;"><?= "Rp ".number_format($value->harga_produk * $value->jumlah_produk) ?></td>
                    									</tr>
                    								<?php
                    									$total_item += $value->jumlah_produk;
                                      $grad_total += ($value->harga_produk * $value->jumlah_produk);
                    									}
                    								?>
                                    <tr>
                                      <td colspan="2"></td>
                                      <td style="text-align: right;"><b>TOTAL</b></td>
                                      <td style="text-align: center;"><b><?= $total_item ?></b></td>
                                      <td style="text-align: center;"><b>Rp <?= number_format($grad_total) ?></b></td>
                                    </tr>
                    								<tr>
                    									<td colspan="5"><b>Alamat Pengiriman : </b> <?= $detail_transaksi[0]->detail_alamat ?></td>
                    								</tr>
                                     <tr>
                                      <td colspan="5"><b>Tanggal Transaksi : </b> 
                                        <?php 
                                        $date = strtotime($detail_transaksi[0]->tanggal_transaksi);
                                        echo date('d F Y', $date); 
                                        ?>
                                      </td>
                                    </tr>
                                    <tr>
                                      <td colspan="5"><b>Ekspedisi Pengiriman : </b> <?= $detail_transaksi[0]->ekspedisi_pengiriman ?></td>
                                    </tr>
                                    <tr>
                                      <td colspan="5"><b>Resi : </b> 
                                        <?php 
                                          if($detail_transaksi[0]->no_resi==""){
                                            echo "resi belum diinputkan";
                                          }else{
                                            echo $detail_transaksi[0]->no_resi;
                                          }
                                        ?>
                                    </td>
                                    <tr>
                                      <td colspan="5"><b>Status Transaksi : </b> <?= $detail_transaksi[0]->status ?></td>
                                    </tr>
                                    </tr>
												</tbody>
											</table>
										</div>
										<!-- /.tab-pane -->
										<div class="tab-pane" id="tab_2-2">
											<table class="table table-stripe">
													
												<tr>
													<td><b>Nama Konsumen :</b> <?= $detail_transaksi[0]->nama_konsumen ?></td>			
												</tr>

												<tr>
													<td><b>No. Tlp. :</b> <?= $detail_transaksi[0]->nomor_telp_konsumen ?></td>				
												</tr>
												
											</table>
										</div>
										<!-- /.tab-pane -->
									
									</div>
									<!-- /.tab-content -->
								</div>

							
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