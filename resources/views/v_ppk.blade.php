@extends('layout.v_layout')
@section('content')
@if(session('success'))
<script>
    $(function() { //ready
        toastr.success("{{session('success')}}");
    });
</script>
@endif

@if(session('failed'))
<script>
    $(function() { //ready
        toastr.error("{{session('failed')}}");
    });
</script>
@endif
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-6">
                    <h3 class="fw-bold">PPK</h3>
                </div>
                <div class="col-md-6 text-end">
                    <button data-bs-toggle="modal" data-bs-target="#modalAdd" class="btn btn-primary">
                        <i class="bi bi-plus-circle"></i> Tambah
                    </button>
                </div>
            </div>
        </div>

        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th style="width: 10%;">No.</th>
                        <th style="width: 30%;">PPK (Jabatan)</th>
                        <th style="width: 30%;">Nama PPK Saat Ini</th>
                        <th style="width: 30%;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($ppk as $index => $data)
                    <tr>
                        <th>
                            {{ $ppk->firstItem() + $index }}
                        </th>
                        <td>{{ $data->jabatan_ppk }}</td>
                        <td>{{ $data->nama }}</td>
                        <td>
                            <div class="d-flex gap-2">
                                <button data-bs-toggle="modal" data-bs-target="#modalEdit{{$data->id_ppk}}" class="btn btn-warning">
                                    <i class="bi bi-pencil-square"></i> Perbarui
                                </button>

                                <button data-bs-toggle="modal" data-bs-target="#modalDelete{{$data->id_ppk}}" class="btn btn-danger">
                                    <i class="bi bi-trash"></i> Hapus
                                </button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="d-flex justify-content-center mt-3">
                {{ $ppk->links() }}
            </div>

        </div>
    </div>
</div>


<div class="modal fade" id="modalAdd" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">

            <form action="/ppk/insert" method="POST">
                @csrf

                <div class="modal-header bg-primary">
                    <h1 class="modal-title text-white fs-5">Tambah PPK</h1>
                    <button type="button" class="btn-close" style="filter: invert(1) grayscale(100%) brightness(200%);" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <label for="jabatan_ppk" class="col-form-label">PPK (Jabatan)</label>
                    <input type="text" name="jabatan_ppk" class="form-control" id="jabatan_ppk" />
                </div>

                <div class="modal-body">
                    <label for="nama" class="col-form-label">Nama PPK Saat Ini</label>
                    <input type="text" name="nama" class="form-control" id="nama" />
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Tutup
                    </button>

                    <button type="submit" class="btn btn-primary">
                        Simpan
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>

@foreach ($ppk as $index => $data)
<div class="modal fade" id="modalEdit{{$data->id_ppk}}" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">

            <form action="/ppk/update/{{$data->id_ppk}}" method="POST">
                @csrf

                <div class="modal-header bg-warning">
                    <h1 class="modal-title fs-5">Perbarui PPK</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <label for="jabatan_ppk" class="col-form-label">Jabatan (PPK)</label>
                    <input type="text" value="{{$data->jabatan_ppk}}" name="jabatan_ppk" class="form-control" id="jabatan_ppk" />
                </div>

                <div class="modal-body">
                    <label for="nama" class="col-form-label">Nama PPK Saat Ini</label>
                    <input type="text" value="{{$data->nama}}" name="nama" class="form-control" id="nama" />
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Tutup
                    </button>

                    <button type="submit" class="btn btn-warning">
                        Simpan
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>

<div class="modal fade" id="modalDelete{{$data->id_ppk}}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h5 class="modal-title text-white" id="exampleModalCenterTitle">{{$data->jabatan_ppk}}</h5>
                <button type="button" style="filter: invert(1) grayscale(100%) brightness(200%);" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-danger">
                Apakah anda yakin ingin menghapus data ini?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak</button>
                <a href="/ppk/delete/{{$data->id_ppk}}" class="btn btn-danger">Ya</a>
            </div>
        </div>
    </div>
</div>
@endforeach

@endsection