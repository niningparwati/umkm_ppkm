<div class="clear"></div>

<section id="main" class="entire_width">
	<div class="container_12">      
		<div id="content">
			<div class="grid_12">
				<h4 class="page_title">Profile <?= ucwords($this->session->userdata('nama_konsumen')); ?></h4>
			</div><!-- .grid_12 -->

			<div class="grid_12">
				<form class="contact" style="width: 100%" method="POST" action="<?=base_urL()?>Konsumen/editProfil" enctype="multipart/form-data">
					<?php if (!is_null($foto_konsumen)) {?>
						<div>
							<center><img src="<?=base_urL()?>assets/foto_konsumen/<?=$foto_konsumen?>" style="width: 200px; height: 200px"></center>
							<br>
						</div>
					<?php } ?>
					<div class="name" style="width: 100%">
						<strong>Foto Profile :</strong><sup class="surely">*</sup><br/>
						<input type="file" name="foto_konsumen" style="width: 100%;border: 1px solid #ccc; height: 30px" required />
					</div><!-- .name -->

					<div class="name" style="width: 100%">
						<br>
						<strong>Nama Lengkap :</strong><sup class="surely">*</sup><br/>
						<input type="text" name="nama_konsumen" value="<?=$nama_konsumen?>" style="width: 98%" required />
					</div><!-- .name -->

					<div class="username" style="width: 100%">
						<strong>Username : </strong><sup class="surely">*</sup><br/>
						<input type="text" name="username_konsumen" value="<?=$username_konsumen?>" style="width: 98%" required />
					</div><!-- .email -->

					<div class="phone" style="width: 100%">
						<strong>Email :</strong><br/>
						<input type="email" name="email_konsumen" value="<?=$email_konsumen?>" style="width: 98%" required />
					</div><!-- .phone -->

					<div class="phone" style="width: 100%">
						<strong>Nomor Telepon :</strong><br/>
						<input type="text" name="nomor_telp_konsumen" value="<?=$no_telp?>" style="width: 98%" required />
					</div><!-- .phone -->

					<div class="phone" style="width: 100%">
						<strong>Jenis Kelamin :</strong><br/>
						<select name="jenis_kelamin" style="width: 100%" >
							<option value="Laki-Laki">Laki-Laki</option>
							<option value="Perempuan">Perempuan</option>
						</select>
					</div><!-- .phone -->

					<div class="comment" style="width: 100%">
						<br>
						<strong>Tanggal Lahir:</strong><sup class="surely">*</sup><br/>
						<input type="date" name="tanggal_lahir" value="<?=$tanggal_lahir?>" style="width: 100%; border: 1px solid #ccc; height: 30px" required />
					</div><!-- .comment -->

					<div class="submit" style="float: right;">
						<br><br>
						<input type="submit" value="Update" />
					</div><!-- .submit -->
				</form><!-- .contact -->
			</div><!-- .grid_8 -->
		</div><!-- #content -->

		<div class="clear"></div>
	</div><!-- .container_12 -->
</section><!-- #main -->

<div class="clear"></div>