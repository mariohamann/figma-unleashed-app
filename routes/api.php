<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Setting;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/example', function () {
    $settings = Setting::all()->keyBy('name')->map(function ($setting) {
        return [
            'value' => $setting->value,
            'type' => $setting->type,
        ];
    });

    $settings['time'] = [
        'value' => date('Y-m-d H:i:s'),
        'type' => 'STRING',
    ];

    return response()->json($settings);
});

Route::get('/increase', function () {
    $clicks = Setting::where('name', 'clicks')->first();
    $clicks->value += 1;
    $clicks->save();

    return response()->json([
        'clicks' => $clicks->value,
    ]);
});

Route::get('/toggle', function () {
    $isActive = Setting::where('name', 'is_active')->first();
    $isActive->value = !$isActive->value;
    $isActive->save();

    return response()->json([
        'is_active' => $isActive->value,
    ]);
});
