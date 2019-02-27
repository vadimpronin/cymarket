<?php

use Illuminate\Http\Request;
use Telegram\Bot\Api;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/telegram/hook', function (Api $telegram) {
    $update = $telegram->commandsHandler(true);

//    if (!$this->dialogs->exists($update)) {
//        // Do something if there are no existing dialogs
//    } else {
//        // Call the next step of the dialog
//        $this->dialogs->proceed($update);
//    }

    return 'ok';
})->name('telegram-hook');
