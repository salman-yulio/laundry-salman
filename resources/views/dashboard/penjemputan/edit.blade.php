<!-- Modal -->
<div class="modal fade" id="staticBackdrop{{ $p->id }}" data-backdrop="static" data-keyboard="false"
    tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header text-dark">
                <h5 class="modal-title" id="exampleModalLabel">Edit Data</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/{{ request()->segment(1) }}/penjemputan/{{ $p->id }}" method="POST"
                    class="mb-5" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="mb-3">
                        <label for="id_member" class="form-label">Pelanggan</label>
                        <select class="form-control form-select mb-3" aria-label=".form-select example" id="member"
                            name="id_member">
                            <option selected>Pilih Member</option>
                            @foreach ($member as $m)
                                <option value="{{ $m->id }}">{{ $m->nama }}</option>
                            @endforeach
                        </select>
                        @error('member')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="petugas" class="form-label">Nama Petugas
                            Penjemputan</label>
                        <input type="text" class="form-control @error('petugas') is-invalid @enderror" id="petugas"
                            name="petugas" required autofocus value="{{ old('petugas', $p->petugas) }}">
                        @error('petugas')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="status" class="form-label">Status </label>
                        <select class="form-select form-control col-8 form-select mb-3"
                            aria-label=".form-select example" id="status" name="status" required autofocus
                            value="{{ old('status', $p->status) }}">
                            <option selected>Pilih status Penjemputan</option>
                            <option name="status" value="tercatat">Tercatat</option>
                            <option name="status" value="penjemputan">Penjemputan</option>
                            <option name="status" value="selesai">Selesai</option>
                        </select>
                        @error('status')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-dark border-0">Save</button>
            </div>
            </form>
        </div>
    </div>
</div>
<form action="/{{ request()->segment(1) }}/penjemputan/{{ $p->id }}" method="post" class="d-inline">
    @csrf
    <input type="hidden" name="_method" value="DELETE">
    <button class="btn btn-danger delete-penjemputan border-0">Delete</button> &nbsp;
</form>
