<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header text-dark">
        <h5 class="modal-title" id="exampleModalLabel">Register</h5>
        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
        <form action="/{{ request()->segment(1) }}/user" method="POST" class="mb-5 text-dark" enctype="multipart/form-data" style>
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Nama</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" required autofocus value="{{ old('name') }}">
            @error('name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control @error('username') is-invalid @enderror" id="username" name="username" required autofocus value="{{ old('username') }}">
            @error('username')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" name="email" required autofocus value="{{ old('email') }}">
            @error('email')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required autofocus value="{{ old('password') }}">
            @error('password')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="id_outlet" class="form-label">Outlet</label>
              <select class="form-select form-select mb-3" aria-label=".form-select example" id="outlet" name="id_outlet">
                  <option selected>Pilih Outlet</option>
                  @foreach ($outlet as $o )
                  <option value="{{ $o->id }}">{{ $o->nama }}</option>
                  @endforeach
                </select>
            @error('outlet')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
          </div>
        <div class="mb-3">
            <label for="role" class="form-label">Role</label>
            <select class="form-select form-select mb-3" aria-label=".form-select example" id="role" name="role">
              <option selected>Pilih Role</option>
              <option name="role">admin</option>
              <option name="role">owner</option>
            </select>
            @error('role')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
          </div>

        </div>
        <div class="modal-footer">
        <button type="submit" class="btn btn-secondary">Submit</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
        </form>
    </div>
    </div>
    </div>
