<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class OutputModel extends Model
{
    public function getDatailByIdPaket($id_paket)
    {
        return DB::table('tbl_rincian_output')
            ->where('id_paket_pekerjaan', $id_paket)
            ->paginate(10);
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
