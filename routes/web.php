
<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PlantController;
use App\Http\Controllers\PlantReportController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return redirect()->route('plants.index');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::resource('plants', PlantController::class);

    Route::get('/reports', [PlantReportController::class, 'index'])
        ->name('reports.index');

    Route::get('/reports/pdf', [PlantReportController::class, 'exportPdf'])
    ->name('reports.pdf');

    Route::get('/reports/csv', [PlantReportController::class, 'exportCsv'])
    ->name('reports.csv');

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});

require __DIR__.'/auth.php';