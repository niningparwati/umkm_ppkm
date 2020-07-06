<div class="clear"></div>

<section id="main">
	<div class="container_12">
		<div id="content" class="grid_9">
			<h1 class="page_title"><?=$nama_produk?></h1>

			<div class="product_page">
				<div class="grid_4 img_slid" id="products">
					<div class="preview slides_container">
						<div class="prev_bg" style="width: 275px; height: 275px;">
							<?php if (!empty($foto_produk)) {?>
								<img src="<?=base_url()?>assets/foto_produk/<?=$foto_produk?>" style="width: 275px; height: 275px;" />
							<?php }else{ ?>
								<img src="<?=base_url()?>assets/foto_produk/produk_default.png" style="width: 275px; height: 275px" />
							<?php } ?>
						</div>
					</div><!-- .prev -->
				</div><!-- .grid_4 -->

				<div class="grid_5">
					<div class="entry_content">
						<p style=" font-size: 13px"><?=$deskripsi?></p>
						<div class="ava_price" style="border: none;">
							<div class="availability_sku">
								<div class="sku" style=" font-size: 13px">
									Harga Produk:
								</div>
								<?php if ($stok > 0) { ?>
									<div class="availability" style=" font-size: 13px">
										Stok: <span><?=$stok?> produk</span>
									</div>
								<?php }else{ ?>
									<div style=" font-size: 13px">
										Stok: <span style="color: red">kosong</span>
									</div>
								<?php } ?>
							</div><!-- .availability_sku -->

							<div class="price">
								<div class="price_new" style="font-size: 30px">Rp <?=number_format($harga,0,',','.')?></div>
							</div><!-- .price -->
						</div><!-- .ava_price -->

						<div class="block_cart">
							<div class="obn_like">
							</div>
							<div class="cart">
								<form action="<?=base_url()?>Konsumen/inputKeranjang/<?=$id_produk?>" method="POST">
									<button type="submit" name="submit" class="bay" style="width: 110px; float: right;display: block;height: 33px;color: #fefefe;text-align: center;text-decoration: none;font-size: 13px Segoeui-Bold, Arial, Verdana, serif;background: #59b7c2; border-radius: 2px">Masukan keranjang</button>
									<span style=" font-size: 13px">Quantity: &nbsp <input type="number" name="qty" min="1" max="<?=$stok?>" value="1" style="height: 30px" ></span>
									
								</form>
							</div>
							<div class="clear"></div>
						</div><!-- .block_cart -->
					</div><!-- .entry_content -->
				</div><!-- .grid_5 -->

				<div class="clear"></div>

				<?php if (!empty($serupa)) {?>
					<div class="related">
						<div class="c_header">
							<div class="grid_7">
								<h2>Produk Serupa</h2>
							</div><!-- .grid_7 -->
						</div><!-- .c_header -->

						<div class="list_carousel">
							<ul id="list_product" class="list_product">
								<?php foreach ($serupa as $key) { ?>
									<a href="<?=base_url()?>Konsumen/detailProduk/<?=$key->id_produk?>" style="text-decoration: none;">
										<li class="">
											<div class="grid_3 product">
												<div class="prev">
													<?php if (!empty($key->foto_produk)) {?>
														<img src="<?=base_url()?>assets/foto_produk/<?=$key->foto_produk?>" style="width: 250px; height: 250px" />
													<?php }else{ ?>
														<img src="<?=base_url()?>assets/foto_produk/produk_default.png" style="width: 250px; height: 250px" />
													<?php } ?>
												</div><!-- .prev -->
												<h3 class="title"><?= substr($key->nama_produk, 0, 20) ?><?php if (strlen($key->nama_produk) > 20) { echo "..."; } ?></h3>
												<div class="cart">
													<div class="price" style="width: 50%">
														<div class="vert">
															<div class="price_new">Rp <?=number_format($key->harga_produk,0,',','.')?></div>
														</div>
													</div>
													<div style="color: #2e9f9a; font-size: 13px" >
														<span style="padding-left: 10px">Stok : <br></span>
														<span style="padding-left: 10px"><?=$key->stok?> produk</span>
													</div>
												</div><!-- .cart -->
											</div><!-- .grid_3 -->
										</li>
									</a>
								<?php } ?>
							</ul><!-- #list_product -->
						</div><!-- .list_carousel -->
					</div><!-- .carousel -->
				<?php } ?>
			</div><!-- .product_page -->
			<div class="clear"></div>

		</div><!-- #content -->

		<div id="sidebar" class="grid_3">
			<aside id="categories_nav">
				<h3>Kategori Produk</h3>

				<nav class="left_menu">
					<ul>
						<li style="border: none;"><a href="<?=base_url()?>Konsumen/Produk/semua" style="text-decoration: none;">Semua Produk</a></li>
						<?php 
						foreach ($kategori as $key) {
							$idK = $key->id_kategori_produk;
							$produk = $this->M_konsumen->produkByKategori($idK);
							?>
							<li style="border: none;"><a href="<?=base_url()?>Konsumen/Produk/<?=$key->id_kategori_produk?>" style="text-decoration: none;"><?=$key->nama_kategori_produk?> <span>(<?=$produk->jumlah?>)</span></a></li>
						<?php } ?>
					</ul>
				</nav><!-- .left_menu -->
			</aside><!-- #categories_nav -->

			<aside id="newsletter_signup">
				<?php $umkm = $this->M_konsumen->umkmById($id_umkm); ?>
				<a href="<?=base_url()?>Konsumen/detailUmkm/<?=$id_umkm?>/semua" style="text-decoration: none;"><h3><?=$umkm->nama_umkm?></h3></a>
				<p style="text-align: justify;"><?=$umkm->deskripsi_umkm?></p><br>
				<p>
					No Telp UMKM : <?=$umkm->nomor_telp_umkm?><br>
					Alamat : <?=$umkm->alamat_umkm?>, <?=$umkm->kota_asal?>, <?=$umkm->provinsi_asal?>
				</p>
			</aside><!-- #newsletter_signup -->
			<?php if (!empty($produk_lain)) { ?>
				<aside id="banners">
					<h3>Produk Lainnya</h3>
					<div class="list_carousel">
						<ul id="list_banners">
							<?php foreach ($produk_lain as $key) {?>
								<li class="banner" style="width: 48%; height: 100px"><a href="<?=base_url()?>Konsumen/detailProduk/<?=$key->id_produk?>">
									<div class="prev">
										<?php if (!empty($key->foto_produk)) { ?>
											<img src="<?php echo base_url()?>assets/foto_produk/<?=$key->foto_produk?>" style="width: 80%; height: 80px; padding-bottom: 25px" />
										<?php }else{ ?>
											<img src="<?php echo base_url()?>assets/foto_produk/produk_default.png" style="width: 80%; height: 80px; padding-bottom: 25px" />
										<?php } ?>
									</div><!-- .prev -->
								</a></li>
							<?php } ?>
						</ul>
						<?php if ($jml_produk_lainnya > 6) {?>
							<center><a href="<?=base_url()?>Konsumen/Produk/semua" style="text-decoration: none;">Lihat Lainnya</a></center>
						<?php } ?>
					</div><!-- .list_carousel -->
				</aside><!-- #banners -->
			<?php } ?>
		</div><!-- .sidebar -->

		<div class="clear"></div>

	</div><!-- .container_12 -->
</section><!-- #main -->

<div class="clear"></div>