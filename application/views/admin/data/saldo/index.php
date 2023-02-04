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
          <?= $this->session->flashdata("message"); ?>
          <?php if( validation_errors() ) : ?>
          <div class="alert alert-danger alert-has-icon alert-dismissible show fade">
            <div class="alert-icon"><i class="fas fa-exclamation-circle"></i></div>
            <div class="alert-body">
              <div class="alert-title">Cetak Gagal!</div><button class="close" data-dismiss="alert"><span>&times;</span></button>
              <?= validation_errors(); ?>.
            </div>
          </div>
          <?php endif; ?>
          <!-- Filter Data -->
          <div class="card">
            <div class="card-body">
              <div>
                <a style="float: right; min-width: 30px" data-collapse="#mycard-collapse" class="btn btn-sm btn-primary" href="#"><i class="fas fa-plus"></i></a> 
                <strong style="font-size: 18px; color: black">Filter Data</strong>
              </div>
              <div class="collapse hide" id="mycard-collapse">
              <hr>
                <form action="<?= base_url('admin/data/saldo/cetak') ?>" method="post" target="_blank">
                  <div class="row">
                    <div class="col-md-3">
                      <label for="tahun1">Tahun</label>
                    </div>
                    <div class="col-md-9">
                      <div class="form-group">
                        <select class="custom-select" name="tahun1" id="tahun1">
                          <option id="pilihtahun" selected>Pilih tahun</option>
                          <?php foreach ($tahun as $th) : ?>
                          <option value="<?= $th->tahun; ?>"><?= $th->tahun; ?></option>
                          <?php endforeach; ?>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-3">
                      <label for="bulanawal">Dari bulan</label>
                    </div>
                    <div class="col-md-9">
                      <div class="form-group">
                        <select class="custom-select" name="bulanawal" id="bulanawal">
                          <option id="pilihbulan" selected>Pilih bulan</option>
                          <?php foreach ($bulan as $key) : ?>
                          <option value="<?= $key->value ?>"><?= $key->bulan ?></option>
                          <?php endforeach; ?>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-3">
                      <label for="bulanakhir">Sampai bulan</label>
                    </div>
                    <div class="col-md-9">
                      <div class="form-group">
                        <select class="custom-select" name="bulanakhir" id="bulanakhir">
                          <option id="pilihbulan2" selected>Pilih bulan</option>
                          <?php foreach ($bulan as $key) : ?>
                          <option value="<?= $key->value ?>"><?= $key->bulan ?></option>
                          <?php endforeach; ?>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-3">
                    </div>
                    <div class="col-md-9">
                      <div class="form-group">
                        <a style="min-width: 100px;" href="#tb_saldo" id="search" class="btn btn-success mr-1"><i class="fas fa-sync-alt"> Proses</i></a> 
                        <button type="submit" style="min-width: 100px;" class="btn btn-primary mr-1"><i class="fa fa-print"></i> Cetak</button>
                        <a style="min-width: 100px;" href="#tb_saldo" id="reset" class="btn btn-danger"><i class="fas fa-power-off"> Reset</i></a>
                      </div>
                    </div>
                  </div>
                <?= form_close(); ?>
              </div>
            </div>
          </div>
          <!-- Filter Data Ends -->

          <!-- Data Tables -->
          <div class="section-body">
	          <div class="row">
	            <div class="col-md-12">
        				<div class="card">
        				  <div class="card-body">
          					<div>
                      <form action="<?= base_url('admin/data/saldo/cetak') ?>" method="post" target="_blank">
                      <input class="menyembunyikan" type="hidden" name="tahun1" value="0">
                      <input class="menyembunyikan" type="hidden" name="bulanawal" value="0">
                      <input class="menyembunyikan" type="hidden" name="bulanakhir" value="0">
                      <button type="submit" style="min-width: 100px; float: right; margin-top: 2em;" class="btn btn-primary mr-1"><i class="fa fa-print"></i> Cetak</button>
                      <?= form_close(); ?>
                      <strong style="font-size: 18px; color: black; float: left; margin-top: 40px"><i class="fa fa-calendar"></i> <span class="tglData"><?= date('d/m/Y') ?></span></strong>
                    </div>
                    <div class="table-responsive">
                      <hr>
          	 				  <table id="tb_saldo" class="table table-striped display nowrap" style="width:100%">
            						<thead>
            						  <tr>
            					 		  <th style="width: 1%">No</th>
            							  <th>Tanggal</th>
                            <th>Uraian</th>
                            <th>Debit</th>
                            <th>Kredit</th>
                            <th>Saldo</th>
                            <th>Keterangan</th>
            			 			  </tr>
            						</thead>
                        <tbody>
                            
                  			</tbody>
                        <tfoot>
                          <tr>
                            <th colspan="3" style="text-align: right;">Total</th>
                            <th id="debit"></th>
                            <th id="kredit"></th>
                            <th id="saldo"></th>
                            <th></th>
                          </tr>
                        </tfoot>
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
  function tampil_data(tahun1='', bulanawal='', bulanakhir='') {
    $('#tb_saldo').DataTable({
          rowReorder: {
            selector: 'td:nth-child(2)'
          },
          responsive: true,
          "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
          "info":     false,
          "destroy": true,
          "processing": true,
          "serverSide": true,
          "order": [],
          "columnDefs": [
            {
              "targets": [ 3 ],
              "render": $.fn.dataTable.render.number( '.', '.', 0, 'Rp ', ',-' ),
            },
            {
              "targets": [ 4 ],
              "render": $.fn.dataTable.render.number( '.', '.', 0, 'Rp ', ',-' ),
            },
            {
              "targets": [ 5 ],
              "render": $.fn.dataTable.render.number( '.', '.', 0, 'Rp ', ',-' ),
            },

          ],

          "ajax": {
              "url": "<?= site_url('admin/data/saldo/get_tabel'); ?>",
              "type": "POST",
              "data":{
                  tahun1 : tahun1, 
                  bulanawal : bulanawal, 
                  bulanakhir : bulanakhir
              },
          },
    });
  }

  function sum(tahun1='', bulanawal='', bulanakhir=''){
    $.ajax({
        type  : 'POST',
        url   : '<?= base_url()?>admin/data/saldo/get_sum',
          data:{
                    tahun1 : tahun1, 
                    bulanawal : bulanawal, 
                    bulanakhir : bulanakhir
                },
        dataType : 'json',
        success : function(sum){
            var debit = 'Rp '+sum.debit+',-';
            var kredit = 'Rp '+sum.kredit+',-';
            var saldo = 'Rp '+sum.saldo+',-';
                $('#debit').html(debit);
                $('#kredit').html(kredit);
                $('#saldo').html(saldo);
        }
    });
  }



  $(document).ready(function(){
    tampil_data();
    sum();

       $('#search').click(function(){

        tahun1 = $('#tahun1').val();
        bulanawal = $('#bulanawal').val();
        bulanakhir = $('#bulanakhir').val();
        if(bulanawal != 'Pilih bulan' && bulanakhir != 'Pilih bulan' && tahun1 != 'Pilih tahun' && bulanawal <= bulanakhir){
            $('#tb_saldo').DataTable().destroy();
            tampil_data(tahun1, bulanawal, bulanakhir);
            sum(tahun1, bulanawal, bulanakhir);
            
        }else{
            Swal.fire({
            icon: 'error',
            title: 'Error!',
            text: 'Periksa kembali inputan filter data'
          });
        }

      });

      $('#reset').click(function(){
        $('#mycard-collapse').removeClass('show');
        $('#mycard-collapse').addClass('hide');
        $('#pilihtahun').prop('selected', true);
        $('#pilihbulan').prop('selected', true);
        $('#pilihbulan2').prop('selected', true);
        tampil_data();
        sum();
      });

  });
  
  </script>

</body>
</html>
