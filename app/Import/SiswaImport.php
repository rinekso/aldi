<?php
 
namespace App\Imports;
 
use App\Rinekso\Users\User;
use Maatwebsite\Excel\Concerns\ToModel;
 
class SiswaImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new User([
            'nama' => $row[1],
            'nis' => $row[2], 
            'alamat' => $row[3], 
        ]);
    }
}