<?php
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Backends\PosController;
use App\Http\Controllers\Backends\RoleController;
use App\Http\Controllers\Backends\UserController;
use App\Http\Controllers\Backends\AllSaleController;
use App\Http\Controllers\Backends\ExpenseController;
use App\Http\Controllers\Backends\MeasureController;
use App\Http\Controllers\Backends\ProductController;
use App\Http\Controllers\Backends\CategoryController;
use App\Http\Controllers\Backends\CurrencyController;
use App\Http\Controllers\Backends\CustomerController;
use App\Http\Controllers\Backends\LanguageController;
use App\Http\Controllers\Backends\SupplierController;
use App\Http\Controllers\Backends\DashboardController;
use App\Http\Controllers\Backends\FileManagerController;
use App\Http\Controllers\Backends\PaymentTypeController;
use App\Http\Controllers\Backends\ExchangeRateController;
use App\Http\Controllers\Backends\BusinessSettingController;
  use App\Services\CnbcScraperService;



// change language
Route::get('language/{locale}', function ($locale) {
    app()->setLocale($locale);
    session()->put('locale', $locale);
    $language = \App\Models\BusinessSetting::where('type', 'language')->first();
    session()->put('language_settings', $language);
    return redirect()->back();
})->name('change_language');


Route::get('/', function () {
    return redirect()->route('login');
});

Auth::routes();

// save temp file
Route::post('save_temp_file', [FileManagerController::class, 'saveTempFile'])->name('save_temp_file');

Route::redirect('/dashboard', '/admin/dashboard');

Route::post('save_temp_file', [FileManagerController::class, 'saveTempFile'])->name('save_temp_file');
Route::get('remove_temp_file', [FileManagerController::class, 'removeTempFile'])->name('remove_temp_file');

// back-end
Route::middleware(['auth', 'CheckUserLogin', 'SetSessionData'])->group(function () {

    Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        // setting
        Route::group(['prefix' => 'setting', 'as' => 'setting.'], function () {
            Route::get('/', [BusinessSettingController::class, 'index'])->name('index');
            Route::put('/update', [BusinessSettingController::class, 'update'])->name('update');

            // language setup
            Route::group(['prefix' => 'language', 'as' => 'language.'], function () {
                Route::get('/', [LanguageController::class, 'index'])->name('index');
                Route::get('/create', [LanguageController::class, 'create'])->name('create');
                Route::post('/', [LanguageController::class, 'store'])->name('store');
                Route::get('/edit', [LanguageController::class, 'edit'])->name('edit');
                Route::put('/update', [LanguageController::class, 'update'])->name('update');
                Route::delete('delete/', [LanguageController::class, 'delete'])->name('delete');

                Route::get('/update-status', [LanguageController::class, 'updateStatus'])->name('update-status');
                Route::get('/update-default-status', [LanguageController::class, 'update_default_status'])->name('update-default-status');
                Route::get('/translate', [LanguageController::class, 'translate'])->name('translate');
                Route::post('translate-submit/{lang}', [LanguageController::class, 'translate_submit'])->name('translate.submit');
            });
        });

        Route::resource('user', UserController::class);

        //Edit Profile
        // Route::resource('profile', ProfileController::class);
        Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
        Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::put('/profile/update/{id}', [ProfileController::class, 'update'])->name('profile.update');

        Route::resource('roles', RoleController::class);

        //product
        Route::resource('products', ProductController::class);
         Route::post('/products/update-status', [ProductController::class, 'updateStatus'])->name('product.update_status');

        //category
        Route::resource('categories', CategoryController::class);

        //supplier
        Route::resource('suppliers', SupplierController::class);

        //measure
        Route::resource('measures', MeasureController::class);

        //customer
        Route::resource('customers', CustomerController::class);

        //all sale
        Route::resource('allsales', AllSaleController::class);

        Route::get('/pos/search', [PosController::class, 'searchProduct'])->name('pos.search');
        Route::resource('pos', PosController::class);
        
        //expense
        Route::resource('expenses', ExpenseController::class);

        //payment type
        Route::resource('paymenttypes', PaymentTypeController::class);

        //currency
        Route::resource('currencies', CurrencyController::class);

        //exchange rate
        Route::resource('exchangerates', ExchangeRateController::class);
     

Route::get('/test-scraper', function () {
    $scraper = new CnbcScraperService();
    $scraper->fetchAndStore();
    return 'Scraper ran, check DB.';
});

    });

});


Route::middleware(['auth'])->group(function () {
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
});





