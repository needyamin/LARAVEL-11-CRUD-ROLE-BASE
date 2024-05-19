<?php
  
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
  
use App\Http\Controllers\API\RegisterController;
use App\Http\Controllers\API\ProductController;
   

//  http://127.0.0.1:8000/api/login?email=needyamin@gmail.com&password=needyamin@gmail.com
//  http://127.0.0.1:8000/api/register?name=needyamin&email=needyamin@gmail.com&password=needyamin@gmail.com&password_confirmation=needyamin@gmail.com
Route::controller(RegisterController::class)->group(function(){
    Route::post('register', 'register');
    Route::post('login', 'login');
});

// http://127.0.0.1:8000/api/products         
Route::middleware('auth:sanctum')->group( function () {
    Route::resource('products', ProductController::class);
});