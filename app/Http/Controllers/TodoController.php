<?php

namespace App\Http\Controllers;

use App\Http\Requests\TodoStorePostRequest;
use App\Http\Requests\TodoUpdatePutRequest;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Models\Todo;
use App\Http\Resources\TodoResource;

class TodoController extends Controller
{

    public function index(): JsonResponse
    {
        $todos = Todo::all();
        return response()->json(TodoResource::collection($todos));
    }

    public function store(TodoStorePostRequest $request): JsonResponse
    {
        $validatedData = $request->validated();

        $newItem = new Todo;
        $newItem->fill($validatedData);
        $newItem->save();

        $newItem = $newItem->refresh();

        return response()->json(new TodoResource($newItem), 201);
    }

    public function show(string $todo)
    {

    }

    public function update(TodoUpdatePutRequest $request, Todo $todo): JsonResponse
    {
        $validatedData = $request->validated();
        $todo->update($validatedData);

        return response()->json(new TodoResource($todo));
    }


    public function destroy(Todo $todo): JsonResponse
    {
        $todo->delete();
        return response()->json(['message' => 'Todo element deleted successfully']);
    }

}
