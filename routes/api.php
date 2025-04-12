<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProductController;
use Illuminate\Support\Facades\Route;
// Mặc định apiResource sẽ trỏ tới 5 hàm mặc định trong ProductController api
// Nếu muốn thêm hàm mới thì cần phải tạo thêm các route khác để trỏ tới hàm mới

//Router tạo thêm phải đặt ở bên trên API resource

Route::post('/login', [AuthController::class, 'login']);
Route::apiResource('products', ProductController::class)->middleware('auth:sanctum');