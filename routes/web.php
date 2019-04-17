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

use Illuminate\Http\Request;

Route::get('/app', function () {
    $query = http_build_query([
        'client_id'     => env("ID_API_APP"),
        'redirect_uri'  => env("REDIR_API_APP"),
        'response_type' => 'code',
        'scope'         => '*',
    ]);
    return redirect("http://127.0.0.1:8000/oauth/authorize?$query");
});

Route::get('callback', function (Request $request) {
    $http = new \GuzzleHttp\Client();
    $arrayFormParams = [
        'grant_type' => 'authorization_code',
        'client_id' => 3,
        'client_secret' => 'dH2VI34NumguoCZ2pqi64n9ouDb5xCUMaU2p4Xro',
        'redirect_uri' => env("REDIR_API_APP"),
        'code' => $request->get('code'),
    ];
    $response = $http->post("http://127.0.0.1:8000/oauth/token", [
        'form_params' => $arrayFormParams
    ]);
    // dd($response->getBody());
});

Route::get('dashboard', function () {
    return "Bem vindo ao sistema";
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
