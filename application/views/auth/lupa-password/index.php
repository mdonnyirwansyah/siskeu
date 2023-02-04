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
              <div class="card-header"><h4>Lupa Password</h4></div>
              <div class="card-body">
                <?= form_open_multipart('auth/lupa', ['class' => 'formlupa']) ?>
                  <p class="text-muted">Kami akan mengirimkan tautan untuk mengatur ulang password anda.</p>
                  <div class="pesan" style="display: none;"></div>
                  <div class="form-group">
                    <div class="d-block">
                      <label for="email" class="control-label">Email</label>
                      <div class="float-right">
                        <a href="<?= site_url('auth') ?>" class="text-small">
                          Login?
                        </a>
                      </div>
                    </div>
                    <input id="email" type="text" class="form-control" name="email" tabindex="2">
                  </div>

                  <div class="form-group">
                    <button type="submit" id="kirim" class="btn btn-primary btn-lg btn-block" tabindex="4">
                      <i class="fas fa-paper-plane"></i> Kirim
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
    $('.formlupa').submit(function(e){
      $('#loading').removeClass('menyembunyikan');
      $('#kirim').addClass('menyembunyikan');
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
            $('#email').val("");
            $('.pesan').html(response.error).show();
            $('#loading').addClass('menyembunyikan');
            $('#kirim').removeClass('menyembunyikan');
          }
          if (response.sukses) {
            $('#email').val("");
            $('#loading').addClass('menyembunyikan');
            $('#kirim').removeClass('menyembunyikan');
            $('.pesan').html('').hide();
            Swal.fire({
              icon: 'success',
              title: 'Selamat!',
              text: response.sukses
            });
            
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
