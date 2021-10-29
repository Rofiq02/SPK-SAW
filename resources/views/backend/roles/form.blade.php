@extends('layouts.backend.app')

@section('title','Roles')

@section('content')
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-check icon-gradient bg-mean-fruit">
                    </i>
                </div>
                <div>{{ isset($role) ? 'Edit' : 'Tambah' }} Role</div>
            </div>
            <div class="page-title-actions">
                <div class="d-inline-block dropdown">
                    <a href="{{ route('roles.index') }}" class="btn-shadow btn btn-danger">
                        <span class="btn-icon-wrapper pr-2 opacity-7">
                            <i class="fas fa-arrow-circle-left fa-w-20"></i>
                        </span>
                        Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="main-card mb-3 card">
                <!-- form start -->
                <form id="roleFrom" role="form" method="POST"
                      action="{{ isset($role) ? route('roles.update',$role->id) : route('roles.store') }}">
                    @csrf
                    @if (isset($role))
                        @method('PUT')
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">Kelola Roles</h5>
                        <input type="text" class="form-control" name="name" value="{{ $role->name ?? '' }}" placeholder="Masukkan nama role" required autofocus>

                        <div class="text-center">
                            <strong>Kelola permission untuk role</strong>
                            @error('permissions')
                            <p class="p-2">
                        <span class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                            </p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="select-all">
                                <label class="custom-control-label" for="select-all">Pilih semua</label>
                            </div>
                        </div>
                        @forelse ($modules->chunk(2) as $key => $chunks)
                            <div class="form-row">
                                @foreach ($chunks as $key => $module)
                                    <div class="col">
                                        <h5>Modul: {{ $module->name }}</h5>
                                        @foreach($module->permissions as $key => $permission)
                                            <div class="mb-3 ml-4">
                                                <div class="custom-control custom-checkbox mb-2">
                                                    <input type="checkbox" class="custom-control-input"
                                                           id="permission-{{ $permission->id }}"
                                                           value="{{ $permission->id }}"
                                                           name="permissions[]"
                                                    @if (isset($role))
                                                        @foreach($role->permissions as $rPermission)
                                                        {{ $permission->id == $rPermission->id ? 'checked' : '' }}
                                                        @endforeach
                                                    @endif
                                                    >
                                                    <label class="custom-control-label" for="permission-{{ $permission->id }}">{{ $permission->name }}</label>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @endforeach
                            </div>
                        @empty
                            <div class="row">
                                <div class="col text-center">
                                    <strong>Belum ada modul yang dibuat.</strong>
                                </div>
                            </div>
                        @endforelse

                        <button type="button" class="btn btn-danger" onClick="resetForm('roleFrom')">
                            <i class="fas fa-redo"></i>
                            <span>Reset</span>
                        </button>

                        <button type="submit" class="btn btn-primary">
                            @isset($role)
                                <i class="fas fa-arrow-circle-up"></i>
                                <span>Perbarui</span>
                            @else
                                <i class="fas fa-plus-circle"></i>
                                <span>Tambah</span>
                            @endisset
                        </button>
                    </div>
                </form>
            </div>
            <!-- /.card -->
        </div>
    </div>
@endsection

@push('js')
    <script type="text/javascript">
        // Listen for click on toggle checkbox
        $('#select-all').click(function (event) {
            if (this.checked) {
                // Iterate each checkbox
                $(':checkbox').each(function () {
                    this.checked = true;
                });
            } else {
                $(':checkbox').each(function () {
                    this.checked = false;
                });
            }
        });
    </script>
@endpush
