  <div class="clear"></div>
  
  <section id="main">
  	<div class="container_12">      
  		<div id="content" class="grid_12">
  			<div>
          <?php 
          if (!empty($informasi)) {
            foreach ($informasi as $key) {
              ?>
              <table style="border: none; margin-left: 10px" >
                <tr>
                  <td style="width: 20%; border: none;">
                    <?php if (!empty($key->gambar)) { ?>
                      <a href="<?=base_url()?>Konsumen/detailInformasi/<?=$key->id_informasi?>"><img src="<?=base_url()?>assets/foto_informasi/<?=$key->gambar?>" style="width: 190px; height: 190px;" /></a>
                    <?php }else{ ?>
                      <a href="<?=base_url()?>Konsumen/detailInformasi/<?=$key->id_informasi?>"><img src="<?=base_url()?>assets/foto_informasi/informasi.png" style="width: 190px; height: 190px" /></a>
                    <?php } ?>
                  </td>
                  <td style="text-align: justify; border: none;">
                    <article class="post" style="margin-left: 20px; margin-right: 20px">
                      <h2 class="title_article"><a href="<?=base_url()?>Konsumen/detailInformasi/<?=$key->id_informasi?>"><?=$key->judul_informasi?></a></h2>
                      <div class="content_article">
                        <?php if (strlen($key->isi_informasi) > 250) { ?>
                          <p><?= substr($key->isi_informasi,0,250) ?> ... </p>
                        <?php }else{ ?>
                          <p><?=$key->isi_informasi?></p>
                        <?php } ?>
                      </div><!-- .content_article -->
                      <div class="footer_article">
                        <span><span>Oleh : <a href="<?=base_url()?>Konsumen/detailUmkm/<?=$key->id_umkm?>/semua" style="text-decoration: none;"><?=$key->nama_umkm?></a></span>
                      </div>
                    </article>
                  </td>
                </tr>
              </table>
              <?php 
            }
          }
          ?>
        </div>
      </div><!-- .c_header -->

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