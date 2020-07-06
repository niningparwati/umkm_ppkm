<section id="main" class="entire_width">
	<div class="container_12">
		<div id="content">
			<div class="grid_12" id="checkout_info">
				<ul class="checkout_list">
					<li class="active">
						<div class="list_header">Pembayaran</div>
						<div class="list_body">
							<div style="text-align: right;"><span style="font-size: 12px">Total yang harus dibayar : </span><span style="font-weight: bold;">
								<?php if (!is_null($transaksi->besar_diskon)) { ?>
									<span style="color: red">Rp <?=number_format($transaksi->total_harga+$transaksi->ongkos_kirim-$transaksi->besar_diskon,0,',','.')?></span>
								<?php }else{ ?>
									<span style="color: red">Rp <?=number_format($transaksi->total_harga+$transaksi->ongkos_kirim,0,',','.')?></span>
								<?php } ?>

							</span></div>
							<form class="checkout_or" style="width: 50%;">
								<h3>ATM</h3>
								<strong>Petunjuk Pembayaran Melalui ATM</strong><br/>
								<p style="text-align: justify;margin-right: 45px">
									1. Pilih menu <b>TRANSFER ></b> kemudian pilih rekening yang akan dituju. <br>
									2. Pilih tujuan transfer <b>REKENING <?=$kontak->nama_bank?> ></b> kemudian masukan nomor rekening tujuan <b><?=$kontak->nomor_rekening?></b> atas nama <b><?=$kontak->pemilik_rekening?></b>. Jika transaksi dari bank yang berbeda maka masukan nomor kode Bank <?=$kontak->nama_bank?> (<b>009</b>) kemudian diikuti dengan nomor rekening <b><?=$kontak->nomor_rekening?></b><br>
									3. Masukan <b>jumlah nominal</b> yang akan ditransfer (pastikan nominal sesuai yang tertera pada bagian atas halaman ini). Setelah muncul konfirmasi, dan jika benar klik tombol <b>YA</b>.<br>
									4. Setelah transaksi berhasil dilakukan, maka bukti pembayaran akan dicetak pada mesin ATM <br>
									5. Upload bukti pembayaran dan lengkapi data pada form berikut. 
								</p>
								<br>
							</form>
							<form class="login" style="width: 50%">
								<h3>Mobile Banking</h3>
								<strong>Petunjuk Pembayaran Melalui Mobile Banking</strong><br/>
								<p style="text-align: justify;margin-right: 45px">
									1. Pilih menu <b>TRANSFER ></b> kemudian pilih rekening yang akan dituju. <br>
									Catatan : <br>
									- Jika menggunakan mbanking <?=$kontak->nama_bank?> maka pilih menu <b>"Antar <?=$kontak->nama_bank?>"</b>. <br> 
									- Jika menggunakan mbanking dari bank berbeda, maka pilih "Antar Bank". Kemudian pilih <b>"BANK <?=$kontak->nama_bank?>"</b><br>
									2. Masukan <b>jumlah nominal</b> yang harus ditransfer (pastikan nominal sesuai yang tertera pada bagian atas halaman ini)<br>
									3. Pada bagian <b>Keterangan</b> atau <b>Berita</b> ketikan <b>Pembayaran Produk UMKM</b>. Kemudian klik tombol <b>Lanjut</b><br>
									4. Masukan password mbanking, kemudian klik tombol <b>Lanjut</b><br>
									5. Setelah selesai, simpan bukti pembayaran tersebut (bisa di <i>screenshoot</i>)
									6. Upload bukti pembayaran dan lengkapi data pada form berikut. 
								</p>
								<br>
							</form>
							<form class="login"  style="width: 100%;" method="POST" action="<?=base_url()?>Konsumen/buktiBayar/<?=$transaksi->id_transaksi?>" enctype="multipart/form-data">
								<h3 style="text-align: center;">Upload Bukti Pembayaran</h3>
								<table>
									<tr>
										<td style="width: 20%;font-weight: bold;font-size: 14px;text-align: left;border: 1px solid #ffffff;">Foto Bukti Pembayaran </td>
										<td style="border: 1px solid #ffffff;"><input type="file" name="bukti" style="width: 90%; border-radius: 2px; border: 1px solid #ccc" required /><br><small style="float: left; margin-left: 30px">(*catatan : file dalam format .png atau . jpg atau .jpeg)</small></td>
										<td style="border: 1px solid #ffffff;">
											<br>
											<center><input type="submit" name="submit" value="Kirim" style="width: 70px;font: bold 14px/35px Segoeui-Bold, Arial, Verdana, serif; font-weight: bold;color: #fefefe" /></center><br>
										</td>
									</tr>
								</table>
							</form>
							<div class="clear"></div>
						</div><!-- .list_body -->
					</li>
					<br><br><br><br><br>
				</ul>
			</div><!-- .grid_9 -->
		</div><!-- #content -->
	</div>	<!-- .container_12 -->
	<div class="clear"></div>
</section>
<div class="clear"></div>