<?php

use Illuminate\Support\Facades\Route;
use App\Models\core\Permission; 
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


#export NODE_OPTIONS=--max-old-space-size=8192
##### php artisan serve --host 192.168.68.231 --port 8000
#### php artisan migrate:refresh --path=/database/migrations/2024_03_16_102807_create_leave_application.php

Route::get('/', function () {
    return view('welcome');
});

### role database: admin, editor, author etc..
Route::group(['middleware' => ['auth', 'role:admin']], function () {
    Route::get('admin', function () {
        return view('welcome');
    });
    
});


### checkPermission database: create, edit, delete etc..
Route::group(['middleware' => ['auth', 'checkPermission:create']], function () {
Route::get('yamin', function () {return view('welcome');});
});

Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
