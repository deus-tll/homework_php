<?php

namespace App\Services\Photos;

use App\Models\Photo\PhotoTag;
use App\Services\Interfaces\EntityServiceInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class PhotoTagService  implements EntityServiceInterface
{

    function index(int $page, int $per_page): LengthAwarePaginator
    {
        return PhotoTag::with('photos')->paginate($per_page, ['*'], 'page', $page);
    }

    function show(int $id): Model
    {
        return PhotoTag::query()->with('photos')->findOrFail($id);
    }

    function store(Request $request): Model
    {
        $tag = new PhotoTag($request->all());
        $tag->save();

        return $tag;
    }

    public function update(Request $request, int $id): bool
    {
        $tag = PhotoTag::query()->findOrFail($id);

        return $tag->update($request->all());
    }

    public function destroy(int $id): void
    {
        $tag = PhotoTag::query()->findOrFail($id);
        $tag->delete();
    }
}
