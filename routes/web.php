<?php

use Illuminate\Support\Facades\Auth;
use App\TwitterOrthographic;

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
    if (Auth::check()) {
        $tweets = App\Tweet::orderBy('created_at', 'desc')->paginate(5);
        foreach ($tweets as $tweet) {
            $teste = new TwitterOrthographic;
            $orthos[$tweet->id] = $teste->check($tweet);
        }
    } else {
        $tweets = App\Tweet::where('approved',1)->orderBy('created_at','desc')->take(5)->get();
        
        foreach ($tweets as $tweet) {
            $teste = new TwitterOrthographic;
            $orthos[$tweet->id] = $teste->check($tweet);
        }
    }
    
    return view('welcome', ['tweets' => $tweets, 'orthos' => $orthos]);
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::post('approve-tweets', ['middleware' => 'auth', function (Illuminate\Http\Request $request){
    foreach ($request->all() as $input_key => $input_val) {
        if (strpos($input_key, 'approval-status-') === 0) {
            $tweet_id = substr_replace($input_key, '', 0, strlen('approval-status-'));
            $tweet = App\Tweet::where('id', $tweet_id)->first();
            if ($tweet) {
                $tweet->approved = (int)$input_val;
                $tweet->save();
            }
        }
    }
    return redirect()->back();
}]);
