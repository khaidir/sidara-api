<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DetailUserAktif;
use App\Models\Version;
use DB;

class DetailUserAktifApiController extends Controller
{

    public function bulk(Request $request)
    {
        $param = $request->input('version');
        $version = Version::where('tables','detail-user-aktif')->value('version');

        if ($param == $version) {
            return response()->json([
                'status' => true,
                'message' => 'Updated'
            ], 200);
        }

        try {

            $bulk = DetailUserAktif::all();

            if ($bulk->isEmpty()) {
                return response()->json([
                    'message' => 'Data tidak ditemukan'
                ], 404);
            }

            $jenjangCounts = DB::table('detail_user_aktif')
                ->select('jenjang', DB::raw('count(*) as count'))
                ->groupBy('jenjang')
                ->get();

            $total = $jenjangCounts->sum('count');

            $jenjang = $jenjangCounts->map(function ($item) use ($total) {
                $item->percentage = $total > 0 ? round(($item->count / $total) * 100, 2) : 0;
                return $item;
            });

            $tipeAkunCounts = DB::table('detail_user_aktif')
                ->select('tipe_akun', DB::raw('count(*) as count'))
                ->groupBy('tipe_akun')
                ->get();

            $total = $tipeAkunCounts->sum('count');

            // Menambahkan persentase untuk setiap tipe akun
            $tipe = $tipeAkunCounts->map(function ($item) use ($total) {
                $item->percentage = $total > 0 ? round(($item->count / $total) * 100, 2) : 0;
                return $item;
            });

            $total = DetailUserAktif::count();

            $data = [
                'total' => @$total,
                'version' => @$version,
                'jenjang' => @$jenjang,
                'tipe' => @$tipe,
                'data' => @$bulk
            ];

            return response()->json($data);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'error' => 'Validation Error',
                'messages' => $e->errors(),
            ], 422);

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Server Error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }


    public function grafik()
    {
        $total = ProgressUnduhanRapor::count();
        $sudahLogin = ProgressUnduhanRapor::where('login_level_npsn', 'Sudah')->count();
        $belumLogin = ProgressUnduhanRapor::where('login_level_npsn', 'Belum')->count();

        $sudahUnduh = ProgressUnduhanRapor::where('unduh_level_npsn', 'Sudah')->count();
        $belumUnduh = ProgressUnduhanRapor::where('unduh_level_npsn', 'Belum')->count();

        $sudahLoginPercent = $total > 0 ? ($sudahUnduh / $total) * 100 : 0;
        $belumLoginPercent = $total > 0 ? ($belumLogin / $total) * 100 : 0;

        $sudahUnduhPercent = $total > 0 ? ($sudahLogin / $total) * 100 : 0;
        $belumUnduhPercent = $total > 0 ? ($belumUnduh / $total) * 100 : 0;

        $data = [
            'total' => $total,
            'stats' => [
                'login' => [
                    'sudah' => [
                        'count' => $sudahLogin,
                        'percentage' => round($sudahLoginPercent, 2)
                    ],
                    'belum' => [
                        'count' => $belumLogin,
                        'percentage' => round($belumLoginPercent, 2)
                    ]
                ],
                'unduh' => [
                    'sudah' => [
                        'count' => $sudahUnduh,
                        'percentage' => round($sudahUnduhPercent, 2)
                    ],
                    'belum' => [
                        'count' => $belumUnduh,
                        'percentage' => round($belumUnduhPercent, 2)
                    ]
                ],
            ]
        ];

        return response()->json($data);
    }

}
