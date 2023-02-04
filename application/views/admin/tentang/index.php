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
                <div class="col-md-12">
                  <div class="card">
                    <div class="">
                      <div class="card-body">
		                    <div class="tickets">
		                      <div class="ticket-content ml-auto mr-auto">
		                        <div class="ticket-header">
		                          <div style="width: 75px; height: 75px" class=" ml-auto ticket-sender-picture img-shadow">
		                            <img src="<?= base_url('assets/uploads/sistem/default.png'); ?>" alt="image">
		                          </div>
		                          <div class="ticket-detail mr-auto">
		                            <div style="font-size: 20px" class="ticket-title">
		                              <div class="font-weight-600">PT. Riau Samudra Mandiri</div>
		                            </div>
		                            <div style="font-size: 17px" class="ticket-info">
		                              <div class="font-weight-600">Helman</div>
		                            </div>
		                            <div class="ticket-info">
		                              <div class="text-muted font-weight-600">Direktur Utama</div>
		                            </div>
		                          </div>
		                        </div>
		                        <div style="font-size: 17px" class="ticket-description">
                              <center><b>LATAR BELAKANG</b></center>
                              <p style="text-align: justify;">PT. Riau Samudra Mandiri didirikan
                              pada tanggal 6 Februari 2012 di Teluk Kuantan, Riau, Indonesia. Perusahaan ini berkomitmen untuk turut serta dalam pembangunan melalui jasa konstruksi listrik dan instalasi. Jasa pelayanan kami meliputi pembangunan jaringan tegangan menengah dan rendah, Mekanikal & Elektrikal, pengadaan alat-alat listrik dan elektronik. <br>
                              Sejalan dengan visi dan misinya, PT. Riau Samudra Mandiri berkomitmen untuk memprioritaskan klien, berprestasi, berpikiran positif dan berkemampuan untuk tampil dengan kinerja profesional demi pertumbuhan yang sehat yang mampu memenuhi keinginan stakeholder. Para staf adalah tulang punggung kesuksesan kami, mulai dari manajer proyek kami, desainer dan estimator, pengawas proyek, tim ahli, dan pekerja harian. Mereka memiliki keahlian untuk memastikan proyek anda selesai dengan benar oleh para profesional terlatih.</p>
	                          	<center><b>VISI</b></center>
            									<p style="text-align: justify;">Menjadi perusahaan konstruksi dan instalasi listrik yang terpercaya dan dapat diandalkan.</p>
            									<center><b>MISI</b></center>
            									<p  style="text-align: justify;"">1. Berpartisipasi dalam pembangunan melalui jasa konstruksi dan instalasi listrik.<br>
            									2. Menyediakan jasa konstruksi dan instalasi listrik yang dapat memberikan nilai tambah bagi stakeholder.<br>
            									3. Memberikan pelayanan dengan sikap profesional dan memenuhi standar kesehatan, keselamatan, sosial dan lingkungan kerja</p>
		                        </div>
		                      </div>
		                    </div>
                      </div>
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

</body>
</html>
