<?php

    use App\Http\Resources\UserResource;
    use Illuminate\Support\Facades\Route;



    Route::get('/', function () {
        return view('welcome');
    });

    //Route::get('/dashboard', function () {return view('dashboard');})->middleware(['auth'])->name('dashboard');

    //Route::get('/user', [UserResource::class, 'index']);
