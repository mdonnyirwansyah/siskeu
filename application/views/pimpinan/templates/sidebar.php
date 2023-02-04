      <!-- Sidebar -->
      <div class="main-sidebar">
        <aside id="sidebar-wrapper">
          <div class="sidebar-brand mt-2">
            <h5><b>Sistem Informasi Keuangan</b></h5> 
            <small><img src="<?= base_url('assets/uploads/sistem/default.png'); ?>" alt="logo" width="20" class="mb-1 mr-2 shadow-dark rounded-circle"> <b>PT. Riau Samudra Mandiri</b></small>
          </div>
          <div class="sidebar-brand sidebar-brand-sm">
            <a href="#"><img src="<?= base_url('assets/uploads/sistem/default.png'); ?>" alt="logo" width="50" class="shadow-dark rounded-circle"></a>
          </div>
          <ul style="margin-top: 10px;" class="sidebar-menu">
            <li class="<?= $judul == 'Dashboard' ? 'active' : '' ?>"><a class="nav-link" href="<?= site_url('pimpinan/dashboard'); ?>"><i class="fas fa-fire"></i> <span>Dashboard</span></a></li>
            <li class="<?= $judul == 'Data User' ? 'active' : '' ?>" class="nav-item dropdown">
              <a href="#" class="nav-link has-dropdown"><i class="fas fa-archive"></i><span>Data</span></a>
              <ul class="dropdown-menu">
                <li class="<?= $judul == 'Data User' ? 'active' : '' ?>"><a class="nav-link" href="<?= site_url('pimpinan/data/user'); ?>">User</a></li>
              </ul>
            </li>
            <li class="<?= $judul == 'Laporan Penerimaan' ? 'active' : '' ?><?= $judul == 'Laporan Pengeluaran' ? 'active' : '' ?><?= $judul == 'Laporan Saldo' ? 'active' : '' ?><?= $judul == 'Laporan Pembayaran SPBJ' ? 'active' : '' ?><?= $judul == 'Laporan Pengeluaran Pimpinan' ? 'active' : '' ?>" class="nav-item dropdown">
              <a href="#" class="nav-link has-dropdown"><i class="fas fa-file"></i><span>Laporan</span></a>
              <ul class="dropdown-menu">
                <li class="<?= $judul == 'Laporan Penerimaan' ? 'active' : '' ?>"><a class="nav-link" href="<?= site_url('pimpinan/laporan/penerimaan'); ?>">Penerimaan</a></li>
                <li class="<?= $judul == 'Laporan Pengeluaran' ? 'active' : '' ?>"><a class="nav-link" href="<?= site_url('pimpinan/laporan/pengeluaran'); ?>">Pengeluaran</a></li>
                <li class="<?= $judul == 'Laporan Saldo' ? 'active' : '' ?>"><a class="nav-link" href="<?= site_url('pimpinan/laporan/saldo'); ?>">Saldo</a></li>
                <li class="<?= $judul == 'Laporan Pembayaran SPBJ' ? 'active' : '' ?>"><a class="nav-link" href="<?= site_url('pimpinan/laporan/spbj'); ?>">Pembayaran SPBJ</a></li>
                <li class="<?= $judul == 'Laporan Pengeluaran Pimpinan' ? 'active' : '' ?>"><a class="nav-link" href="<?= site_url('pimpinan/laporan/pimpinan'); ?>">Pengeluaran Pimpinan</a></li>
              </ul>
            </li>
            <li class="<?= $judul == 'Pengaturan Akun' ? 'active' : '' ?><?= $judul == 'Pengaturan Umum' ? 'active' : '' ?>" class="nav-item dropdown">
              <a href="#" class="nav-link has-dropdown"><i class="fas fa-cog"></i><span>Pengaturan</span></a>
              <ul class="dropdown-menu">
                <li class="<?= $judul == 'Pengaturan Akun' ? 'active' : '' ?>"><a class="nav-link" href="<?= site_url('pimpinan/pengaturan/akun'); ?>">Akun</a></li>
              </ul>
            </li>
            <li class="<?= $judul == 'Tentang' ? 'active' : '' ?>"><a class="nav-link" href="<?= site_url('pimpinan/tentang'); ?>"><i class="fas fa-info-circle"></i> <span>Tentang</span></a></li>
          </ul>
          <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
            <a href="<?= site_url('auth/logout') ?>" class="btn btn-danger btn-lg btn-block btn-icon-split"><i class="fas fa-sign-out-alt"></i> Logout</a>
          </div>
        </aside>
      </div>
      <!-- Sidebar Ends -->