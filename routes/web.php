    <?php

    use Illuminate\Support\Facades\Route;
    use App\Http\Controllers\CrudController;
    use App\Http\Controllers\DataTableCrudController;
    use App\Http\Controllers\StudentController;
    use App\Http\Controllers\UserController; 
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

    // Route::get('/', [CrudController::class, 'index']);
    Route::resource('todo', CrudController::class);
    Route::get('todo/update/{id}', [CrudController::class, 'update'])->name('todo.update');
    Route::delete('todo/{id}', [CrudController::class, 'destroy'])->name('todo.destroy');
    Route::resource('todos', DataTableCrudController::class);
    Route::get('/deleteTodo/{id}', [DataTableCrudController::class, 'deleteTodo'])->name('deleteTodo');
    Route::get('todos/edit/{todo}', [DataTableCrudController::class, 'edit'])->name('todos.edit');
    Route::post('todos/update/{todo}', [DataTableCrudController::class, 'updateTodo'])->name('todos.update');
    Route::get('/todos/destroy/{id}', [DataTableCrudController::class, 'destroy'])->name('destroy');
    Route::get('downloadPDF/{id}',[DataTableCrudController::class,'downloadPDF'])->name('downloadPDF');
    Route::get('/list', [DataTableCrudController::class,'list'])->name('list');
    Route::get('/show-sorted-data', [DataTableCrudController::class,'showSortedData'])->name('show.sorted.data');
    Route::get('todos/pdf', [DataTableCrudController::class, 'createPDF'])->name('todos.pdf');
    Route::resource('student', StudentController::class);
    Route::get('student_export',[StudentController::class, 'get_student_data'])->name('student.export');

// ==========================================import export routes============================================================


// Route::resource('login', UserController::class);

// Define a route for the login page
// Define a route for the login page
Route::get('/', [UserController::class, 'loginForm'])->name('login');
Route::post('/loginSubmit', [UserController::class, 'login'])->name('loginSubmit');
Route::resource('login', UserController::class);

// Rest of your code...


Route::middleware(['auth'])->group(function () {
    Route::get('/file-import', [UserController::class, 'importView'])->name('importView');
    Route::post('/import', [UserController::class, 'import'])->name('import');
    Route::get('/export-users', [UserController::class, 'exportUsers'])->name('export-users');
    Route::post('/login/store', [UserController::class, 'store'])->name('login.store');
    Route::get('/logout', [UserController::class, 'logout'])->name('logout');


    // Add more routes that require authentication here
    // ...
});

// Route::get('/', function () {
//     return redirect()->route('login');
// });


    // Route::get('download-list-pdf', 'DataTableCrudController@downloadListPDF')->name('downloadListPDF');



    // Route::get('todos', 'DataTableCrudController@create')->name('todos.create');
    // Route::post('todos', 'DataTableCrudController@store')->name('todos.store'); // New route for AJAX request
    // Route::get('todos', 'DataTableCrudController@index')->name('todos.index');

    // Route::get('todo/datatables', [DataTableCrudController::class, 'TodoList'])->name('todo.home');
    // Route::get('/todo', CrudController::class,'index');


    // Route::get('/', function () {
    //     return view('welcome');
    // });
    