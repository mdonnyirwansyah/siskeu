      <!-- Navbar -->
      <div class="navbar-bg"></div>
      <nav class="navbar navbar-expand-lg main-navbar">
        <form class="form-inline mr-auto">
          <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
          </ul>
        </form>
        <ul class="navbar-nav navbar-right">
          <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
            <img alt="image" src="<?= base_url('assets/uploads/profil/'.$user['image']); ?>" class="rounded-circle mr-1">
            <div class="d-sm-none d-lg-inline-block" id="akun">Hi, <?= $user['name']; ?></div></a>
            <div class="dropdown-menu dropdown-menu-right">
              <div class="dropdown-title">
                Logged in 
                <?php $time_login = $this->session->userdata('time_login'); $logged_in = time() - $time_login; if (date('i', $logged_in) < 1) {
                    echo date('s', $logged_in).' Sec';
                  } elseif (date('i', $logged_in) >= 1 && date('i', $logged_in) < 60) {
                    echo date('i', $logged_in).' Min';
                  } else {
                    echo date('H', $logged_in).' Hours';
                  } 
                ?> 
                ago
              </div>
              <a href="<?= site_url('admin/pengaturan/akun'); ?>" class="dropdown-item has-icon">
                <i class="far fa-user"></i> Akun
              </a>
              <div class="dropdown-divider"></div>
              <a href="<?= site_url('auth/logout') ?>" class="dropdown-item has-icon text-danger">
                <i class="fas fa-sign-out-alt"></i> Logout
              </a>
            </div>
          </li>
        </ul>
      </nav>
      <!-- Navbar Ends -->