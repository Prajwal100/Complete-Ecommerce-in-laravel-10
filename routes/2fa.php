<?php

  use App\Http\Controllers\Admin\LoginSecurityController;

  Route::get('/', [LoginSecurityController::class, 'show2faForm']);
  Route::post('/generateSecret', [LoginSecurityController::class, 'generate2faSecret'])->name('generate2faSecret');
  Route::post('/enable2fa', [LoginSecurityController::class, 'enable2fa'])->name('enable2fa');
  Route::post('/disable2fa', [LoginSecurityController::class, 'disable2fa'])->name('disable2fa');
// 2fa middleware
  Route::post('/2faVerify', [LoginSecurityController::class, 'verify2fa'])->name('2faVerify')->middleware('2fa');
