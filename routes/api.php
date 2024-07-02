<?php
use App\Http\Controllers\AvailableTimeController;
use App\Http\Controllers\PasswordResetController;
use App\Http\Controllers\ExtensionReservationController;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\RateWithCommentController;
use App\Http\Controllers\PlaceController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\FeedBackController;
use App\Http\Controllers\FavouriteController;
use App\Http\Controllers\ExtensionController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdController;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group([
    'prefix'        => 'auth',
    'controller'    => AuthController::class
], function () {
    Route::post('/login', 'login');
    Route::post('/register', 'register');
    Route::group([
        'middleware' => 'auth:api'
    ], function () {
        Route::post('/logout', 'logout');
        Route::put('/update-profile', 'updateProfile');
        Route::get('/profile', 'getUserProfile');
    });
});

Route::group([
    'prefix' => '/ads',
    'controller' => AdController::class,
//  'middleware'    => ['auth:api', 'role:ADMIN']
], function () {
    Route::get('/myAds', 'getMyAds');
    Route::get('/approve' , 'approveRequest');
    Route::get('/reject' , 'rejectRequest');
    Route::get('/getAdsRequest','getAdsRequest');
    Route::delete('/{id}', 'delete');
    Route::put('/{id}', 'update');
    Route::post('/', 'store');
    Route::get('/{id}', 'findById');
    Route::get('/', 'getAll');
});

Route::group([
    'prefix' => '/users',
    'controller' => UserController::class,
    'middleware' => 'auth:api'
], function () {
    Route::put('/chargeBalance/{id}', 'chargeBalance');
    Route::get('/investor', 'getAllInvestors');
    Route::delete('/{id}', 'delete');
    Route::put('/{id}', 'update');
    Route::post('/', 'store');
    Route::get('/{id}', 'findById');
    Route::get('/', 'getAll');
});

Route::group([
    'prefix' => '/addresses',
    'controller' => AddressController::class,
    'middleware' => 'auth:api'
], function () {
    Route::delete('/{id}', 'delete');
    Route::put('/{id}', 'update');
    Route::post('/', 'store');
    Route::get('/{id}', 'findById');
    Route::get('/', 'getAll');
});

Route::group([
    'prefix' => '/categories',
    'controller' => CategoryController::class,
    'middleware' => 'auth:api'
], function () {
    Route::delete('/{id}', 'delete');
    Route::put('/{id}', 'update');
    Route::post('/', 'store');
    Route::get('/{id}', 'findById');
    Route::get('/', 'getAll');
});

Route::group([
    'prefix' => '/extensions',
    'controller' => ExtensionController::class,
    'middleware' => 'auth:api'
], function () {
    Route::delete('/{id}', 'delete');
    Route::put('/{id}', 'update');
    Route::post('/', 'store');
    Route::get('/{id}', 'findById');
    Route::get('/', 'getAll');
});

Route::group([
    'prefix' => '/favourites',
    'controller' => FavouriteController::class,
    'middleware' => 'auth:api'
], function () {
    Route::delete('/{id}', 'delete');
    Route::put('/{id}', 'update');
    Route::post('/', 'store');
    Route::get('/{id}', 'findById');
    Route::get('/', 'getAll');
});

Route::group([
    'prefix' => '/feedBacks',
    'controller' => FeedBackController::class,
    'middleware' => 'auth:api'
], function () {
    Route::delete('/{id}', 'delete');
    Route::put('/{id}', 'update');
    Route::post('/', 'store');
    Route::get('/{id}', 'findById');
    Route::get('/', 'getAll');
});

Route::group([
    'prefix' => '/images',
    'controller' => ImageController::class,
    'middleware' => 'auth:api'
], function () {
    Route::delete('/{id}', 'delete');
    Route::put('/{id}', 'update');
    Route::post('/', 'store');
    Route::get('/{id}', 'findById');
    Route::get('/', 'getAll');
});

Route::group([
    'prefix' => '/places',
    'controller' => PlaceController::class,
    'middleware' => 'auth:api'
], function () {
    Route::get('/myPlaces','getMyPlaces');
    Route::get('/filterPlaces','filterPlace');
    Route::get('/getPlacesByCatId','getPlacesByCatId');
    Route::get('/approve' , 'approveRequest');
    Route::get('/reject' , 'rejectRequest');
    Route::get('/getPlacesRequest','getPlacesRequest');
    Route::get('/search',  'search');
    Route::delete('/{id}', 'delete');
    Route::post('/{id}', 'update');
    Route::post('/', 'store');
    Route::get('/{id}', 'findById');
    Route::get('/', 'getAll');
});

Route::group([
    'prefix' => '/rateWithComments',
    'controller' => RateWithCommentController::class,
    'middleware' => 'auth:api'
], function () {
    Route::get('/getCommentsByPlaceId','getCommentsByPlaceId');
    Route::delete('/{id}', 'delete');
    Route::put('/{id}', 'update');
    Route::post('/', 'store');
    Route::get('/{id}', 'findById');
    Route::get('/', 'getAll');
});

Route::group([
    'prefix' => '/reservations',
    'controller' => ReservationController::class,
    'middleware' => 'auth:api'
], function () {
    Route::get('/placeReservation', 'getPlaceReservation');
    Route::post('/storeFromDay', 'storeFromDay');
    Route::get('/myReservation', 'getMyReservation');
    Route::post('/makeDay', 'makeDay');
    Route::post('/makeHour', 'makeHour');
    Route::post('/test', 'storeTest');
    Route::get('/times/{id}', 'getTimes');
    Route::get('/days/{id}', 'getDay');
    Route::delete('/{id}', 'delete');
    Route::put('/{id}', 'update');
    Route::post('/', 'store');
    Route::get('/{id}', 'findById');
    Route::get('/', 'getAll');
});

Route::group([
    'prefix' => '/types',
    'controller' => TypeController::class,
    'middleware' => 'auth:api'
], function () {
    Route::delete('/{id}', 'delete');
    Route::put('/{id}', 'update');
    Route::post('/', 'store');
    Route::get('/{id}', 'findById');
    Route::get('/', 'getAll');
});

Route::group([
    'prefix' => '/extensionReservations',
    'controller' => ExtensionReservationController::class,
    'middleware' => 'auth:api'
], function () {
    Route::delete('/{id}', 'delete');
    Route::put('/{id}', 'update');
    Route::post('/', 'store');
    Route::get('/{id}', 'findById');
    Route::get('/', 'getAll');
});

Route::group([
    'prefix' => '/passwordResets',
    'controller' => PasswordResetController::class,
    'middleware' => 'auth:api'
], function () {
    Route::delete('/{id}', 'delete');
    Route::put('/{id}', 'update');
    Route::post('/', 'store');
    Route::get('/{id}', 'findById');
    Route::get('/', 'getAll');
});

Route::group([
    'prefix' => '/availableTimes',
    'controller' => AvailableTimeController::class,
    // 'middleware' => ''
], function () {
    Route::put('/{id}', 'update');
    Route::post('/', 'store');
    Route::get('/{id}', 'findById');
    Route::get('/', 'getAll');
});
