	    <!-- Modal view Penerimaan -->
      <div class="modal fade" id="view" tabindex="-1" aria-labelledby="viewLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <strong style="font-size: 18px; color: black" class="modal-title" id="viewLabel">Detail Penerimaan</strong>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
          <div class="modal-body">
            <div class="row">
              <div class="col-md-3">
                <label for="tanggal">Tanggal</label>
              </div>
              <div class="col-md-9">
                <div class="form-group">
                  <input type="text" class="form-control" name="tanggal" id="tanggal" value="<?= $tanggal ?>" readonly>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-3">
                <label for="uraian">Uraian</label>
              </div>
              <div class="col-md-9">
                <div class="form-group">
                  <textarea class="form-control" name="uraian" id="uraian" readonly><?= $uraian ?></textarea>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-3">
                <label for="jumlah">jumlah</label>
              </div>
              <div class="col-md-9">
                <div class="form-group">
                  <input type="text" class="form-control" name="jumlah" id="jumlah" value="Rp <?= number_format($satuan * $volume,0,',','.'); ?>,-" readonly>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-3">
                <label for="keterangan">Keterangan</label>
              </div>
              <div class="col-md-9">
                <div class="form-group">
                  <textarea class="form-control" name="keterangan" id="keterangan" readonly><?= $keterangan ?></textarea>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-3">
                <label for="bukti_transaksi">Bukti Transaksi</label>
              </div>
              <div class="col-md-9">
                <div class="form-group">
                  <img style="display: block;margin-left: auto;margin-right: auto; width: 60%;" alt="image" src="<?= base_url('assets'); ?>/uploads/invoice/<?= $bukti_transaksi ?>" class="img-fluid">
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button style="min-width: 100px;" type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-times-circle"></i> Keluar</button>
          </div>
        </div>
      </div>
    </div>
    <!-- Modal view Penerimaan Ends -->

    <!-- JS Libraies -->

    <!-- Page Specific JS File -->

