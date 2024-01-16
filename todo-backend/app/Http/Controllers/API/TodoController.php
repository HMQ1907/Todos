<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\todo;
use App\Http\Resources\TodoCollection;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    //
    public function index()
    {
        $todos =  todo::all();
        return TodoCollection::collection($todos);
    }
    public function add(Request $request)
    {
        $todo = new todo;
        $todo->content = $request->content;
        $todo->checked = $request->checked;
        $todo->completed = $request->completed; 
        $todo->created_at = now();
        $todo->updated_at = now();
        $todo->save();
        $todos = todo::get();
        return TodoCollection::collection($todos);
    }

    public function delete(Request $request){
        $todo = todo::find($request->id);
        if ($todo) {
            $todo->delete();
            $todos = todo::get();
            return TodoCollection::collection($todos);
        } else {
            return response()->json(['error' => 'Todo not found'], 404);
        }
    }

    public function deleteAll(Request $request) {
        $todoIds = $request->query('id', []);
    
        if (empty($todoIds)) {
            return response()->json(['error' => 'Todo IDs not found in the request'], 400);
        }
    
        foreach ($todoIds as $todoId) {
            $todoModel = todo::find($todoId);
            
            if ($todoModel) {
                $todoModel->delete();
            } else {
                return response()->json(['error' => 'Todo not found'], 404);
            }
        }
    
        $remainingTodos = todo::get();
        return TodoCollection::collection($remainingTodos);
    }
    
}
