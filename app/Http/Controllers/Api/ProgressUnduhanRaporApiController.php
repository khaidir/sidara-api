<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProgressUnduhanRapor;
use App\Models\Version;

class ProgressUnduhanRaporApiController extends Controller
{

    /**
     * Display a paginated listing of the resource.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        try {
            $validated = $request->validate([
                'kota' => 'array',
                'kota.*' => 'string',
                'jenjang' => 'array',
                'jenjang.*' => 'string',
                'sederajat' => 'array',
                'sederajat.*' => 'string',
                'login' => 'array',
                'login.*' => 'string',
                'unduh' => 'array',
                'unduh.*' => 'string',
                'page' => 'integer|min:1',
                'per_page' => 'integer|min:1'
            ]);

            $kota = $validated['kota'] ?? [];
            $jenjang = $validated['jenjang'] ?? [];
            $sederajat = $validated['sederajat'] ?? [];
            $login = $validated['login'] ?? [];
            $unduh = $validated['unduh'] ?? [];
            $perPage = $validated['per_page'] ?? 10;

            $query = ProgressUnduhanRapor::query();

            // filter
            if (!empty($kota)) {
                $query->whereIn('nama_kabupaten', $kota);
            }
            if (!empty($jenjang)) {
                $query->whereIn('pengelompokan_jenjang', $jenjang);
            }
            if (!empty($jenjang)) {
                $query->whereIn('pendidikan_sederajat', $sederajat);
            }
            if (!empty($login)) {
                $query->whereIn('login_level_jenjang', $login);
            }
            if (!empty($unduh)) {
                $query->whereIn('unduh_level_jenjang', $unduh);
            }

            $data = $query->paginate($perPage)->withQueryString()->onEachSide(1);

            if ($data->isEmpty()) {
                return response()->json([
                    'message' => 'Data tidak ditemukan'
                ], 404);
            }

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

    public function bulk(Request $request)
    {
        $param = $request->input('version');
        $version = Version::where('tables','progress-unduhan-rapor')->value('version');

        if ($param == $version) {
            return response()->json([
                'status' => true,
                'message' => 'Updated'
            ], 200);
        }

        try {

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
                'version' => $version,
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
