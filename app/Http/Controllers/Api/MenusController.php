<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;
use DB;

class MenusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $menus = Menu::select(
            'menus.id',
            'menus.name',
            'menus.label',
            DB::raw("CONCAT('https://sidara.buayadarat.cloud/images/mobile/', menus.icon) AS icon"),
            'menus.description',
            'menus.link',
            'menus.menu_id'
        )->whereNull('menu_id') // Hanya parent menus
            ->with('children')             // Muat relasi child menus
            ->get();

        if ($menus->isEmpty()) {
            return response()->json(['message' => 'No menus found'], 404);
        }

        return response()->json($menus);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|unique:menus|max:255',
            'label' => 'required|string|max:255',
            'icon' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'link' => 'required|string|max:255',
            'menu_id' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $menu = Menu::create($request->all());

        return response()->json(['message' => 'Menu created successfully', 'data' => $menu], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function show($id): JsonResponse
    {
        $menu = Menu::find($id);

        if (!$menu) {
            return response()->json(['message' => 'Menu not found'], 404);
        }

        return response()->json($menu);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return JsonResponse
     */
    public function update(Request $request, $id): JsonResponse
    {
        $menu = Menu::find($id);

        if (!$menu) {
            return response()->json(['message' => 'Menu not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|unique:menus,name,' . $menu->id . '|max:255',
            'label' => 'required|string|max:255',
            'icon' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'link' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $menu->update($request->all());

        return response()->json(['message' => 'Menu updated successfully', 'data' => $menu]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function destroy($id): JsonResponse
    {
        $menu = Menu::find($id);

        if (!$menu) {
            return response()->json(['message' => 'Menu not found'], 404);
        }

        $menu->delete();

        return response()->json(['message' => 'Menu deleted successfully']);
    }
}
