<?php

use App\Core\Services\UserService;
use App\Http\Controllers\Api\v1\ProfileController;
use App\Http\Controllers\Api\v1\UsersController as UsersControllerAlias;
use App\Http\Controllers\JsonApiAuth\ConfirmablePasswordController;
use App\Http\Controllers\JsonApiAuth\EmailVerificationNotificationController;
use App\Http\Controllers\JsonApiAuth\LoginController;
use App\Http\Controllers\JsonApiAuth\LogoutController;
use App\Http\Controllers\JsonApiAuth\NewPasswordController;
use App\Http\Controllers\JsonApiAuth\PasswordResetLinkController;
use App\Http\Controllers\JsonApiAuth\RegisterController;
use App\Http\Controllers\JsonApiAuth\VerifyEmailController;
use App\Models\User;
use App\Notifications\Api\ResetPasswordStudentNotification;
use Illuminate\Support\Facades\Route;

Route::post('/register', RegisterController::class)->name('json-api-auth.register');

Route::post('/login', LoginController::class)->middleware(['throttle:10,1'])->name('json-api-auth.login');

Route::get('/logout', LogoutController::class)
    ->middleware('auth:sanctum')
    ->name('json-api-auth.logout');

Route::post('/forgot-password', PasswordResetLinkController::class)
    ->name('json-api-auth.password.email');

Route::post('/reset-password', NewPasswordController::class)
    ->name('json-api-auth.password.update');

Route::post('/email/verification-notification', EmailVerificationNotificationController::class)
    ->middleware(['auth:sanctum', 'throttle:6,1'])
    ->name('json-api-auth.verification.send');

Route::get('/verify-email/{id}/{hash}', VerifyEmailController::class)
    ->middleware(['signed', 'throttle:6,1'])
    ->name('json-api-auth.verification.verify');

Route::post('/confirm-password', ConfirmablePasswordController::class)
    ->middleware('auth:sanctum')
    ->name('json-api-auth.password.confirm');

Route::post('/check-previous-session', [ProfileController::class, 'checkPreviousSessionAccess']);

Route::post('/passwords-system/users/request-change-password', [UsersControllerAlias::class, 'requestResetPasswordUser']);
