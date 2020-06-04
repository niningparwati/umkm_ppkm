<div class="clear"></div>

<section id="main">
	<div class="container_12">
		<div id="content" class="grid_9">
			<h1 class="page_title"><?=$nama_umkm?></h1>

			<div class="product_page">
				<div class="grid_4 img_slid" id="products">
					<div class="preview slides_container">
						<div class="prev_bg">
							<?php 
							$cekFoto = $this->M_konsumen->fotoUmkm($id_umkm);
							if (!is_null($cekFoto)) {
								$fotoUmkm = $this->M_konsumen->semuaFotoUMKM($id_umkm);
								?>
								<a class="jqzoom" rel="gal1" href="<?=base_url()?>assets/galeri_umkm/<?=$cekFoto->foto?>">
									<img src="<?=base_url()?>assets/galeri_umkm/<?=$cekFoto->foto?>"  style="width: 300px; height: 300px" title="" alt=""/>
								</a>
							<?php }else{ ?>
								<a class="jqzoom" rel="gal1" href="<?=base_url()?>assets/galeri_umkm/default.png">
									<img src="<?=base_url()?>assets/galeri_umkm/default.png"  style="width: 100%; height: 100%" title="" alt=""/>
								</a>
							<?php } ?>
						</div>
					</div><!-- .prev -->

					<ul class="pagination clearfix" id="thumblist">
						<?php 
						$cekFoto = $this->M_konsumen->semuaFotoUMKM($id_umkm);
						if (!is_null($cekFoto)) {
							foreach ($cekFoto as $key) {
								?>
								<li><a href='javascript:void(0);' rel="{gallery: 'gal1', smallimage: '<?php echo base_url()?>assets/galeri_umkm/<?=$key->foto?>',largeimage: '<?php echo base_url()?>assets/galeri_umkm/<?=$key->foto?>'}"><img src='<?php echo base_url()?>assets/galeri_umkm/<?=$key->foto?>' alt=""></a></li>
								<?php 
							} 
						}else{ ?>
							<li><a href='javascript:void(0);' rel="{gallery: 'gal1', smallimage: '<?php echo base_url()?>assets/galeri_umkm/default.png',largeimage: '<?php echo base_url()?>assets/galeri_umkm/default.png'}"><img src='<?php echo base_url()?>assets/galeri_umkm/default.png' alt=""></a></li>
						<?php } ?>
					</ul>

				</div><!-- .grid_4 -->

				<div class="grid_5">
					<div class="entry_content">
						<div class="review">
							<a class="plus" href="#"></a>
							<a class="plus" href="#"></a>
							<a class="plus" href="#"></a>
							<a href="#"></a>
							<a href="#"></a>
							<span>1 REVIEW(S)</span>
							<a class="add_review" href="#">ADD YOUR REVIEW</a>
						</div>
						<div class="ava_price">
							<div class="availability_sku">
								<div class="sku">
									<?=$deskripsi?>
									<br><br>
									Alamat : <?=$alamat?>
									<br>
									Nomor Telp : <?=$no_telp?>
								</div>
							</div><!-- .availability_sku -->
						</div><!-- .ava_price -->
					</div><!-- .entry_content -->

				</div><!-- .grid_5 -->

				<div class="clear"></div>
				<br>
				<div class="related">
					<br><br>
					<div class="c_header">
						<div class="grid_7">
							<h2>Produk UMKM</h2>
						</div><!-- .grid_7 -->
					</div><!-- .c_header -->

					<div class="list_carousel">
						<ul id="list_product" class="list_product">
							<?php foreach ($produk as $key) { ?>
								<li class="">
									<div class="grid_3 product">
										<div class="prev">
											<a href="<?=base_url()?>Konsumen/detailProduk/<?=$key->id_produk?>"><img src="<?=base_url()?>assets/foto_produk/<?=$key->foto_produk?>" alt="" title="" style="width: 100%; height: 100%" /><br><br><span style="font-size: 20px;"><?=$key->nama_produk?></span></a>
										</div><!-- .prev -->
										<h3 class="title"></h3>
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
			</div><!-- .product_page -->
			<div class="clear"></div>

		</div><!-- #content -->

		<div id="sidebar" class="grid_3">
			<aside id="categories_nav">
				<h3>Categories</h3>

				<nav class="left_menu">
					<ul>
						<li><a href="#">Solids <span>(21)</span></a></li>
						<li><a href="#">Liquids <span> (27)</span></a></li>
						<li><a href="#">Spray <span>(33)</span></a></li>
						<li><a href="#">Electric <span>(17)</span></a></li>
						<li><a href="#">For Cars <span>(23)</span></a></li>
						<li><a href="#">For Room <span>(7)</span></a></li>
						<li class="last"><a href="#">Other <span>(135)</span></a></li>
					</ul>
				</nav><!-- .left_menu -->
			</aside><!-- #categories_nav -->

			<aside id="specials" class="specials">
				<h3>Specials</h3>

				<ul>
					<li>
						<div class="prev">
							<a href="#"><img src="images/special1.png" alt="" title="" /></a>
						</div>

						<div class="cont">
							<a href="#">Honeysuckle Flameless Luminary Refill</a>
							<div class="prise"><span class="old">$177.00</span>$75.00</div>
						</div>
					</li>

					<li>
						<div class="prev">
							<a href="#"><img src="images/special2.png" alt="" title="" /></a>
						</div>

						<div class="cont">
							<a href="#">Honeysuckle Flameless Luminary Refill</a>
							<div class="prise"><span class="old">$177.00</span>$75.00</div>
						</div>
					</li>
				</ul>
			</aside><!-- #specials -->

			<aside id="newsletter_signup">
				<h3>Newsletter Signup</h3>
				<p>Phasellus vel ultricies felis. Duis
				rhoncus risus eu urna pretium.</p>

				<form class="newsletter">
					<input type="email" name="newsletter" class="your_email" value="" placeholder="Enter your email address..."/>
					<input type="submit" id="submit" value="Subscribe" />
				</form>
			</aside><!-- #newsletter_signup -->

			<aside id="banners">
				<a id="ban_next" class="next arows" href="#"><span>Next</span></a>
				<a id="ban_prev" class="prev arows" href="#"><span>Prev</span></a>

				<h3>Banners</h3>

				<div class="list_carousel">
					<ul id="list_banners">
						<li class="banner"><a href="#">
							<div class="prev">
								<img src="images/banner.png" alt="" title="" />
							</div><!-- .prev -->

							<h2>New smells</h2>

							<p>in the next series</p>
						</a></li>

						<li class="banner"><a href="#">
							<div class="prev">
								<img src="images/banner.png" alt="" title="" />
							</div><!-- .prev -->

							<h2>New smells</h2>

							<p>in the next series</p>
						</a></li>

						<li class="banner"><a href="#">
							<div class="prev">
								<img src="images/banner.png" alt="" title="" />
							</div><!-- .prev -->

							<h2>New smells</h2>

							<p>in the next series</p>
						</a></li>

					</ul>
				</div><!-- .list_carousel -->
			</aside><!-- #banners -->

			<aside id="tags">
				<h3>Tags</h3>
				<a class="t1" href="">california</a>
				<a class="t2" href="">canada</a>
				<a class="t3" href="">canon</a>
				<a class="t4" href="">cat</a>
				<a class="t5" href="">chicago</a>
				<a class="t6" href="">christmas</a>
				<a class="t7" href="">mars</a>
				<a class="t8" href="">church</a>
				<a class="t9" href="">city</a>
				<a class="t10" href="">clouds</a>
				<a class="t11" href="">color</a>
				<a class="t12" href="">concert</a>
				<a class="t13" href="">dance</a>
				<a class="t14" href="">day</a>
				<a class="t15" href="">dog</a>
				<a class="t16" href="">england</a>
				<a class="t17" href="">europe</a>
			</aside><!-- #community_poll -->
		</div><!-- .sidebar -->

		<div class="clear"></div>

	</div><!-- .container_12 -->
</section><!-- #main -->

<div class="clear"></div>