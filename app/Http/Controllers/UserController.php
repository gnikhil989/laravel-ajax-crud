<?php

namespace App\Http\Controllers;

use App\Exports\ExportUser;
use App\Imports\ImportUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;

class UserController extends Controller
{

    public function loginForm()
    {
        return view('login.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
// dd($credentials);
        if (auth()->attempt($credentials)) {
            // Authentication successful, user is logged in
            // dd($credentials);
            echo "auth";
            return redirect()->route('importView');
        }

        // Authentication failed
        return redirect()->route('login')->with('error', 'Invalid email or password.');
    }

    public function importView(Request $request)    
    {
        
        if ($request->ajax()) {
            $data = User::latest()->get();

            return datatables()->of($data)
                ->addIndexColumn()
                ->make(true);
        }
        return view('login.importFile');
   

    }

    public function import(Request $request)
{
    $importedData = Excel::toArray(new ImportUser, $request->file('file'))[0];

    // Check the first row of the imported data
    if (count($importedData) > 0) {
        $firstRow = $importedData[0];
        if ($this->isFirstRowValid($firstRow)) {
            array_shift($importedData); // Remove the first row if it matches the criteria
        }
    }

    // Validate for empty cells
    $emptyCells = $this->validateEmptyCells($importedData);

    // If there are empty cells, create a new Excel file and download it
    if (!empty($emptyCells)) {
        $fileName = 'empty_cells_' . now()->format('YmdHis') . '.xlsx';
        Excel::store(new ExportUser($emptyCells), $fileName);

        return response()->download(storage_path('app/' . $fileName))
            ->deleteFileAfterSend(true)
            ->setStatusCode(422, 'Unprocessable Entity')
            ->header('Content-Type', 'application/octet-stream');
    }

    // Process the data and store valid rows in the database
    foreach ($importedData as $data) {
        // Check if the password field is not empty before creating the User
        if (!empty($data[2])) {
            User::create([
                'name' => $data[0], // Assuming the name is in the first column
                'email' => $data[1],
                'password' => Hash::make($data[2]), // Assuming the email is in the second column
                // Add other fields as needed
            ]);
        }
    }

    return redirect()->back();
}

// Function to check for empty cells in the imported data
private function validateEmptyCells($importedData)
{
    $emptyCells = [];
    foreach ($importedData as $index => $data) {
        // Check if any cell is empty
        if (in_array(null, $data, true)) {
            // Record the invalid row
            $emptyCells[] = array_merge(['Row Number' => $index + 2], $data);
        }
    }

    return $emptyCells;
}

    
// Function to check if the first row is valid
    private function isFirstRowValid($firstRow)
    {
        return $firstRow[0] === 'name' && $firstRow[1] === 'email' && $firstRow[2] === 'password';
    }

    public function exportUsers(Request $request)
    {
        ob_end_clean();
        ob_start();
        return Excel::download(new ExportUser, 'users.xlsx');
    }

    public function create()
    {
        return view('login.add');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required',
            'password' => 'required',
        ]);

        $user = new User([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')), // Hash the password
        ]);

        $user->save();

        return response()->json(['success' => 'New Record created successfully']);
    }
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');

    }
}
