<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Models\Todo;

class TodoController extends Controller
{

    public function index(): JsonResponse
    {
        $todos = Todo::all();
        return response()->json($todos);
    }

    public function store(Request $request): JsonResponse
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'user_id' => 'required|integer',
            'priority' => 'string|in:Low,Medium,High',
            'description' => 'string',
            'is_checked' => 'boolean',
            'due_date' => 'date',
        ]);

        $newItem = new Todo;
        $newItem->fill($validatedData);
        $newItem->save();

        return response()->json($newItem, 201);
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
