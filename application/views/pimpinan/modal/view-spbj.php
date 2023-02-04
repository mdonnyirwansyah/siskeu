	    <!-- Modal view Pembayaran SPBJ -->
      <div class="modal fade" id="view" tabindex="-1" aria-labelledby="viewLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <strong style="font-size: 18px; color: black" class="modal-title" id="viewLabel">Detail Pembayaran SPBJ</strong>
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
                <label for="penerima">Penerima</label>
              </div>
              <div class="col-md-9">
                <div class="form-group">
                  <textarea class="form-control" name="penerima" id="penerima" readonly><?= $penerima ?></textarea>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-3">
                <label for="no_spbj">No SPBJ</label>
              </div>
              <div class="col-md-9">
                <div class="form-group">
                  <input type="text" class="form-control" name="no_spbj" id="no_spbj" value="<?= $no_spbj ?>" readonly>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-3">
                <label for="area">Area</label>
              </div>
              <div class="col-md-9">
                <div class="form-group">
                  <textarea class="form-control" name="area" id="area" readonly><?= $area ?></textarea>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-3">
                <label for="nilai_spbj">Nilai SPBJ</label>
              </div>
              <div class="col-md-9">
                <div class="form-group">
                  <input type="text" class="form-control" name="nilai_spbj" id="nilai_spbj" value="Rp <?= number_format($nilai_spbj,0,',','.'); ?>,-" readonly>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-3">
                <label for="fee">Fee BOS</label>
              </div>
              <div class="col-md-9">
                <div class="form-group">
                  <input type="text" class="form-control" name="fee" id="fee" value="Rp <?= number_format($nilai_spbj * 0.10,0,',','.'); ?>,-" readonly>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-3">
                <label for="pemasukkan">Nominal Pemasukkan</label>
              </div>
              <div class="col-md-9">
                <div class="form-group">
                  <input type="text" class="form-control" name="pemasukkan" id="pemasukkan" value="Rp <?= number_format($pemasukkan,0,',','.'); ?>,-" readonly>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-3">
                <label for="pengiriman">Nominal Pengiriman</label>
              </div>
              <div class="col-md-9">
                <div class="form-group">
                  <input type="text" class="form-control" name="pengiriman" id="pengiriman" value="Rp <?= number_format($pengiriman,0,',','.'); ?>,-" readonly>
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
                  <img style="display: block;margin-left: auto;margin-right: auto; width: 40%;" alt="image" src="<?= base_url('assets'); ?>/uploads/invoice/<?= $bukti_transaksi ?>" class="img-fluid">
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
    <!-- Modal view Pembayaran SPBJ Ends -->

    <!-- JS Libraies -->

    <!-- Page Specific JS File -->

