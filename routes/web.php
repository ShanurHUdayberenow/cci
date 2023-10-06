<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\AllController;
use App\Http\Controllers\BizInfo\FoOffersController;
use App\Http\Controllers\BizInfo\LocalBrandsController;
use App\Http\Controllers\BizInfo\PartnersController;
use App\Http\Controllers\BizInfo\PositionController;
use App\Http\Controllers\BizInfo\TendersController;
use App\Http\Controllers\BizInfo\TmOffersController;
use App\Http\Controllers\ContactsController;
use App\Http\Controllers\ExhibitionsController;
use App\Http\Controllers\FormsController;
use App\Http\Controllers\InvestmentsController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\NewsCciController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\ParcipantsController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('check-email', static function (Request $request) {
    if (User::where('email', $request->get('email'))->exists()) {
        return \response()->json(false);
    } else {
        return \response()->json(true);
    }
});

Route::get('locale/{locale}', [MainController::class, 'changeLocale'])->name('locale');

Route::group(['middleware' => 'set_locale'], function () {
    Route::get('/participants_event', [ParcipantsController::class, 'single'])->name('parcipants');

    Route::resource('/form', FormsController::class);
    Route::get('/investment/{slug}', [InvestmentsController::class, 'single'])->name('investment');

    Route::get('/', [MainController::class, 'index'])->name('home');
    Route::get('/membership/{slug}', [MainController::class, 'membership'])->name('membership');
    Route::get('/branch/{slug}', [MainController::class, 'branch'])->name('branch');
    Route::get('/conference/{slug}', [MainController::class, 'conferences'])->name('conferences');
    Route::get('/conferences', [MainController::class, 'conferences'])->name('conference');

    Route::get('/album/{slug}', [MainController::class, 'album'])->name('album_single');

    Route::get('/about/{slug}', [AboutController::class, 'about'])->name('abouts');

    Route::get('/news', [NewsController::class, 'index'])->name('news');
    Route::get('/news/{slug}', [NewsController::class, 'single'])->name('news_single');

    Route::get('/news-cci', [NewsCciController::class, 'index'])->name('news_cci');
    Route::get('/news-cci/{slug}', [NewsCciController::class, 'single'])->name('news_cci_single');

    Route::get('/contacts', ContactsController::class)->name('contacts');

    Route::get('/turkmen_exhibition', [ExhibitionsController::class, 'tmExhibition'])->name('tm-exhibition');
    Route::get('/foreign_exhibition', [ExhibitionsController::class, 'foExhibition'])->name('fo-exhibition');

    Route::group([
        'prefix' => 'biz-info',
        'as'     => 'biz-info.'
    ], static function () {
        Route::get('/local-brands', LocalBrandsController::class)->name('local-brands');
        Route::get('/tenders', TendersController::class)->name('tenders');
        Route::get('/partners', PartnersController::class)->name('partners');
        Route::get('/fo-offers', FoOffersController::class)->name('fo-offers');
        Route::get('/tm-offers', TmOffersController::class)->name('tm-offers');
        Route::get('/position', PositionController::class)->name('position');
    });

    Route::feeds();
});
