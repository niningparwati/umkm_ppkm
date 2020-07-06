  <div class="clear"></div>
  
  <section id="main">
  	<div class="container_12">      
  		<div id="content" class="grid_9">
  			<h1 class="page_title" style="border-bottom: none;">
          <?php 
          if ($judul == "Semua"){ 
            echo $judul." UMKM";
          }else{
            echo "UMKM ".$judul;
          }
          ?>
        </h1>
        <div class="listing_product">
          <?php if (empty($umkm)) {
            echo "<center><h4>UMKM tidak ditemukan</h4></center>";
          } ?>
          <?php foreach ($umkm as $key) {
  					// $foto = $this->M_konsumen->fotoUmkm($key->id_umkm);  					
           ?>
           <div class="product_li">
            <div class="grid_3">
             <div class="prev">
              <a href="<?=base_url()?>Konsumen/detailUmkm/<?=$key->id_umkm?>/semua">
               <?php if (!empty($key->foto_user)) { ?>
                <img src="<?=base_url()?>assets/foto_user/<?=$key->foto_user?>" alt="" title="" />
              <?php }else{ ?>
                <img src="<?=base_url()?>assets/foto_umkm/store.png" alt="" title="" />
              <?php } ?>
            </a>
          </div><!-- .prev -->
        </div><!-- .grid_3 -->

        <div class="grid_3">
          <a href="<?=base_url()?>Konsumen/detailUmkm/<?=$key->id_umkm?>/semua">
           <div class="entry_content" style="font-size: 13px; color: black">
            <a href="<?=base_url()?>Konsumen/detailUmkm/<?=$key->id_umkm?>/semua"><h3 class="title"><?= substr($key->nama_umkm, 0, 20) ?><?php if (strlen($key->nama_umkm) > 20) { echo "..."; } ?></h3></a>
            <p>
              <?= substr($key->deskripsi_umkm, 0, 60) ?><?php if (strlen($key->deskripsi_umkm) > 60) { echo "..."; } ?> <br><br>
              <?php 
              $foto = $this->M_konsumen->fotoUmkm($key->id_umkm);
              foreach($foto as $a) { 
                ?>
                <?php if (!empty($a->foto)) { ?>
                  <img src="<?=base_url()?>assets/galeri_umkm/<?=$a->foto?>" style="width: 50px; height: 50px;">
                <?php }else{ ?>
                  <img src="<?=base_url()?>assets/foto_produk/produk_default.png" style="width: 50px; height: 50px;">
                <?php } ?>
              <?php } ?>
            </p>
          </div><!-- .entry_content -->
        </a> 
      </div><!-- .grid_4 -->

      <div class="grid_2">
       <div class="cart">
        <div class="price" style="font-size: 13px; color: black">
         <?php 
         $produk = $this->M_konsumen->jmlProdukByUmkm($key->id_umkm);
         ?>
         <div class="price_old">Terdapat <?=$produk->jumlah?> produk</div>
       </div>
       <a href="<?=base_url()?>Konsumen/detailUmkm/<?=$key->id_umkm?>/semua" class="bay" style="font-size: 13px;font-weight: normal;">Selengkapnya ... </a>
     </div><!-- .cart -->
   </div><!-- .grid_2 -->

   <div class="clear"></div>
 </div><!-- .article -->
<?php } ?>
<div class="clear"></div>
</div><!-- .listing_product -->

<div class="clear"></div>

<?php if ($jumlah > $batas) { ?>
  <div class="pagination">
    <?php echo $pagination; ?>
  </div><!-- .pagination -->
<?php } if(($jumlah < $batas) AND ($jumlah >0)){ ?>

<?php } ?>

</div><!-- #content -->

<div id="sidebar" class="grid_3">
 <aside id="categories_nav">
  <h4>Kategori UMKM</h4>

  <nav class="left_menu">
   <ul>
    <li style="border: none;"><a href="<?=base_url()?>Konsumen/Umkm/semua/0" style="text-decoration: none;font-size: 13px; color: black">Semua UMKM ( <?=$jumlah?> )</a></li>
    <?php foreach ($kategori as $key) { ?>
     <li style="border: none;"><a href="<?=base_url()?>Konsumen/Umkm/Kategori/<?=$key->id_kategori_umkm?>" style="text-decoration: none;font-size: 13px; color: black"><?=$key->nama_kategori_umkm?> ( <?= $this->M_konsumen->jmlUmkmByKategori($key->id_kategori_umkm)->jumlah ?> )</a></li>
   <?php } ?>
 </ul>
</nav><!-- .left_menu -->
</aside><!-- #categories_nav -->

<aside id="shop_by">
  <h4 style="font-size: 13px; color: black">Kabupaten/Kota</h4>

  <nav class="left_menu">
   <ul>
    <li><a href="<?=base_url()?>Konsumen/Umkm/semua/0" style="text-decoration: none;font-size: 13px; color: black">Semua UMKM</a></li>
    <?php foreach ($kabupaten as $key) {?>
      <li style="border: none;"><a href="<?=base_url()?>Konsumen/Umkm/Kota/<?=$key->kota_asal?>" style="text-decoration: none;font-size: 13px; color: black"><?= ucwords($key->kota_asal) ?></a></li>
    <?php } ?>
  </ul>
</nav>
<div class="clear"></div>

</div><!-- .container_12 -->
</section><!-- #main -->

<div class="clear"></div>