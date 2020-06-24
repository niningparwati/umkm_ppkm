<div class="clear"></div>

<section id="main">
	<div class="container_12">      
		<div id="content" class="grid_9">
			<div class="options" style="border: none;">
				<div class="grid_6" style="height: 50px">
					<p style="font-size: 30px; font-family: Bitter, Myriad Pro, Verdana, serif; margin-top: 25px">
						<?php 
						if ($jenis == 'semua') {
							echo "SEMUA PRODUK";
						}else{
							echo "PRODUK ".strtoupper($jenis);
						}
						?>
					</p>
				</div>
			</div>

			<div class="grid_product">

				<?php foreach ($produk as $key) { ?>
					<a href="<?=base_url()?>Konsumen/detailProduk/<?=$key->id_produk?>">
						<div class="grid_3 product">
							<div class="prev">
								<?php if (!empty($key->foto_produk)) {?>
									<img src="<?=base_url()?>assets/foto_produk/<?=$key->foto_produk?>" style="width: 250px; height: 250px" />
								<?php }else{ ?>
									<img src="<?=base_url()?>assets/foto_produk/produk_default.png" style="width: 250px; height: 250px" />
								<?php } ?>
							</div><!-- .prev -->
							<h3 class="title"><?=$key->nama_produk?></h3>
							<div class="cart">
								<div class="price" style="width: 50%">
									<div class="vert">
										<div class="price_new">Rp <?=number_format($key->harga_produk,2,',','.')?></div>
									</div>
								</div>
								<div style="color: #2e9f9a; font-size: 13px" >
									<span style="padding-left: 10px">Stok : <br></span>
									<span style="padding-left: 10px"><?=$key->stok?> produk</span>
								</div>
							</div><!-- .cart -->
						</div><!-- .grid_3 -->
					</a>
				<?php } ?>

				<div class="clear"></div>
			</div><!-- .grid_product -->

			<div class="clear"></div>

			<?php if (empty($produk)) {
				echo "<center><h4>Produk kategori <?=$jenis?> tidak ditemukan</h4></center>";
			} ?>

			<?php if ($jumlah > $batas) { ?>
				<div class="pagination">
					<?=$pagination?>
				</div><!-- .pagination -->
			<?php }elseif(($jumlah < $batas) AND ($jumlah >0)){ ?>
				
			<?php }else{ ?>
				<center><h3>Produk tidak ditemukan</h3></center>
			<?php } ?>
		</div><!-- #content -->

		<div id="sidebar" class="grid_3">
			<aside id="categories_nav">
				<h3>Kategori Produk</h3>
				<nav class="left_menu">
					<ul style=" font-size: 13px">
						<li style="border: none;"><a href="<?=base_url()?>Konsumen/Produk/semua" style="text-decoration: none;">Semua Produk</a></li>
						<?php 
						foreach ($kategori as $key) {
							$idK = $key->id_kategori_produk;
							$produk = $this->M_konsumen->produkByKategori($idK);
							?>
							<li style="border: none;"><a href="<?=base_url()?>Konsumen/Produk/<?=$key->id_kategori_produk?>" style="text-decoration: none;"><?=$key->nama_kategori_produk?> <span>(<?=$produk->jumlah?>)</span></a></li>
							<?php 
						}
						?>
					</ul>
				</nav><!-- .left_menu -->
			</aside><!-- #categories_nav -->
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