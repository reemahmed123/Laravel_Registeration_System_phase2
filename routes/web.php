<?php

use Illuminate\Support\Facades\DB; // ✅ Add this line to import DB


use App\Http\Controllers\StudentsController;
use App\Models\Students;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

//Route::get('/', [UsersController::class, 'test']);

// http://127.0.0.1:8000/register    write this path to test ptoject
Route::get('/register', [StudentsController::class, 'create'])->name('register');
Route::post('/register', [StudentsController::class, 'store'])->name('register.store');

Route::post('/check-username', [StudentsController::class, 'checkUsername'])->name('check.username');


/*Route::get('/test-insert', function () {
    try {
        DB::table('students')->insert([
            'full_name' => 'Test',
            'user_name' => 'testuser',
            'phone' => '123',
            'whatsapp' => '123',
            'address' => 'Test City', // ✅ Add this
            'email' => 'test@test.com',
            'password' => bcrypt('test@123'),
            'user_image'=>'nn.png'
        ]);
        return 'Insert successful!';
    } catch (\Exception $e) {
        return 'Insert failed: ' . $e->getMessage();
    }
});*/
