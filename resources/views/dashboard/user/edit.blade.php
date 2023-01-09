<!-- Modal -->
<div class="modal fade" id="ModalPerbaharuiData{{ $u->id }}" data-backdrop="static" data-keyboard="false"
    tabindex="-1" aria-labelledby="ModalPerbaharuiDataLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header text-dark">
                <h5 class="modal-title" id="ModalPerbaharuiDataLabel">Edit Data</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-dark">
                <form action="/{{ request()->segment(1) }}/user/{{ $u->id }}" method="POST"
                    class="mb-5" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                            name="name" required autofocus value="{{ old('name', $u->name) }}">
                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="text" class="form-control @error('email') is-invalid @enderror" id="email"
                            name="email" required autofocus value="{{ old('email', $u->email) }}">
                        @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Outlet</label>
                        <select name="id_outlet" id="outlet" class="form-control js-example-basic-single w-100">
                            @foreach ($outlet as $otl)
                                @if (old('id_outlet') && old('id_outlet') == $otl->id)
                                    <option value="{{ $otl->id }}" selected>{{ $otl->nama }}</option>
                                @else
                                @endif
                                <option value="{{ $otl->id }}">{{ $otl->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="role" class="form-label">Role</label>
                        <select class="form-control" name="role" id="role">
                            <option value="admin" @if ($u->jenis == 'admin') selected @endif>Admin</option>
                            <option value="kasir" @if ($u->jenis == 'kasr') selected @endif>Kasir</option>
                            <option value="owner" @if ($u->jenis == 'owner') selected @endif>Owner</option>
                        </select>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-warning">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>
