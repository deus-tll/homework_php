<?php

namespace App\Services\Photos;

use App\Models\Photo\PhotoCategory;
use App\Services\Interfaces\EntityServiceInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class PhotoCategoryService implements EntityServiceInterface
{

    function index(int $page, int $per_page): LengthAwarePaginator
    {
        return PhotoCategory::with('photos')->paginate($per_page, ['*'], 'page', $page);
    }

    function show(int $id): Model
    {
        return PhotoCategory::query()->with('photos')->findOrFail($id);
    }

    function store(Request $request): Model
    {
        $category = new PhotoCategory($request->all());
        $category->save();

        return $category;
    }

    public function update(Request $request, int $id): bool
    {
        $category = PhotoCategory::query()->findOrFail($id);
        $category->update($request->all());

        return $category->update($request->all());
    }

    public function destroy(int $id): void
    {
        $category = PhotoCategory::query()->findOrFail($id);
        $category->delete();
    }
}
