	    <!-- Modal Edit Pengeluaran -->
      <div class="modal fade" id="edit" tabindex="-1" aria-labelledby="editLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <strong style="font-size: 18px; color: black" class="modal-title" id="editLabel">Edit Pengeluaran</strong>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
          <?= form_open_multipart('admin/data/pengeluaran/edit', ['class' => 'formedit']) ?>
          <div class="modal-body">
            <div class="form-group">
              <div class="pesan_edit" style="display: none;"></div>
            </div>
            <input type="hidden" name="id" id="id" value="<?= $id ?>">
            <div class="row">
              <div class="col-md-3">
                <label for="tanggal">Tanggal</label>
              </div>
              <div class="col-md-9">
                <div class="form-group">
                  <input type="text" class="form-control" name="tanggal" id="tanggal" value="<?= $tanggal ?>">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-3">
                <label for="uraian">Uraian</label>
              </div>
              <div class="col-md-9">
                <div class="form-group">
                  <textarea class="form-control" name="uraian" id="uraian"><?= $uraian ?></textarea>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-3">
                <label for="penerima">Penerima</label>
              </div>
              <div class="col-md-9">
                <div class="form-group">
                  <input type="text" class="form-control" name="penerima" id="penerima" value="<?= $penerima ?>">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-3">
                <label for="kebutuhan">Kebutuhan</label>
              </div>
              <div class="col-md-9">
                <div class="form-group">
                  <textarea class="form-control" name="kebutuhan" id="kebutuhan"><?= $kebutuhan ?></textarea>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-3">
                <label for="satuan">Satuan</label>
              </div>
              <div class="col-md-9">
                <div class="form-group">
                  <input type="text" class="form-control" name="satuan" id="satuan" value="<?= $satuan ?>">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-3">
                <label for="volume">Volume</label>
              </div>
              <div class="col-md-9">
                <div class="form-group">
                  <input type="text" class="form-control" name="volume" id="volume" value="<?= $volume ?>">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-3">
                <label for="keterangan">Keterangan</label>
              </div>
              <div class="col-md-9">
                <div class="form-group">
                  <textarea class="form-control" name="keterangan" id="keterangan"><?= $keterangan ?></textarea>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-3">
                <label for="invoice">Bukti Transaksi</label>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <img style="display: block;margin-right: auto; width: 100%;" alt="image" src="<?= base_url('assets'); ?>/uploads/invoice/<?= $bukti_transaksi ?>" class="img-thumbnail mb-1">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <input type="file" class="form-control" name="invoice" id="invoice" value="<?= $bukti_transaksi ?>">
                  <footer class="blockquote-footer"><cite title="Source Title">Hanya jpg, jpeg, png dan maksimal ukuran 2048kb.</cite></footer>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button style="min-width: 100px;" type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
            <button style="min-width: 100px;" type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-times-circle"></i> Keluar</button>
          </div>
          <?= form_close(); ?>
        </div>
      </div>
    </div>
    <!-- Modal Edit Pengeluaran Ends -->

    <!-- JS Libraies -->

    <!-- Page Specific JS File -->
	  <script>
	  $(document).ready(function(){
	      $('.formedit').submit(function(e){
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
	              $('.pesan_edit').html(response.error).show();
	            }
	            if (response.sukses) {
	              Swal.fire({
	              	icon: 'success',
	              	title: 'Selamat!',
	              	text: response.sukses
	              });
	              tampil_data();
                sum();
	              $('#edit').modal('hide');
	            }
	          },
	          error: function(xhr, ajaxOptions, thrownError) {
	          	alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
	          }
	        });
	      	return false;
	      });
	  });
		</script>

