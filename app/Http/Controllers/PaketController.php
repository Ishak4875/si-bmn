<?php

namespace App\Http\Controllers;

use App\Models\OutputModel;
use App\Models\PaketModel;
use App\Models\PPKModel;
use Illuminate\Http\Request;

class PaketController extends Controller
{
    private $PaketModel;
    private $PPKModel;
    private $OutputModel;
    public function __construct()
    {
        $this->PaketModel = new PaketModel();
        $this->PPKModel = new PPKModel();
        $this->OutputModel = new OutputModel();
    }

    public function getAllPaket()
    {
        $data = [
            'paket' => $this->PaketModel->getAllData(),
            'ppk' => $this->PPKModel->getAllData()
        ];

        return view('v_paket', $data);
    }

    public function insertPaket(Request $request)
    {
        $data = [
            'id_satker' => $request->id_satker,
            'id_ppk' => $request->id_ppk,
            'nama_paket_pekerjaan' => $request->nama_paket_pekerjaan,
            'tahun_anggaran' => $request->tahun_anggaran,
            'nilai_kontrak' => $request->nilai_kontrak,
            'nomor_kontrak' => $request->nomor_kontrak,
            'nama_penyedia' => $request->nama_penyedia,
            'tanggal_mulai_kontrak' => $request->tanggal_mulai_kontrak,
            'tanggal_selesai_kontrak' => $request->tanggal_selesai_kontrak,
            'tanggal_pho' => $request->tanggal_pho
        ];

        try {
            $this->PaketModel->insertPaket($data);
            return redirect()->route('Paket')->with('success', 'Data Paket Berhasil Ditambahkan');
        } catch (\Throwable $th) {
            return redirect()->route('Paket')->with('failed', 'Data Paket Gagal Ditambahkan');
        }
    }

    public function displayDetailPaket(Request $request)
    {
        $id_paket = $request->id_paket_pekerjaan;
        $data = [
            'paket' => $this->PaketModel->getDetailData($id_paket),
            'output' => $this->OutputModel->getDatailByIdPaket($id_paket)
        ];
        return view('v_detailPaket', $data);
    }

    public function updatePaket(Request $request)
    {
        $data = [
            'id_satker' => $request->id_satker,
            'id_ppk' => $request->id_ppk,
            'nama_paket_pekerjaan' => $request->nama_paket_pekerjaan,
            'tahun_anggaran' => $request->tahun_anggaran,
            'nilai_kontrak' => $request->nilai_kontrak,
            'nomor_kontrak' => $request->nomor_kontrak,
            'nama_penyedia' => $request->nama_penyedia,
            'tanggal_mulai_kontrak' => $request->tanggal_mulai_kontrak,
            'tanggal_selesai_kontrak' => $request->tanggal_selesai_kontrak,
            'tanggal_pho' => $request->tanggal_pho
        ];

        try {
            $this->PaketModel->updatePaket($request->id_paket_pekerjaan, $data);
            return redirect()->route('Paket')->with('success', 'Data Paket Berhasil Diperbarui');
        } catch (\Throwable $th) {
            return redirect()->route('Paket')->with('failed', 'Data Paket Gagal Diperbarui');
        }
    }


    public function deletePaket(Request $request)
    {
        try {
            $this->PaketModel->deletePaket($request->id_paket_pekerjaan);
            return redirect()->route('Paket')->with('success', 'Data Paket Berhasil Dihapus');
        } catch (\Throwable $th) {
            return redirect()->route('Paket')->with('failed', 'Data Paket Gagal Dihapus');
        }
    }
}
