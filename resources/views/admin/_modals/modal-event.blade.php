<div class="modal fade" id="modalEvent" tabindex="-1" role="dialog" aria-labelledby="modalEventTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEventTitle">Tambah</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="formEvent" method="POST" data-parsley-validate>
            @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="event">Event:</label>
                                <input type="text" name="event" id="event" class="form-control form-control-sm" placeholder="Event" data-parsley-error-message="Event tidak boleh kosong" required>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="tingkat">Tingkat:</label>
                                <select name="tingkat" id="tingkat" class="form-control">
                                    <option value="">-- Pilih Tingkat --</option>
                                    <option value="SD">siswa SD</option>
                                    <option value="SMP">siswa SMP</option>
                                    <option value="SMA">siswa SMA</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="start_date">Start Date:</label>
                                <input type="text" name="start_date" id="start_date" class="start form-control form-control-sm" placeholder="Tanggal Mulai" data-parsley-error-message="Tanggal tidak boleh kosong" required>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="end_date">End Date:</label>
                                <input type="text" name="end_date" id="end_date" class="end form-control form-control-sm" placeholder="Tanggal Selesai" data-parsley-error-message="Tanggal tidak boleh kosong" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="description">Deskripsi <small><em>(optional)</em></small></label>
                                <textarea name="description" id="description" class="form-control form-control-sm" cols="10" rows="3" placeholder="Boleh Kosong"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="row">
                        <div class="col">
                            <input type="hidden" name="action" id="action">
                            <input type="hidden" name="hidden_id" id="hidden_id">
                            <input type="submit" name="action_button" id="action_button" class="btn btn-sm btn-block btn-flat btn-success" value="Tambah">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<div id="confirmModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title">Confirmation</h2>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <h4 style="margin:0;">Apakah anda yakin ingin menghapus event ini?</h4>
            </div>
            <div class="modal-footer">
             <button type="button" name="ok_button" id="ok_button" class="btn btn-danger">HAPUS</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            </div>
        </div>
    </div>
</div>