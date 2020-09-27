<div class="modal fade" id="modalMapel" tabindex="-1" role="dialog" aria-labelledby="modalMapelTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalMapelTitle">Tambah</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="formMapel" method="POST" data-parsley-validate>
            @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="event_id">Pilih Event:</label>
                                <select name="event_id" id="event_id" class="form-control form-control-sm" data-parsley-required-message="Event tidak boleh kosong">
                                    <option value="">-- Pilih --</option>
                                    @foreach ($events as $event)
                                        <option value="{{ $event->id }}">{{ $event->event }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="mapel">Mata Pelajaran:</label>
                                <input type="text" name="mapel" id="mapel" class="form-control form-control-sm" placeholder="Mata Pelajaran" data-parsley-error-message="Mata Pelajaran tidak boleh kosong" required>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="waktu">Waktu:</label>
                                <div class="input-group input-group-sm">
                                    <input type="text" name="waktu" id="waktu" class="form-control form-control-sm" placeholder="Waktu" data-parsley-error-message="Waktu tidak boleh kosong" required oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                                    <div class="input-group-prepend">
                                      <div class="input-group-text">Menit</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="row">
                        <div class="col">
                            <input type="hidden" name="action" id="action">
                            <input type="hidden" name="hidden_id" id="hidden_id">
                            <input type="hidden" name="kode_mapel" id="kode_mapel">
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
                <h4 style="margin:0;">Apakah anda yakin ingin menghapus Mata Pelajaran ini?</h4>
            </div>
            <div class="modal-footer">
             <button type="button" name="ok_button" id="ok_button" class="btn btn-danger">HAPUS</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            </div>
        </div>
    </div>
</div>