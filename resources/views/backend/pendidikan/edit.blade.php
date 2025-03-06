@extends('backend.layouts.template')

@section('content')
<section id="main-content">
    <section class="wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h3 class="page-header"><i class="icon_document_alt"></i> Edit Data Pendidikan</h3>
                <ol class="breadcrumb">
                    <li><i class="fa fa-home"></i><a href="{{ route('dash.index') }}">Home</a></li>
                    <li><i class="icon_document_alt"></i>Pendidikan</li>
                </ol>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                        Form Edit Pendidikan
                    </header>
                    <div class="panel-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('pendidikan.update', $pendidikan->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label for="nama">Nama Sekolah</label>
                                <input type="text" class="form-control" name="nama" value="{{ old('nama', $pendidikan->nama) }}" required>
                            </div>

                            <div class="form-group">
                                <label for="tingkatan">Tingkatan</label>
                                <select class="form-control" name="tingkatan" required>
                                    <option value="" disabled>Pilih Tingkatan</option>
                                    <option value="TK" {{ old('tingkatan', $pendidikan->tingkatan) == 'TK' ? 'selected' : '' }}>TK</option>
                                    <option value="SD" {{ old('tingkatan', $pendidikan->tingkatan) == 'SD' ? 'selected' : '' }}>SD</option>
                                    <option value="SMP" {{ old('tingkatan', $pendidikan->tingkatan) == 'SMP' ? 'selected' : '' }}>SMP</option>
                                    <option value="SMA/SMK" {{ old('tingkatan', $pendidikan->tingkatan) == 'SMA/SMK' ? 'selected' : '' }}>SMA/SMK</option>
                                    <option value="D3" {{ old('tingkatan', $pendidikan->tingkatan) == 'D3' ? 'selected' : '' }}>D3</option>
                                    <option value="D4/S1" {{ old('tingkatan', $pendidikan->tingkatan) == 'D4/S1' ? 'selected' : '' }}>D4/S1</option>
                                    <option value="S2" {{ old('tingkatan', $pendidikan->tingkatan) == 'S2' ? 'selected' : '' }}>S2</option>
                                    <option value="S3" {{ old('tingkatan', $pendidikan->tingkatan) == 'S3' ? 'selected' : '' }}>S3</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="tahun_masuk">Tahun Masuk</label>
                                <input type="number" class="form-control" name="tahun_masuk" value="{{ old('tahun_masuk', $pendidikan->tahun_masuk) }}" required>
                            </div>

                            <div class="form-group">
                                <label for="tahun_keluar">Tahun Keluar</label>
                                <input type="number" class="form-control" name="tahun_keluar" value="{{ old('tahun_keluar', $pendidikan->tahun_keluar) }}" required>
                            </div>

                            <button type="submit" class="btn btn-success">
                                <i class="fa fa-save"></i> Update
                            </button>
                            <a href="{{ route('pendidikan.index') }}" class="btn btn-danger">
                                <i class="fa fa-times"></i> Batal
                            </a>
                        </form>
                    </div>
                </section>
            </div>
        </div>
    </section>
</section>
@endsection
