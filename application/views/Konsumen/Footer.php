<?php 
  $cek = $this->M_konsumen->Kontak();
 ?>
<footer>
  <div class="f_navigation">
    <div class="container_12">
      <div class="grid_6">
        <h3>Kontak Kami</h3>
        <ul class="f_contact">
          <li><?=$cek->alamat?></li>
          <li><?=$cek->telepon?></li>
          <li><?=$cek->email?></li>
        </ul><!-- .f_contact -->
      </div><!-- .grid_3 -->
      
      <div class="grid_6">
        <h3>Sosial Media</h3>
        <nav class="f_menu">
          <ul>
            <li><a href="#">Website : <?=$cek->website?></a></li>
            <li><a href="#">Instagram : <?=$cek->instagram?></a></li>
            <li><a href="#">Facebook : <?=$cek->facebook?></a></li>
          </ul>
        </nav><!-- .private -->
      </div><!-- .grid_3 -->
      
      <div class="clear"></div>
    </div><!-- .container_12 -->
  </div><!-- .f_navigation -->
  
  <div class="f_info">
    <div class="container_12">
      <div class="grid_6">
        <p class="copyright">© Breeze Store Theme, 2012</p>
      </div><!-- .grid_6 -->
      
      <div class="grid_6">
        <div class="soc">
          <a class="google" href="#"></a>
          <a class="twitter" href="#"></a>
          <a class="facebook" href="#"></a>
        </div><!-- .soc -->
      </div><!-- .grid_6 -->
      
      <div class="clear"></div>
    </div><!-- .container_12 -->
  </div><!-- .f_info -->
</footer>

<!-- Sweetalert -->
<script src="<?= base_url() ?>assets/plugins/sweetalert/dist/sweetalert2.all.min.js"></script>
<script src="<?= base_url() ?>assets/js/sweetalert.js"></script>

<script src="<?= base_url()?>assets/jquery.min.js"></script> 
<script src="<?= base_url()?>assets/jquery.mask.min.js"></script>

<script src="<?=base_url()?>assets/konsumen/js/jquery-1.7.2.min.js"></script> 
<script src="<?=base_url()?>assets/konsumen/js/html5.js"></script>
<script src="<?=base_url()?>assets/konsumen/js/main.js"></script>
<script src="<?=base_url()?>assets/konsumen/js/jquery.carouFredSel-6.2.0-packed.js"></script>
<script src="<?=base_url()?>assets/konsumen/js/jquery.touchSwipe.min.js"></script>
<script src="<?=base_url()?>assets/konsumen/js/checkbox.js"></script>
<script src="<?=base_url()?>assets/konsumen/js/radio.js"></script>
<!-- <script src="<?=base_url()?>assets/konsumen/js/selectBox.js"></script> -->
<script src="<?=base_url()?>assets/konsumen/js/jquery.jqzoom-core.js"></script>

</body>
</html>