<?php

namespace App\Http\Controllers;

use App\Http\Requests\TodoStorePostRequest;
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

    public function store(TodoStorePostRequest $request): JsonResponse
    {

        $validatedData = $request->validated();

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
