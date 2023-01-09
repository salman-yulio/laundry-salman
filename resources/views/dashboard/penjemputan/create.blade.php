                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header text-dark">
                                        <h5 class="modal-title" id="exampleModalLabel">Input New Data</h5>
                                        <button type="button" class="btn-close" data-dismiss="modal"
                                            aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">

                                        <form action="/{{ request()->segment(1) }}/penjemputan" method="POST"
                                            class="mb-5 text-dark" enctype="multipart/form-data" style>
                                            @csrf
                                            <div class="mb-3">
                                                <label for="id_member" class="form-label">Pelanggan</label>
                                                <select class="form-control form-select mb-3"
                                                    aria-label=".form-select example" id="member" name="id_member">
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
                                                <input type="text"
                                                    class="form-control @error('petugas') is-invalid @enderror"
                                                    id="petugas" name="petugas" required autofocus
                                                    value="{{ old('petugas') }}">
                                                @error('petugas')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label for="status" class="form-label">Status </label>
                                                <select class="form-select form-control col-8 form-select mb-3"
                                                    aria-label=".form-select example" id="status" name="status" required
                                                    autofocus value="{{ old('status') }}">
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
                                        <button type="submit" class="btn btn-secondary">Save</button>
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Close</button>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
