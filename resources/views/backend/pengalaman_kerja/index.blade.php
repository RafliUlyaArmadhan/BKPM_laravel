@extends('backend.layouts.template')

@section('content')
<section id="main-content">
    <section class="wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h3 class="page-header"><i class="icon_document_alt"></i> Pengalaman Kerja</h3>
                <ol class="breadcrumb">
                    <li><i class="fa fa-home"></i><a href="{{ route('dash.index') }}"> Home</a></li>
                    <li><i class="fa fa-briefcase"></i> Pengalaman Kerja</li>
                </ol>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                        <strong>Data Pengalaman Kerja</strong>
                    </header>
                    <div class="panel-body">
                        @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                        @endif

                        <a href="{{ route('pengalaman_kerja.create') }}" class="btn btn-primary">
                            <i class="fa fa-plus"></i> Tambah
                        </a>

                        <br><br>

                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama</th>
                                    <th>Jabatan</th>
                                    <th>Tahun Masuk</th>
                                    <th>Tahun Keluar</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pengalaman_kerja as $key => $data)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $data->nama }}</td>
                                    <td>{{ $data->jabatan }}</td>
                                    <td>{{ $data->tahun_masuk }}</td>
                                    <td>{{ $data->tahun_keluar ?? '-' }}</td>
                                    <td>
                                        <a class="btn btn-warning" href="{{ route('pengalaman_kerja.edit', $data->id) }}">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <form action="{{ route('pengalaman_kerja.destroy', $data->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach

                                @if ($pengalaman_kerja->isEmpty())
                                <tr>
                                    <td colspan="6" class="text-center"><strong>Belum ada data pengalaman kerja.</strong></td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </section>
            </div>
        </div>
    </section>
</section>
@endsection
