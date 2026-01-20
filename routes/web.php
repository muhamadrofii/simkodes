<?php

use App\Http\Middleware\CheckSessionTimeout;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\OfficerController;
use App\Http\Controllers\SupervisorController;
use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\IncomingLetterController;
use App\Http\Controllers\OutgoingLetterController;
use App\Http\Controllers\InventoryController;
use Illuminate\Support\Facades\Auth;



// Index ke login

// Index: Jika sudah login, ke dashboard. Jika belum, ke login.
Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('dashboard');
    }
    return redirect()->route('login');
});

// Login
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);

// Logout
Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();

    return redirect()->route('login');
})->name('logout');

Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);

// Route::middleware(['auth'])->group(function () {
    // Dashboard (butuh login)
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    // Route::middleware([CheckSessionTimeout::class])->group(function () {
    Route::get('/members', [MemberController::class, 'index'])->name('members.index');
    Route::get('/members/{id}/kta', [MemberController::class, 'printKTA'])->name('members.kta');

    Route::get('/members/create', [MemberController::class, 'create'])->name('members.create');
    Route::post('/members', [MemberController::class, 'store'])->name('members.store');
    Route::get('/members/{id}', [MemberController::class, 'show'])->name('members.show');
    Route::get('/members/{id}/edit', [MemberController::class, 'edit'])->name('members.edit');
    Route::put('/members/{id}', [MemberController::class, 'update'])->name('members.update');
    Route::delete('/members/{id}', [MemberController::class, 'destroy'])->name('members.destroy');

    Route::get('/officers', [OfficerController::class, 'index'])->name('officers.index');
    Route::get('/officers/{id}/kta', [OfficerController::class, 'printKTA'])->name('officers.kta');
    Route::get('/officers/create', [OfficerController::class, 'create'])->name('officers.create');
    Route::post('/officers', [OfficerController::class, 'store'])->name('officers.store');
    Route::get('/officers/{id}', [OfficerController::class, 'show'])->name('officers.show');
    Route::get('/officers/{id}/edit', [OfficerController::class, 'edit'])->name('officers.edit');
    Route::put('/officers/{id}', [OfficerController::class, 'update'])->name('officers.update');
    Route::delete('/officers/{id}', [OfficerController::class, 'destroy'])->name('officers.destroy');

    Route::get('/supervisors', [SupervisorController::class, 'index'])->name('supervisors.index');
    Route::get('/supervisors/{id}/kta', [SupervisorController::class, 'printKTA'])->name('supervisors.kta');
    Route::get('/supervisors/create', [SupervisorController::class, 'create'])->name('supervisors.create');
    Route::post('/supervisors', [SupervisorController::class, 'store'])->name('supervisors.store');
    Route::get('/supervisors/{id}', [SupervisorController::class, 'show'])->name('supervisors.show');
    Route::get('/supervisors/{id}/edit', [SupervisorController::class, 'edit'])->name('supervisors.edit');
    Route::put('/supervisors/{id}', [SupervisorController::class, 'update'])->name('supervisors.update');
    Route::delete('/supervisors/{id}', [SupervisorController::class, 'destroy'])->name('supervisors.destroy');



    Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
    Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
    Route::get('/categories/{id}', [CategoryController::class, 'show'])->name('categories.show');
    Route::get('/categories/{id}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
    Route::put('/categories/{id}', [CategoryController::class, 'update'])->name('categories.update');
    Route::delete('/categories/{id}', [CategoryController::class, 'destroy'])->name('categories.destroy');


    Route::get('/incomingletters', [IncomingLetterController::class, 'index'])->name('incomingletters.index');
    Route::get('/incomingletters/create', [IncomingLetterController::class, 'create'])->name('incomingletters.create');
    Route::post('/incomingletters', [IncomingLetterController::class, 'store'])->name('incomingletters.store');
    Route::get('/incomingletters/{id}', [IncomingLetterController::class, 'show'])->name('incomingletters.show');
    Route::get('/incomingletters/{id}/edit', [IncomingLetterController::class, 'edit'])->name('incomingletters.edit');
    Route::put('/incomingletters/{id}', [IncomingLetterController::class, 'update'])->name('incomingletters.update');
    Route::delete('/incomingletters/{id}', [IncomingLetterController::class, 'destroy'])->name('incomingletters.destroy');

    Route::get('/outgoingletters', [OutgoingLetterController::class, 'index'])->name('outgoingletters.index');
    Route::get('/outgoingletters/create', [OutgoingLetterController::class, 'create'])->name('outgoingletters.create');
    Route::post('/outgoingletters', [OutgoingLetterController::class, 'store'])->name('outgoingletters.store');
    Route::get('/outgoingletters/{id}', [OutgoingLetterController::class, 'show'])->name('outgoingletters.show');
    Route::get('/outgoingletters/{id}/edit', [OutgoingLetterController::class, 'edit'])->name('outgoingletters.edit');
    Route::put('/outgoingletters/{id}', [OutgoingLetterController::class, 'update'])->name('outgoingletters.update');
    Route::delete('/outgoingletters/{id}', [OutgoingLetterController::class, 'destroy'])->name('outgoingletters.destroy');


    Route::get('/outgoing-letters', [OutgoingLetterController::class, 'index'])->name('outgoingletters.index');

    // use App\Http\Controllers\InventoryController;

    // ========== INVENTORIES ROUTES ==========

    // Index (list semua data)
    Route::get('/inventories/export/pdf', [InventoryController::class, 'exportPdf'])->name('inventories.export.pdf');
    Route::get('/inventories/export/excel', [InventoryController::class, 'exportExcel'])->name('inventories.export.excel');
    Route::get('/inventories', [InventoryController::class, 'index'])->name('inventories.index');

    // Form tambah data
    Route::get('/inventories/create', [InventoryController::class, 'create'])->name('inventories.create');

    // Simpan data baru
    Route::post('/inventories', [InventoryController::class, 'store'])->name('inventories.store');
    Route::get('/inventories/{inventory}', [InventoryController::class, 'show'])->name('inventories.show');
    Route::get('/inventories/{id}/edit', [InventoryController::class, 'edit'])->name('inventories.edit');
    Route::put('/inventories/{id}', [InventoryController::class, 'update'])->name('inventories.update');
    Route::get('/inventories/{id}/delete', [InventoryController::class, 'delete'])->name('inventories.delete');
    Route::delete('/inventories/{id}', [InventoryController::class, 'destroy'])->name('inventories.destroy');


    Route::get('/report', [ReportController::class, 'index'])->name('report.index');
    Route::get('/report/filter', [ReportController::class, 'filter'])->name('report.filter');
    Route::get('/report/print/{start_date}/{end_date}', [ReportController::class, 'print'])->name('report.print');


    Route::get('/about', function () {
        return view('about.index');
    })->name('about');

// });