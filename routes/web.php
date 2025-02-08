<?php

use App\Http\Controllers\ApprovalController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\BookingHistoriesController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\RoleAccessController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserManagementController;
use App\Http\Controllers\VehicleController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Route::middleware('auth', 'verified')->group(function () {
    Route::resource('dashboard', DashboardController::class);

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Notification
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::post('/notifications/read-all', [NotificationController::class, 'markAsRead'])->name('notifications.readAll');
    Route::get('/notifications/read', function () {
        Auth::user()->unreadNotifications->markAsRead();
        return redirect()->route('approvals.index');
    })->name('notifications.read');
});

// Master data - Superadmin
Route::middleware('auth', 'verified', 'role:superadmin')->group(function () {
    Route::resource('masterdata/role', RoleController::class);
    Route::resource('masterdata/permission', PermissionController::class);
    Route::resource('masterdata/role-access', RoleAccessController::class);
    Route::resource('masterdata/user-management', UserManagementController::class);
    Route::resource('user', UserController::class);
});

// Menu - Superadmin dan Admin
Route::middleware('auth', 'verified', 'role:superadmin|admin')->group(function () {
    Route::resource('vehicle', VehicleController::class);
    Route::resource('driver', DriverController::class);
    Route::resource('booking/new-order', BookingController::class);
    Route::get('booking/histories', [BookingHistoriesController::class, 'index'])->name('histories.index');
    Route::post('booking/{bookingId}/move-to-histories', [BookingController::class, 'moveToHistories'])->name('booking.moveToHistories');
    Route::delete('booking/histories/{id}', [BookingHistoriesController::class, 'destroy'])->name('histories.destroy');
    Route::get('reports/', [ReportController::class, 'index'])->name('reports.index');
});

// Approval - Superadmin dan Approver
Route::middleware(['auth', 'verified', 'role:superadmin|approver'])->group(function () {
    Route::get('/approvals', [ApprovalController::class, 'index'])->name('approvals.index');
    Route::post('/approvals/{booking}/approve', [ApprovalController::class, 'approve'])->name('approvals.approve');
    Route::get('/approvals/{booking}/reject-view', [ApprovalController::class, 'reject'])->name('approvals.reject');
    Route::post('/approvals/{booking}/reject-action', [ApprovalController::class, 'storeReject'])->name('approvals.storeReject');
});

require __DIR__ . '/auth.php';