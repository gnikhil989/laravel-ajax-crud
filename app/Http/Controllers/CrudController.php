<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo;
use Response;

class CrudController extends Controller
{
    public function index()
    {
        $todo = Todo::all();
        return view('home')->with(compact('todo'));
    }
    /**
     * Store a newly created resource in storage.
     *
     */


     public function edit($id)
{
    $todo = Todo::find($id);
    dd($id, $todo); // Add these lines for debugging
    return view('edit')->with(compact('todo'));
}

 
     public function update(Request $request, $id)
     {
         $data = $request->validate([
             'title' => 'required|max:255',
             'description' => 'required'
         ]);
 
         $todo = Todo::find($id);
         if ($todo) {
             $todo->update($data);
         }
 
        //  return redirect('/')->with('success', 'Todo updated successfully');
        return Response::json($todo);

     }
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required'
        ]);
        $todo = Todo::create($data);
        return Response::json($todo);
   }
   public function destroy($id)
{
    // Delete the record with the given ID
    Todo::destroy($id);

    return response()->json(['message' => 'Todo deleted successfully']);
}

   

}
