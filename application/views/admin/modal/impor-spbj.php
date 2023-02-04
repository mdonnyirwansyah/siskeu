	    <!-- Modal impor Pembayaran SPBJ -->
      <div class="modal fade" id="impor" tabindex="-1" aria-labelledby="imporLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <strong style="font-size: 18px; color: black" class="modal-title" id="imporLabel">Impor Pembayaran SPBJ</strong>
              <button type="button" class="close close-a" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
          <?= form_open_multipart('admin/data/spbj/impor', ['class' => 'formimpor']) ?>
          <div class="modal-body">
            <div class="form-group">
              <div class="pesan" style="display: none;"></div>
            </div>
            <div class="row">
              <div class="col-md-3">
                <label for="csv">File CSV</label>
              </div>
              <div class="col-md-9">
                <div class="form-group">
                  <input type="file" class="form-control" name="csv" id="csv">
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button style="min-width: 100px;" id="kirim" type="submit" class="btn btn-primary"><i class="fas fa-upload"></i> Kirim</button>
            <a style="min-width: 100px; color: white;" id="loading" class="menyembunyikan btn btn-primary"><img src="<?= base_url('vendor'); ?>/loading/loading1.gif" width="20"> Tunggu</a>
            <button style="min-width: 100px;" type="button" class="close-a btn btn-danger" data-dismiss="modal"><i class="fas fa-times-circle"></i> Kembali</button>
          </div>
          <?= form_close(); ?>
        </div>
      </div>
    </div>
    <!-- Modal impor Pembayaran SPBJ Ends -->

    <!-- JS Libraies -->

    <!-- Page Specific JS File -->
	  <script>
	  $(document).ready(function(){
	      $('.formimpor').submit(function(e){
          $('#loading').removeClass('menyembunyikan');
          $('#kirim').addClass('menyembunyikan');
          $('.close-a').addClass('menyembunyikan');
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
                $('#loading').addClass('menyembunyikan');
                $('#kirim').removeClass('menyembunyikan');
                $('.close-a').removeClass('menyembunyikan');
	            }
	            if (response.sukses) {
	              Swal.fire({
	              	icon: 'success',
	              	title: 'Selamat!',
	              	text: response.sukses
	              });
	              tampil_data();
                sum();
	              $('#impor').modal('hide');
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

