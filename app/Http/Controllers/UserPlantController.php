<?php

namespace App\Http\Controllers;

use App\Models\Plant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserPlantController extends Controller
{
    // اضافه کردن یک گیاه به لیست گیاهان کاربر
    public function store(Request $request)
    {
        $request->validate([
            'plant_id' => 'required|exists:plants,id',
        ]);

        $user = Auth::user();
        $user->plants()->attach($request->plant_id);

        return response()->json(['message' => 'گیاه به لیست شما اضافه شد'], 200);
    }

    // دریافت لیست گیاهان کاربر
    public function index()
    {
        return response()->json(Auth::user()->plants, 200);
    }

    // حذف گیاه از لیست کاربر
    public function destroy($id)
    {
        $user = Auth::user();
        $user->plants()->detach($id);

        return response()->json(['message' => 'گیاه از لیست شما حذف شد'], 200);
    }
}
