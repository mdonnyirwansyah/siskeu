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
                      <a style="min-width: 100px;" href="#tb_pengeluaran" id="search" class="btn btn-success mr-1"><i class="fas fa-sync-alt"> Proses</i></a>
                      <a style="min-width: 100px;" href="#tb_pengeluaran" id="reset" class="btn btn-danger"><i class="fas fa-power-off"> Reset</i></a>
                    </div>
                  </div>
                </div>
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
                      <strong style="font-size: 18px; color: black; float: left; margin-top: 40px"><i class="fa fa-calendar"></i> <span class="tglData"><?= date('d/m/Y') ?></span></strong>
                    </div>
          					<div class="table-responsive">
                      <hr>
          	 				  <table id="tb_pengeluaran" class="table table-striped display nowrap" style="width:100%">
            						<thead>
            						  <tr>
            					 		  <th style="width: 1%">No</th>
            							  <th>Tanggal</th>
                            <th>No SPBJ</th>
                            <th>Nilai SPBJ</th>
                            <th>Fee BOS</th>
                            <th>Nominal Pemasukkan</th>
                            <th>Nominal Pengiriman</th>
            						    <th>Aksi</th>
            			 			  </tr>
            						</thead>
                        <tbody>
                            
                  			</tbody>
                        <tfoot>
                          <tr>
                            <th colspan="3" style="text-align: right;">Total</th>
                            <th id="nilaiSum"></th>
                            <th id="feeSum"></th>
                            <th id="pemasukkanSum"></th>
                            <th id="pengirimanSum"></th>
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
    $('#tb_pengeluaran').DataTable({
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
            {
              "targets": [ 6 ],
              "render": $.fn.dataTable.render.number( '.', '.', 0, 'Rp ', ',-' ),
            },

          ],

          "ajax": {
              "url": "<?= site_url('pimpinan/laporan/spbj/get_tabel'); ?>",
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
        url   : '<?= site_url()?>pimpinan/laporan/spbj/get_sum',
          data:{
                    tahun1 : tahun1, 
                    bulanawal : bulanawal, 
                    bulanakhir : bulanakhir
                },
        dataType : 'json',
        success : function(sum){
            var pengiriman = 'Rp '+sum.pengiriman+',-';
            var pemasukkan = 'Rp '+sum.pemasukkan+',-';
            var nilai = 'Rp '+sum.nilai+',-';
            var fee = 'Rp '+sum.fee+',-';
                $('#nilaiSum').html(nilai);
                $('#feeSum').html(fee);
                $('#pemasukkanSum').html(pemasukkan);
                $('#pengirimanSum').html(pengiriman);
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
            $('#tb_pengeluaran').DataTable().destroy();
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

  function view(id) {
    $.ajax({
      type: 'post',
      url: "<?= site_url('pimpinan/laporan/spbj/form_view'); ?>",
      data: {
          id: id
      },
      dataType: "json",
      success: function(response) {
        if (response.sukses) {
          $('.viewmodal').html(response.sukses).show();
          $('#view').on('shown.bs.modal', function(e) {
            $('#tanggal').focus();
          })
          $('#view').modal('show');
        }
      }
    });
  }
  </script>

</body>
</html>
