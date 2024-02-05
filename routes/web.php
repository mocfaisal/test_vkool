<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
 */

//  Defined first route
Route::get('/', function () {
    // return view('welcome');
    // return view('layouts.backend.admin.mainLayout');
    return redirect()->route('auth.login');
});

Route::group(['namespace' => 'App'], function () {


    Route::group(['namespace' => 'Livewire'], function () {

        Route::group(['middleware' => ['auth', 'auth.basic'], 'namespace' => 'Backend'], function () {
            Route::group(['namespace' => 'Admin'], function () {

                Route::prefix('admin')->group(function () {
                    Route::group(['namespace' => 'Home'], function () {
                        Route::get('/', Index::class)->name('backend.admin.home');
                    });

                    Route::group(['namespace' => 'Settings'], function () {
                        Route::prefix('settings')->group(function () {
                            Route::group(['namespace' => 'Menu'], function () {
                                Route::prefix('menu')->group(function () {
                                    Route::get('/', Index::class)->name('backend.admin.settings.menu');
                                    Route::get('/getData', 'Index@getData')->name('backend.admin.settings.menu.data');
                                    Route::post('/update', 'Index@save')->name('backend.admin.settings.menu.update');
                                });
                            });
                        });
                    });
                });
            });

            Route::group(['namespace' => 'Master'], function () {

                Route::prefix('master')->group(function () {

                    Route::group(['namespace' => 'Inventory'], function () {
                        Route::prefix('inventory')->group(function () {
                            Route::get('/', Index::class)->name('backend.master.inventory');
                            Route::get('/create', Create::class)->name('backend.master.inventory.create');
                            // Route::get('/edit/{id}', Edit::class)->name('backend.master.inventory.edit');

                            Route::post('/table', 'Index@getData')->name('backend.master.inventory.getData.table');
                        });
                    });
                });
            });

            Route::group(['namespace' => 'Transaksi'], function () {

                Route::prefix('transaksi')->group(function () {

                    Route::group(['namespace' => 'Penjualan'], function () {
                        Route::prefix('penjualan')->group(function () {
                            Route::get('/', Index::class)->name('backend.transaksi.penjualan');
                            Route::get('/create', Create::class)->name('backend.transaksi.penjualan.create');
                            // Route::get('/edit/{id}', Edit::class)->name('backend.transaksi.penjualan.edit');

                            Route::post('/table', 'Index@getData')->name('backend.transaksi.penjualan.getData.table');
                        });
                    });
                });
            });
        });

        Route::group(['namespace' => 'Frontend'], function () {
            Route::group(['namespace' => 'Auth'], function () {
                Route::prefix('auth')->group(function () {
                    Route::get('/logout', 'Login@logout')->name('frontend.auth.logout');

                    Route::middleware('guest')->group(function () {
                        Route::prefix('login')->group(function () {
                            Route::get('/', Login::class)->name('frontend.auth.login');
                        });

                        Route::prefix('register')->group(function () {
                            Route::get('/', Register::class)->name('frontend.auth.register');
                        });

                        Route::group(['namespace' => 'ForgotPass'], function () {
                            Route::prefix('forgot_pass')->group(function () {
                                Route::get('/', Index::class)->name('frontend.auth.forgot_pass');
                                Route::get('/reset-password/{token}', Reset::class)->name('password.reset');
                            });
                        });
                    });
                });
            });
        });
    });
});

// Defined last route
// using reroute by name of route above

Route::get('/login', function () {
    return redirect()->route('frontend.auth.login');
})->name('auth.login');

Route::get('/logout', function () {
    return redirect()->route('frontend.auth.logout');
})->name('auth.logout');

Route::get('/register', function () {
    return redirect()->route('frontend.auth.register');
})->name('auth.register');

Route::get('/forgot_pass', function () {
    return redirect()->route('frontend.auth.forgot_pass');
})->name('auth.forgot_pass');


// Others
Route::get('/clear-cache', function () {
    $exitCode = Artisan::call('config:clear');
    $exitCode = Artisan::call('cache:clear');
    $exitCode = Artisan::call('view:clear');
    $exitCode = Artisan::call('route:clear');
    $exitCode = Artisan::call('config:cache');
    $exitCode = Artisan::call('view:cache');
    $exitCode = Artisan::call('route:cache');
    // $exitCode = Artisan::call('clear-compiled');

    return 'DONE'; //Return anything
});

Route::get('/clear-cache2', function () {
    $exitCode = Artisan::call('config:clear');
    $exitCode = Artisan::call('cache:clear');
    $exitCode = Artisan::call('view:clear');
    $exitCode = Artisan::call('route:clear');
    return 'DONE'; //Return anything
});
