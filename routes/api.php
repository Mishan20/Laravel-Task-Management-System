<?php
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\TaskController;
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
//Employee Routes
Route::get('getEmployees', [EmployeeController::class, 'index']);
Route::post('addEmployee', [EmployeeController::class, 'store']);
Route::resource('findEmployee', EmployeeController::class);
Route::put('updateEmployee/{id}', [EmployeeController::class, 'update']);
Route::delete('deleteEmployee/{id}', [EmployeeController::class, 'destroy']);
Route::get('searchEmployee/{name}', [EmployeeController::class, 'search']);

//Task Routes
Route::get('getTasks', [TaskController::class, 'index']);
Route::post('addTask', [TaskController::class, 'store']);
Route::resource('findTask', TaskController::class);
Route::put('updateTask/{id}', [TaskController::class, 'update']);
Route::delete('deleteTask/{id}', [TaskController::class, 'destroy']);
Route::get('searchTask/{name}', [TaskController::class, 'search']);


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
