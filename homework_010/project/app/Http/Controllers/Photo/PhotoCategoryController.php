<?php

namespace App\Http\Controllers\Photo;

use App\Http\Controllers\Controller;
use App\Http\Requests\Photo\StorePhotoCategoryRequest;
use App\Http\Requests\Photo\UpdatePhotoCategoryRequest;
use App\Models\Photo\PhotoCategory;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;

class PhotoCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Collection
    {
        return PhotoCategory::with('photos')->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePhotoCategoryRequest $request): JsonResponse|PhotoCategory
    {
        try {
            $category = new PhotoCategory($request->all());
            $category->save();

            return $category;
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id): Model|Collection|Builder|JsonResponse|array|null
    {
        try {
            return PhotoCategory::query()->with('photos')->findOrFail($id);
        }
        catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Category not found.', 'error' => $e->getMessage()], 404);
        }
        catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePhotoCategoryRequest $request, string $id): Model|Collection|Builder|JsonResponse|array|null
    {
        try {
            $category = PhotoCategory::query()->findOrFail($id);
            $category->update($request->all());

            return $category;
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Category not found.', 'error' => $e->getMessage()], 404);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): JsonResponse
    {
        try {
            $category = PhotoCategory::query()->findOrFail($id);
            $category->delete();

            return response()->json(['message' => 'Category deleted successfully.']);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Category not found.', 'error' => $e->getMessage()], 404);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
