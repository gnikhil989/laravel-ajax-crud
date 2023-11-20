<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;
use PDF;

class DataTableCrudController extends Controller
{
    public function index()
    {
        if (\request()->ajax()) {
            $data = Todo::where('is_active', '!=', 0)->latest()->get();

            return datatables()->of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $editLink = route('todos.edit', $row->id);
                    $deleteLink = route('deleteTodo', $row->id);
                    $pdfLink = route('downloadPDF', $row->id);

                    $actionBtn = '<a class="btn btn-info" href="' . $editLink . '">Edit</a> <a class="btn btn-primary" href="' . $deleteLink . '">Delete</a> <a class="btn btn-success" href="' . $pdfLink . '">Download PDF</a>';

                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('todos.index');
    }

    public function create()
    {
        return view('todos.add');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
        ]);

        $todo = new Todo([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'date' => $request->input('date'),

            'time' => $request->input('time'),

        ]);

        $todo->save();

        return response()->json(['success' => 'Todo created successfully']);
    }

    public function edit(Todo $todo)
    {
        return view('todos.edit', compact('todo'));
    }

    public function updateTodo(Request $request, Todo $todo)
    {
        // dd($request->all());
        $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);

        $todo->update([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'date' => $request->input('date'),
            'time' => $request->input('time'),
        ]);

        return response()->json(['success' => 'Todo updated successfully']);
    }
    public function destroy($id)
    {
        Todo::find($id)->delete();
        return ['success' => true, 'message' => 'Deleted Successfully'];
    }

    public function deleteTodo($id)
    {
        $is_activeValue = 0;

        Todo::where('id', $id)->update(['is_active' => $is_activeValue]);

        return response()->json(['success' => true, 'message' => 'Deleted Successfully']);
    }

    public function downloadPDF($id)
    {
        $todo = Todo::find($id);

        if ($todo) {
            $pdf = PDF::loadView('todos.pdf', compact('todo'));
            return $pdf->download('todo-details.pdf');
        } else {
            return redirect()->route('todos.index')->with('error', 'Record not found.');
        }
    }

    public function show($id)
    {
        // Retrieve data from the database
        $data = Todo::where('is_active', '!=', 0)->latest()->get();
        // Share data to the view
        view()->share('todos', $data);

        // Generate the PDF
        $pdf = PDF::loadView('todos.list', compact('data'));

        // Return the PDF for download
        return $pdf->download('datatable_data.pdf');

    }

    public function createPDF()
    {
        // Retrieve data from the database
        $data = Todo::all();

        // Share data to the view
        view()->share('todos', $data);

        // Generate the PDF
        $pdf = PDF::loadView('pdf_view', compact('data'));

        // Return the PDF for download
        return $pdf->download('datatable_data.pdf');
    }

}
