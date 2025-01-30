<?php

namespace App\Http\Controllers;
use App\Services\PlantService;

use App\Models\Plant;
use Illuminate\Http\Request;

class PlantController extends Controller
{
    /**
 * @OA\Get(
 *     path="/api/plant",
 *     summary="دریافت تمام گیاهان",
 *     tags={"Plants"},
 *     @OA\Response(
 *         response=200,
 *         description="لیست گیاهان",
 *     )
 * )
 */
    // دریافت لیست تمام گیاهان
    public function index()
    {
        return response()->json(Plant::all(), 200);
    }

    // اضافه کردن یک گیاه جدید
    public function store(Request $request)
    {
        $request->validate([
            'common_name' => 'required|string|unique:plants',
            'watering_general_benchmark' => 'required|array',
        ]);

        $plant = Plant::create($request->all());
        return response()->json($plant, 201);
    }

    // دریافت اطلاعات یک گیاه بر اساس نام
    public function show($name)
    {
        $plant = Plant::where('common_name', $name)->first();
        if (!$plant) {
            return response()->json(['message' => 'گیاه مورد نظر یافت نشد'], 404);
        }
        return response()->json($plant, 200);
    }

    // حذف یک گیاه بر اساس ID
    public function destroy($id)
    {
        $plant = Plant::find($id);
        if (!$plant) {
            return response()->json(['message' => 'گیاه مورد نظر یافت نشد'], 404);
        }
        $plant->delete();
        return response()->json(['message' => 'گیاه با موفقیت حذف شد'], 200);
    }

    public function updatePlants(PlantService $plantService)
    {
        $plants = $plantService->fetchAndStorePlants();
    
        if ($plants) {
            return response()->json([
                'message' => 'داده‌های گیاهان با موفقیت بروزرسانی شدند!',
                'plants' => $plants
            ]);
        }  
        return response()->json(['message' => 'مشکلی در دریافت اطلاعات از API وجود دارد.'], 500);
    }
}

