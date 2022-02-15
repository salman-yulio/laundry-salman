<!-- Modal -->
<div class="modal fade" id="staticBackdrop{{ $o->id }}" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                  <div class="modal-content">
                                                    <div class="modal-header text-dark">
                                                      <h5 class="modal-title" id="exampleModalLabel">Edit Data</h5>
                                                      <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                    <form action="/{{ request()->segment(1)}}/outlet/{{ $o->id }}" method="POST" class="mb-5" enctype="multipart/form-data">
                                              @method('PUT')
                                              @csrf
                                              <div class="mb-3">
                                                <label for="nama" class="form-label">Nama</label>
                                                <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" required autofocus value="{{ old('nama', $o->nama) }}">
                                                @error('nama')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                              </div>
                                              <div class="mb-3">
                                                <label for="alamat" class="form-label">Alamat</label>
                                                <input type="text" class="form-control @error('alamat') is-invalid @enderror" id="alamat" name="alamat" required autofocus value="{{ old('alamat', $o->alamat) }}">
                                                @error('alamat')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                              </div>
                                              <div class="mb-3">
                                                <label for="telepon" class="form-label">Telepon</label>
                                                <input type="text" class="form-control @error('telepon') is-invalid @enderror" id="telepon" name="telepon" required autofocus value="{{ old('telepon', $o->telepon) }}">
                                                @error('telepon')
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
                                          <form action="/{{ request()->segment(1)}}/outlet/{{ $o->id }}" method="post" class="d-inline">
                                              @csrf
                                              <input type="hidden" name="_method" value="DELETE">
                                              <button class="btn btn-danger delete-outlet border-0">Delete</button> &nbsp;
                                          </form>
