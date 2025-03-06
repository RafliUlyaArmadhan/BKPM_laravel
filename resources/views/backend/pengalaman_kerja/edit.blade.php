@extends('backend.layouts.template')

@section('content')
<section id="main-content">
    <section class="wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h3 class="page-header"><i class="icon_document_alt"></i> Edit Pengalaman Kerja</h3>
                <ol class="breadcrumb">
                    <li><i class="fa fa-home"></i><a href="{{ url('dash.index') }}">Home</a></li>
                    <li><i class="icon_document_alt"></i>Riwayat Hidup</li>
                    <li><i class="fa fa-files-o"></i><a href="{{ route('pengalaman_kerja.index') }}">Pengalaman Kerja</a></li>
                    <li><i class="fa fa-edit"></i>Edit</li>
                </ol>
            </div>
        </div>

        <!-- Form Edit -->
        <div class="row">
            <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                        Form Edit Pengalaman Kerja
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

                        <form action="{{ route('pengalaman_kerja.update', $pengalaman_kerja->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label>Nama Perusahaan</label>
                                <input type="text" name="nama" class="form-control" value="{{ $pengalaman_kerja->nama }}" required>
                            </div>

                            <div class="form-group">
                                <label>Jabatan</label>
                                <input type="text" name="jabatan" class="form-control" value="{{ $pengalaman_kerja->jabatan }}" required>
                            </div>

                            <div class="form-group">
                                <label>Tahun Masuk</label>
                                <input type="number" name="tahun_masuk" class="form-control" value="{{ $pengalaman_kerja->tahun_masuk }}" required>
                            </div>

                            <div class="form-group">
                                <label>Tahun Keluar</label>
                                <input type="number" name="tahun_keluar" class="form-control" value="{{ $pengalaman_kerja->tahun_keluar }}" required>
                            </div>

                            <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
                            <a href="{{ route('pengalaman_kerja.index') }}" class="btn btn-secondary"><i class="fa fa-arrow-left"></i> Kembali</a>
                        </form>
                    </div>
                </section>
            </div>
        </div>
    </section>
</section>
@endsection