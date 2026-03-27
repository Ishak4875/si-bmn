<?php

namespace App\Http\Controllers;

use App\Models\OutputModel;
use Illuminate\Http\Request;

class OutputController extends Controller
{
    private $OutputModel;
    public function __construct()
    {
        $this->OutputModel = new OutputModel();
    }

    public function insertOutput(Request $request)
    {
        $data = [
            'id_paket_pekerjaan' => $request->id_paket_pekerjaan,
            'jenis_bangunan' => $request->jenis_bangunan,
            'volume' => $request->volume,
            'satuan' => $request->satuan,
            'nilai_bangunan' => $request->nilai_bangunan,
            'bobot' => $request->bobot,
            'desa' => $request->desa,
            'kecamatan' => $request->kecamatan,
            'kota' => $request->kota,
            'provinsi' => $request->provinsi,
            'titik_koordinat' => $request->titik_koordinat,
            'foto' => $request->foto,
            'foto_drone' => $request->foto_drone
        ];

        try {
            $this->OutputModel->insertOutput($data);
            return redirect()->back()->with('success', 'Data Output Berhasil Ditambahkan');
        } catch (\Throwable $th) {
            return redirect()->back()->with('failed', 'Data Output Gagal Ditambahkan');
        }
    }

    public function updateOutput(Request $request)
    {
        $data = [
            'id_paket_pekerjaan' => $request->id_paket_pekerjaan,
            'jenis_bangunan' => $request->jenis_bangunan,
            'volume' => $request->volume,
            'satuan' => $request->satuan,
            'nilai_bangunan' => $request->nilai_bangunan,
            'bobot' => $request->bobot,
            'desa' => $request->desa,
            'kecamatan' => $request->kecamatan,
            'kota' => $request->kota,
            'provinsi' => $request->provinsi,
            'titik_koordinat' => $request->titik_koordinat,
            'foto' => $request->foto,
            'foto_drone' => $request->foto_drone
        ];

        try {
            $this->OutputModel->updateOutput($request->id_rincian_output, $data);
            return redirect()->back()->with('success', 'Data Output Berhasil Diperbarui');
        } catch (\Throwable $th) {
            return redirect()->back()->with('failed', 'Data Output Gagal Diperbarui');
        }
    }
}
