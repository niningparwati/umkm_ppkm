  <div class="clear"></div>
  
  <section id="main">
  	<div class="container_12">      
  		<div id="content" class="grid_12">
  			<h1 class="page_title">INFORMASI UMKM</h1>

  			<div>
  				<?php 
  				if (!empty($informasi)) { 
  					foreach ($informasi as $key) {
  						?>
  						<div class="grid_3 product" style="margin:8px">
  							<div class="prev">
  								<a href="<?=base_url()?>Konsumen/detailUmkm/<?=$key->id_umkm?>/semua"><img src="<?=base_url()?>assets/foto_informasi/<?=$key->gambar?>" style="width: 300px; height: 300px" /></a>
  							</div><!-- .prev -->
  							<h3 class="title"><?=$key->judul_informasi?></h3>
  							<p style="padding-left: 10px; padding-right: 10px; text-align: justify;"><?=$key->isi_informasi?></p>
  						</div><!-- .grid_3 -->
  						<?php 
  					}
  				}else{
  					echo "<h4>Tidak ada informasi UMKM</h4>";
  				} ?>
  				<div class="clear"></div>
  			</div><!-- .grid_product -->

  			<!-- <div class="clear"></div> -->
  			<br><br>
  			<?php if ( $jumlah > $batas) { ?>
  				<div class="pagination">
  					<?=$pagination?>
  				</div><!-- .pagination -->
  			<?php }elseif(($jumlah < $batas) AND ($jumlah >0)){ ?>

  			<?php } ?>
  		</div><!-- #content -->

  		<div class="clear"></div>

  	</div><!-- .container_12 -->
  </section><!-- #main -->

  <div class="clear"></div>