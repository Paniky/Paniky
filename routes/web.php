<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ComicController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SearchController;
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
Route::get('comics',[ComicController::class,'listAllComics']);
Route::get('novels',[ComicController::class,'listAllNovels']);
Route::get('search',[SearchController::class,'Search']);
Route::get('/comics/cover/{releasePath}', function ($releasePath)
{
    $path = storage_path() . '/app/editorial/comic/'.$releasePath.'/presentation/cover.jpg';
    ;
    //return(print_r(scandir($path)));
    if(!File::exists($path)) abord(404);

    $file = File::get($path);
    $type = File::mimeType($path);

    $response = Response::make($file, 200);
    $response->header("Content-Type", "image/jpeg");
    return response()->file($path);
})->name('land');
Route::get('/lands/{filename}', function ($filename)
{
    $path = storage_path() . '/app/land/'.$filename
    ;
    //return(print_r(scandir($path)));
    if(!File::exists($path)) abord(404);

    $file = File::get($path);
    $type = File::mimeType($path);

    $response = Response::make($file, 200);
    $response->header("Content-Type", "image/jpeg");
    return response()->file($path);
})->name('land');
Route::get('/profiles/{filename}', function ($filename)
{
    $path = storage_path() . '/app/pfp/'.$filename
    ;
    //return(print_r(scandir($path)));
    if(!File::exists($path)) abord(404);

    $file = File::get($path);
    $type = File::mimeType($path);

    $response = Response::make($file, 200);
    $response->header("Content-Type", "image/jpeg");
    return response()->file($path);
})->name('pfp');
Route::get('/foo', function () {
Artisan::call('storage:link');
});
Route::get('/', function () {
    return view('welcome');
});
Route::get('/authors',[AuthorController::class,'index']);
Route::get('/{author}', [AuthorController::class,'show']);

Route::get('/user/register',[AuthorController::class,'register']);
Route::get('/user/follow/{users}',[UserController::class,'follow']);
Route::get('/user/login',[UserController::class,'logForm']);
Route::post('/user/register/action',[AuthorController::class,'store']);
Route::post('/user/login/action',[UserController::class,'login']);
Route::get('/comics/create', [ComicController::class,'createComic']);
Route::post('/comics/create/action', [ComicController::class,'store']);
Route::get('/novels/{comic}', [ComicController::class,'show']);
Route::get('/comics/{comic}', [ComicController::class,'show']);

