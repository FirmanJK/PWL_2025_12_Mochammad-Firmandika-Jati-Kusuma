@extends('layouts.template')

@section('content')

<div class="row">
    <div class="col-md-4">
        <div class="card card-primary card-outline">
            <div class="card-body box-profile">
                <div class="text-center">
                    <img class="profile-user-img img-fluid img-circle" 
                         src="{{ asset('storage/profile/' . ($user->profile_photo ?? 'Foto.jpg')) }}"
                         alt="User profile picture"
                         style="width: 150px; height: 150px; object-fit: cover; border: 5px solid #e9ecef;">
                </div>

                <h3 class="profile-username text-center">{{ $user->nama }}</h3>

                <p class="text-muted text-center">{{ $user->level->level_nama ?? 'Tidak diketahui' }}</p>

                <ul class="list-group list-group-unbordered mb-3">
                    <li class="list-group-item">
                        <b>Username</b> <a class="float-right">{{ $user->username }}</a>
                    </li>
                    <li class="list-group-item">
                        <b>ID Level</b> <a class="float-right">{{ $user->level_id }}</a>
                    </li>
                </ul>

                <button onclick="modalAction('{{ route('profile.edit') }}')" 
                        class="btn btn-primary btn-block">
                    <i class="fas fa-camera mr-2"></i>Edit Foto Profil
                </button>
            </div>
        </div>
    </div>

    <div class="col-md-8">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Informasi Profil</h3>
            </div>
            
            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <i class="icon fas fa-check"></i> {{ session('success') }}
                    </div>
                @endif
                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <i class="icon fas fa-ban"></i> {{ session('error') }}
                    </div>
                @endif

                <form action="{{ route('profile.update') }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Username</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" value="{{ $user->username }}" readonly>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Nama Lengkap</label>
                        <div class="col-sm-9">
                            <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" 
                                   value="{{ old('nama', $user->nama) }}">
                            @error('nama')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Password Baru</label>
                        <div class="col-sm-9">
                            <div class="input-group">
                                <input type="password" name="password" 
                                       class="form-control @error('password') is-invalid @enderror"
                                       placeholder="Kosongkan jika tidak ingin mengubah">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary toggle-password" type="button">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                                @error('password')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <small class="text-muted">Minimal 8 karakter</small>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Konfirmasi Password</label>
                        <div class="col-sm-9">
                            <input type="password" name="password_confirmation" 
                                   class="form-control" 
                                   placeholder="Konfirmasi password baru">
                        </div>
                    </div>

                    <div class="form-group row mt-4">
                        <div class="col-sm-9 offset-sm-3">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save mr-2"></i>Simpan Perubahan
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="myModal" class="modal fade animate shake" tabindex="-1" data-backdrop="static" data-keyboard="false" data-width="75%"></div>

@endsection

@push('js')
<script>
    function modalAction(url = '') {
        $('#myModal').load(url, function(response, status, xhr) {
            if (status == "error") {
                alert('Terjadi kesalahan saat memuat form');
            } else {
                $('#myModal').modal('show');
            }
        });
    }

    $(document).ready(function() {
        $('.toggle-password').click(function() {
            const input = $(this).parent().prev('input');
            const icon = $(this).find('i');
            
            if (input.attr('type') === 'password') {
                input.attr('type', 'text');
                icon.removeClass('fa-eye').addClass('fa-eye-slash');
            } else {
                input.attr('type', 'password');
                icon.removeClass('fa-eye-slash').addClass('fa-eye');
            }
        });
    });
</script>
@endpush