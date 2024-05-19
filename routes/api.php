<?php
  
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
  
use App\Http\Controllers\API\RegisterController;
use App\Http\Controllers\API\ProductController;
   

### AGETNT API 
// GET: http://oams.test/api/agent_api?phone=01878578504
Route::get('/agent_api', [App\Http\Controllers\API\Otithee\AgentApiController::class, 'agent_api'])->name('agent_api');


### AUTH API
// POST: http://oams.test/api/login?email=needyamin@gmail.com&password=needyamin@gmail.com
// POST: http://oams.test/api/register?name=needyamin&email=needyamin@gmail.com&password=needyamin@gmail.com&password_confirmation=needyamin@gmail.com
Route::controller(RegisterController::class)->group(function(){
    Route::post('register', 'register');
    Route::post('login', 'login');
});

### ALL PRODUCT API
// GET, PUT, CREATE, DELETE  --> Please see::: php artisan route:list  
Route::middleware('auth:sanctum')->group( function () {
    Route::resource('products', ProductController::class);
});