<?php

namespace App\Http\Controllers;

use App\Http\Requests\TodoStorePostRequest;
use App\Http\Requests\TodoUpdatePutRequest;
use Illuminate\Http\JsonResponse;
use App\Models\Todo;
use App\Http\Resources\TodoResource;
use Spatie\QueryBuilder\QueryBuilder;

class TodoController extends Controller
{

    public function index(): JsonResponse
    {
        $todos = QueryBuilder::for(Todo::class)
            ->allowedSorts([
                'title',
                'description',
                'priority',
                'due_date',
            ])
            ->allowedFilters([
                'title',
                'description',
            ])->get();

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

    public function updateIsChecked(Todo $todo): JsonResponse
    {
        $todo->update(['is_checked' => !$todo->is_checked]);

        return response()->json(new TodoResource($todo));
    }

}
