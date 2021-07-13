<?php

namespace App\Imports;

use App\Item;
use Maatwebsite\Excel\Concerns\ToModel;

class ItemImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Item([
            'jenisItem'=> $row[1],
            'hargajual'=> $row[2],
            'stockjumlah'=> $row[3],
            'catatan'=> $row[4],
            'tipeitem'=> $row[5],
            'hargabeli'=> $row[6],
            'satuan'=> $row[7]
            //2310
            ,'jumlahminimal' => $row[8]
        ]);
    }
}
