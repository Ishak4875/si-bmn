<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OutputModel extends Model
{
    public function getDatailByIdPaket($id_paket)
    {
        return DB::table('tbl_rincian_output')
            ->where('id_paket_pekerjaan', $id_paket)
            ->paginate(10);
    }

    public function searchData($id_paket, $jenis_bangunan)
    {
        return DB::table('tbl_rincian_output')
            ->where('id_paket_pekerjaan', $id_paket)
            ->when($jenis_bangunan, function ($query, $jenis_bangunan) {
                return $query->where('jenis_bangunan', 'like', '%' . $jenis_bangunan . '%');
            })
            ->paginate(10)
            ->withQueryString();
    }

    public function countOutputPekerjaan()
    {
        return DB::table('tbl_paket_pekerjaan')
            ->leftJoin('tbl_ppk', 'tbl_paket_pekerjaan.id_ppk', '=', 'tbl_ppk.id_ppk')
            ->leftJoin('tbl_satker', 'tbl_paket_pekerjaan.id_satker', '=', 'tbl_satker.id_satker')
            ->leftJoin('tbl_rincian_output', 'tbl_paket_pekerjaan.id_paket_pekerjaan', '=', 'tbl_rincian_output.id_rincian_output')
            ->when(Auth::user()->level != 0, function ($query) {
                $query->where('tbl_paket_pekerjaan.id_satker', Auth::user()->level);
            })

            ->count();
    }

    public function insertOutput($data_output)
    {
        return DB::table('tbl_rincian_output')->insert($data_output);
    }

    public function updateOutput($id_output, $data_output)
    {
        DB::table('tbl_rincian_output')
            ->where('id_rincian_output', $id_output)
            ->update($data_output);
    }

    public function deleteOutput($id_output)
    {
        DB::table('tbl_rincian_output')
            ->where('id_rincian_output', $id_output)
            ->delete();
    }
}
