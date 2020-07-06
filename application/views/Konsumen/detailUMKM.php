<div class="clear"></div>

<section id="main">
	<div class="container_12">
		<div id="content" class="grid_9">
			<h1 class="page_title"><?=$nama_umkm?></h1>

			<div class="product_page">
				<div class="grid_4 img_slid" id="products">
					<div class="preview slides_container">
						<div class="prev_bg" style="width: 270px; height: 275px">
							<?php if ($foto) { ?>
								<a class="jqzoom" rel="gal1" href="#">
									<img src="<?=base_url()?>assets/foto_user/<?=$foto?>" style="width: 270px; height: 275px" title="" alt=""/>
								</a>
							<?php }else{ ?>
								<img src="<?=base_url()?>assets/foto_umkm/store.png" style="width: 270px; height: 275px" title="" alt=""/>
							</a>
						<?php } ?>
					</div>
				</div><!-- .prev -->
			</div><!-- .grid_4 -->

			<div class="grid_5">
				<div class="entry_content">
					<div class="availability_sku">
						<div class="sku" style=" font-size: 13px">
							<p style="text-align: justify;"><?=$deskripsi?></p>
							<br><br>
							Alamat : <?=$alamat?>
							<br>
							Nomor Telp : <?=$no_telp?>
						</div>
					</div><!-- .availability_sku -->
				</div><!-- .entry_content -->

			</div><!-- .grid_5 -->

			<div class="clear"></div>
			<br>
			<?php if (!empty($produk)) {?>
				<div class="related">
					<br><br>
					<div class="c_header">
						<div class="grid_7">
							<h2>
								<?php if ($jenis == 'semua') {
									echo "SEMUA PRODUK";
								} else {
									echo "PRODUK ".strtoupper($jenis);
								}
								?>
							</h2>
						</div><!-- .grid_7 -->
					</div><!-- .c_header -->

					<div class="list_carousel">
						<ul id="list_product" class="list_product">
							<?php foreach ($produk as $key) { ?>
								<li style="margin-top: 25px">
									<a href="<?=base_url()?>Konsumen/detailProduk/<?=$key->id_produk?>" style="text-decoration: none;color: black">
										<div class="grid_3 product">
											<div class="prev">
												<?php if (!empty($key->foto_produk)) {?>
													<img src="<?=base_url()?>assets/foto_produk/<?=$key->foto_produk?>" style="width: 250px; height: 250px" />
												<?php }else{ ?>
													<img src="<?=base_url()?>assets/foto_produk/produk_default.png" style="width: 250px; height: 250px" />
												<?php } ?>
												<br><br>
											</div><!-- .prev -->
											<h3 class="title"><?=$key->nama_produk?></h3>
											<div class="cart">
												<div class="price" style="width: 50%">
													<div class="vert">
														<div class="price_new">Rp <?=number_format($key->harga_produk,0,',','.')?></div>
													</div>
												</div>
												<div style="color: #2e9f9a;">
													<span style="padding-left: 10px">Stok : <br></span>
													<span style="padding-left: 10px"><?=$key->stok?> produk</span>
												</div>
												<a href="#" class="bay"></a>
											</div><!-- .cart -->
										</div><!-- .grid_3 -->
									</a>
								</li>
							<?php } ?>
						</ul><!-- #list_product -->
					</div><!-- .list_carousel -->
				</div><!-- .carousel -->
			<?php } ?>
		</div><!-- .product_page -->
		<div class="clear"></div>

	</div><!-- #content -->

	<div id="sidebar" class="grid_3" style=" font-size: 13px; color: black">
		<aside id="categories_nav">
			<h3>KATEGORI PRODUK</h3>
			<nav class="left_menu">
				<ul>
					<li style="border: none;"><a href="<?=base_url()?>Konsumen/detailUmkm/<?=$id_umkm?>/semua" style="text-decoration: none;">Semua Produk</a></li>
					<?php foreach ($kategori_produk as $key) { ?>
						<li style="border: none;"><a href="<?=base_url()?>Konsumen/detailUmkm/<?=$id_umkm?>/<?=$key->id_kategori_produk?>" style="text-decoration: none;"><?=$key->nama_kategori_produk?></a></li>
					<?php } ?>
				</ul>
			</nav><!-- .left_menu -->
		</aside><!-- #categories_nav -->

		<?php if (!empty($cekFoto)) { ?>
			<aside id="banners">	<!-- Galeri UMKM -->
				<h3>GALERI FOTO</h3>

				<div class="list_carousel">
					<ul id="list_banners">
						<?php foreach ($cekFoto as $key) { ?>
							<li class="banner" style="width: 48%; height: 100px;"><a href="#">
								<div class="prev">
									<img src="<?php echo base_url()?>assets/galeri_umkm/<?=$key->foto?>" style="width: 80%; height: 80px; padding-bottom: 25px" />
								</div><!-- .prev -->
							</a></li>
						<?php } ?>
					</ul>
				</div><!-- .list_carousel -->
			</aside><!-- #banners -->
		<?php } ?>

		<?php if (!empty($portofolio)) { ?>
			<aside id="specials" class="specials" style="font-size: 13px">
				<h3>PORTOFOLIO</h3>
				<ul>
					<?php foreach ($portofolio as $key) { ?>
						<li style="border: none;">
							<div class="prev">
								<?php if (!empty($key->foto_portofolio)) { ?>
									<img src="<?=base_url()?>assets/foto_portofolio/<?=$key->foto_portofolio?>" style="width: 80px;height: 80px" />
								<?php }else{ ?>
									<img src="<?=base_url()?>assets/foto_portofolio/portofolio.png" style="width: 80px;height: 80px" />
								<?php } ?>
							</div>

							<div class="cont">
								<b><?=$key->judul_portofolio?></b>
								<div style=" font-size: 13px"><?=$key->keterangan?><br><br></div>
								<div style=" font-size: 13px"><?=$key->alamat?>, <?=$key->tanggal?></div>
							</div>
						</li>
					<?php } ?>
				</ul>
			</aside><!-- #specials -->
		<?php } ?>

		<?php if (!empty($market)) { ?>
			<aside id="newsletter_signup" style=" font-size: 13px">
				<h3>MARKET</h3>
				<?php foreach ($market as $key) { ?>
					<p>
						<b><?=$key->nama_market?></b><br>
						Alamat : <?=$key->alamat_market?> <br>
						Link : <a href="<?=$key->link_market?>"><?=$key->link_market?></a>
					</p>
					<br>
				<?php } ?>
			</aside><!-- #newsletter_signup -->
		<?php } ?>

		<?php if (!empty($informasi)) { ?>
			<aside id="specials" class="specials">
				<h3>INFORMASI</h3>
				<ul>
					<?php foreach ($informasi as $key) { ?>
						<li style="height: 100px; border: none;">
							<a href="<?=base_url()?>Konsumen/DetailInformasi/<?=$key->id_informasi?>" style="text-decoration: none;color: black">
								<div class="prev">
									<?php if (!empty($key->gambar)) { ?>
										<img src="<?=base_url()?>assets/foto_informasi/<?=$key->gambar?>" style="width: 80px;height: 80px" />
									<?php }else{ ?>
										<img src="<?=base_url()?>assets/foto_informasi/informasi.png" style="width: 80px;height: 80px" />
									<?php } ?>
								</div>
								<div class="cont"  style=" font-size: 13px">
									<b><?=$key->judul_informasi?></b>
									<div><?= substr($key->isi_informasi, 0, 100) ?> ... <br><br></div>
								</div>
							</a>
						</li>
					<?php } ?>
				</ul>
			</aside><!-- #specials -->
			<br><br>
			<?php if ($jmlh_informasi > 4) {?>
				<center><a href="<?=base_url()?>Konsumen/Informasi" style="text-decoration: none;">Lihat Lainnya</a></center>
			<?php } ?>
		<?php } ?>

	</div><!-- .sidebar -->

	<div class="clear"></div>

</div><!-- .container_12 -->
</section><!-- #main -->

<div class="clear"></div>