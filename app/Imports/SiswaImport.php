<?php

namespace App\Imports;

use App\Rinekso\Users\User;
use App\Rinekso\Jenjang\Jenjang;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class SiswaImport implements ToCollection
{
    /**
     * @param array $row
     *
     * @return User|null
     */
    public function collection(Collection $rows)
    {
        // dd($rows);
        foreach ($rows as $index=>$row) 
        {
            if($index > 0){
                // dd($row[1]);
                if($row[0] != null){
                    User::create([
                        'nik' => $row[0]+0,
                        'nama' => $row[1],
                        'password' => Hash::make($row[0]+0),
                        'id_user_role' => 3,
                        'id_jenjang' => $row[2]+0,
                        'id_kelas' => $row[3]+0,
                        'saldo' => 0
                    ]);
                }else{
                    break;
                }
            }
        }
        return true;
    }
}