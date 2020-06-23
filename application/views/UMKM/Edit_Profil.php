<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">

   <!-- Content Wrapper. Contains page content -->
   <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Tambah Informasi
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Forms</a></li>
        <li class="active">General Elements</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <!-- form start -->
            <form role="form" id="edit" action="<?= $action?>/<?= $profil->id_umkm ?>" method="post" enctype="multipart/form-data">
              <div class="box-body">
                <div class="row">
                  <div class="col-md-3">
                      <div class="form-group">
                        <label for="Gambar">Foto User</label> <br>
                        <?php if ($foto) { ?>
                          <img src="<?= base_url()?>assets/foto_user/<?= $foto ?>" style="width: 150px; height: 150px"><br><br>
                        <?php }else{ ?>
                          <img src="<?= base_url()?>assets/foto_user/user.png ?>" style="width: 150px; height: 150px"><br><br>
                        <?php } ?>
                        <input type="file" name="foto_user" class="form-control">
                        <input type="hidden" name="foto_user" class="form-control" value="<?= $profil->foto_user ?>">
                      </div>
                  </div>
                  <div class="col-md-9">
                        <div class="form-group">
                          <label for="Judul">Nama Pemilik </label>
                          <input type="text" name="nama" class="form-control" value="<?= $profil->nama_lengkap ?>" >
                          <?php echo form_error('nama'); ?>
                        </div>
                        <div class="form-group">
                          <label for="Judul">Tanggal Lahir *Bulan/Tanggal/Tahun</label>
                          <input type="date" name="tanggal_lahir" class="form-control" value="<?= $profil->tanggal_lahir ?>" >
                          <?php echo form_error('tanggal_lahir'); ?>
                        </div>                        
                        <div class="form-group">
                          <label for="Konten">Email *optional</label>
                          <input type="text" name="email" class="form-control" value="<?= $profil->email ?>">
                        </div>
                        <div class="row">
                           <div class="col-md-4">
                              <div class="form-group">
                                <label for="">Username</label> <br>
                                <input type="text" name="username" class="form-control" value="<?= $profil->username ?>" >
                                <?php echo form_error('username'); ?>
                              </div>
                          </div>
                          <div class="col-md-4">
                              <div class="form-group">
                                <label for="">Ubah Password *optional</label> <br>
                                <input type="password" name="password" class="form-control" value="<?= $profil->username ?>" >
                                <?php echo form_error('password'); ?>
                              </div>
                          </div>
                        </div>
                        
                        <div class="form-group">
                          <label for="Judul">Nama UMKM</label>
                          <input type="text" name="nama_umkm" class="form-control" value="<?= $profil->nama_umkm ?>" >
                          <?php echo form_error('nama_umkm'); ?>
                        </div>
                         <div class="form-group">
                          <label for="kategori">Kategori UMKM</label>
                          <select class="form-control" name="id_kategori_umkm" >
                            <option value="" selected disabled>==PILIH==</option>
                            <?php foreach($kategori as $key){ ?>
                              <option value="<?=$key->id_kategori_umkm?>"  <?php if($key->id_kategori_umkm==$profil->id_kategori_umkm) echo "selected" ?>> <?=$key->nama_kategori_umkm?> </option>
                            <?php  } ?>
                          </select>
                          <?php echo form_error('id_kategori_umkm'); ?>
                        </div>
                         <div class="form-group">
                          <label for="Judul">No. Tlp UMKM</label>
                          <input type="text" name="nomor_telp_umkm" class="form-control" value="<?= $profil->nomor_telp_umkm ?>" >
                          <?php echo form_error('nomor_telp_umkm'); ?>
                        </div>
                        <div class="row">
                          <div class="col-md-6">
                             <div class="form-group">
                              <label for="Judul">Alamat UMKM</label>
                              <textarea name="alamat_umkm" class="form-control" ><?=$profil->alamat_umkm?></textarea>
                              <?php echo form_error('alamat_umkm'); ?>
                            </div>
                          </div>

                          <div class="col-md-3">
                              <div class="form-group">
                                <label for="Judul">Kota/Kabupaten</label>
                                <input type="text" name="kota_asal" class="form-control" value="<?= $profil->kota_asal ?>" >
                                <?php echo form_error('kota_asal'); ?>
                              </div>
                          </div>

                          <div class="col-md-3">
                             <div class="form-group">
                                <label for="Judul">Provinsi</label>
                                <input type="text" name="provinsi_asal" class="form-control" value="<?= $profil->provinsi_asal ?>" >
                                <?php echo form_error('provinsi_asal'); ?>
                              </div>                    
                          </div>                        
                          
                  </div>
                </div>
              
                
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <a href="<?= base_url()?>UMKM/Profil" class="btn btn-danger"><i class="fa fa-fw fa-arrow-left"></i>Kembali</a>
                <a class="btn btn-primary pull-right" data-toggle="modal" href="#" data-target="#editData">Update</a>
              </div>
            </form>
          </div>
        </div>
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>

  <div class="modal fade" id="editData" tabindex="-1" role="dialog" aria-hidden="true" aria-labelledby="ExampleModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="ExampleModalLabel">Konfirmasi Edit</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>Anda yakin ingin mengubah data profil?</p>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Tidak</button>
          <button type="submit" class="btn btn-primary" form="edit">Iya</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->

</body>
</html>