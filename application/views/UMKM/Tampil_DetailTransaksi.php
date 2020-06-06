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
									<a href="<?php echo base_url(); ?>UMKM/Transaksi/<?php echo $id_umkm ?>"><button type="submit" class="btn btn-primary"> <i class="fa fa-arrow-left"></i> Back</button></a>
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
											<table class="table table-stripe">
													<thead>
													<th>No.</th>
													<th>Nama Produk</th>
													<th>Harga</th>
													<th>Jumlah Beli</th>
												</thead>
												<tbody>
													<?php
														$no = 1;
														$total_item = 0;
                    									foreach ($produk_dipesan as $key => $value) {
                    								?>
                    									<tr>
                    										<td><?= $no++; ?></td>
                    										<td><?= $value->nama_produk; ?></td>
                    										<td><?= "Rp ".number_format($value->harga_produk,2); ?></td>
                    										<td><?= $value->jumlah_produk; ?></td>
                    									</tr>
                    								<?php
                    									$total_item += $value->jumlah_produk;
                    									}
                    								?>
                    								<tr>
                    									<td colspan="4"><b>Total Item : </b><?= $total_item ?></td>
                    								</tr>
                    								<tr>
                    									<td colspan="4"><b>Total Harga : </b>Rp<?= number_format($detail_transaksi[0]->total_harga,2) ?></td>
                    								</tr>
                    								<tr>
                    									<td colspan="4"><b>Catatan Konsumen : </b><?= $detail_transaksi[0]->catatan_konsumen ?></td>
                    								</tr>
                    								<tr>
                    									<td colspan="4"><b>Alamat Pengiriman : </b> </td>
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