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
                    <h3 class="fw-bold">Paket Pekerjaan</h1>
                </div>
                <div class="col-md-6 text-end">
                    <button href="/add" data-bs-toggle="modal" data-bs-target="#modalAdd" class="btn btn-primary">
                        <i class="bi bi-plus-circle"></i> Tambah
                    </button>
                </div>
            </div>
            <form method="GET" action="">
                <div class="row mb-3 align-items-end">

                    <!-- Kecil -->
                    <div class="col-md-2">
                        <input type="text" name="tahun" class="form-control" placeholder="Tahun Anggaran"
                            value="{{ request('tahun') }}">
                    </div>

                    <!-- Besar -->
                    <div class="col-md-4">
                        <input type="text" name="jabatan" class="form-control" placeholder="PPK (Jabatan)"
                            value="{{ request('jabatan') }}">
                    </div>

                    <!-- Besar -->
                    <div class="col-md-4">
                        <input type="text" name="nama" class="form-control" placeholder="Nama PPK"
                            value="{{ request('nama') }}">
                    </div>

                    <!-- Tombol -->
                    <div class="col-md-2 d-flex justify-content-end gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-search"></i> Cari
                        </button>

                        <a href="{{ url()->current() }}" class="btn btn-secondary">
                            Reset
                        </a>
                    </div>

                </div>
            </form>
        </div>
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col" style="width: 10%;">No.</th>
                        <th scope="col" style="width: 20%;">Paket</th>
                        <th scope="col" style="width: 15%;">Satker</th>
                        <th scope="col" style="width: 15%;">PPK (Jabatan)</th>
                        <th scope="col" style="width: 15%;">Nama PPK Saat Ini</th>
                        <th scope="col" style="width: 10%;">Tahun Anggaran</th>
                        <th scope="col" style="width: 30%;">Action</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach($paket as $index => $data)
                    <tr>
                        <th scope="row">{{ $paket->firstItem() + $index }}</th>
                        <td>{{ $data->nama_paket_pekerjaan }}</td>
                        <td>{{ $data->satker }}</td>
                        <td>{{ $data->jabatan_ppk }}</td>
                        <td>{{ $data->nama }}</td>
                        <td>{{ $data->tahun_anggaran }}</td>
                        <td>
                            <div class="d-flex gap-2">
                                <a href="/paket/detail/{{$data->id_paket_pekerjaan}}" class="btn btn-primary">
                                    <i class="bi bi-info-circle"></i> Detail
                                </a>

                                <button data-bs-toggle="modal" data-bs-target="#modalEdit{{$data->id_paket_pekerjaan}}" class="btn btn-warning">
                                    <i class="bi bi-pencil-square"></i> Perbarui
                                </button>

                                <button data-bs-toggle="modal" data-bs-target="#modalDelete{{$data->id_paket_pekerjaan}}" class="btn btn-danger">
                                    <i class="bi bi-trash"></i> Hapus
                                </button>
                            </div>
                        </td>

                    </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="d-flex justify-content-center mt-3">
                {{ $paket->links() }}
            </div>

        </div>
    </div>
</div>


<div class="modal fade" id="modalAdd" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">

            <form action="/paket/insert" method="POST">
                @csrf

                <div class="modal-header bg-primary">
                    <h1 class="modal-title text-white fs-5">Tambah Paket</h1>
                    <button type="button" class="btn-close" style="filter: invert(1) grayscale(100%) brightness(200%);" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <div>
                        <label for="id_satker" class="col-form-label">Nama Satker</label>
                        <select class="form-select" name="id_satker" id="id_satker" required>
                            <option value="2">SNVT PJPA SULAWESI IV PROV. SULAWESI TENGGARA</option>
                            <option value="3">SNVT PJSA SULAWESI IV PROV. SULAWESI TENGGARA</option>
                            <option value="4">SNVT PEMBANGUNAN BENDUNGAN BWS SULAWESI IV</option>
                            <option value="5">SATKER OP SDA SULAWESI IV</option>
                        </select>
                    </div>

                    <div>
                        <label for="id_ppk" class="col-form-label">PPK (Jabatan)</label>
                        <select class="form-select" id="id_ppk" name="id_ppk" required>
                            @foreach($ppk as $data)
                            <option value="{{ $data->id_ppk }}">{{ $data->jabatan_ppk }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="nama_paket_pekerjaan" class="col-form-label">Nama Paket Pekerjaan</label>
                        <input type="text" name="nama_paket_pekerjaan" class="form-control" id="nama_paket_pekerjaan" required />
                    </div>
                    <div>
                        <label for="tahun_anggaran" class="col-form-label">Tahun Anggaran</label>
                        <input type="number" name="tahun_anggaran" class="form-control" id="tahun_anggaran" required />
                    </div>
                    <div>
                        <label for="nilai_kontrak" class="col-form-label">Nilai Kontrak (Rp.)</label>
                        <input type="number" name="nilai_kontrak" class="form-control" id="nilai_kontrak" required />
                    </div>
                    <div>
                        <label for="nomor_kontrak" class="col-form-label">Nomor Kontrak</label>
                        <input type="number" name="nomor_kontrak" class="form-control" id="nomor_kontrak" required />
                    </div>
                    <div>
                        <label for="nama_penyedia" class="col-form-label">Nama Penyedia</label>
                        <input type="text" name="nama_penyedia" class="form-control" id="nama_penyedia" required />
                    </div>
                    <div>
                        <label for="tanggal_mulai_kontrak" class="col-form-label">Tanggal Mulai Kontrak</label>
                        <input type="date" name="tanggal_mulai_kontrak" class="form-control" id="tanggal_mulai_kontrak" required />
                    </div>
                    <div>
                        <label for="tanggal_selesai_kontrak" class="col-form-label">Tanggal Selesai Kontrak</label>
                        <input type="date" name="tanggal_selesai_kontrak" class="form-control" id="tanggal_selesai_kontrak" required />
                    </div>
                    <div>
                        <label for="tanggal_pho" class="col-form-label">Tanggal PHO</label>
                        <input type="date" name="tanggal_pho" class="form-control" id="tanggal_pho" required />
                    </div>
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

@foreach ($paket as $index => $data)
<div class="modal fade" id="modalEdit{{$data->id_paket_pekerjaan}}" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">

            <form action="/paket/update/{{$data->id_paket_pekerjaan}}" method="POST">
                @csrf

                <div class="modal-header bg-primary">
                    <h1 class="modal-title text-white fs-5">Perbarui Paket</h1>
                    <button type="button" class="btn-close" style="filter: invert(1) grayscale(100%) brightness(200%);" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <div>
                        <label for="id_satker" class="col-form-label">Nama Satker</label>
                        <select class="form-select" name="id_satker" id="id_satker" required>
                            <option value="2">SNVT PJPA SULAWESI IV PROV. SULAWESI TENGGARA</option>
                            <option value="3">SNVT PJSA SULAWESI IV PROV. SULAWESI TENGGARA</option>
                            <option value="4">SNVT PEMBANGUNAN BENDUNGAN BWS SULAWESI IV</option>
                            <option value="5">SATKER OP SDA SULAWESI IV</option>
                        </select>
                    </div>

                    <div>
                        <label for="id_ppk" class="col-form-label">Nama PPK</label>
                        <select class="form-select" id="id_ppk" name="id_ppk" size="5" required>
                            @foreach($ppk as $dataPPK)
                            <option value="{{ $dataPPK->id_ppk }}"
                                {{ $dataPPK->id_ppk == $data->id_ppk ? 'selected' : '' }}>
                                {{ $dataPPK->nama }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="nama_paket_pekerjaan" class="col-form-label">Nama Paket Pekerjaan</label>
                        <input type="text" value="{{$data->nama_paket_pekerjaan}}" name="nama_paket_pekerjaan" class="form-control" id="nama_paket_pekerjaan" required />
                    </div>
                    <div>
                        <label for="tahun_anggaran" class="col-form-label">Tahun Anggaran</label>
                        <input type="number" value="{{$data->tahun_anggaran}}" name="tahun_anggaran" class="form-control" id="tahun_anggaran" required />
                    </div>
                    <div>
                        <label for="nilai_kontrak" class="col-form-label">Nilai Kontrak (Rp.)</label>
                        <input type="number" value="{{$data->nilai_kontrak}}" name="nilai_kontrak" class="form-control" id="nilai_kontrak" required />
                    </div>
                    <div>
                        <label for="nomor_kontrak" class="col-form-label">Nomor Kontrak</label>
                        <input type="number" value="{{$data->nomor_kontrak}}" name="nomor_kontrak" class="form-control" id="nomor_kontrak" required />
                    </div>
                    <div>
                        <label for="nama_penyedia" class="col-form-label">Nama Penyedia</label>
                        <input type="text" value="{{$data->nama_penyedia}}" name="nama_penyedia" class="form-control" id="nama_penyedia" required />
                    </div>
                    <div>
                        <label for="tanggal_mulai_kontrak" class="col-form-label">Tanggal Mulai Kontrak</label>
                        <input type="date" value="{{$data->tanggal_mulai_kontrak}}" name="tanggal_mulai_kontrak" class="form-control" id="tanggal_mulai_kontrak" required />
                    </div>
                    <div>
                        <label for="tanggal_selesai_kontrak" class="col-form-label">Tanggal Selesai Kontrak</label>
                        <input type="date" value="{{$data->tanggal_selesai_kontrak}}" name="tanggal_selesai_kontrak" class="form-control" id="tanggal_selesai_kontrak" required />
                    </div>
                    <div>
                        <label for="tanggal_pho" class="col-form-label">Tanggal PHO</label>
                        <input type="date" value="{{$data->tanggal_pho}}" name="tanggal_pho" class="form-control" id="tanggal_pho" required />
                    </div>
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

<div class="modal fade" id="modalDelete{{$data->id_paket_pekerjaan}}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h5 class="modal-title text-white" id="exampleModalCenterTitle">{{$data->nama_paket_pekerjaan}}</h5>
                <button type="button" style="filter: invert(1) grayscale(100%) brightness(200%);" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-danger">
                Apakah anda yakin ingin menghapus data ini?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak</button>
                <a href="/paket/delete/{{$data->id_paket_pekerjaan}}" class="btn btn-danger">Ya</a>
            </div>
        </div>
    </div>
</div>
@endforeach

@endsection