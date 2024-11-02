<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProgressUnduhanRapor;
use App\Models\Version;

class BulkApiController extends Controller
{

    public function bulk(Request $request)
    {

        $version = $request->input('version');
        if( !isset($version) )
        {
            return response()->json([
                'message' => 'Version not found'
            ], 404);
        }

        $


        $progressUnduhanRapor = $version['progress-unduhan-rapor'] ?? null;
        $detailUserAktif = $version['detail-user-aktif'] ?? null;

        // check version
        // if ( $version['progress-unduhan-rapor'] > )

        try {

            $validated = $request->validate([
                'date' => 'date',
                'version' => 'integer|min:1'
            ]);

            $bulk = ProgressUnduhanRapor::all();

            if ($bulk->isEmpty()) {
                return response()->json([
                    'message' => 'Data tidak ditemukan'
                ], 404);
            }

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
                ],
                'data' => $bulk
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

}
