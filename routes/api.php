<?php

use App\Http\Controllers\LoanController;
use Illuminate\Support\Facades\Route;

Route::apiResource('loans', LoanController::class);