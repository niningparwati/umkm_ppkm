<div class="clear"></div>

<section id="main">
	<div class="container_12">
		<div id="content" class="grid_9">
			<h1 class="page_title"><?=$nama_produk?></h1>

			<div class="product_page">
				<div class="grid_4 img_slid" id="products">
					<div class="preview slides_container">
						<div class="prev_bg">
							<a class="jqzoom" rel="gal1" href="<?=base_url()?>assets/foto_produk/<?=$foto_produk?>">
								<img src="<?=base_url()?>assets/foto_produk/<?=$foto_produk?>"  style="width: 100%; height: 100%" title="" alt=""/>
							</a>
						</div>
					</div><!-- .prev -->
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
									Harga Produk:
								</div>
								<?php if ($stok > 0) { ?>
									<div class="availability">
										Stok: <span><?=$stok?> produk</span>
									</div>
								<?php }else{ ?>
									<div>
										Stok: <span style="color: red">kosong</span>
									</div>
								<?php } ?>
							</div><!-- .availability_sku -->

							<div class="price">
								<div class="price_new" style="font-size: 30px">Rp <?=number_format($harga,2,',','.')?></div>
							</div><!-- .price -->
						</div><!-- .ava_price -->

						<div class="block_cart">
							<div class="obn_like">
							</div>

							<div class="cart">
								<a href="#" class="bay">Add to Cart</a>
								<input type="text" name="" class="number" value="1" />
								<span>Quantity:</span>
							</div>
							<div class="clear"></div>
						</div><!-- .block_cart -->
					</div><!-- .entry_content -->

				</div><!-- .grid_5 -->

				<div class="clear"></div>

				<div class="grid_9" >
					<div id="wrapper_tab" class="tab1">
						<a href="#" class="tab1 tab_link">Deskripsi</a>
						<a href="#" class="tab2 tab_link">Review</a>
						<a href="#" class="tab3 tab_link">Profile UMKM</a>

						<div class="clear"></div>

						<div class="tab1 tab_body">
							<p><?=$deskripsi?></p>
							<div class="clear"></div>
						</div><!-- .tab1 .tab_body -->

						<div class="tab2 tab_body">
							<h4>Customer reviews</h4>
							<ul class="comments">
								<li>
									<div class="autor">Mike Example</div>, <time datetime="2012-11-03">03.11.2012</time>

									<div class="evaluation">
										<div class="quality">
											<strong>Quality</strong>
											<a class="plus" href="#"></a>
											<a class="plus" href="#"></a>
											<a class="plus" href="#"></a>
											<a href="#"></a>
											<a href="#"></a>
										</div>
										<div class="price">
											<strong>Price</strong>
											<a class="plus" href="#"></a>
											<a class="plus" href="#"></a>
											<a class="plus" href="#"></a>
											<a class="plus_minus" href="#"></a>
											<a href="#"></a>
										</div>
										<div class="clear"></div>
									</div><!-- .evaluation -->

									<p>Suspendisse at placerat turpis. Duis luctus erat vel magna pharetra aliquet. Maecenas tincidunt feugiat ultricies. Phasellus et dui risus. Vestibulum adipiscing, eros quis lobortis dictum.</p>
								</li>

								<li>
									<div class="autor">Mike Example</div>, <time datetime="2012-11-03">03.11.2012</time>

									<div class="evaluation">
										<div class="quality">
											<strong>Quality</strong>
											<a class="plus" href="#"></a>
											<a class="plus" href="#"></a>
											<a class="plus" href="#"></a>
											<a class="plus" href="#"></a>
											<a class="plus_minus" href="#"></a>
										</div>
										<div class="price">
											<strong>Price</strong>
											<a class="plus" href="#"></a>
											<a class="plus" href="#"></a>
											<a class="plus" href="#"></a>
											<a class="plus" href="#"></a>
											<a href="#"></a>
										</div>
										<div class="clear"></div>
									</div><!-- .evaluation -->

									<p>Etiam mollis volutpat odio, id euismod justo gravida a. Aliquam erat volutpat. Phasellus faucibus venenatis lorem, vitae commodo elit pretium et. Duis rhoncus lobortis congue. Vestibulum et purus dui, vel porta lectus. Sed vulputate pulvinar adipiscing.</p>
								</li>
							</ul><!-- .comments -->

							<form class="add_comments">
								<h4>Write Your Own Review</h4>

								<div class="evaluation">
									<div class="quality">
										<strong>Quality</strong><sup class="surely">*</sup>
										<input class="niceRadio" type="radio" name="quality" value="1" /><span class="eva_num">1</span>
										<input class="niceRadio" type="radio" name="quality" value="2" /><span class="eva_num">2</span>
										<input class="niceRadio" type="radio" name="quality" value="3" /><span class="eva_num">3</span>
										<input class="niceRadio" type="radio" name="quality" value="4" /><span class="eva_num">4</span>
										<input class="niceRadio" type="radio" name="quality" value="5" /><span class="eva_num">5</span>
									</div>
									<div class="price">
										<strong>Price</strong><sup class="surely">*</sup>
										<input class="niceRadio" type="radio" name="price" value="1" /><span class="eva_num">1</span>
										<input class="niceRadio" type="radio" name="price" value="2" /><span class="eva_num">2</span>
										<input class="niceRadio" type="radio" name="price" value="3" /><span class="eva_num">3</span>
										<input class="niceRadio" type="radio" name="price" value="4" /><span class="eva_num">4</span>
										<input class="niceRadio" type="radio" name="price" value="5" /><span class="eva_num">5</span>
									</div>
									<div class="clear"></div>
								</div><!-- .evaluation -->

								<div class="nickname">
									<strong>Nickname</strong><sup class="surely">*</sup><br/>
									<input type="text" name="" class="" value="" />
								</div><!-- .nickname -->

								<div class="your_review">
									<strong>Summary of Your Review</strong><sup class="surely">*</sup><br/>
									<input type="text" name="" class="" value="" />
								</div><!-- .your_review -->

								<div class="clear"></div>

								<div class="text_review">
									<strong>Review</strong><sup class="surely">*</sup><br/>
									<textarea name="text"></textarea>
									<i>Note: HTML is not translated!</i>
								</div><!-- .text_review -->

								<input type="submit" value="Submit Review" />
							</form><!-- .add_comments -->
							<div class="clear"></div>
						</div><!-- .tab2 .tab_body -->

						<div class="tab3 tab_body">
							<h4><a href="#"><?=$nama_umkm?></a></h4>
							<p>" <?=$deskripsi_umkm?> "</p>
							<p>Alamat	: <?=$alamat?> <br> No. telp : <?=$no_telp?></p>
							<div class="clear"></div>
						</div><!-- .tab3 .tab_body -->
						<div class="clear"></div>
					</div>​<!-- #wrapper_tab -->
					<div class="clear"></div>
				</div><!-- .grid_9 -->

				<div class="clear"></div>

				<div class="related">
					<div class="c_header">
						<div class="grid_7">
							<h2>Produk Serupa</h2>
						</div><!-- .grid_7 -->

						<div class="grid_2">
							<a id="next_c1" class="next arows" href="#"><span>Next</span></a>
							<a id="prev_c1" class="prev arows" href="#"><span>Prev</span></a>
						</div><!-- .grid_2 -->
					</div><!-- .c_header -->

					<div class="list_carousel">
						<ul id="list_product" class="list_product">
							<?php foreach ($serupa as $key) { ?>
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
															echo '<span style="color: black">'.$key->stok.'</span>';
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