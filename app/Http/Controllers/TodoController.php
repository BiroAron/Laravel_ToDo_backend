<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Models\Todo;

class TodoController extends Controller
{

    public function index() : JsonResponse
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
