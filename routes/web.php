<?php

use App\Models\Organization;
use App\Models\User;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('control/');
});



Route::get('/login', function () {
    return view('login');
})->name('login');


Route::get('/logout', function () {
    Auth::logout();
    return redirect()->route('login')->with('success', 'You are logged out');
});

Route::get('/createPermission', [\App\Http\Controllers\StaffController::class, 'createPermission']);

Route::post('/login_user', [\App\Http\Controllers\InController::class, 'weblogin'])->name('weblogin.user');



Route::group(['prefix'=>'driver', 'as'=>'driver.', 'middleware' => ['auth', 'driver', 'active'] ], function (){
    Route::get('/', function () { return redirect('/driver/new/delivery'); });
    Route::get('/new/delivery', function () { return view('driver.newdelivery'); })->name('driverDashboard');
    Route::get('/refused/delivery', function () { return view('driver.refuseddelivery'); });
    Route::get('/sucessfull/delivery', function () { return view('driver.sucessfulldelivery'); });
    Route::get('/history/delivery', function () { return view('driver.history'); });

    Route::post('/driverFreightMessage', [\App\Http\Controllers\DeliveryController::class, 'driverFreightMessage'])->name('driverFreightMessage');
});


Route::group(['prefix'=>'control', 'as'=>'control.', 'middleware' => ['auth', 'active', 'addoc'] ], function (){

    Route::group(['middleware' => ['admin'] ], function (){

        Route::get('/', function () {
            return view('control.index');
        })->name('dashboard');
        Route::get('/addnewstaff', function () {
            return view('control.addstaff');
        });

        Route::get('/all/staff', function () {
            return view('control.allstaff');
        });

        //staff routes
        Route::post('/addStaff', [\App\Http\Controllers\StaffController::class, 'addStaff'])->name('addStaff');
        Route::post('/userStatus', [\App\Http\Controllers\StaffController::class, 'userStatus'])->name('userStatus');

        ///organization management
        Route::post('/createOrganization', [\App\Http\Controllers\OrganizationController::class, 'createOrganization'])->name('createOrganization');
        Route::post('/editOrganizationInfo', [\App\Http\Controllers\OrganizationController::class, 'editOrganizationInfo'])->name('editOrganizationInfo');
        Route::get('/organization/new', function () {
            return view('control.addorganization');
        });

        Route::get('/organization/{slug}', function ($slug) {
            $org = \App\Models\Organization::where('slug', $slug)->first(); if(!$org){ abort(404); }
            return view('control.organization', compact('org'));
        });

        Route::get('/organizations/all', function () {
            return view('control.allorg');
        });


        Route::get('/freight/flagged', function () {
            return view('control.flagged');
        });


        Route::get('/freight/delivered', function () {
            return view('control.deliveerd');
        });


        Route::get('/freight/ofd', function () {
            return view('control.ofd');
        });


        /////delivery
        Route::get('/history/delivery', function () {
            return view('control.deliveryhistory');
        });


        //driver management
        Route::get('/driver/add', function () {
            return view('control.adddriver');
        });

        Route::get('/driver/all', function () {
            return view('control.alldriver');
        });

        Route::get('/driver/profile/{id}', function ($id) {
            $driver = User::find($id); if(!$driver) { abort(404); }
            return view('control.driverprofile', compact('driver'));
        });


    });
    
    // Freight management
    Route::post('/createMainfest', [\App\Http\Controllers\FreightController::class, 'createMainfest'])->name('createMainfest');
    Route::post('/editManifest', [\App\Http\Controllers\FreightController::class, 'editManifest'])->name('editManifest');

    Route::get('/all/manifest', function () { return view('control.viewallmanifest'); });
    Route::get('/all/freight', function () { return view('control.viewallfreight'); });

    Route::post('/eidtFreight', [\App\Http\Controllers\FreightController::class, 'eidtFreight'])->name('eidtFreight');
    Route::post('/createFreight', [\App\Http\Controllers\FreightController::class, 'createFreight'])->name('createFreight');
    Route::post('/assign_freight', [\App\Http\Controllers\FreightController::class, 'assignFreightToDriver'])->name('assign.freight');
    Route::post('/update_freight', [\App\Http\Controllers\FreightController::class, 'adminUpdateFreight'])->name('assign.freight.update');
    Route::post('/approve_freight', [\App\Http\Controllers\FreightController::class, 'makeFreightapproval']);

    Route::get('d/freight/{driver_id}/{date?}', function ($driver_id, $date) {
        $driver = User::find($driver_id);
        return view('control.print_freight', compact('driver', 'date'));
    });


    Route::get('o/freight/{org_id}/{date?}', function ($org_id, $date) {
        $org = Organization::find($org_id);
        return view('control.print_invoice', compact('org', 'date'));
    });
    ///search routes

    Route::post('/collectsearch', function (Request $request) {
        return redirect('/control/search/'.$request->q);
    });


    Route::get('/search/{q}', function ($q) {
        return view('control.search', compact('q'));
    });


});
