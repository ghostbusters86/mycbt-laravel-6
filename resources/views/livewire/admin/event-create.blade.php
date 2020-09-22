<form wire:submit.prevent="tambahEvent">
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label>Event:</label>
                <input type="text" class="form-control form-control-sm @error('event') is-invalid @enderror" wire:model="event" placeholder="Nama Event">
                @error('event') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label>Tanggal Mulai:</label>
                <input type="text" class="form-control form-control-sm @error('start_date') is-invalid @enderror" id="mulai" wire:model="start_date" placeholder="Tanggal Mulai" onchange="this.dispatchEvent(new InputEvent('input'))">
                @error('start_date') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label>Tanggal Selesai:</label>
                <input type="text" class="form-control form-control-sm @error('end_date') is-invalid @enderror" id="selesai" wire:model="end_date" placeholder="Tanggal Selesai" onchange="this.dispatchEvent(new InputEvent('input'))">
                @error('end_date') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label>Deskripsi <small><em>(optional)</em></small>:</label>
                <textarea cols="10" rows="3" class="form-control form-control-sm" wire:model="description" placeholder="Boleh dikosongkan"></textarea>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <button type="submit" class="btn btn-sm btn-block btn-flat btn-success">Tambah</button>
        </div>
    </div>
</form>