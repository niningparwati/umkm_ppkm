<div class="clear"></div>

<section id="main">
	<div class="container_12">
		<div id="content" class="grid_9">
			<h1 class="page_title"><?=$nama_umkm?></h1>

			<div class="product_page">
				<div class="grid_4 img_slid" id="products">
					<div class="preview slides_container">
						<div class="prev_bg">
							<?php if ($foto) { ?>
								<a class="jqzoom" rel="gal1" href="#">
									<img src="<?=base_url()?>assets/foto_user/<?=$foto?>"  style="width: 295px; height: 295px" title="" alt=""/>
								</a>
							<?php }else{ ?>
								<img src="<?=base_url()?>assets/foto_umkm/store.png"  style="width: 100%; height: 100%" title="" alt=""/>
							</a>
						<?php } ?>
					</div>
				</div><!-- .prev -->
			</div><!-- .grid_4 -->

			<div class="grid_5">
				<div class="entry_content">
					<div class="availability_sku">
						<div class="sku">
							<?=$deskripsi?>
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
								<li class="">
									<div class="grid_3 product">
										<div class="prev">
											<a href="<?=base_url()?>Konsumen/detailProduk/<?=$key->id_produk?>"><img src="<?=base_url()?>assets/foto_produk/<?=$key->foto_produk?>" alt="" title="" style="width: 100%; height: 100%" /><br><br></a>
										</div><!-- .prev -->
										<h3 class="title"><?=$key->nama_produk?></h3>
										<div class="cart">
											<div class="price" style="width: 73%">
												<div class="vert">
													<div class="price_new">Rp <?=number_format($key->harga_produk,2,',','.')?></div>
													<div style="font-size: 10px; color: black; font-family: calibri">
														Status stok : 
														<?php 
														if ($key->stok > 0) {
															echo '<span style="color: black">'.$key->stok.' produk</span>';
														} else{
															echo '<span style="color: red">kosong</span>';
														}
														?>
													</div>
												</div>
											</div>
											<a href="#" class="bay"></a>
										</div><!-- .cart -->
									</div><!-- .grid_3 -->
								</li>
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
			<h3>KATEGORI PRODUK</h3>
			<nav class="left_menu">
				<ul>
					<li><a href="<?=base_url()?>Konsumen/detailUmkm/<?=$id_umkm?>/semua">Semua Produk</a></li>
					<?php foreach ($kategori_produk as $key) { ?>
						<li><a href="<?=base_url()?>Konsumen/detailUmkm/<?=$id_umkm?>/<?=$key->id_kategori_produk?>"><?=$key->nama_kategori_produk?></a></li>
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
							<li class="banner" style="width: 48%; height: 100px"><a href="#">
								<div class="prev">
									<img src="<?php echo base_url()?>assets/galeri_umkm/<?=$key->foto?>" style="width: 100%; height: 100px" />
								</div><!-- .prev -->
							</a></li>
						<?php } ?>
					</ul>
				</div><!-- .list_carousel -->
			</aside><!-- #banners -->
		<?php } ?>

		<?php if (!empty($portofolio)) { ?>
			<aside id="specials" class="specials">
				<h3>PORTOFOLIO</h3>
				<ul>
					<?php foreach ($portofolio as $key) { ?>
						<li>
							<div class="prev">
								<a href="#"><img src="<?=base_url()?>assets/foto_portofolio/<?=$key->foto_portofolio?>" style="width: 80px;height: 80px" /></a>
							</div>

							<div class="cont">
								<b><?=$key->judul_portofolio?></b>
								<div><small><?=$key->keterangan?></small><br><br></div>
								<div><?=$key->alamat?>, <?=$key->tanggal?></div>
							</div>
						</li>
					<?php } ?>
				</ul>
			</aside><!-- #specials -->
		<?php } ?>

		<?php if (!empty($market)) { ?>
			<aside id="newsletter_signup">
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
						<li>
							<div class="prev">
								<a href="#"><img src="<?=base_url()?>assets/foto_informasi/<?=$key->gambar?>" style="width: 80px;height: 80px" /></a>
							</div>

							<div class="cont">
								<b><?=$key->judul_informasi?></b>
								<div><small><?=$key->isi_informasi?></small><br><br></div>
							</div>
						</li>
					<?php } ?>
				</ul>
			</aside><!-- #specials -->
		<?php } ?>

	</div><!-- .sidebar -->

	<div class="clear"></div>

</div><!-- .container_12 -->
</section><!-- #main -->

<div class="clear"></div>