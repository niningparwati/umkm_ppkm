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
      <h1 class="page_title">Checkout</h1>
      <table class="cart_product">
        <tr>
          <th class="images">Gambar Produk</th>
          <th class="bg name">Nama Produk</th>
          <th class="bg price">Harga Produk</th>
          <th class="qty">Jumlah Produk</th>
          <th class="bg subtotal">Subtotal</th>
        </tr>
        <form method="POST" action="<?=base_url()?>Konsumen/Transaksi">

          <?php
          foreach ($produk as $key) {
            ?>
            <tr>
              <td class="images"><img src="<?=base_url()?>assets/foto_produk/<?=$key->foto_produk?>" alt="Product Slide 1"></td>
              <td class="bg name"><b><?=$key->nama_produk?></b><br/><?=$key->deskripsi_produk?></td>
              <td class="bg price">Rp <?=number_format($key->harga_produk,2,',','.')?></td>
              <td class="qty" style="padding-top: 30px">
                <?=$key->jumlah_produk?>
              </td>
              <td class="bg subtotal">
                <?php 
                $jml = $key->jumlah_produk;
                $hrg = $key->harga_produk;
                $total = $jml*$hrg;
                echo 'Rp '.number_format($total,2,',','.');
                ?>
              </td>
            </tr>
          <?php } ?>
          <tr>
            <td colspan="4" class="cart_but" style="float: center;font-size: 20px">
              Total Harga
            </td>
            <td colspan="2" style="float: center; font-size: 20px;">
              Rp<?=number_format($totalHarga,2,',','.')?>
            </td>
          </tr>
        </form>
      </table>
    </div><!-- .grid_12 -->

    <div class="clear"></div>

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
              <small>*note : pastikan alamat ditulis secara lengpar serta cantumkan nomor telepon dan nama penerima</small><br><br>
              <textarea name="detail_alamat" value="<?=$this->input->post('detail_alamat')?>" style="width: 91%;" required></textarea>
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
          <?php if ($alamat->provinsi AND $alamat->kota AND $alamat->detail_alamat) { ?>
            <h3>Alamat Pengiriman</h3>
            <p>
              <b>Provinsi :</b><br><?=$alamat->provinsi?><br>
              <b>Kabupaten / Kota :</b><br><?=$alamat->kota?><br>
              <b>Detail Alamat :</b><br>
              <?=$alamat->detail_alamat?>
            </p>
          <?php } ?>
          <h3>Estimasi Ongkos Kirim</h3>

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
             <a href="<?=base_url()?><?=$biaya['rajaongkir']['results'][0]['code']?>/Konsumen/updateBiaya/<?=$key['service']?>/<?=$key['cost'][0]['value']?>/<?=$key['cost'][0]['etd']?>"><input type="submit" id="apply_coupon" value="Pilih" /></a>
             <?php
           }
         }
         ?>

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

   <div class="clear"></div>
 </div><!-- #content_bottom -->
 <div class="clear"></div>

</div><!-- .container_12 -->
</section><!-- #main -->

<div class="clear"></div>

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