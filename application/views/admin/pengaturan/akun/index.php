<!DOCTYPE html>
<html lang="en">
<?php $this->load->view($header); ?>

<body>
  <div id="app">
    <div class="main-wrapper">
      <div class="navbar-bg"></div>
      <!-- Navbar -->
      <?php $this->load->view($navbar); ?>
      <!-- Navbar Ends -->

      <!-- Sidebar -->
      <?php $this->load->view($sidebar); ?>
      <!-- Sidebar Ends -->
      
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1><?= $judul; ?></h1>
          </div>

          <!-- Content -->
            <div class="section-body">
              <div class="row">
                <div class="col-12 col-md-12">
                  <div class="card profile-widget">
                    <div class="profile-widget-header">
                      <img alt="image" id="profil1" src="" class="rounded-circle profile-widget-picture">
                      <div class="profile-widget-items">
                        <div class="profile-widget-item">
                          <div class="profile-widget-item-label">Role</div>
                          <div class="profile-widget-item-value"><?= $user['role_id'] == '2' ? 'Admin' : 'Pimpinan' ?>
                          </div>
                        </div>
                        <div class="profile-widget-item">
                          <div class="profile-widget-item-label">User Since</div>
                          <div class="profile-widget-item-value"><?= date('d F Y', $user['date_created']) ?></div>
                        </div>
                        <div class="profile-widget-item">
                          <div class="profile-widget-item-label">Status</div>
                          <div class="profile-widget-item-value"><?= $user['is_active'] == '1' ? 'Aktif' : '' ?>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="profile-widget-description">
                      <?= form_open_multipart('admin/pengaturan/akun/ganti_password', ['class' => 'formpassword']) ?>
                        <div class="card-body">
                          <strong style="font-size: 18px; color: black">Ganti Password</strong>
                          <hr>
                          <div class="form-group">
                            <div class="pesan_password" style="display: none;"></div>
                          </div>
                          <input type="hidden" name="id" id="id" value="<?= $user['id'] ?>">
                          <div class="row">
                            <div class="col-md-3">
                              <label for="current_password">Password saat ini</label>
                            </div>
                            <div class="col-md-9">
                              <div class="form-group">
                                <input type="password" class="form-control" id="current_password" name="current_password">
                              </div>
                            </div>
                          </div>
                          
                          <div class="row">
                            <div class="col-md-3">
                              <label for="new_password1">Password baru</label>
                            </div>
                            <div class="col-md-9">
                              <div class="form-group">
                                <input type="password" class="form-control" id="new_password1" name="new_password1">
                              </div>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-md-3">
                              <label for="new_password2">Ketik ulang password</label>
                            </div>
                            <div class="col-md-9">
                              <div class="form-group">
                                <input type="password" class="form-control" id="new_password2" name="new_password2">
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="card-footer text-right">
                          <button style="min-width: 100px;" type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
                        </div>
                      <?= form_close(); ?>
                    </div>
                  </div>
                  <div class="card profile-widget">
                    <div class="profile-widget-description">
                      <?= form_open_multipart('admin/pengaturan/akun/edit', ['class' => 'formedit']) ?>
                        <div class="card-body">
                          <strong style="font-size: 18px; color: black">Edit Profil</strong>
                          <hr>
                          <div class="form-group">
                            <div class="pesan" style="display: none;"></div>
                          </div>
                          <input type="hidden" name="id" id="id" value="<?= $user['id'] ?>">
                          <div class="row">
                            <div class="col-md-3">
                              <label for="email">Email</label>
                            </div>
                            <div class="col-md-9">
                              <div class="form-group">
                                <input type="text" class="form-control" id="email" name="email" value="<?= $user['email'] ?>" readonly>
                              </div>
                            </div>
                          </div>
                          
                          <div class="row">
                            <div class="col-md-3">
                              <label for="name">Nama</label>
                            </div>
                            <div class="col-md-9">
                              <div class="form-group">
                                <input type="text" class="form-control" id="name" name="name">
                              </div>
                            </div>
                          </div>
                          
                          <div class="row">
                            <div class="col-md-3">
                              <label for="image">Foto Profil</label>
                            </div>
                            <div class="col-md-3">
                              <div class="form-group">
                                <img id="profil2" style="display: block; margin-right: auto; width: 100%;" alt="image" src="" class="img-thumbnail mb-1">
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group">
                                <input type="file" class="form-control" name="image" id="image">
                                <footer class="blockquote-footer"><cite title="Source Title">Hanya jpg, jpeg, png dan maksimal ukuran 2048kb.</cite></footer>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="card-footer text-right">
                          <button style="min-width: 100px;" type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
                        </div>
                      <?= form_close(); ?>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          <!-- Content Ends -->

        </section>
      </div>
      <!-- Main Content Ends -->

      <!-- Footer -->
      <?php $this->load->view($footer); ?>
      <!-- Footer Ends -->
    </div>
  </div>

  <!-- Modal -->
    
  <!-- Modal Ends -->

  
  <!-- General JS Scripts -->
  <?php $this->load->view($script_general); ?>
  <!-- General JS Scripts Ends -->

  <script type="text/javascript">
    function data(){
      $.ajax({
          type  : 'POST',
          url   : '<?= site_url()?>admin/pengaturan/akun/profil',
            data:{
                      id : <?= $user['id'] ?>,
                  },
       dataType : 'json',
        success : function(profil){
          var image = '<?= base_url(); ?>assets/uploads/profil/'+profil.image;
                  $('#name').val(profil.name);
                  $('#profil1').attr('src', image);
                  $('#profil2').attr('src', image);
                  $('#akun').html("Hi, "+profil.name); 

                  
          }
      });
    }

    $(document).ready(function(){
      data();
      $('.formpassword').submit(function(e){
          $.ajax({
            type: "post",
            url: $(this).attr('action'),
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            dataType: "json",

            success: function(response) {
              if (response.validasi) {
                $('.pesan_password').html(response.validasi).show();
              }
              if (response.error) {
                Swal.fire({
                  icon: 'error',
                  title: 'Error!',
                  text: response.error
                });
              }
              if (response.sukses) {
                Swal.fire({
                  icon: 'success',
                  title: 'Selamat!',
                  text: response.sukses
                });
                $('#current_password').val("");
                $('#new_password1').val("");
                $('#new_password2').val("");
              }
            },
            error: function(xhr, ajaxOptions, thrownError) {
              alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
          });
          return false;
      });
      $('.formedit').submit(function(e){
          $.ajax({
            type: "post",
            url: $(this).attr('action'),
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            dataType: "json",

            success: function(response) {
              if (response.error) {
                $('.pesan').html(response.error).show();
              }
              if (response.sukses) {
                Swal.fire({
                  icon: 'success',
                  title: 'Selamat!',
                  text: response.sukses
                });
                $('#image').val(""); 
                data();
              }
            },
            error: function(xhr, ajaxOptions, thrownError) {
              alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
          });
          return false;
      });

  });
  </script>

</body>
</html>
