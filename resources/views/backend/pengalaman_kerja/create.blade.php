@extends('backend.layouts.template')

@section('content')
<section id="main-content">
    <section class="wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h3 class="page-header"><i class="bi bi-file-earmark-text"></i> Riwayat Hidup</h3>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><i class="bi bi-house-door"></i> <a href="{{ route('dash.index') }}">Home</a></li>
                        <li class="breadcrumb-item"><i class="bi bi-file-earmark-text"></i> Riwayat Hidup</li>
                        <li class="breadcrumb-item active" aria-current="page"><i class="bi bi-briefcase"></i> Pengalaman Kerja</li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <section class="card">
                    <header class="card-header">
                        {{ isset($admin_lecturer) ? 'Mengubah' : 'Menambahkan' }} Pengalaman Kerja
                    </header>
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <strong>Oops!</strong> There were some problems with your input.<br>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('pengalaman_kerja.store') }}" id="pengalaman_kerja_form">
                            @csrf
                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama Perusahaan</label>
                                <input type="text" class="form-control" id="nama" name="nama" minlength="5" required>
                            </div>

                            <div class="mb-3">
                                <label for="jabatan" class="form-label">Jabatan</label>
                                <input type="text" class="form-control" id="jabatan" name="jabatan" minlength="2" required>
                            </div>

                            <div class="mb-3">
                                <label for="tahun_masuk" class="form-label">Tahun Masuk</label>
                                <input type="text" class="form-control datepicker" id="tahun_masuk" name="tahun_masuk" required>
                            </div>

                            <div class="mb-3">
                                <label for="tahun_keluar" class="form-label">Tahun Selesai</label>
                                <input type="text" class="form-control datepicker" id="tahun_keluar" name="tahun_keluar" required>
                            </div>

                            <button type="submit" class="btn btn-primary"><i class="bi bi-save"></i> Simpan</button>
                            <a href="{{ route('pengalaman_kerja.index') }}" class="btn btn-secondary"><i class="bi bi-x"></i> Batal</a>
                        </form>
                    </div>
                </section>
            </div>
        </div>
    </section>
</section>
@endsection

@push('styles')
    <link href="{{ asset('backend/css/bootstrap-datepicker.css') }}" rel="stylesheet">
@endpush

@push('scripts')
    <script src="{{ asset('backend/js/bootstrap-datepicker.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('.datepicker').datepicker({
                format: 'yyyy',
                viewMode: 'years',
                minViewMode: 'years'
            });
        });
    </script>
@endpush