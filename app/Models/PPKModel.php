<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PPKModel extends Model
{
    public function getAllData()
    {
        return DB::table('tbl_ppk')->paginate(5);
    }

    public function getAllSatker()
    {
        return DB::table('tbl_satker')->get();
    }

    public function insertPPK($data_ppk)
    {
        return DB::table('tbl_ppk')->insert($data_ppk);
    }

    public function updatePPK($id_ppk, $data_ppk)
    {
        DB::table('tbl_ppk')
            ->where('id_ppk', $id_ppk)
            ->update($data_ppk);
    }

    public function deletePPK($id_ppk)
    {
        DB::table('tbl_ppk')->where('id_ppk', $id_ppk)
            ->delete();
    }
}
