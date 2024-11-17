<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/check', function (Request $request) {
    return response()->json(['message' => 'API is working!']);
});
