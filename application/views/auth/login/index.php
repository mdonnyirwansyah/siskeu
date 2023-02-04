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

  <!-- Template CSS -->
  <link rel="stylesheet" href="<?= base_url('vendor'); ?>/stisla-master/css/style.css">
  <link rel="stylesheet" href="<?= base_url('vendor'); ?>/stisla-master/css/components.css">
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
              <div class="card-header"><h4>Login</h4></div>
              <div class="card-body">
                <form method="POST" action="<?= site_url('auth/login') ?>">
                    <?= $this->session->flashdata("message"); ?>
                    <?php if( validation_errors() ) : ?>
                      <div class="alert alert-danger alert-has-icon">
                        <div class="alert-icon"><i class="fas fa-exclamation-circle"></i></div>
                        <div class="alert-body">
                          <div class="alert-title">Peringatan!</div>
                          <?= validation_errors(); ?>
                        </div>
                      </div>
                    <?php endif; ?>
                  <div class="form-group">
                    <label for="email">Email</label>
                    <input id="email" type="text" class="form-control" name="email" tabindex="1" autofocus>
                  </div>

                  <div class="form-group">
                    <div class="d-block">
                      <label for="password" class="control-label">Password</label>
                      <div class="float-right">
                        <!-- <a href="<?= site_url('auth/lupa_password') ?>" class="text-small">
                          Lupa Password?
                        </a> -->
                      </div>
                    </div>
                    <input id="password" type="password" class="form-control" name="password" tabindex="2">
                  </div>

                  <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                      <i class="fas fa-sign-in-alt"></i> Login
                    </button>
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

  <!-- JS Libraies -->

  <!-- Template JS File -->
  <script src="<?= base_url('vendor'); ?>/stisla-master/js/scripts.js"></script>
  <script src="<?= base_url('vendor'); ?>/stisla-master/js/custom.js"></script>

  <!-- Page Specific JS File -->
</body>
</html>
