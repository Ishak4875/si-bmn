<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PaketModel extends Model
{
    public function getAllData()
    {
        return DB::table('tbl_paket_pekerjaan')
            ->leftJoin('tbl_ppk', 'tbl_paket_pekerjaan.id_ppk', '=', 'tbl_ppk.id_ppk')
            ->leftJoin('tbl_satker', 'tbl_paket_pekerjaan.id_satker', '=', 'tbl_satker.id_satker')
            ->paginate(10);
    }

    public function getDetailData($id_paket)
    {
        return DB::table('tbl_paket_pekerjaan')
            ->leftJoin('tbl_ppk', 'tbl_paket_pekerjaan.id_ppk', '=', 'tbl_ppk.id_ppk')
            ->leftJoin('tbl_satker', 'tbl_paket_pekerjaan.id_satker', '=', 'tbl_satker.id_satker')
            ->where('tbl_paket_pekerjaan.id_paket_pekerjaan', $id_paket)
            ->first();
    }

    public function insertPaket($data_paket)
    {
        return DB::table('tbl_paket_pekerjaan')->insert($data_paket);
    }

    public function updatePaket($id_paket, $data_paket)
    {
        DB::table('tbl_paket_pekerjaan')
            ->where('id_paket_pekerjaan', $id_paket)
            ->update($data_paket);
    }

    public function deletePaket($id_paket)
    {
        DB::table('tbl_paket_pekerjaan')->where('id_paket_pekerjaan', $id_paket)
            ->delete();
    }
}
