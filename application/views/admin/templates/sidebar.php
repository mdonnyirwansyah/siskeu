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
            <li class="<?= $judul == 'Dashboard' ? 'active' : '' ?>"><a class="nav-link" href="<?= site_url('admin/dashboard'); ?>"><i class="fas fa-fire"></i> <span>Dashboard</span></a></li>
            <li class="<?= $judul == 'Data Penerimaan' ? 'active' : '' ?><?= $judul == 'Data Pengeluaran' ? 'active' : '' ?><?= $judul == 'Data Saldo' ? 'active' : '' ?><?= $judul == 'Data Pembayaran SPBJ' ? 'active' : '' ?><?= $judul == 'Data Pengeluaran Pimpinan' ? 'active' : '' ?>" class="nav-item dropdown">
              <a href="#" class="nav-link has-dropdown"><i class="fas fa-archive"></i><span>Data</span></a>
              <ul class="dropdown-menu">
                <li class="<?= $judul == 'Data Penerimaan' ? 'active' : '' ?>"><a class="nav-link" href="<?= site_url('admin/data/penerimaan'); ?>">Penerimaan</a></li>
                <li class="<?= $judul == 'Data Pengeluaran' ? 'active' : '' ?>"><a class="nav-link" href="<?= site_url('admin/data/pengeluaran'); ?>">Pengeluaran</a></li>
                <li class="<?= $judul == 'Data Saldo' ? 'active' : '' ?>"><a class="nav-link" href="<?= site_url('admin/data/saldo'); ?>">Saldo</a></li>
                <li class="<?= $judul == 'Data Pembayaran SPBJ' ? 'active' : '' ?>"><a class="nav-link" href="<?= site_url('admin/data/spbj'); ?>">Pembayaran SPBJ</a></li>
                <li class="<?= $judul == 'Data Pengeluaran Pimpinan' ? 'active' : '' ?>"><a class="nav-link" href="<?= site_url('admin/data/pimpinan'); ?>">Pengeluaran Pimpinan</a></li>
              </ul>
            </li>
            <li class="<?= $judul == 'Pengaturan Akun' ? 'active' : '' ?>" class="nav-item dropdown">
              <a href="#" class="nav-link has-dropdown"><i class="fas fa-cog"></i><span>Pengaturan</span></a>
              <ul class="dropdown-menu">
                <li class="<?= $judul == 'Pengaturan Akun' ? 'active' : '' ?>"><a class="nav-link" href="<?= site_url('admin/pengaturan/akun'); ?>">Akun</a></li>
              </ul>
            </li>
            <li class="<?= $judul == 'Tentang' ? 'active' : '' ?>"><a class="nav-link" href="<?= site_url('admin/tentang'); ?>"><i class="fas fa-info-circle"></i> <span>Tentang</span></a></li>
          </ul>
          <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
            <a href="<?= site_url('auth/logout') ?>" class="btn btn-danger btn-lg btn-block btn-icon-split"><i class="fas fa-sign-out-alt"></i> Logout</a>
          </div>
        </aside>
      </div>
      <!-- Sidebar Ends -->