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
          <!-- Formulir Tambah -->
          <div class="section-body">
            <div class="row">
              <div class="col-md-12">
                <div class="card">
                  <div class="card-body">
                    <strong style="font-size: 18px; color: black">Formulir Tambah</strong>
                    <hr>
                    <?= form_open_multipart('admin/data/pimpinan/tambah', ['class' => 'formtambah']) ?>
                      <div class="form-group">
                        <div class="pesan" style="display: none;"></div>
                      </div>
                      <div class="row">
                        <div class="col-md-3">
                          <label for="tanggal">Tanggal</label>
                        </div>
                        <div class="col-md-9">
                          <div class="form-group">
                            <input type="datetime-local" class="form-control" name="tanggal" id="tanggal">
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-3">
                          <label for="uraian">Uraian</label>
                        </div>
                        <div class="col-md-9">
                          <div class="form-group">
                            <textarea class="form-control" name="uraian" id="uraian"></textarea>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-3">
                          <label for="penerima">Penerima</label>
                        </div>
                        <div class="col-md-9">
                          <div class="form-group">
                            <input type="text" class="form-control" name="penerima" id="penerima">
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-3">
                          <label for="kebutuhan">Kebutuhan</label>
                        </div>
                        <div class="col-md-9">
                          <div class="form-group">
                            <textarea class="form-control" name="kebutuhan" id="kebutuhan"></textarea>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-3">
                          <label for="satuan">Satuan</label>
                        </div>
                        <div class="col-md-9">
                          <div class="form-group">
                            <input type="text" class="form-control" name="satuan" id="satuan">
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-3">
                          <label for="volume">Volume</label>
                        </div>
                        <div class="col-md-9">
                          <div class="form-group">
                            <input type="text" class="form-control" name="volume" id="volume">
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-3">
                          <label for="keterangan">Keterangan</label>
                        </div>
                        <div class="col-md-9">
                          <div class="form-group">
                            <textarea class="form-control" name="keterangan" id="keterangan"></textarea>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-3">
                        </div>
                        <div class="col-md-9">
                          <div class="form-group">
                            <button style="min-width: 100px;" type="submit" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah</button>
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

          <!-- Filter Data -->
          <div class="card">
            <div class="card-body">
              <div>
                <a style="float: right; min-width: 30px" data-collapse="#mycard-collapse" class="btn btn-sm btn-primary" href="#"><i class="fas fa-plus"></i></a> 
                <strong style="font-size: 18px; color: black">Filter Data</strong>
              </div>
              <div class="collapse hide" id="mycard-collapse">
              <hr>
                <form action="<?= base_url('admin/data/pimpinan/cetak') ?>" method="post" target="_blank">
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
                        <a style="min-width: 100px;" href="#tb_pimpinan" id="search" class="btn btn-success mr-1"><i class="fas fa-sync-alt"> Proses</i></a> 
                        <button type="submit" style="min-width: 100px;" class="btn btn-primary mr-1"><i class="fa fa-print"></i> Cetak</button>
                        <a style="min-width: 100px;" href="#tb_pimpinan" id="reset" class="btn btn-danger"><i class="fas fa-power-off"> Reset</i></a>
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
                      <!-- <a style="min-width: 100px; float: right; color: white; margin-top: 2em" class="btn btn-secondary ml-1" onclick="impor(1)"><i class="fa fa-file-import"></i> Impor</a> -->
                      <form action="<?= base_url('admin/data/pimpinan/cetak') ?>" method="post" target="_blank">
                      <input class="menyembunyikan" type="hidden" name="tahun1" value="0">
                      <input class="menyembunyikan" type="hidden" name="bulanawal" value="0">
                      <input class="menyembunyikan" type="hidden" name="bulanakhir" value="0">
                      <button type="submit" style="min-width: 100px; float: right; margin-top: 2em;" class="btn btn-primary mr-1"><i class="fa fa-print"></i> Cetak</button>
                      <?= form_close(); ?>
                      <strong style="font-size: 18px; color: black; float: left; margin-top: 40px"><i class="fa fa-calendar"></i> <span class="tglData"><?= date('d/m/Y') ?></span></strong>
                    </div>
          					<div class="table-responsive">
                      <hr>
          	 				  <table id="tb_pimpinan" class="table table-striped display nowrap" style="width:100%">
            						<thead>
            						  <tr>
            					 		  <th style="width: 1%">No</th>
            							  <th>Tanggal</th>
                            <th>Uraian</th>
                            <th>Penerima</th>
                            <th>Jumlah</th>
                            <th>Keterangan</th>
            						    <th>Aksi</th>
            			 			  </tr>
            						</thead>
                        <tbody>
                            
                  			</tbody>
                        <tfoot>
                          <tr>
                            <th colspan="4" style="text-align: right;">Total</th>
                            <th id="sum"></th>
                            <th></th>
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
    $('#tb_pimpinan').DataTable({
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
              "targets": [ 4 ],
              "render": $.fn.dataTable.render.number( '.', '.', 0, 'Rp ', ',-' ),
            },

          ],

          "ajax": {
              "url": "<?= site_url('admin/data/pimpinan/get_tabel'); ?>",
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
        url   : '<?= site_url()?>admin/data/pimpinan/get_sum',
          data:{
                    tahun1 : tahun1, 
                    bulanawal : bulanawal, 
                    bulanakhir : bulanakhir
                },
        dataType : 'json',
        success : function(sum){
            var html = 'Rp '+sum+',-';
                $('#sum').html(html);
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
            $('#tb_pimpinan').DataTable().destroy();
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

      $('#tandai').click(function(e) {
        if ($(this).is(":checked")) {
          $('.tandai_id').prop('checked', true)
        } else {
          $('.tandai_id').prop('checked', false)
        }
      })

      $('.formtambah').submit(function(e){
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
              }
              if (response.sukses) {
                Swal.fire({
                  icon: 'success',
                  title: 'Selamat!',
                  text: response.sukses
                });
                $('#tanggal').val("");
                $('#uraian').val("");
                $('#penerima').val("");
                $('#kebutuhan').val("");
                $('#satuan').val("");
                $('#volume').val("");
                $('#keterangan').val("");
                tampil_data();
                sum();
              }
            },
            error: function(xhr, ajaxOptions, thrownError) {
              alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
          });
          return false;
        });
  });

  function impor(id) {
    $.ajax({
      type: 'post',
      url: "<?= site_url('admin/data/pimpinan/form_impor'); ?>",
      data: {
          id: id
      },
      dataType: "json",
      success: function(response) {
        if (response.sukses) {
          $('.viewmodal').html(response.sukses).show();
          $('#impor').on('shown.bs.modal', function(e) {
            $('#csv').focus();
          })
          $('#impor').modal('show');
        }
      }
    });
  }

  function view(id) {
    $.ajax({
      type: 'post',
      url: "<?= site_url('admin/data/pimpinan/form_view'); ?>",
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

  function edit(id) {
    $.ajax({
      type: 'post',
      url: "<?= site_url('admin/data/pimpinan/form_edit'); ?>",
      data: {
          id: id
      },
      dataType: "json",
      success: function(response) {
        if (response.sukses) {
          $('.viewmodal').html(response.sukses).show();
          $('#edit').on('shown.bs.modal', function(e) {
            $('#tanggal').focus();
          })
          $('#edit').modal('show');
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
                url: "<?= site_url('admin/data/pimpinan/hapus'); ?>",
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
