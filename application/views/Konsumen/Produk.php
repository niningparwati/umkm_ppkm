<div class="clear"></div>

<section id="main">
	<div class="container_12">      
		<div id="content" class="grid_9">
			<div class="options" style="border: none;">
				<div class="grid_6" style="height: 50px">
					<p style="font-size: 30px; font-family: Bitter, Myriad Pro, Verdana, serif; margin-top: 25px">Produk UMKM</p>
				</div>
				<div class="grid_2">
					<form class="search">
						<input type="text" name="search" class="entry_form" value="" placeholder="Search entire store here..."/>
					</form>
				</div>
			</div>

			<hr>
			<div class="options">

				<div class="show">
					<span>Show</span>
					<select title="Show">
						<option>1</option>
						<option>2</option>
						<option>3</option>
						<option>4</option>
						<option>5</option>
						<option>6</option>
						<option>7</option>
						<option>8</option>
						<option>9</option>
						<option>10</option>
						<option>11</option>
						<option>12</option>
					</select>

					<span class="per-page">per page</span>
				</div><!-- .show -->

				<div class="sort">
					<span class="sort-by">Sort By</span>
					<select>
						<option>Position</option>
						<option>Price</option>
						<option>Rating</option>
						<option>Name</option>
					</select>

					<a class="sort_up" href="#">&#8593;</a>
				</div><!-- .sort -->
			</div><!-- .options -->

			<div class="grid_product">

				<?php foreach ($produk as $key) { ?>
					<div class="grid_3 product">
						<div class="prev">
							<a href="<?=base_url()?>Konsumen/detailProduk/<?=$key->id_produk?>"><img src="<?=base_url()?>assets/foto_produk/<?=$key->foto_produk?>" style="width: 100%; height: 200px" alt="" title="" /></a>
						</div><!-- .prev -->
						<h3 class="title"><?=$key->nama_produk?></h3>
						<div class="cart">
							<div class="price">
								<div class="vert">
									<div class="price_new">Rp <?=number_format($key->harga_produk,2,',','.')?></div>
								</div>
							</div>
							<a href="#" class="obn"></a>
							<a href="#" class="like"></a>
							<a href="#" class="bay"></a>
						</div><!-- .cart -->
					</div><!-- .grid_3 -->
				<?php } ?>

				<div class="clear"></div>
			</div><!-- .grid_product -->

			<div class="clear"></div>

			<div class="pagination">
				<?=$pagination?>
			</div><!-- .pagination -->
			<p class="pagination_info">( terdapat <?=$jumlah_produk?> produk UMKM )</p>
		</div><!-- #content -->

		<div id="sidebar" class="grid_3">
			<aside id="categories_nav">
				<h3>Kategori Produk</h3>

				<nav class="left_menu">
					<ul>
						<?php 
						foreach ($kategori as $key) {
							$idK = $key->id_kategori_produk;
							$produk = $this->M_konsumen->produkByKategori($idK);
							?>
							<li><a href="#"><?=$key->nama_kategori_produk?> <span>(<?=$produk->jumlah?>)</span></a></li>
							<?php 
						}
						?>
					</ul>
				</nav><!-- .left_menu -->
			</aside><!-- #categories_nav -->

			<aside id="shop_by">
				<h3>Shop By</h3>

				<div class="currently_shopping">
					<p>Currently Shopping by:</p>
					<ul>
						<li><a title="close" class="close" href="#"></a>Price: <span>$0.00 - $999.99</span></li>
						<li><a title="close" class="close" href="#"></a>Manufacturer: <span>Apple</span></li>
					</ul>

					<a class="clear_all" href="#">Clear All</a>

					<div class="clear"></div>
				</div><!-- .currently_shopping -->

				<h4>Category</h4>

				<form action="#" class="check_opt">
					<p><input class="niceCheck" type="checkbox" >For Home (23)</p>
					<p><input class="niceCheck" type="checkbox" name="" value="">For Car (27)</p>
					<p><input class="niceCheck" type="checkbox" name="" value="">For Office (9)</p>
				</form>

				<h4>Price</h4>

				<form action="#" class="check_opt">
					<p><input class="niceCheck" type="checkbox" name="" value="">0.00 - $49.99 (21)</p>
					<p><input class="niceCheck" type="checkbox" name="" value="">$50.00 - $99.99 (7)</p>
					<p><input class="niceCheck" type="checkbox" name="" value="">0$100.00 and above (15)</p>
				</form>
			</aside><!-- #shop_by -->

			<aside id="specials" class="specials">
				<h3>Specials</h3>

				<ul>
					<li>
						<div class="prev">
							<a href="/product_page.html"><img src="images/special1.png" alt="" title="" /></a>
						</div>

						<div class="cont">
							<a href="/product_page.html">Honeysuckle Flameless Luminary Refill</a>
							<div class="prise"><span class="old">$177.00</span>$75.00</div>
						</div>   
					</li>

					<li>
						<div class="prev">
							<a href="/product_page.html"><img src="images/special2.png" alt="" title="" /></a>
						</div>

						<div class="cont">
							<a href="/product_page.html">Honeysuckle Flameless Luminary Refill</a>
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
		</div><!-- .sidebar -->

		<div class="clear"></div>

	</div><!-- .container_12 -->
</section><!-- #main -->

<div class="clear"></div>

<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script>
	$(document).ready(function($){

		$('.listSearch li').each(function(){
			$(this).attr('searchData', $(this).text().toLowerCase());
		});
		$('.boxSearch').on('keyup', function(){
			var dataList = $(this).val().toLowerCase();
			$('.listSearch li').each(function(){
				if ($(this).filter('[searchData *= ' + dataList + ']').length > 0 || dataList.length < 1) {
					$(this).show();
				} else {
					$(this).hide();
				}
			});
		});

	});
</script>