<!DOCTYPE html>
<html lang="en">
<?php $this->load->view($header); ?>

<body>
  <div id="app">
    <div class="main-wrapper">
      

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

          <!-- Formulir Tambah -->
          <div class="section-body">
            <div class="row">
              <div class="col-md-12">
                <div class="card">
                  <div class="card-body">
                    <strong style="font-size: 18px; color: black">Formulir Tambah</strong>
                    <hr>
                    <?= form_open_multipart('pimpinan/data/user/tambah', ['class' => 'formtambah']) ?>
                      <div class="form-group">
                        <div class="pesan" style="display: none;"></div>
                      </div>
                      <div class="row">
                        <div class="col-md-3">
                          <label for="name">Nama</label>
                        </div>
                        <div class="col-md-9">
                          <div class="form-group">
                            <input type="text" class="form-control" name="name" id="name">
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-3">
                          <label for="role_id">Role</label>
                        </div>
                        <div class="col-md-9">
                          <div class="form-group">
                            <select class="form-control" id="role_id" name="role_id">
                              <option id="pilihRole">Pilih role</option>
                              <option value="2">Admin</option>
                              <option value="1">Pimpinan</option>
                            </select>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-3">
                          <label for="email">Email</label>
                        </div>
                        <div class="col-md-9">
                          <div class="form-group">
                            <input type="text" class="form-control" id="email" name="email">
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-3">
                          <label for="password">Password</label>
                        </div>
                        <div class="col-md-9">
                          <div class="form-group">
                            <input type="password" class="form-control" name="password" id="password">
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-3">
                          <label for="password1">Ketik ulang password</label>
                        </div>
                        <div class="col-md-9">
                          <div class="form-group">
                            <input type="password" class="form-control" id="password1" name="password1">
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-3">
                        </div>
                        <div class="col-md-9">
                          <div class="form-group">
                            <button style="min-width: 100px;" type="submit" id="tambah" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah</button>
                            <a style="min-width: 100px; color: white;" id="loading" class="menyembunyikan btn btn-primary"><img src="<?= base_url('vendor'); ?>/loading/loading1.gif" width="20"> Tunggu</a>
                          </div>
                        </div>
                      </div> 
                    <?= form_close(); ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- Formulir Tambah Ends -->

          <!-- Data Tables -->
          <div class="section-body">
	          <div class="row">
	            <div class="col-md-12">
        				<div class="card">
      				    <div class="card-body">
                    <div>
                      <strong style="font-size: 18px; color: black; float: left; margin-top: 40px"><i class="fa fa-calendar"></i> <span class="tglData"><?= date('d/m/Y') ?></span></strong>
                    </div>
          					<div class="table-responsive">
                      <hr>
          	 				  <table id="tb_user" class="table table-striped display nowrap" style="width:100%">
            						<thead>
            						  <tr>
            					 		  <th style="width: 1%">No</th>
            							  <th style="width:10%">Foto</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Tanggal Registrasi</th>
                            <th>Status</th>
            						    <th>Aksi</th>
            			 			  </tr>
            						</thead>
                        <tbody>
                            
                  			</tbody>
        						  </table>
                		</div>
      					  </div>
        				</div>
	            </div>
            </div>
	        </div>
          <!-- Data Tables Ends -->

        </section>
      </div>
      <!-- Main Content Ends -->

      <!-- Footer -->
      <?php $this->load->view($footer); ?>
      <!-- Footer Ends -->
    </div>
  </div>

  <!-- Modal -->
  	<div class="viewmodal" style="display: none;"></div>
  <!-- Modal Ends -->
 
  <!-- General JS Scripts -->
  <?php $this->load->view($script_general); ?>
  <!-- General JS Scripts Ends -->

  <!-- JS Libraies -->

  <!-- Page Specific JS File -->
  <script>
  function tampil_data() {
    $('#tb_user').DataTable({
          rowReorder: {
            selector: 'td:nth-child(2)'
          },
          responsive: true,
          "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
          "info": false,
          "destroy": true,
          "processing": true,
          "serverSide": true,
          "order": [],

          "ajax": {
              "url": "<?= site_url('pimpinan/data/user/get_tabel'); ?>",
              "type": "POST",
              "data":{
              },
          },
    });
  }


  $(document).ready(function(){
    tampil_data();

      $('.formtambah').submit(function(e){
        $('#loading').removeClass('menyembunyikan');
        $('#tambah').addClass('menyembunyikan');
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
                $('#loading').addClass('menyembunyikan');
                $('#tambah').removeClass('menyembunyikan');
                $('.pesan').html(response.error).show();
              }
              if (response.sukses) {
                $('#loading').addClass('menyembunyikan');
                $('#tambah').removeClass('menyembunyikan');
                Swal.fire({
                  icon: 'success',
                  title: 'Selamat!',
                  text: response.sukses
                });
                $('#name').val("");
                $('#pilihRole').prop('selected', true);
                $('#email').val("");
                $('#password').val("");
                $('#password1').val("");
                tampil_data();
              }
            },
            error: function(xhr, ajaxOptions, thrownError) {
              alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
          });
          return false;
      });

  });

  function view(id) {
    $.ajax({
      type: 'post',
      url: "<?= site_url('pimpinan/data/user/form_view'); ?>",
      data: {
          id: id
      },
      dataType: "json",
      success: function(response) {
        if (response.sukses) {
          $('.viewmodal').html(response.sukses).show();
          $('#view').modal('show');
        }
      }
    });
  }

  function hapus(id) {
    Swal.fire({
            title: `Hapus data`,
            text: `Apakah anda yakin?`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Hapus',
            cancelButtonText: 'Tidak'
          }).then((result) => {
            if (result.value) {
              $.ajax({
                type: "post",
                url: "<?= site_url('pimpinan/data/user/hapus'); ?>",
                data: {
                  id : id
                },
                dataType: "json",
                success: function(response) {
                  if (response.sukses) {
                    Swal.fire({
                    icon: 'success',
                    title: 'Selamat',
                    text: response.sukses
                    })
                    tampil_data();
                    sum();
                  } else {
                    Swal.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    text: response.gagal
                    })
                    tampil_data();
                    sum();
                  }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                  alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
              });
            }
          })
  }
  </script>

</body>
</html>
