<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SsoController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SsoLogController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HelpController;
use App\Http\Controllers\AccessRequestController;
use App\Http\Controllers\ApplicationCategoryController;
use App\Http\Controllers\SettingController;




Route::get('/', fn () => redirect()->route('login'));

# --- Auth (tanpa API)
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'doLogin'])->name('login.do');

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    # Dashboard & SSO
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/sso/{slug}', [SsoController::class, 'redirect'])->name('sso.redirect');

    # ===== Admin only: superadmin & it-admin =====
    Route::middleware('role:superadmin,it-admin')->group(function () {
        // Applications CRUD
        Route::get('/applications', [ApplicationController::class, 'index'])->name('applications.index');
        Route::get('/applications/create', [ApplicationController::class, 'create'])->name('applications.create');
        Route::post('/applications', [ApplicationController::class, 'store'])->name('applications.store');
        Route::get('/applications/{application}/edit', [ApplicationController::class, 'edit'])->name('applications.edit');
        Route::put('/applications/{application}', [ApplicationController::class, 'update'])->name('applications.update');
        Route::delete('/applications/{application}', [ApplicationController::class, 'destroy'])->name('applications.destroy');

        // Applications ↔ Roles
        Route::get('/applications/{application}/roles', [ApplicationController::class, 'editRoles'])->name('applications.roles');
        Route::post('/applications/{application}/roles', [ApplicationController::class, 'updateRoles'])->name('applications.roles.update');

        // Roles
        Route::get('/roles', [RoleController::class, 'index'])->name('roles.index');
        Route::post('/roles', [RoleController::class, 'store'])->name('roles.store');
        Route::delete('/roles/{role}', [RoleController::class, 'destroy'])->name('roles.destroy');

        // SSO Logs
        Route::get('/sso-logs', [SsoLogController::class, 'index'])->name('sso.logs');

        // pengumuman
        Route::get('/announcements', [AnnouncementController::class, 'index'])->name('announcements.index');
        Route::get('/announcements/create', [AnnouncementController::class, 'create'])->name('announcements.create');
        Route::post('/announcements', [AnnouncementController::class, 'store'])->name('announcements.store');
        Route::get('/announcements/{announcement}/edit', [AnnouncementController::class, 'edit'])->name('announcements.edit');
        Route::put('/announcements/{announcement}', [AnnouncementController::class, 'update'])->name('announcements.update');
        Route::delete('/announcements/{announcement}', [AnnouncementController::class, 'destroy'])->name('announcements.destroy');

        // ============ 1. Permintaan akses (ADMIN lihat & tindak) ============
        Route::get('/access-requests', [AccessRequestController::class, 'index'])->name('access-requests.index');
        Route::post('/access-requests/{accessRequest}/approve', [AccessRequestController::class, 'approve'])->name('access-requests.approve');
        Route::post('/access-requests/{accessRequest}/reject', [AccessRequestController::class, 'reject'])->name('access-requests.reject');

        // ============ 2. Kategori Aplikasi ============
        Route::get('/app-categories', [ApplicationCategoryController::class, 'index'])->name('app-categories.index');
        Route::post('/app-categories', [ApplicationCategoryController::class, 'store'])->name('app-categories.store');
        Route::delete('/app-categories/{category}', [ApplicationCategoryController::class, 'destroy'])->name('app-categories.destroy');

        // ============ 3. Pengaturan Sistem ============
        Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
        Route::post('/settings', [SettingController::class, 'store'])->name('settings.store');


    });

    # ===== Users (superadmin, it-admin, hr) =====
    Route::middleware('role:superadmin,it-admin,hr')->group(function () {
        Route::get('/users', [UserController::class, 'index'])->name('users.index');
        Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
        Route::post('/users', [UserController::class, 'store'])->name('users.store');
        Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
        Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
        Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');

        // atur role user (cek detail izin di controller)
        Route::post('/users/{user}/roles', [UserController::class, 'updateRoles'])->name('users.roles.update');

        Route::get('/departments', [\App\Http\Controllers\DepartmentController::class, 'index'])->name('departments.index');
        Route::post('/departments', [\App\Http\Controllers\DepartmentController::class, 'store'])->name('departments.store');
        Route::delete('/departments/{department}', [\App\Http\Controllers\DepartmentController::class, 'destroy'])->name('departments.destroy');

    });

    // profil user (semua user)
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::post('/profile', [ProfileController::class, 'updatePassword'])->name('profile.updatePassword');

    // riwayat sso milik user sendiri
    Route::get('/my-logs', [SsoLogController::class, 'my'])->name('sso.my');

    // halaman bantuan
    Route::get('/help', [HelpController::class, 'index'])->name('help.index');

    // ============ 1. Permintaan akses (user biasa) ============
    Route::get('/access-requests/create', [AccessRequestController::class, 'create'])->name('access-requests.create');
    Route::post('/access-requests', [AccessRequestController::class, 'store'])->name('access-requests.store');
    Route::get('/access-requests/my', [AccessRequestController::class, 'my'])->name('access-requests.my');

});
