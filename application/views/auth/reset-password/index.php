<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title><?= $judul; ?></title>

  <link rel="icon" href="<?= base_url('assets/uploads/sistem/default.png'); ?>" type="image/png">

  <!-- General CSS Files -->
  <link rel="stylesheet" href="<?= base_url('vendor'); ?>/stisla-master/bootstrap-4.3.1/bootstrap.min.css">
  <link rel="stylesheet" href="<?= base_url('vendor'); ?>/stisla-master/fontawesome-free/css/all.min.css">

  <!-- CSS Libraries -->
  <!-- Sweet Alert2 -->
  <link rel="stylesheet" href="<?= base_url('vendor'); ?>/sweetalert2/dist/sweetalert2.min.css">

  <!-- Template CSS -->
  <link rel="stylesheet" href="<?= base_url('vendor'); ?>/stisla-master/css/style.css">
  <link rel="stylesheet" href="<?= base_url('vendor'); ?>/stisla-master/css/components.css">

  <style type="text/css">
    .menyembunyikan{
      display: none;
    }
  </style>

</head>

<body>
  <div id="app">
    <section class="section">
      <div class="container mt-2">
        <div class="row">
          <div class="offset-lg-3 col-lg-6 mt-2">
            <div class="login-brand">
              <img src="<?= base_url('assets/uploads/sistem/default.png'); ?>" alt="logo" width="100" class="shadow-dark rounded-circle">
              <h5 class="text-center mt-3">Selamat Datang di Sistem Informasi Keuangan</h5>
              <h6 class="text-center mb-3">PT. Riau Samudra Mandiri</h6>
            </div>
            
          </div>
          <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">

            <div class="card card-primary shadow-dark">
              <div class="card-header"><h4>Reset Password</h4></div>
              <div class="card-body">
                <?= form_open_multipart('auth/ganti_password', ['class' => 'formganti']) ?>
                  <div class="pesan" style="display: none;"></div>
                  <input type="hidden" name="email" value="<?= $email ?>">
                  <div class="form-group">
                    <label for="password">Password baru</label>
                    <input id="password" type="password" class="form-control" name="password" tabindex="1" autofocus>
                  </div>

                  <div class="form-group">
                    <label for="password1">Ketik ulang password</label>
                    <input id="password1" type="password" class="form-control" name="password1" tabindex="1">
                  </div>

                  <div class="form-group">
                    <button type="submit" id="simpan" class="btn btn-primary btn-lg btn-block" tabindex="4">
                      <i class="fas fa-save"></i> Simpan
                    </button>
                    <a style="color: white;" id="loading" class="menyembunyikan btn btn-primary btn-lg btn-block" tabindex="4"><img src="<?= base_url('vendor'); ?>/loading/loading1.gif" width="20"> Tunggu</a>
                  </div>
                <?= form_close(); ?>
              </div>
            </div>
            <div class="simple-footer">
              Copyright &copy; 2021 <div class="bullet"></div> Built by <a href="https://instagram.com/m.dony_irwansyah" target="_blank">M. Donny Irwansyah.</a>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>


  <!-- General JS Scripts -->
  <script src="<?= base_url('vendor'); ?>/stisla-master/jquery/jquery-3.3.1.min.js"></script>
  <script src="<?= base_url('vendor'); ?>/stisla-master/bootstrap-4.3.1/popper.min.js"></script>
  <script src="<?= base_url('vendor'); ?>/stisla-master/bootstrap-4.3.1/bootstrap.min.js"></script>
  <script src="<?= base_url('vendor'); ?>/stisla-master/bootstrap-4.3.1/jquery.nicescroll.min.js"></script>
  <script src="<?= base_url('vendor'); ?>/stisla-master/bootstrap-4.3.1/moment.min.js"></script>
  <script src="<?= base_url('vendor'); ?>/stisla-master/js/stisla.js"></script>
  <script src="<?= base_url('vendor'); ?>/sweetalert2/dist/sweetalert2.all.min.js"></script>

  <!-- JS Libraies -->

  <!-- Template JS File -->
  <script src="<?= base_url('vendor'); ?>/stisla-master/js/scripts.js"></script>
  <script src="<?= base_url('vendor'); ?>/stisla-master/js/custom.js"></script>

  <!-- Page Specific JS File -->
  <script type="text/javascript">
    $('.formganti').submit(function(e){
      $('#loading').removeClass('menyembunyikan');
      $('#simpan').addClass('menyembunyikan');
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
            $('#loading').addClass('menyembunyikan');
            $('#simpan').removeClass('menyembunyikan');
          }
          if (response.sukses) {
            $('#loading').addClass('menyembunyikan');
            $('#simpan').removeClass('menyembunyikan');
            $('.pesan').html('').hide();
            Swal.fire({
              title: `Selamat!`,
              text: response.sukses,
              icon: 'success',
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Ok',
            }).then((result) => {
              if (result.value) {
                location.replace("<?= site_url('auth') ?>")
              }
            })
          }
        },
        error: function(xhr, ajaxOptions, thrownError) {
          alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        }
      });
    return false;
    });
  </script>
</body>
</html>
