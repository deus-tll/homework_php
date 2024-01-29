<?php

namespace App\Services\Photos;

use App\Jobs\Photo\OptimizeUploadPhotoJob;
use App\Models\Photo\Photo;
use App\Services\Interfaces\EntityServiceInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class PhotoService implements EntityServiceInterface
{

    function index(int $page, int $per_page): LengthAwarePaginator
    {
        return Photo::with('category')->paginate($per_page, ['*'], 'page', $page);
    }

    function show(int $id): Model
    {
        return Photo::query()->with('category', 'tags')->findOrFail($id);
    }

    function store(Request $request): Model
    {
        $photo = new Photo($request->all());

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

    public function update(Request $request, int $id): bool
    {
        $photo = Photo::query()->findOrFail($id);

        $photo->fill($request->except(['photo', 'category_id', 'tags']));

        if ($request->has('category_id')) {
            $photo->category()->associate($request->input('category_id'));
        }

        if ($request->has('tags')) {
            $photo->tags()->sync($request->input('tags'));
        }

        if ($request->hasFile('photo')) {
            $userId = $request->user()->id;
            $file = $request->file('photo');
            $extension = $file->getClientOriginalExtension();
            $filename = $photo->id . '.original.' . $extension;
            $filePath = $file->storeAs('user_id_' . $userId . '/photo_id_' . $photo->id, $filename);
            $fileUrl = url(Storage::url($filePath));
            $photo->url = $fileUrl;
        }

        return $photo->save();
    }

    public function destroy(int $id): void
    {
        DB::beginTransaction();

        $photo = Photo::query()->findOrFail($id);
        $photo->delete();

        DB::commit();
    }
}
