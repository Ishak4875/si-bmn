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
            </div>
        </div>
        <div class="card-body">
            <table class="table">
                <tbody>
                    <tr>
                        <th scope="row">Nama Paket</th>
                        <td>:</td>
                        <td>{{ $paket->nama_paket_pekerjaan }}</td>
                    </tr>
                    <tr>
                        <th scope="row">Nama Satker</th>
                        <td>:</td>
                        <td>{{ $paket->satker }}</td>
                    </tr>
                    <tr>
                        <th scope="row">Nama PPK</th>
                        <td>:</td>
                        <td>{{ $paket->nama }}</td>
                    </tr>
                    <tr>
                        <th scope="row">Tahun Anggaran</th>
                        <td>:</td>
                        <td>{{ $paket->tahun_anggaran }}</td>
                    </tr>
                    <tr>
                        <th scope="row">Nilai Kontrak</th>
                        <td>:</td>
                        <td>{{ $paket->nilai_kontrak }}</td>
                    </tr>
                    <tr>
                        <th scope="row">Nomor Kontrak</th>
                        <td>:</td>
                        <td>{{ $paket->nomor_kontrak }}</td>
                    </tr>
                    <tr>
                        <th scope="row">Nama Penyedia</th>
                        <td>:</td>
                        <td>{{ $paket->nama_penyedia }}</td>
                    </tr>
                    <tr>
                        <th scope="row">Tanggal Mulai Kontrak</th>
                        <td>:</td>
                        <td>{{ $paket->tanggal_mulai_kontrak }}</td>
                    </tr>
                    <tr>
                        <th scope="row">Tanggal Selesai Kontrak</th>
                        <td>:</td>
                        <td>{{ $paket->tanggal_selesai_kontrak }}</td>
                    </tr>
                    <tr>
                        <th scope="row">Tanggal PHO</th>
                        <td>:</td>
                        <td>{{ $paket->tanggal_pho }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <br>
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-6">
                    <h3 class="fw-bold">Rincian Output Pekerjaan</h1>
                </div>
                <div class="col-md-6 text-end">
                    <button href="/add" data-bs-toggle="modal" data-bs-target="#modalAdd" class="btn btn-primary">
                        <i class="bi bi-plus-circle"></i> Tambah
                    </button>
                </div>
            </div>
            <form method="GET" action="/paket/detail/{{$paket->id_paket_pekerjaan}}/search">
                <div class="row mb-3 align-items-end">

                    <!-- Kecil -->
                    <div class="col-md-10">
                        <input type="text" name="jenis_bangunan" class="form-control" placeholder="Jenis Bangunan"
                            value="{{ request('jenis_bangunan') }}">
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
                        <th scope="col" style="width: 20%;">Jenis Bangunan</th>
                        <th scope="col" style="width: 15%;">Volume</th>
                        <th scope="col" style="width: 15%;">Satuan</th>
                        <th scope="col" style="width: 10%;">Nilai Bangunan (Rp.)</th>
                        <th scope="col" style="width: 30%;">Action</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach($output as $index => $data)
                    <tr>
                        <th scope="row">{{ $output->firstItem() + $index }}</th>
                        <td>{{ $data->jenis_bangunan }}</td>
                        <td>{{ $data->volume }}</td>
                        <td>{{ $data->satuan }}</td>
                        <td>{{ $data->nilai_bangunan }}</td>
                        <td>
                            <div class="d-flex gap-2">
                                <button data-bs-toggle="modal" data-bs-target="#modalDetail{{$data->id_rincian_output}}" class="btn btn-primary">
                                    <i class="bi bi-info-circle"></i> Detail
                                </button>

                                <button data-bs-toggle="modal" data-bs-target="#modalEdit{{$data->id_rincian_output}}" class="btn btn-warning">
                                    <i class="bi bi-pencil-square"></i> Perbarui
                                </button>

                                <button data-bs-toggle="modal" data-bs-target="#modalDelete{{$data->id_rincian_output}}" class="btn btn-danger">
                                    <i class="bi bi-trash"></i> Hapus
                                </button>
                            </div>
                        </td>

                    </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="d-flex justify-content-center mt-3">
                {{ $output->links() }}
            </div>
        </div>
    </div>
</div>


<!-- Modal Tambah -->
<div class="modal fade" id="modalAdd" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">

            <form action="/output/insert/{{$paket->id_paket_pekerjaan}}" method="POST">
                @csrf

                <div class="modal-header bg-primary">
                    <h1 class="modal-title text-white fs-5">Tambah Output</h1>
                    <button type="button" class="btn-close" style="filter: invert(1) grayscale(100%) brightness(200%);" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <div>
                        <label for="jenis_bangunan" class="col-form-label">Jenis Bangunan</label>
                        <input type="text" name="jenis_bangunan" class="form-control" id="jenis_bangunan" required />
                    </div>
                    <div>
                        <label for="volume" class="col-form-label">Volume</label>
                        <input type="number" name="volume" class="form-control" id="volume" required />
                    </div>
                    <div>
                        <label for="satuan" class="col-form-label">Satuan</label>
                        <input type="text" name="satuan" class="form-control" id="satuan" required />
                    </div>
                    <div>
                        <label for="nilai_bangunan" class="col-form-label">Nilai Bangunan (Rp.)</label>
                        <input type="number" name="nilai_bangunan" class="form-control" id="nilai_bangunan" required />
                    </div>
                    <div>
                        <label for="bobot" class="col-form-label">Bobot (Persentase)</label>
                        <div class="form-text">
                            (Bobot (Persentase) = Nilai Kontrak / Nilai Bangunan)
                            (0 - 1)
                        </div>
                        <input type="decimal" name="bobot" class="form-control" id="bobot" required />
                    </div>
                    <div>
                        <label for="desa" class="col-form-label">Desa (Lokasi)</label>
                        <input type="text" name="desa" class="form-control" id="desa" required />
                    </div>
                    <div>
                        <label for="kecamatan" class="col-form-label">Kecamatan (Lokasi)</label>
                        <input type="text" name="kecamatan" class="form-control" id="kecamatan" required />
                    </div>
                    <div>
                        <label for="kota" class="col-form-label">Kota (Lokasi)</label>
                        <input type="text" name="kota" class="form-control" id="kota" required />
                    </div>
                    <div>
                        <label for="provinsi" class="col-form-label">Provinsi (Lokasi)</label>
                        <input type="text" name="provinsi" class="form-control" id="provinsi" required />
                    </div>
                    <div>
                        <label for="titik_koordinat" class="col-form-label">Titik Koordinat (DMS)</label>
                        <input type="text" name="titik_koordinat" class="form-control" id="titik_koordinat" required />
                    </div>
                    <div>
                        <label for="foto" class="col-form-label">Foto 100% (Link)</label>
                        <div class="form-text">
                            Masukkan Link Drive
                        </div>
                        <input type="text" name="foto" class="form-control" id="foto" required />
                    </div>
                    <div>
                        <label for="foto_drone" class="col-form-label">Foto Drone (Link)</label>
                        <div class="form-text">
                            Masukkan Link Drive
                        </div>
                        <input type="text" name="foto_drone" class="form-control" id="foto_drone" required />
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


@foreach ($output as $index => $data)
<!-- Modal Detail -->
<div class="modal fade" id="modalDetail{{$data->id_rincian_output}}" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header bg-primary">
                <h1 class="modal-title text-white fs-5">Detail Output</h1>
                <button type="button" class="btn-close" style="filter: invert(1) grayscale(100%) brightness(200%);" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <table class="table">
                    <tbody>
                        <tr>
                            <th scope="row">Jenis Bangunan</th>
                            <td>:</td>
                            <td>{{ $data->jenis_bangunan }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Volume</th>
                            <td>:</td>
                            <td>{{ $data->volume }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Satuan</th>
                            <td>:</td>
                            <td>{{ $data->satuan }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Nilai Bangunan</th>
                            <td>:</td>
                            <td>{{ $data->nilai_bangunan }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Bobot</th>
                            <td>:</td>
                            <td>{{ $data->bobot }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Desa (Lokasi)</th>
                            <td>:</td>
                            <td>{{ $data->desa }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Kecamatan (Lokasi)</th>
                            <td>:</td>
                            <td>{{ $data->kecamatan }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Kota (Lokasi)</th>
                            <td>:</td>
                            <td>{{ $data->kota }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Provinsi (Lokasi)</th>
                            <td>:</td>
                            <td>{{ $data->provinsi }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Titik Koordinat (DMS)</th>
                            <td>:</td>
                            <td>{{ $data->titik_koordinat }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Foto 100% (Link)</th>
                            <td>:</td>
                            <td>{{ $data->foto }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Foto Drone (Link)</th>
                            <td>:</td>
                            <td>{{ $data->foto_drone }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    Tutup
                </button>
            </div>

        </div>
    </div>
</div>

<!-- Modal Edit -->
<div class="modal fade" id="modalEdit{{$data->id_rincian_output}}" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">

            <form action="/output/update/{{$paket->id_paket_pekerjaan}}/{{$data->id_rincian_output}}" method="POST">
                @csrf

                <div class="modal-header bg-primary">
                    <h1 class="modal-title text-white fs-5">Perbarui Output</h1>
                    <button type="button" class="btn-close" style="filter: invert(1) grayscale(100%) brightness(200%);" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <div>
                        <label for="jenis_bangunan" class="col-form-label">Jenis Bangunan</label>
                        <input type="text" value="{{$data->jenis_bangunan}}" name="jenis_bangunan" class="form-control" id="jenis_bangunan" required />
                    </div>
                    <div>
                        <label for="volume" class="col-form-label">Volume</label>
                        <input type="number" value="{{$data->volume}}" name="volume" class="form-control" id="volume" required />
                    </div>
                    <div>
                        <label for="satuan" class="col-form-label">Satuan</label>
                        <input type="text" value="{{$data->satuan}}" name="satuan" class="form-control" id="satuan" required />
                    </div>
                    <div>
                        <label for="nilai_bangunan" class="col-form-label">Nilai Bangunan</label>
                        <input type="number" value="{{$data->nilai_bangunan}}" name="nilai_bangunan" class="form-control" id="nilai_bangunan" required />
                    </div>
                    <div>
                        <label for="bobot" class="col-form-label">Bobot</label>
                        <div class="form-text">
                            (Bobot = Nilai Kontrak / Nilai Bangunan)
                            Pakai "." untuk "koma"
                        </div>
                        <input type="number" step="0.01" value="{{$data->bobot}}" name="bobot" class="form-control" id="bobot" required />
                    </div>
                    <div>
                        <label for="desa" class="col-form-label">Desa (Lokasi)</label>
                        <input type="text" value="{{$data->desa}}" name="desa" class="form-control" id="desa" required />
                    </div>
                    <div>
                        <label for="kecamatan" class="col-form-label">Kecamatan (Lokasi)</label>
                        <input type="text" value="{{$data->kecamatan}}" name="kecamatan" class="form-control" id="kecamatan" required />
                    </div>
                    <div>
                        <label for="kota" class="col-form-label">Kota (Lokasi)</label>
                        <input type="text" value="{{$data->kota}}" name="kota" class="form-control" id="kota" required />
                    </div>
                    <div>
                        <label for="provinsi" class="col-form-label">Provinsi (Lokasi)</label>
                        <input type="text" value="{{$data->provinsi}}" name="provinsi" class="form-control" id="provinsi" required />
                    </div>
                    <div>
                        <label for="titik_koordinat" class="col-form-label">Titik Koordinat (DMS)</label>
                        <input type="text" value="{{$data->titik_koordinat}}" name="titik_koordinat" class="form-control" id="titik_koordinat" required />
                    </div>
                    <div>
                        <label for="foto" class="col-form-label">Foto 100% (Link)</label>
                        <div class="form-text">
                            Masukkan Link Drive
                        </div>
                        <input type="text" value="{{$data->foto}}" name="foto" class="form-control" id="foto" required />
                    </div>
                    <div>
                        <label for="foto_drone" class="col-form-label">Foto Drone (Link)</label>
                        <div class="form-text">
                            Masukkan Link Drive
                        </div>
                        <input type="text" value="{{$data->foto_drone}}" name="foto_drone" class="form-control" id="foto_drone" required />
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

<!-- Modal Delete -->
<div class="modal fade" id="modalDelete{{$data->id_rincian_output}}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h5 class="modal-title text-white" id="exampleModalCenterTitle">{{$data->jenis_bangunan}}</h5>
                <button type="button" style="filter: invert(1) grayscale(100%) brightness(200%);" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-danger">
                Apakah anda yakin ingin menghapus data ini?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak</button>
                <a href="/output/delete/{{$paket->id_paket_pekerjaan}}/{{$data->id_rincian_output}}" class="btn btn-danger">Ya</a>
            </div>
        </div>
    </div>
</div>
@endforeach

@endsection