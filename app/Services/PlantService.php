<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use App\Models\Plant;

class PlantService
{
    protected $apiKey;

    public function __construct()
    {
        $this->apiKey = env('PERENUAL_API_KEY'); // کلید API را از .env دریافت می‌کند
    }

    public function fetchAndStorePlants($page = 1)
    {
        $cacheKey = "plants_data_page_{$page}";

        // اگر داده‌های صفحه موردنظر در کش وجود داشت، همان را برمی‌گردانیم
        if (Cache::has($cacheKey)) {
            return Cache::get($cacheKey);
        }

        // درخواست به API برای دریافت داده‌های گیاهان
        $response = Http::get("https://perenual.com/api/species-list", [
            'key' => $this->apiKey,
            'page' => $page
        ]);

        if ($response->successful()) {
            $plantsData = $response->json()['data'];

            foreach ($plantsData as $plantData) {
                Plant::updateOrCreate(
                    ['common_name' => $plantData['common_name']],
                    [
                        'scientific_name' => $plantData['scientific_name'][0] ?? null,
                        'other_names' => json_encode($plantData['other_name'] ?? []),
                        'image_url' => $plantData['default_image']['original_url'] ?? null,
                        'cycle' => $plantData['cycle'] ?? null,
                        'watering' => $plantData['watering'] ?? null,
                        'sunlight' => $plantData['sunlight'][0] ?? null,
                        'indoor' => $plantData['indoor'] ?? null,
                        'hardiness' => $plantData['hardiness'] ?? null,
                        'edible' => $plantData['edible'] ?? null,
                        'poisonous' => $plantData['poisonous'] ?? null
                    ]
                );
            }

            // ذخیره‌سازی داده‌ها در کش برای ۲۴ ساعت
            Cache::put($cacheKey, $plantsData, now()->addDay());

            return $plantsData;
        }

        return null;
    }
}
