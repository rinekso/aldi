<?php

namespace App\Exports;

use App\Rinekso\Jenjang\Jenjang;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ContohExport implements FromView
{
    public function view(): View
    {
        return view('exports.example', [
            'jenjang' => Jenjang::all()
        ]);
    }
}