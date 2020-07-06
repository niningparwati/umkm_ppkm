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
    "key: 590213f97cfe285c488355e8c2138907"
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
     <table style="border:none; text-align: right;">
      <form action="<?=base_url()?>Konsumen/inputDiskon/<?=$transaksi->id_transaksi?>" method="POST">
        <tr>
          <td style="border: none;text-align: left;font-size: 30px; width: 60%">Checkout</td>
          <td style="border: none;">
            Masukan kode voucher &nbsp
          </td>
          <td style="border: none;text-align: right;">
            &nbsp &nbsp &nbsp <input type="text" name="kode_diskon" style="width: 80%; height: 30px">
          </td>
          <td style="border: none;text-align: right;">
            <button name="submit" type="submit" style="height: 30px; padding-right: 10px; padding-left: 10px;">Kirim</button>
          </td>
        </tr>
      </form>
    </table>
    <table class="cart_product">
      <tr>
        <th class="bg name" style="text-align: center;font-weight: bold;color: black">Gambar Produk</th>
        <th class="bg name" style="text-align: center;font-weight: bold;color: black">Nama Produk</th>
        <th class="bg price" style="text-align: center;font-weight: bold;color: black">Harga Produk</th>
        <th class="bg name" style="text-align: center;font-weight: bold;color: black">Jumlah Produk</th>
        <th colspan="2" class="bg subtotal" style="text-align: center;font-weight: bold;color: black">Subtotal</th>
      </tr>
      <!-- <form method="POST" action="<?=base_url()?>Konsumen/Transaksi"> -->
        <?php
        foreach ($produk as $key) {
          ?>
          <tr>
            <td class="images" style="border: none; vertical-align: middle;">
              <a href="<?=base_url()?>Konsumen/detailProduk/<?=$key->id_produk?>">
                <?php if (!empty($key->foto_produk)) { ?>
                  <img src="<?=base_url()?>assets/foto_produk/<?=$key->foto_produk?>" alt="Product Slide 1">
                <?php }else{ ?>
                  <img src="<?=base_url()?>assets/foto_produk/produk_default.png" alt="Product Slide 1">
                <?php } ?>
              </a>  
            </td>
            <td class="qty" style="border: none; vertical-align: middle;">
              <a href="<?=base_url()?>Konsumen/detailProduk/<?=$key->id_produk?>" style="text-decoration: none; color: black"><?=$key->nama_produk?></a>
            </td>
            <td class="qty" style="border: none; vertical-align: middle;">Rp <?=number_format($key->harga_produk,0,',','.')?></td>
            <td class="qty" style="padding-top: 30px; border: none; vertical-align: middle;">
              <?=$key->jumlah_produk?>
            </td>
            <td class="qty" colspan="2" style="border: none; vertical-align: middle;">
              <?php 
              $jml = $key->jumlah_produk;
              $hrg = $key->harga_produk;
              $total = $jml*$hrg;
              echo 'Rp '.number_format($total,0,',','.');
              ?>
            </td>
          </tr>
        <?php } ?>
        <tr>
          <td colspan="5" class="cart_but" style="text-align: right;font-size: 14px; border: none;">
            <br>
            <?php if (is_null($transaksi->besar_diskon)) { ?>
              Total Harga &nbsp : 
            <?php }else{ ?>
              Total Harga &nbsp : <br>
              Diskon &nbsp :
            <?php } ?>
          </td>
          <td colspan="1" class="cart_but" style="text-align: center; font-size: 14px; border: none;">
            <br>
            <?php if (is_null($transaksi->besar_diskon)) { ?>
              &nbsp &nbsp  <b> Rp <?=number_format($totalHarga,0,',','.')?></b>
            <?php }else{ ?>
              &nbsp &nbsp  <b>Rp <?=number_format($totalHarga,0,',','.')?></b>
              <br>
              &nbsp &nbsp  <b>Rp <?= number_format($transaksi->besar_diskon,0,',','.') ?></b>
            <?php } ?>
          </td>
        </tr>
        <!-- </form> -->
      </table>
    </div><!-- .grid_12 -->

    <div class="clear"></div>

    <div id="content_bottom" class="shopping_box">
      <div class="grid_4">
        <div class="bottom_block estimate">
          <h3>Alamat Pengiriman</h3>

          <p>Lengkapi alamat perngiriman produk!</p>
          <form method="POST">
            <p>
              <input type="hidden" name="provinsi" value="9" selected>
            </p>
            <p>
              <input type="hidden" name="kota" value="22" selected>
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
              <!-- <strong>Berat barang (gram)</strong><br/> -->
              <input type="text" name="berat" value="1000" placeholder="gram" hidden />
            </p>
            <input type="submit" name="submit" id="get_estimate" value="Cek Ongkir" />
          </form>

        </div><!-- .estimate -->
      </div><!-- .grid_4 -->

      <?php if (!empty($alamat->provinsi) AND !empty($alamat->kota) AND !empty($alamat->detail_alamat)) { ?>
        <div class="grid_4">
          <div class="bottom_block discount">

            <h3>Alamat Pengiriman</h3>
            <p>
              <b>Provinsi :</b><br><?=$alamat->provinsi?><br>
              <b>Kabupaten / Kota :</b><br><?=$alamat->kota?><br>
              <b>Detail Alamat :</b><br>
              <?=$alamat->detail_alamat?>
            </p>

            <?php if (!empty($alamat->ekspedisi_pengiriman) AND !empty($alamat->estimasi_pengiriman) AND !empty($alamat->ongkos_kirim)) {?>
              <h3>Estimasi Ongkos Kirim</h3>
              <b>Rp <?=number_format($alamat->ongkos_kirim,0,',','.')?></b><br>
              <span style="font-size: 13px">Ekspedisi Pengiriman : <?=$alamat->ekspedisi_pengiriman?><br></span>
              <span style="font-size: 13px">durasi pengiriman : <?=strtolower($alamat->estimasi_pengiriman) ?></span>
            <?php } ?>

            <?php 
            $biaya = json_decode($ongkir,true);
            if ($biaya['rajaongkir']['status']['code'] == '200') {
              foreach ($biaya['rajaongkir']['results'][0]['costs'] as $key) {
                ?>
                <!-- echo $key['service']; -->
                <b><?=$key['service']?></b>
                <p style="font-size: 12px">
                 Biaya ongkir: <b>Rp <?=number_format($key['cost'][0]['value'],0,',','.')?></b><br>
                 Estimasi pengiriman : <b><?=$key['cost'][0]['etd']?> hari</b>
               </p>
               <a href="<?=base_url()?>Konsumen/updateBiaya/<?=$transaksi->id_transaksi?>/<?=$biaya['rajaongkir']['results'][0]['code']?>/<?=$key['service']?>/<?=$key['cost'][0]['value']?>/<?=$key['cost'][0]['etd']?>" style="text-decoration: none;"><input type="submit" id="apply_coupon" value="Pilih" /></a>
               <?php
             }
           }
           ?>
         </div><!-- .discount -->
       </div><!-- .grid_4 -->
     <?php } ?>

     
     <div class="grid_4">
      <div class="bottom_block total">
        <table class="subtotal">
          <tr>
            <td style="width: 50%">Total Harga</td><td class="price">Rp <?=number_format($alamat->total_harga,0,',','.')?></td>
          </tr>
          <?php if (!empty($alamat->ongkos_kirim)) { ?>
            <tr>
              <td>Ongkos Kirim</td><td class="price">Rp <?=number_format($alamat->ongkos_kirim,0,',','.')?></td>
            </tr>
          <?php }if (!is_null($transaksi->besar_diskon)) { ?>
            <tr>
              <td>Diskon</td><td class="price">Rp <?=number_format($transaksi->besar_diskon,0,',','.')?></td>
            </tr>
          <?php } ?>

          <?php if (!is_null($transaksi->besar_diskon)) { ?>
            <tr >
              <td style="font-size: 15px"><b>Total Bayar</b></td>
              <?php $total = $alamat->total_harga+$alamat->ongkos_kirim-$transaksi->besar_diskon ?>
              <td class="price"><b>Rp <?=number_format($total,0,',','.')?></b></td>
            </tr>
          <?php }else{ ?>
            <tr >
              <td style="font-size: 15px"><b>Total Bayar</b></td>
              <?php $total = $alamat->total_harga+$alamat->ongkos_kirim ?>
              <td class="price"><b>Rp <?=number_format($total,0,',','.')?></b></td>
            </tr>
          <?php } ?>

        </table>
        <a href="<?=base_url()?>Konsumen/Pembayaran/<?=$transaksi->id_transaksi?>"><button class="checkout">LANJUTKAN PEMBAYARAN</button></a><br>
        <a style="color: red; text-decoration: none;" href="#" onclick="BatalkanTransaksi(<?=$alamat->id_transaksi?>)">Batalkan Pesanan</a>

      </div><!-- .total -->
    </div><!-- .grid_4 -->

    <div class="clear"></div>

  </div><!-- #content_bottom -->
  <div class="clear"></div>

</div><!-- .container_12 -->
</section><!-- #main -->

<div class="clear"></div>

<script type="text/javascript">

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

  function BatalkanTransaksi(id) {
    var id = id;

    Swal.fire({
      title: 'Konfirmasi!',
      text: "Anda yakin ingin membatalkan transaksi?",
      icon: 'warning',
      showCancelButton: true,
      cancelButtonText: "Tidak",
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Ya!'
    }).then((result) => {
      if (result.value) {
        location.href = '<?=base_url()?>Konsumen/BatalkanTransaksi/'+id
      }
    })
  }

</script>