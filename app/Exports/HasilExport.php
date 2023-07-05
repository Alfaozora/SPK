<?php

namespace App\Exports;

use App\Models\pemeringkatan;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class HasilExport implements FromView
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function view(): View
    {
        $pemeringkatans = Pemeringkatan::join('alternatifs', 'pemeringkatans.alternatif_id', '=', 'alternatifs.kode')
            ->select('alternatifs.nkk', 'alternatifs.nik', 'alternatifs.alamat', 'pemeringkatans.*')
            ->orderBy('peringkat', 'ASC')
            ->get();

        return view('hasil.excel', [
            'pemeringkatans' => $pemeringkatans,
        ]);
    }
}
