	    <!-- Modal view User -->
      <div class="modal fade" id="view" tabindex="-1" aria-labelledby="viewLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <strong style="font-size: 18px; color: black" class="modal-title" id="viewLabel">Detail User</strong>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
          <div class="modal-body">
            <div class="row">
              <div class="col-md-3">
                <label for="name">Nama</label>
              </div>
              <div class="col-md-9">
                <div class="form-group">
                  <input type="text" class="form-control" name="name" id="name" value="<?= $name ?>" readonly>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-3">
                <label for="email">Email</label>
              </div>
              <div class="col-md-9">
                <div class="form-group">
                  <input type="text" class="form-control" name="email" id="email" value="<?= $email ?>" readonly>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-3">
                <label for="role_id">Role</label>
              </div>
              <div class="col-md-9">
                <div class="form-group">
                  <input type="text" class="form-control" name="role_id" id="role_id" value="<?= $role_id == 1 ? 'Pimpinan' : 'Admin' ?>" readonly>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-3">
                <label for="date_created">Tanggal Registrasi</label>
              </div>
              <div class="col-md-9">
                <div class="form-group">
                  <input type="text" class="form-control" name="date_created" id="date_created" value="<?= date('r', $date_created) ?>" readonly>
                </div>
              </div>
            </div>
             <div class="row">
              <div class="col-md-3">
                <label for="is_active">Status</label>
              </div>
              <div class="col-md-9">
                <div class="form-group">
                  <input type="text" class="form-control" name="is_active" id="is_active" value="<?= $is_active == 1 ? 'Aktif' : '' ?>" readonly>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-3">
                <label for="image">Foto</label>
              </div>
              <div class="col-md-9">
                <div class="form-group">
                  <img style="display: block;margin-left: auto;margin-right: auto; width: 40%;" alt="image" src="<?= base_url('assets'); ?>/uploads/profil/<?= $image ?>" class="img-thumbnail">
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
    <!-- Modal view User Ends -->

    <!-- JS Libraies -->

    <!-- Page Specific JS File -->

