<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Alternatif;

class BackupController extends Controller
{
    public function cadangkanAlternatif(Request $request)
    {
        // Cadangkan data alternatif
        $dataAlternatif = DB::table('alternatifs')->get();

        // Simpan data cadangan dalam file
        $fileName = 'backup_alternatif_' . now()->format('YmdHis') . '.json';
        $filePath = storage_path('app/backup/' . $fileName);
        file_put_contents($filePath, json_encode($dataAlternatif));

        return response()->download($filePath, $fileName)->deleteFileAfterSend();
    }
}
