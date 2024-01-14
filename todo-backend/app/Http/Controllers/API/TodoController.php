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
}
