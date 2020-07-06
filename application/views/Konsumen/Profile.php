<!--Sweet Alert -->
<?php if($this->session->flashdata('success_profil')) { ?>
  <div class="success-flash" data-success="<?= $this->session->flashdata('success_profil') ?>"></div>
<?php } else if ($this->session->flashdata('error_profil')) { ?>
  <div class="error-flash" data-error="<?= $this->session->flashdata('error_profil') ?>"></div>
<?php }else if ($this->session->flashdata('warning_profil')) {?>
  <div class="warning-flash" data-warning="<?= $this->session->flashdata('warning_profil') ?>"></div>
<?php } ?>
<!-- End Sweet Alert -->

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
							<center>
								<?php if (!empty($foto_konsumen)) { ?>
									<img src="<?=base_urL()?>assets/foto_konsumen/<?=$foto_konsumen?>" style="width: 200px; height: 200px">
								<?php }else{ ?>
									<img src="<?=base_urL()?>assets/foto_konsumen/konsumen.png" style="width: 200px; height: 200px">
								<?php } ?>
							</center>
							<br>
						</div>
					<?php } ?>
					<div class="name" style="width: 98%">
						<strong>Foto Profile </strong><small style="font-size: 10px">(format png, jpg, atau jpeg)</small><br/>
						<input type="file" name="foto_konsumen" style="width: 100%;border: 1px solid #ccc; height: 30px" />
					</div><!-- .name -->

					<div class="name" style="width: 100%">
						<br>
						<strong>Nama Lengkap </strong><sup class="surely">*</sup><br/>
						<input type="text" name="nama_konsumen" value="<?=$nama_konsumen?>" style="width: 98%" required />
					</div><!-- .name -->

					<div class="username" style="width: 100%">
						<strong>Username  </strong><sup class="surely">*</sup><br/>
						<input type="text" name="username_konsumen" value="<?=$username_konsumen?>" style="width: 98%" required />
					</div><!-- .email -->

					<div class="phone" style="width: 100%">
						<strong>Email </strong><br/>
						<input type="email" name="email_konsumen" value="<?=$email_konsumen?>" style="width: 98%" required />
					</div><!-- .phone -->

					<div class="phone" style="width: 100%">
						<strong>Nomor Telepon </strong><br/>
						<input type="text" name="nomor_telp_konsumen" value="<?=$no_telp?>" style="width: 98%" required />
					</div><!-- .phone -->

					<div class="phone" style="width: 100%">
						<strong>Jenis Kelamin </strong><br/>
						<select name="jenis_kelamin" style="width: 98%" >
							<?php if ($jenis_kelamin == 'Laki-Laki') {?>
								<option value="Laki-Laki">Laki-Laki</option>
								<option value="Perempuan">Perempuan</option>
							<?php }else{ ?>
								<option value="Perempuan">Perempuan</option>
								<option value="Laki-Laki">Laki-Laki</option>
							<?php } ?>
						</select>
					</div><!-- .phone -->

					<div class="comment" style="width: 100%">
						<br>
						<strong>Tanggal Lahir</strong><sup class="surely">*</sup><br/>
						<input type="date" name="tanggal_lahir" value="<?=$tanggal_lahir?>" max="<?=date('Y-m-d', strtotime('-1 days', strtotime(date('Y-m-d'))))?>" style="width: 98%; border: 1px solid #ccc; height: 30px" />
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