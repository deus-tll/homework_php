<?php

namespace App\Http\Controllers\Photo;

use App\Http\Controllers\Controller;
use App\Http\Requests\Photo\StorePhotoRequest;
use App\Http\Requests\Photo\UpdatePhotoRequest;
use App\Jobs\Photo\OptimizeUploadPhotoJob;
use App\Models\Photo\Photo;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class PhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Collection|array
    {
        return Photo::with('category', 'tags')->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePhotoRequest $request): string|Photo
    {
        try {
            $photo = $request->getModelFromRequest();

            $userId = $request->user()->id;
            $photo->user()->associate($userId);
            $photo->save();

            $file = $request->file('photo');
            $extension = $file->getClientOriginalExtension();
            $filename = $photo->id . '.original.' . $extension;
            $filePath = $file->storeAs('user_id_' . $userId . '/photo_id_' . $photo->id, $filename);
            $fileUrl = url(Storage::url($filePath));
            $photo->url = $fileUrl;

            $photo->category()->associate($request->input('category_id'));
            $photo->save();

            if ($request->has('tags')) {
                $photo->tags()->attach($request->input('tags'));
            }

            try {
                $photo->save();
                OptimizeUploadPhotoJob::dispatch($photo->id);
            } catch (\Exception $e) {
                Log::error(__CLASS__ . '::' . __METHOD__, (array)$e->getMessage());
            }

            return $photo;
        }
        catch (Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id): Model|Collection|Builder|JsonResponse|array|null
    {
        try {
            return Photo::query()->with('category', 'tags')->findOrFail($id);
        }
        catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Photos not found.', 'error' => $e->getMessage()], 404);
        }
        catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePhotoRequest $request, int $id): Model|Collection|Builder|JsonResponse|array|null
    {
        try {
            $photo = Photo::query()->findOrFail($id);

            $photo->fill($request->except(['photo', 'category_id', 'tags']));

            if ($request->has('category_id')) {
                $photo->category()->associate($request->input('category_id'));
            }

            if ($request->has('tags')) {
                $photo->tags()->sync($request->input('tags'));
            }

            if ($request->hasFile('photo')) {
                $file = $request->file('photo');
                $filename = time() . '_' . $file->getClientOriginalName();

                $filePath = $file->storeAs('public/photos', $filename);
                $fileUrl = url(Storage::url($filePath));

                $photo->url = $fileUrl;
            }

            $photo->save();

            return $photo;
        }
        catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Photos not found.', 'error' => $e->getMessage()], 404);
        }
        catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id): JsonResponse
    {
        try {
            DB::beginTransaction();

            $photo = Photo::query()->findOrFail($id);
            $photo->delete();

            DB::commit();

            return response()->json(['message' => 'Photos deleted successfully.']);
        }
        catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Photos not found.', 'error' => $e->getMessage()], 404);
        }
        catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
