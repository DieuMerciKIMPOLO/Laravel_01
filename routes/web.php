<?php

// use Illuminate\Validation\Validator;

// use Illuminate\Support\Facades\Route;
// use Illuminate\Support\Facades\App;

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
// php artisan config:clear 
Route::post('/', function(){
$url_i=request('url');
$data=['url'=>$url_i];
// $validation=Validator::make($data,['url'=>'required|url']);
// dd($_POST);
// if($validation->fails()){
//     dd('Failed');
// }else{
//     dd('Success');
// }
// Validator::make($data,['url'=>'required|url'])->validate();
// Validator::make(
//     $data,
//     ['url'=>'required|url'],
//     [
//         'url.required'=>'Ce champ est obligatoire',
//         'url.url'=>'L" url saisie est invalide'
//     ]
//     )->validate();
Validator::make($data,['url'=>'required|url'])->validate();
$url=App\url::where('url',$url_i)->first();
if($url){
    return view('result')->with('shortened', $url->shortened);
}

$url_f=App\url::create([
 'url'=>$url_i,
 'shortened'=>App\url::getUniqueShortUrl()
]);
if($url_f){
    return view('result')->withShortened($url_f->shortened);
}
// dd(request('url'));
// dd(request()->get('url'));
// dd(request()->input('url'));
});

Route::get('/{shortened}', function ($shortened) {
    $url= App\url::where('shortened', $shortened)->first();
    if(!$url){
      return redirect('/');
    }else{
      return redirect($url->url);
    }
});
