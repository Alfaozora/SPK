<?php

namespace App\Http\Controllers;

use App\Models\kriteria;
use App\Models\nilaiintensitas;
use App\Models\perbandingan_kriteria;
use App\Models\alternatif;
use App\Models\sub_kriteria;
use App\Models\perbandingan_alternatif;
use App\Models\pemeringkatan;

use Illuminate\Http\Request;
use Redirect;

class PerhitunganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kriterias = kriteria::all();
        $nilaiintensitas = nilaiintensitas::all();
        $perbandingan_kriterias = perbandingan_kriteria::all();
        $alternatifs = alternatif::all();
        $sub_kriterias = sub_kriteria::all();
        return view('perhitungan.perhitungan', compact('kriterias', 'nilaiintensitas', 'perbandingan_kriterias', 'alternatifs', 'sub_kriterias'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $nilaiintensitas = nilaiintensitas::all();
        $nilaiintensitas = $request->input('nilai');

        $kriterias = kriteria::all();
        $perbandingan_kriterias = perbandingan_kriteria::all();
        $perbandingan_kriterias = $request->input('nilai');

        $sub_kriterias = sub_kriteria::all();
        $perbandingan_alternatifs = perbandingan_alternatif::all();
        $alternatifs = alternatif::all();

        //Mendapatkan daftar semua kriteria yang tersedia
        $kriterias = kriteria::pluck('kode_kriteria')->toArray();

        //Menyiapkan matriks perbandingan berpasangan
        $matriksPerbandingan = [];

        foreach ($kriterias as $kriteria1) {
            foreach ($kriterias as $kriteria2) {
                if ($kriteria1 === $kriteria2) {
                    $nilai = 1;
                } else {
                    $nilai = $perbandingan_kriterias[$kriteria1][$kriteria2];
                }
                $matriksPerbandingan[$kriteria1][$kriteria2] = $nilai;
            }
        }

        //melakukan normalisasi matriks perbandingan
        $matriksNormalisasi = [];
        foreach ($kriterias as $kriteria1) {
            foreach ($kriterias as $kriteria2) {
                if ($matriksPerbandingan[$kriteria2][$kriteria1] != 0) {
                    $nilaiNormalisasi = 1 / $matriksPerbandingan[$kriteria2][$kriteria1];
                    // dd($matriksPerbandingan);
                } else {
                    $nilaiNormalisasi = $matriksPerbandingan[$kriteria1][$kriteria2];
                    // dd($matriksPerbandingan);
                }
                $matriksNormalisasi[$kriteria1][$kriteria2] = round($nilaiNormalisasi, 2);
            }
        }


        //Menghitung total jumlah setiap kriteria
        $jumlahKolom = [];
        foreach ($kriterias as $kriteria2) {
            $jumlahKolom[$kriteria2] = 0;
            foreach ($kriterias as $kriteria1) {
                $jumlahKolom[$kriteria2] += $matriksNormalisasi[$kriteria1][$kriteria2];
                // dd($matriksNormalisasi);
            }
        }

        //Menghitung Matriks Nilai Kriteria
        $matriksNilaiKriteria = [];

        foreach ($kriterias as $kriteria2) {
            $jumlahKolom[$kriteria2];
            foreach ($kriterias as $kriteria1) {
                $matriksNilaiKriteria[$kriteria1][$kriteria2] = number_format($matriksNormalisasi[$kriteria1][$kriteria2] / $jumlahKolom[$kriteria2], 3);
            }
        }

        //Menghitung Jumlah Baris Nilai Kriteria
        $jumlahBaris = [];
        foreach ($kriterias as $kriteria1) {
            $jumlahBaris[$kriteria1] = 0;
            foreach ($kriterias as $kriteria2) {
                $jumlahBaris[$kriteria1] += $matriksNilaiKriteria[$kriteria1][$kriteria2];
            }
        }

        //Menghitung Bobot Prioritas
        $bobotPrioritas = [];
        foreach ($kriterias as $kriteria1) {
            $bobotPrioritas[$kriteria1] = number_format($jumlahBaris[$kriteria1] / count($kriterias), 3);
        }

        //Menghitung Eigen Value
        $eigenValue = [];
        foreach ($kriterias as $kriteria1) {
            $eigenValue[$kriteria1] = 0;
            foreach ($kriterias as $kriteria2) {
                $eigenValue[$kriteria1] = number_format($jumlahKolom[$kriteria1] * $bobotPrioritas[$kriteria1], 3);
            }
        }

        //Total eigen value
        $totalEigenValue = [];
        foreach ($kriterias as $kriteria1) {
            $totalEigenValue[$kriteria1] = 0;
            foreach ($kriterias as $kriteria2) {
                $totalEigenValue[$kriteria1] += $eigenValue[$kriteria2];
            }
        }

        //Menghitung CI
        $ci = [];
        foreach ($kriterias as $kriteria1) {
            $ci[$kriteria1] = number_format(($totalEigenValue[$kriteria1] - count($kriterias)) / (count($kriterias) - 1), 3);
        }

        //Menghitung RI
        $n = count($kriterias);
        $nilaiRI = [0, 0, 0.58, 0.90, 1.12, 1.24, 1.32, 1.41, 1.45];
        $nilaiRI = $nilaiRI[$n - 1];

        //Menghitung CR
        $cr = [];
        foreach ($kriterias as $kriteria1) {
            $cr[$kriteria1] = number_format($ci[$kriteria1] / $nilaiRI, 3);
        }


        //Menghitung Konversi Nilai Perbandingan Antar Kriteria Ke Matriks Berpasangan Fuzzy
        $matriksTFN = [];
        $matriksTFNInverse = [];

        foreach ($kriterias as $kriteria1) {
            $matriksTFN[$kriteria1] = [];
            foreach ($kriterias as $kriteria2) {
                $nilaiNormalisasi = $matriksPerbandingan[$kriteria1][$kriteria2];
                $tfn = [];
                if ($nilaiNormalisasi == 1) {
                    $tfn['l'] = 1;
                    $tfn['m'] = 1;
                    $tfn['u'] = 1;
                } elseif ($nilaiNormalisasi == 2) {
                    $tfn['l'] = 0.5;
                    $tfn['m'] = 1;
                    $tfn['u'] = 0.5;
                } elseif ($nilaiNormalisasi == 3) {
                    $tfn['l'] = 1;
                    $tfn['m'] = 1.5;
                    $tfn['u'] = 2;
                } elseif ($nilaiNormalisasi == 4) {
                    $tfn['l'] = 1.5;
                    $tfn['m'] = 2;
                    $tfn['u'] = 2.5;
                } elseif ($nilaiNormalisasi == 5) {
                    $tfn['l'] = 2;
                    $tfn['m'] = 2.5;
                    $tfn['u'] = 3;
                } elseif ($nilaiNormalisasi == 6) {
                    $tfn['l'] = 2.5;
                    $tfn['m'] = 3;
                    $tfn['u'] = 3.5;
                } elseif ($nilaiNormalisasi == 7) {
                    $tfn['l'] = 3;
                    $tfn['m'] = 3.5;
                    $tfn['u'] = 4;
                } elseif ($nilaiNormalisasi == 8) {
                    $tfn['l'] = 3.5;
                    $tfn['m'] = 4;
                    $tfn['u'] = 4.5;
                } elseif ($nilaiNormalisasi == 9) {
                    $tfn['l'] = 4;
                    $tfn['m'] = 4.5;
                    $tfn['u'] = 4.5;
                }
                $matriksTFN[$kriteria1][$kriteria2] = $tfn;
                $nilaiNormalisasi = $matriksPerbandingan[$kriteria1][$kriteria2];
                $tfn = [];
                if ($nilaiNormalisasi == 1) {
                    $tfn['l'] = 1;
                    $tfn['m'] = 1;
                    $tfn['u'] = 1;
                } elseif ($nilaiNormalisasi == 2) {
                    $tfn['l'] = 0.7;
                    $tfn['m'] = 1;
                    $tfn['u'] = 2;
                } elseif ($nilaiNormalisasi == 3) {
                    $tfn['l'] = 0.5;
                    $tfn['m'] = 0.7;
                    $tfn['u'] = 1;
                } elseif ($nilaiNormalisasi == 4) {
                    $tfn['l'] = 0.4;
                    $tfn['m'] = 0.5;
                    $tfn['u'] = 0.7;
                } elseif ($nilaiNormalisasi == 5) {
                    $tfn['l'] = 0.3;
                    $tfn['m'] = 0.4;
                    $tfn['u'] = 0.5;
                } elseif ($nilaiNormalisasi == 6) {
                    $tfn['l'] = 0.28;
                    $tfn['m'] = 0.3;
                    $tfn['u'] = 0.4;
                } elseif ($nilaiNormalisasi == 7) {
                    $tfn['l'] = 0.25;
                    $tfn['m'] = 0.28;
                    $tfn['u'] = 0.3;
                } elseif ($nilaiNormalisasi == 8) {
                    $tfn['l'] = 0.22;
                    $tfn['m'] = 0.25;
                    $tfn['u'] = 0.28;
                } elseif ($nilaiNormalisasi == 9) {
                    $tfn['l'] = 0.28;
                    $tfn['m'] = 0.28;
                    $tfn['u'] = 0.25;
                }
                $matriksTFNInverse[$kriteria1][$kriteria2] = $tfn;
            }
        }


        //menggabungkan matriks tfn kosong dengan matriks tfn yang sudah diisi
        foreach ($matriksTFN as $matriks1 => $value) {
            foreach ($matriksTFNInverse as $matriks2 => $value2) {
                if ($matriksTFN[$matriks1][$matriks2] == null) {
                    $matriksTFN[$matriks1][$matriks2] = $matriksTFNInverse[$matriks2][$matriks1];
                }
            }
        }



        //Jumlah TFN
        $jumlahLMU = [];

        foreach ($kriterias as $kriteria1) {
            $jumlahLMU[$kriteria1] = [
                'l' => 0,
                'm' => 0,
                'u' => 0,
            ];
            foreach ($kriterias as $kriteria2) {
                if ($matriksTFN[$kriteria1][$kriteria2]['l']) {
                    $jumlahLMU[$kriteria1]['l'] += $matriksTFN[$kriteria1][$kriteria2]['l'];
                }
                if ($matriksTFN[$kriteria1][$kriteria2]['m']) {
                    $jumlahLMU[$kriteria1]['m'] += $matriksTFN[$kriteria1][$kriteria2]['m'];
                }
                if ($matriksTFN[$kriteria1][$kriteria2]['u']) {
                    $jumlahLMU[$kriteria1]['u'] += $matriksTFN[$kriteria1][$kriteria2]['u'];
                }
            }
        }

        //total jumlah nilai l,m,u dari setiap kriteria
        $totalLMU = [
            'l' => 0,
            'm' => 0,
            'u' => 0,
        ];
        foreach ($kriterias as $kriteria1) {
            $totalLMU['l'] += $jumlahLMU[$kriteria1]['l'];
            $totalLMU['m'] += $jumlahLMU[$kriteria1]['m'];
            $totalLMU['u'] += $jumlahLMU[$kriteria1]['u'];
        }

        //Menghitung nlai sintesis fuzzy untuk kriteria
        $nilaiSintesisFuzzy = [];
        foreach ($kriterias as $kriteria1) {
            $nilaiSintesisFuzzy[$kriteria1] = [
                'l' => round($jumlahLMU[$kriteria1]['l'] / $totalLMU['u'], 2),
                'm' => round($jumlahLMU[$kriteria1]['m'] / $totalLMU['m'], 2),
                'u' => round($jumlahLMU[$kriteria1]['u'] / $totalLMU['l'], 2),
            ];
        }
        // dd($nilaiSintesisFuzzy);


        //Menghitung derajat keanggotan dari perbandingan nilai sintesis fuzzy
        $derajatKeanggotaan = [];
        $totalMinimum = 0;
        foreach ($kriterias as $kriteria1) {
            $l1 = $nilaiSintesisFuzzy[$kriteria1]['l'];
            $m1 = $nilaiSintesisFuzzy[$kriteria1]['m'];

            $derajatKeanggotaan[$kriteria1] = [];

            foreach ($kriterias as $kriteria2) {
                $m2 = $nilaiSintesisFuzzy[$kriteria2]['m'];
                $u2 = $nilaiSintesisFuzzy[$kriteria2]['u'];

                if ($m2 >= $m1) {
                    $derajatKeanggotaan[$kriteria1][$kriteria2] = 1;
                } elseif ($l1 >= $u2) {
                    $derajatKeanggotaan[$kriteria1][$kriteria2] = 0;
                } else {
                    $derajatKeanggotaan[$kriteria1][$kriteria2] = round(($l1 - $u2) / (($m2 - $u2) - ($m1 - $l1)), 2);
                }
                // dd($m2);
            }
            $nilaiMinimum[$kriteria1] = min($derajatKeanggotaan[$kriteria1]);
            $totalMinimum += $nilaiMinimum[$kriteria1];
        }

        //menghitung normalisasi vektor
        $normalisasiVektor = [];
        foreach ($kriterias as $kriteria1) {
            $normalisasiVektor[$kriteria1] = round($nilaiMinimum[$kriteria1] / $totalMinimum, 2);
        }

        //Menampilkan Konversi Bobot Kirteria Dari Masing-Masing Alternatif ke tabel
        $bobotValues = $request->input('bobot');
        $matriksBobot = [];
        foreach ($bobotValues as $alternatifId => $kriteriaBobots) {
            foreach ($kriteriaBobots as $kriteriaId => $bobot) {
                $matriksBobot[$alternatifId][$kriteriaId] = $bobot;
            }
        }

        //menghitung bobot kriteria dengan alternatif dikali dengan normalisasi vektor
        $matriksBobotVektor = [];
        foreach ($bobotValues as $alternatifId => $kriteriaBobots) {
            foreach ($kriteriaBobots as $kriteriaId => $bobot) {
                $matriksBobotVektor[$alternatifId][$kriteriaId] = $bobot * $normalisasiVektor[$kriteriaId];
            }
        }
        // dd($matriksBobotVektor);

        //menjumlahkan baris dari matriks bobot vektor
        $totalBobotVektor = [];
        foreach ($bobotValues as $alternatifId => $kriteriaBobots) {
            $totalBobot = 0;
            foreach ($kriteriaBobots as $kriteriaId => $bobot) {
                $totalBobot += $matriksBobotVektor[$alternatifId][$kriteriaId];
            }
            $totalBobotVektor[$alternatifId] = $totalBobot;
        }
        // dd($totalBobotVektor);

        //melakukan perangkingan alternatif berdasarkan nilai total bobot vektor
        arsort($totalBobotVektor);
        $peringkat = 1;
        foreach ($totalBobotVektor as $kode => $totalBobot) {
            $alternatifs = Alternatif::where('kode', $kode)->first();
            $namaAlternatif = $alternatifs ? $alternatifs->nama : 'N/A';

            //Menyimpan hasil pemeringkatan ke dalam database
            Pemeringkatan::updateOrCreate(
                [
                    'alternatif_id' => $kode,
                ],
                [
                    'nama' => $namaAlternatif,
                    'bobot' => $totalBobot,
                    'peringkat' => $peringkat,
                ]
            );
            $peringkat++;
        }
        // dd($namaAlternatif);

        //menyimpan dan mengupdate nilai inisialiasi kriteria
        foreach ($nilaiintensitas as $key => $value) {
            foreach ($value as $key2 => $value2) {
                $perbandingan_kriterias = new perbandingan_kriteria();
                $perbandingan_kriterias->kriteria1 = $key;
                $perbandingan_kriterias->kriteria2 = $key2;
                $perbandingan_kriterias->nilai = $value2;
                //menyimpan dan memperbarui data
                perbandingan_kriteria::updateOrCreate(
                    [
                        'kriteria1' => $key,
                        'kriteria2' => $key2,
                    ],
                    [
                        'nilai' => $value2,
                    ]
                );
            }
        }
        // dd($perbandingan_kriterias);

        //menyimpan dan mengupdate nilai inisialisasi Bobot Nilai Kriteria Untuk Masing Masing Alternatif
        $bobotValues = $request->input('bobot');

        foreach ($bobotValues as $alternatifId => $kriteriaBobots) {
            foreach ($kriteriaBobots as $kriteriaId => $bobot) {
                // Cari entitas yang sesuai dengan alternatif_id dan kriteria_id
                $perbandingan = perbandingan_alternatif::where('alternatif_id', $alternatifId)
                    ->where('kriteria_id', $kriteriaId)
                    ->first();

                if ($perbandingan) {
                    // Jika entitas sudah ada, update bobot
                    $perbandingan->bobot = $bobot;
                    $perbandingan->save();
                } else {
                    // Jika entitas belum ada, buat data baru
                    perbandingan_alternatif::create([
                        'alternatif_id' => $alternatifId,
                        'kriteria_id' => $kriteriaId,
                        'bobot' => $bobot,
                    ]);
                }
            }
        }


        return view('perhitungan.proses', [
            'kriterias' => $kriterias,
            'matriksPerbandingan' => $matriksPerbandingan,
            'jumlahKolom' =>  $jumlahKolom,
            'jumlahBaris' => $jumlahBaris,
            'matriksNormalisasi' => $matriksNormalisasi,
            'matriksNilaiKriteria' => $matriksNilaiKriteria,
            'bobotPrioritas' => $bobotPrioritas,
            'eigenValue' => $eigenValue,
            'totalEigenValue' => $totalEigenValue,
            'ci' => $ci,
            'nilaiRI' => $nilaiRI,
            'cr' => $cr,
            'matriksTFN' => $matriksTFN,
            'matriksTFNInverse' => $matriksTFNInverse,
            'jumlahLMU' => $jumlahLMU,
            'totalLMU' => $totalLMU,
            'nilaiSintesisFuzzy' => $nilaiSintesisFuzzy,
            'derajatKeanggotaan' => $derajatKeanggotaan,
            'nilaiMinimum' => $nilaiMinimum,
            'totalMinimum' => $totalMinimum,
            'normalisasiVektor' => $normalisasiVektor,
            'alternatifs' => $alternatifs,
            'sub_kriterias' => $sub_kriterias,
            'perbandigan_alternatifs' => $perbandingan_alternatifs,
            'matriksBobot' => $matriksBobot,
            'matriksBobotVektor' => $matriksBobotVektor,
            'totalBobotVektor' => $totalBobotVektor,
            'namaAlternatif' => $namaAlternatif,
        ]);
    }

    public function proses(Request $request)
    {
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
