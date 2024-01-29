<?php

namespace App\Http\Controllers\Old_Photo_Controllers;

use App\Http\Controllers\Controller;

use App\Http\Requests\Photo\StorePhotoTagRequest;
use App\Http\Requests\Photo\UpdatePhotoTagRequest;
use App\Models\Photo\PhotoTag;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;

class PhotoTagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Collection
    {
        return PhotoTag::with('photos')->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePhotoTagRequest $request): PhotoTag|JsonResponse
    {
        try {
            $tag = new PhotoTag($request->all());
            $tag->save();

            return $tag;
        }
        catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id): Model|Collection|Builder|JsonResponse|array|null
    {
        try {
            return PhotoTag::query()->with('photos')->findOrFail($id);
        }
        catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Tag not found.', 'error' => $e->getMessage()], 404);
        }
        catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePhotoTagRequest $request, int $id): Model|Collection|Builder|JsonResponse|array|null
    {
        try {
            $tag = PhotoTag::query()->findOrFail($id);
            $tag->update($request->all());

            return $tag;
        }
        catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Tag not found.', 'error' => $e->getMessage()], 404);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id): JsonResponse
    {
        try {
            $tag = PhotoTag::query()->findOrFail($id);
            $tag->delete();

            return response()->json(['message' => "Tag deleted successfully."]);
        }
        catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Tag not found.', 'error' => $e->getMessage()], 404);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
