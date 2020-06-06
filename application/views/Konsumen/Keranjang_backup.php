<?php 

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://api.rajaongkir.com/starter/province",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_HTTPHEADER => array(
    "key: 28b6e68fb3460455044054d3d955e252"
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  $provinsi = json_decode($response, true);
  // var_dump($response);
}

?>

<div class="clear"></div>

<section id="main" class="entire_width">
  <div class="container_12">
   <div class="grid_12">
    <h1 class="page_title">Keranjang Belanja</h1>
    <?php 
    $cek1 = $this->M_konsumen->cekIdTransaksi($this->session->userdata('id_konsumen'));  // cek produk di tabel transaksi status menunggu konfirmasi
    
    if (!is_null($produk) AND is_null($cek1)) {
      ?>
      <table class="cart_product">
       <tr>
        <th class="edit"> </th>
        <th class="images"></th>
        <th class="bg name">Nama Produk</th>
        <th class="bg price">Harga Produk</th>
        <th class="qty">Jumlah Produk</th>
        <th class="bg subtotal">Subtotal</th>
        <th class="close"> </th>
      </tr>
      <form method="POST" action="<?=base_url()?>Konsumen/Transaksi">

        <?php
        foreach ($produk as $key) {
          $cek = $this->M_konsumen->getKeranjang($key->id_keranjang);
          $jml = $cek->jumlah_barang;
          $stok = $this->M_konsumen->produkById($cek->id_produk)->stok;
          if ($jml > $stok) {
            $data = array(
              'jumlah_barang' => $stok
            );
            $this->M_konsumen->updateKeranjang($data, $key->id_keranjang);
          }
          ?>
          <tr>
            <td><input type="checkbox" name="keranjang[]" id="undefined" value="<?=$key->id_keranjang?>" tabindex="0" style="margin-top: 20px"></td>
            <td class="images"><a href="<?=base_url()?>Konsumen/detailProduk/<?=$key->id_produk?>"><img src="<?=base_url()?>assets/foto_produk/<?=$key->foto_produk?>" alt="Product Slide 1"></a></td>
            <td class="bg name"><b><?=$key->nama_produk?></b><br/><?=$key->deskripsi_produk?></td>
            <td class="bg price">Rp <?=number_format($key->harga_produk,2,',','.')?></td>
            <td class="qty" style="padding-top: 30px">
              <a href="<?=base_url()?>Konsumen/kurangiBarang/<?=$key->id_keranjang?>"><img src="<?=base_url()?>assets/konsumen/images/primary-minus.png" style="width: 8px; padding-right: 10px"></a>
              <?=$key->jumlah_barang?>
              <a href="<?=base_url()?>Konsumen/tambahBarang/<?=$key->id_keranjang?>"><img src="<?=base_url()?>assets/konsumen/images/primary-plus.png" style="width: 8px; padding-left: 10px"></a>
            </td>
            <td class="bg subtotal">
             <?php 
             $jml = $key->jumlah_barang;
             $hrg = $key->harga_produk;
             $total = $jml*$hrg;
             echo 'Rp '.number_format($total,2,',','.');
             ?>
           </td>
           <td class="close">
            <!-- MODAL HAPUS PRODUK-->
            <div>
              <label class="modal1-open modal1-label close1" for="modal1-open"><img src="<?=base_url()?>assets/konsumen/images/close.png"></label>
              <input type="radio" name="modal1" value="open" id="modal1-open" class="modal1-radio">

              <div class="modal1">
                <label class="modal1-label overlay"><input type="radio" name="modal1" value="close1" class="modal1-radio"/></label>
                <div class="content1">
                  <div class="top1">
                    <b>Anda yakin produk ini akan dihapus dari keranjang?</b>
                    <label class="modal1-label close-btn1">
                      <input type="radio" name="modal1" value="close1" class="modal1-radio"/>
                    </label>
                  </div>
                  <div class="footer1">
                    <br><br>
                    <a href="<?=base_url()?>Konsumen/Keranjang/<?=$this->session->userdata('id_konsumen')?>"><button type="button" style="padding: 8px; background: #7b808a" class="btn1 btn-default pull-left1" data-dismiss="modal1-label">Tidak</button></a>
                    <a href="<?=base_url()?>Konsumen/hapusProduk/<?=$key->id_produk?>"><button type="button" style="padding: 8px;margin-left: 350px; width: 50px; text-align: center; background: #DD4B39" class="btn1 btn-default pull-right" data-dismiss="modal1">Ya</button></a>
                  </div>
                </div>
              </div>
            </div>
            <!-- MODAL -->

          </td>
        </tr>
      <?php } ?>
      <tr>
       <td colspan="7" class="cart_but">

        <!-- MODAL HAPUS KERANJANG-->
        <div style="float: left;">
          <label class="modal-open modal-label" for="modal-open"><p><img src="<?=base_url()?>assets/konsumen/images/delete.png" style="width: 12px;"> Kosongkan keranjang</p></label>
          <input type="radio" name="modal" value="open" id="modal-open" class="modal-radio">

          <div class="modal">
            <label class="modal-label overlay"><input type="radio" name="modal" value="close" class="modal-radio"/></label>
            <div class="content">
              <div class="top">
                <b>Anda yakin semua produk dalam keranjang akan dihapus?</b>
                <label class="modal-label close-btn">
                  <input type="radio" name="modal" value="close" class="modal-radio"/>
                </label>
              </div>
              <div class="footer">
                <br><br>
                <a href="<?=base_url()?>Konsumen/Keranjang/<?=$this->session->userdata('id_konsumen')?>"><button type="button" style="padding: 8px; background: #7b808a" class="btn btn-default pull-left" data-dismiss="modal-label">Tidak</button></a>
                <a href="<?=base_url()?>Konsumen/hapusKeranjang"><button type="button" style="padding: 8px;margin-left: 350px; width: 50px; text-align: center; background: #DD4B39" class="btn btn-default pull-right" data-dismiss="modal">Ya</button></a>
              </div>
            </div>
          </div>
        </div>
        <!-- MODAL -->

        <button class="update" name="submit" type="submit"><img src="<?=base_url()?>assets/konsumen/images/bg_cart_nav.png"> Checkout Barang</button>
      </td>
    </tr>
  </form>
</table>
</div><!-- .grid_12 -->
<?php } else{ ?>
<?php } ?>

<div class="clear"></div>

<?php 
  $cek1 = $this->M_konsumen->cekIdTransaksi($this->session->userdata('id_konsumen'));  // cek produk di tabel transaksi status menunggu konfirmasi
  if (!is_null($cek1) AND !is_null($produk)) {  // mengecek data di tabel transaksi dan tabel keranjang
    ?>
    <table class="cart_product" style="text-align: center;">
      <tr>
        <th class="bg name" style="text-align: center;"><b>Gambar Produk</b></th>
        <th class="bg price" style="text-align: center;"><b>Nama Produk</b></th>
        <th class="bg name" style="text-align: center;"><b>Harga Produk</b></th>
        <th class="bg price" style="text-align: center;"><b>Jumlah Produk</b></th>
        <th class="bg name" style="text-align: center;"><b>Subtotal</b></th>
      </tr>
      <?php 
      // $cek2 = $this->M_konsumen->produkCheckout($cek1->id_transaksi);
      foreach ($produk as $key) {
        ?>
        <tr>
          <td class="images" style="text-align: center;"><img src="<?=base_url()?>assets/foto_produk/<?=$key->foto_produk?>"></td>
          <td class="qty" style="text-align: center; padding-top: 50px"><?=$key->nama_produk?></td>
          <td class="bg name" style="text-align: center; padding-top: 50px">Rp <?=number_format($key->harga_produk,2,',','.')?></td>
          <td class="qty" style="text-align: center; padding-top: 50px"><?=$key->jumlah_barang?></td>
          <td class="bg name" style="text-align: center; padding-top: 50px"><?=$key->jumlah_barang?></td>
        </tr>
      <?php } ?>
    </table>
    <div id="content_bottom" class="shopping_box">
      <div class="grid_4">
        <div class="bottom_block estimate">
          <h3>Alamat Pengiriman</h3>

          <p>Enter your destination to get a shipping estimate.</p>
          <form method="POST">
            <p>
              <strong>Provinsi Asal:</strong><sup class="surely">*</sup><br/>
              <select id="provinsi" name="provinsi" style="width: 100%">
                <option>------ pilih provinsi asal ------</option>
                <?php 
                $biaya = json_decode($ongkir);
                if ($provinsi['rajaongkir']['status']['code'] == '200') {
                  foreach ($provinsi['rajaongkir']['results'] as $prov) {
                    ?>
                    <!--       echo "<option value='".$prov['province_id']."' ".($prov['province_id'] == $this->input->post('provinsi') ? "selected" : "").">".$prov['province']."</option>"; -->
                    <option value="<?=$prov['province_id']?>" <?php if( $prov['province_id'] ==  $this->input->post('provinsi') ){ ?> selected="selected" <?php }?>><?=$prov['province']?></option>
                    <?php
                  }
                }
                ?>
              </select>
            </p>
            <p>
              <strong>Kota Asal:</strong><br/>
              <select id="kota" name="kota" style="width: 100%">
                <option>-------- pilih kota asal --------</option>
              </select>
            </p>
            <p>
              <strong>Provinsi Tujuan:</strong><sup class="surely">*</sup><br/>
              <select id="provinsi_tujuan" nama="provinsi_tujuan" style="width: 100%">
                <option>------ pilih provinsi ------</option>
                <?php 
                if ($provinsi['rajaongkir']['status']['code'] == '200') {
                  foreach ($provinsi['rajaongkir']['results'] as $prov) {
                    echo "<option value='".$prov['province_id']."' ".($prov['province_id'] == $this->input->post('provinsi_tujuan') ? "selected" : "").">".$prov['province']."</option>";
                  }
                }
                ?>
              </select>
            </p>
            <p>
              <strong>Kota Tujuan:</strong><br/>
              <select id="kota_tujuan" name="kota_tujuan" style="width: 100%">
                <option>-------- pilih kota tujuan --------</option>
              </select>
            </p>
            <p>
              <strong>Detail Alamat</strong><br/>
              <textarea name="detail_alamat" value="<?=$this->input->post('detail_alamat')?>" style="width: 91%;"></textarea>
            </p>
            <p>
              <strong>Pilih Ekspedisi</strong><br/>
              <select id="ekspedisi" name="ekspedisi" style="width: 100%">
                <option>-------- pilih ekspedisi --------</option>
                <?php 
                $eks = ['jne' => 'JNE', 'pos' => 'POS', 'tiki' => 'TIKI'];
                foreach ($eks as $key => $value) {
                  echo "<option value='".$key."' ".($key == $this->input->post('ekspedisi') ? "selected": "")." >".$value."</option>";
                }
                ?>
              </select>
            </p>
            <p>
              <strong>Berat barang (gram)</strong><br/>
              <input type="text" name="berat" value="<?=$this->input->post('berat')?>" placeholder="gram" />
            </p>
            <input type="submit" name="submit" id="get_estimate" value="Cek Ongkir" />
          </form>

        </div><!-- .estimate -->
      </div><!-- .grid_4 -->

      <div class="grid_4">
        <div class="bottom_block discount">
          <h3>Estimasi Ongkos Kirim</h3>

          <form>
            <?php 
            $biaya = json_decode($ongkir,true);
            if ($biaya['rajaongkir']['status']['code'] == '200') {
              foreach ($biaya['rajaongkir']['results'][0]['costs'] as $key) {
                ?>
                <!-- echo $key['service']; -->
                <b><?=$key['service']?></b>
                <p style="font-size: 12px">
                 Biaya ongkir: <b>Rp <?=number_format($key['cost'][0]['value'],2,',','.')?></b><br>
                 Estimasi pengiriman : <b><?=$key['cost'][0]['etd']?> hari</b>
               </p>
               <?php
             }
           }
           ?>
           <input type="submit" id="apply_coupon" value="Apply Coupon" />
         </form>
       </div><!-- .discount -->
     </div><!-- .grid_4 -->

     <div class="grid_4">
      <div class="bottom_block total">
       <table class="subtotal">
         <tr>
           <td>Subtotal</td><td class="price">$1, 500.00</td>
         </tr>
         <tr class="grand_total">
           <td>Grand Total</td><td class="price">$1, 500.00</td>
         </tr>
       </table>
       <button class="checkout">PROCEED TO CHECKOUT</button>
       <a href="#">Checkout with Multiple Addresses</a>
     </div><!-- .total -->
   </div><!-- .grid_4 -->

 <?php } ?>

 <div class="clear"></div>
</div><!-- #content_bottom -->
<div class="clear"></div>

</div><!-- .container_12 -->
</section><!-- #main -->

<div class="clear"></div>

<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> -->
<!-- <script>
  // menampilkan kota asal pengiriman
  $(document).ready(function(){
    $('#origin_province').change(function(){

      var province_id=$('#origin_province').val();
      $.get('<?php echo site_url('Konsumen/get_city_by_province/') ?>'+province_id, function(resp){
        // console.log(resp);
        $('#origin_city').html(resp);
      });
    });
  });


  // menampilkan kota tujuan pengiriman
  $(document).ready(function(){
    $('#destination_province').change(function(){

      var province_id=$('#destination_province').val();
      $.get('<?php echo site_url('Konsumen/get_city_by_province/') ?>'+province_id, function(resp){
        // console.log(resp);
        $('#destination_city').html(resp);
      });
    });
  });
</script> -->

<script type="text/javascript">
  document.getElementById('provinsi').addEventListener('change', function(){

    fetch("<?= base_url('konsumen/kota/') ?>"+this.value,{
      method:'GET'
    })
    .then((response) => response.text())
    .then((data) => {
      console.log(data)
      document.getElementById('kota').innerHTML = data
    })
  })

  document.getElementById('provinsi_tujuan').addEventListener('change', function(){

    fetch("<?= base_url('konsumen/kota/') ?>"+this.value,{
      method:'GET'
    })
    .then((response) => response.text())
    .then((data) => {
      console.log(data)
      document.getElementById('kota_tujuan').innerHTML = data
    })
  })
</script>
