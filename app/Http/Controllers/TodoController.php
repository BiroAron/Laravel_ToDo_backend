<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
USE App\Models\Todo;

class TodoController extends Controller
{

    public function index()
    {
        $todos = Todo::all();
        return response()->json($todos);
    }

    public function store(Request $request)
    {

    }

    public function show(string $todo)
    {

    }

    public function update(Request $request, string $todo)
    {

    }


    public function destroy(string $todo)
    {

    }

}
