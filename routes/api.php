<?php
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
//Public Routes

//Admin Routes
Routes::post('register', [AuthController::class, 'register']);
Routes::post('login', [AuthController::class, 'login']);

//Employee Routes
Route::get('getEmployees', [EmployeeController::class, 'index']);
Route::resource('findEmployee', EmployeeController::class);
Route::get('searchEmployee/{name}', [EmployeeController::class, 'search']);

//Task Routes
Route::get('getTasks', [TaskController::class, 'index']);
Route::resource('findTask', TaskController::class);
Route::get('searchTask/{name}', [TaskController::class, 'search']);


//Protected Routes 
Route::group(['middleware' => ['auth:sanctum']], function () {
    
    //Admin Routes
    Route::post('logout', [AuthController::class, 'logout']);
    
    //Employee Routes
    Route::post('addEmployee', [EmployeeController::class, 'store']);
    Route::put('updateEmployee/{id}', [EmployeeController::class, 'update']);
    Route::delete('deleteEmployee/{id}', [EmployeeController::class, 'destroy']);

    //Task Routes
    Route::post('addTask', [TaskController::class, 'store']);
    Route::put('updateTask/{id}', [TaskController::class, 'update']);
    Route::delete('deleteTask/{id}', [TaskController::class, 'destroy']);
});