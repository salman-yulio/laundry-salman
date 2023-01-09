                        <!-- Modal -->
                        <div class="modal fade" id="staticBackdrop{{ $a->id }}" tabindex="-1" role="dialog"
                            aria-labelledby="staticBackdrop" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header text-dark">
                                        <h5 class="modal-title" id="exampleModalLabel">Edit Data</h5>
                                        <button type="button" class="btn-close" data-dismiss="modal"
                                            aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">

                                        <form action="/{{ request()->segment(1) }}/absensi/{{ $a->id }}"
                                            method="POST" class="mb-5 text-dark" enctype="multipart/form-data" style>
                                            @method('PUT')
                                            @csrf
                                            <div class="mb-3">
                                                <label for="nama" class="form-label">Nama Karyawan</label>
                                                <input type="text"
                                                    class="form-control @error('nama') is-invalid @enderror" id="nama"
                                                    name="nama" required autofocus
                                                    value="{{ old('nama', $a->nama) }}">
                                                @error('nama')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label for="tanggal_masuk" class="form-label">Tanggal Masuk</label>
                                                <input type="date"
                                                    class="form-control @error('tanggal_masuk') is-invalid @enderror"
                                                    id="tanggal_masuk" name="tanggal_masuk" required autofocus
                                                    value="{{ old('tanggal_masuk', $a->tanggal_masuk) }}">
                                                @error('tanggal_masuk')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label for="waktu_masuk" class="form-label">Waktu Masuk</label>
                                                <input type="time"
                                                    class="form-control @error('waktu_masuk') is-invalid @enderror"
                                                    id="waktu_masuk" name="waktu_masuk" required autofocus
                                                    value="{{ old('waktu_masuk', $a->waktu_masuk) }}">
                                                @error('harga')
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
