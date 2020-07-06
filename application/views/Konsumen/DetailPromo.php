<div class="clear"></div>

<section id="main">
	<div class="container_12">
		<div id="content" class="grid_12">
			<div>
				<div class="grid_12 img_slid">
					<div class="preview slides_container">
						<div class="prev_bg">
							<a class="jqzoom" rel="gal1" href="#">
								<?php if (!empty($foto_promo)) { ?>
									<img src="<?=base_url()?>assets/foto_promo/<?=$foto_promo?>" style="width: 100%; height: 250px;" />
								<?php } ?>
							</a>
						</div>
					</div><!-- .prev -->
				</div><!-- .grid_4 -->

				<div class="grid_12">
					<div>
						<div><br><br>
							<span style="font-size: 30px;font-weight: bold;"><?=$nama_promo?></span><br><br>
							Kode Voucher : <span style="font-weight: bold;"><?=$kode_promo?></span><br><br>
							<div style="width: 100%; text-align: justify;">
								<?php if ($id_umkm) { $nama_umkm = $this->M_konsumen->umkmById($id_umkm)->nama_umkm; } ?>

								<?php if ($minimal_belanja!=0 AND $maksimum_potongan!=0 ) { ?>

									Voucher diskon sebesar <?=$besar_promo?>% <?php if(!is_null($id_umkm)) { ?> hanya untuk pembelian produk di <a href="<?=base_url()?>Konsumen/detailUmkm/<?=$id_umkm?>/semua" style="text-decoration: none;"> <?=$nama_umkm?> </a> <?php } ?> . Berlaku untuk transaksi dengan minimal pembelian Rp <?= number_format($minimal_belanja,0,',','.') ?> dengan maksimum diskon yang dapat digunakan sebesar Rp <?= number_format($maksimum_potongan,0,',','.') ?>. Voucher diskon hanya berlaku sampai <?= tgl_indo($berlaku_sampai) ?> .

								<?php }elseif ($minimal_belanja!=0) { ?>

									Voucher diskon sebesar <?=$besar_promo?>% <?php if(!is_null($id_umkm)) { ?> hanya untuk pembelian produk di <a href="<?=base_url()?>Konsumen/detailUmkm/<?=$id_umkm?>/semua" style="text-decoration: none;"> <?=$nama_umkm?> </a> <?php } ?> . Berlaku untuk transaksi dengan minimal pembelian Rp <?= number_format($minimal_belanja,0,',','.') ?> . Voucher diskon hanya berlaku sampai <?= tgl_indo($berlaku_sampai) ?> .

								<?php }elseif ($maksimum_potongan!=0) { ?>

									Voucher diskon sebesar <?=$besar_promo?>% <?php if(!is_null($id_umkm)) { ?> hanya untuk pembelian produk di <a href="<?=base_url()?>Konsumen/detailUmkm/<?=$id_umkm?>/semua" style="text-decoration: none;"> <?=$nama_umkm?> </a> <?php } ?> . Maksimum diskon yang dapat digunakan sebesar Rp <?= number_format($maksimum_potongan,0,',','.') ?>. Voucher diskon hanya berlaku sampai <?= tgl_indo($berlaku_sampai) ?> .

								<?php }else{ ?>

									Voucher diskon sebesar <?=$besar_promo?>% <?php if(!is_null($id_umkm)) { ?> hanya untuk pembelian produk di <a href="<?=base_url()?>Konsumen/detailUmkm/<?=$id_umkm?>/semua" style="text-decoration: none;"> <?=$nama_umkm?> </a> <?php } ?> . Voucher diskon hanya berlaku sampai <?= tgl_indo($berlaku_sampai) ?> .
								<?php } ?>
								<br><br>
							</div>
						</div><!-- .availability_sku -->
					</div><!-- .entry_content -->

				</div><!-- .grid_5 -->
			</div><!-- .product_page -->
			<div class="clear"></div>
			<br>
		</div><!-- #content -->

	</div><!-- .container_12 -->
</section><!-- #main -->

<div class="clear"></div>