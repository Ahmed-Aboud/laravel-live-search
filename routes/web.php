<?php

use App\Movie;
use Illuminate\Http\Request;
use TeamTNT\TNTSearch\TNTSearch;
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

Route::get('/', function (Request $request,TNTSearch $tnt) {


    if($request->ajax()){
        $results = Movie::search($request->search)->paginate(5)->map(function($movie) use ($tnt, $request){
    $movie->name = $tnt->highlight($movie->name, $request->search, 'em', ['wholeWord' => false]);
    return $movie;
});
	    return response()->json([
	        'status' => true,
	        'results' => $results
	    ], 200);
     
 }
   return view('welcome');
});


Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});
