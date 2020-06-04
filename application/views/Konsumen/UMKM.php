  <div class="clear"></div>
  
  <section id="main">
  	<div class="container_12">      
  		<div id="content" class="grid_9">
  			<h1 class="page_title">UMKM</h1>

  			<div class="options">
  				<div class="grid-list">
  					<a class="grid" href="/catalog_grid.html"><span>img</span></a>
  					<a class="list curent" href="/"><span>img</span></a>
  				</div><!-- .grid-list -->

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

  			<div class="listing_product">
  				<?php foreach ($umkm as $key) {
  					$foto = $this->M_konsumen->fotoUmkm($key->id_umkm);  					
  					?>
  					<div class="product_li">
  						<div class="grid_3">
  							<div class="prev">
  								<a href="<?=base_url()?>Konsumen/detailUmkm/<?=$key->id_umkm?>">
  									<?php if (!empty($foto)) { ?>
  										<img src="<?=base_url()?>assets/galeri_umkm/<?=$foto->foto?>" alt="" title="" />
  									<?php }else{ ?>
  										<img src="<?=base_url()?>assets/galeri_umkm/default.png" alt="" title="" />
  									<?php } ?>
  								</a>
  							</div><!-- .prev -->
  						</div><!-- .grid_3 -->

  						<div class="grid_4">
  							<div class="entry_content">
  								<a href="/product_page.html"><h3 class="title"><?=$key->nama_umkm?></h3></a>
  								<p><?=$key->deskripsi_umkm?></p>
  							</div><!-- .entry_content -->
  						</div><!-- .grid_4 -->

  						<div class="grid_2">
  							<div class="cart">
  								<div class="price">
  									<?php 
  									$produk = $this->M_konsumen->jmlProdukByUmkm($key->id_umkm);
  									?>
  									<div class="price_old">Terdapat <?=$produk->jumlah?> produk</div>
  									<div class="price_old">$725.00</div>
  								</div>
  								<a href="<?=base_url()?>Konsumen/detailUmkm/<?=$key->id_umkm?>" class="bay">Learn more ... </a>
  							</div><!-- .cart -->
  						</div><!-- .grid_2 -->

  						<div class="clear"></div>
  					</div><!-- .article -->
  				<?php } ?>
  				<div class="clear"></div>
  			</div><!-- .listing_product -->

  			<div class="clear"></div>

  			<div class="pagination">
  				<?php echo $pagination; ?>
  			</div><!-- .pagination -->
  			<p class="pagination_info">Displaying 1 to 12 (of 100 products)</p>
  		</div><!-- #content -->

  		<div id="sidebar" class="grid_3">
  			<aside id="categories_nav">
  				<h3>Kategori</h3>

  				<nav class="left_menu">
  					<ul>
  						<?php foreach ($kategori as $key) { ?>
  							<li><a href="#"><?=$key->nama_kategori_umkm?> <span>(21)</span></a></li>
  						<?php } ?>
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
  		</div><!-- #sidebar -->

  		<div class="clear"></div>

  	</div><!-- .container_12 -->
  </section><!-- #main -->
  
  <div class="clear"></div>