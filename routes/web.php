<?php

/*

 Route::group(['middleware' => ['role:super-admin|writer']], function () {

});

Route::group(['middleware' => ['permission:publish articles|edit articles']], function () {

});

*/
Auth::routes();


//<editor-fold desc="Guest Routes">
Route::group( [ 'middleware' => [ 'guest' ] ], function () {
	Route::get( '/', function () {
		return view( 'welcome' );
	} );
} );
//</editor-fold>

// All Authenticate user routes
Route::group( [ 'middleware' => [ 'auth' ] ], function () {
	//<editor-fold desc="Redirecting user after login base on role">
	Route::get( '/home', function () {
		if ( auth()->user()->hasRole( 'admin' ) ) {
			$redirect = redirect( route( 'admin.home' ) );
		} else {
			$redirect = redirect( route( 'user.home' ) );
		}

		return $redirect;
	} )->name( 'home' );
	//</editor-fold>

	//<editor-fold desc="Admin Route">
	Route::group( [ 'middleware' => [ 'role:admin' ], 'as' => 'admin.' ], function () {
		// All Admin Routes +++++
		Route::get( '/admin', function () {
			return view( 'home' );
		} )->name( 'home' );

	} );
	//</editor-fold>

	//<editor-fold desc="User Route">
	Route::group( [ 'middleware' => [ 'role:user' ] ], function () {
		//All User Routes +++++
		Route::get( '/user', function () {
			return view( 'home' );
		} )->name( 'user.home' );

	} );
	//</editor-fold>
} );
// All Authenticate user routes end
