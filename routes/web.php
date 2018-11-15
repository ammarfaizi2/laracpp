<?php

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
    return view('welcome');
});

/**
 * Test 1
 */
function func_1() {
	for ($i=0; $i < 10000; $i++) { 
		print "Hello World\n";
	}
}

Route::get("/laracpp-1", function () {
	$start = microtime(true);
	print "<!--";
	for ($i=0; $i < 1000; $i++) { 
		test_1();
	}
	print "-->";
	print microtime(true) - $start;
});

Route::get("/laravel-1", function () {
	$start = microtime(true);
	print "<!--";
	for ($i=0; $i < 1000; $i++) { 
		func_1();
	}
	print "-->";
	print microtime(true) - $start;
});

