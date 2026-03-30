<?php

namespace App\Http\Controllers;

use App\Models\OutputModel;
use App\Models\PaketModel;
use App\Models\PPKModel;
use Illuminate\Http\Request;

class PPKController extends Controller
{
    private $PPKModel;
    private $PaketModel;
    private $OutputModel;
    public function __construct()
    {
        $this->PPKModel = new PPKModel();
        $this->PaketModel = new PaketModel();
        $this->OutputModel = new OutputModel();
    }

    public function index()
    {
        $data = [
            'jumlah_paket' => $this->PaketModel->countPaketPekerjaan(),
            'jumlah_rincian_output' => $this->OutputModel->countOutputPekerjaan()
        ];
        return view('v_dashboard', $data);
    }

    public function getAllPPK()
    {
        $data = [
            'ppk' => $this->PPKModel->getAllData()
        ];
        return view('v_ppk', $data);
    }

    public function insertPPK(Request $request)
    {
        $data = [
            'jabatan_ppk' => $request->jabatan_ppk,
            'nama' => $request->nama,
        ];

        try {
            $this->PPKModel->insertPPK($data);
            return redirect()->route('PPK')->with('success', 'Data PPK Berhasil Ditambahkan');
        } catch (\Throwable $th) {
            return redirect()->route('PPK')->with('failed', 'Data PPK Gagal Ditambahkan');
        }
    }

    public function updatePPK(Request $request)
    {

        $data = [
            'jabatan_ppk' => $request->jabatan_ppk,
            'nama' => $request->nama,
        ];

        try {
            $this->PPKModel->updatePPK($request->id_ppk, $data);
            return redirect()->route('PPK')->with('success', 'Data PPK Berhasil Diperbarui');
        } catch (\Throwable $th) {
            return redirect()->route('PPK')->with('failed', 'Data PPK Gagal Diperbarui');
        }
    }

    public function deletePPK(Request $request)
    {
        try {
            $this->PPKModel->deletePPK($request->id_ppk);
            return redirect()->route('PPK')->with('success', 'Data PPK Berhasil Dihapus');
        } catch (\Throwable $th) {
            return redirect()->route('PPK')->with('failed', 'Data PPK Gagal Dihapus');
        }
    }
}
