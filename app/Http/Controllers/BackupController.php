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

    public function upload()
    {
        return view('alternatif.upload');
    }

    public function uploadAlternatif(Request $request)
    {
        $uploadedFile = $request->file('json_file');
        $jsonContent = file_get_contents($uploadedFile);
        $dataAlternatif = json_decode($jsonContent, true);

        foreach ($dataAlternatif as $item) {
            Alternatif::updateOrCreate(
                [
                    'kode' => $item['kode'],
                    'nkk' => $item['nkk'],
                    'nik' => $item['nik'],
                    'nama' => $item['nama'],
                    'alamat' => $item['alamat'],
                    'nomor' => $item['nomor'],
                ]
            );
        }
        return redirect()->route('alternatif.index')->with('success', 'Data alternatif berhasil diupload');
    }
}
