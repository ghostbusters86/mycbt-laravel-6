<div class="modal fade" id="modalPenilaian" tabindex="-1" role="dialog" aria-labelledby="modalPenilaianTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalPenilaianTitle">Tambah</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="formPenilaian" method="POST" data-parsley-validate>
            @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="penilaian">Nama Penilaian:</label>
                                <input type="text" name="penilaian" id="penilaian" class="form-control form-control-sm" placeholder="Nama Penilaian" data-parsley-error-message="Nama Penilaian tidak boleh kosong" required>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="level">Tingkat:</label>
                                <select name="level" id="level" class="form-control form-control-sm" required data-parsley-required-message="Level tidak boleh kosong">
                                    <option value="">-- Pilih --</option>
                                    <option value="mudah">Mudah</option>
                                    <option value="sedang">Sedang</option>
                                    <option value="sulit">Sulit</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="benar">Point Benar:</label>
                                <input type="text" name="benar" id="benar" class="form-control form-control-sm" placeholder="Hanya diisi dengan angka/koma menggunakan titik" data-parsley-error-message="Poin tidak boleh kosong" required oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="salah">Point Salah:</label>
                                <input type="text" name="salah" id="salah" class="form-control form-control-sm" placeholder="Hanya diisi dengan angka/koma menggunakan titik" data-parsley-error-message="Poin tidak boleh kosong" required>
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
                <h4 style="margin:0;">Apakah anda yakin ingin menghapus Penilaian ini?</h4>
            </div>
            <div class="modal-footer">
             <button type="button" name="ok_button" id="ok_button" class="btn btn-danger">HAPUS</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            </div>
        </div>
    </div>
</div>