<?php

//<editor-fold desc="Login Routes">
Route::group( [
	'prefix'     => LaravelLocalization::setLocale(),
	'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
], function () {
	Auth::routes();
} );
//</editor-fold>

//<editor-fold desc="Guest Routes">
Route::group( [ 'middleware' => [ 'guest' ], 'prefix' => LaravelLocalization::setLocale() ], function () {
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
	Route::group( [
		'prefix'     => LaravelLocalization::setLocale(),
		'middleware' => [ 'role:user', 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ,'localize']
	],
		function () {
			//All User Routes +++++
			Route::get( '/user', function () {
				return view( 'home' );
			} )->name( 'user.home' );


			Route::get( LaravelLocalization::transRoute('routes.posts'), function () {
				return view( 'home' );
			} )->name( 'post.all' );

			Route::get( '/post/1', function () {
				return view( 'home' );
			} )->name( 'post' );

		} );
	//</editor-fold>
} );
// All Authenticate user routes end
