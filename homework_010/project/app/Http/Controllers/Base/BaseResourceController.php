<?php

namespace App\Http\Controllers\Base;

use App\Http\Controllers\Controller;
use App\Services\Interfaces\EntityServiceInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class BaseResourceController extends Controller
{
    protected function __construct(){}

    protected EntityServiceInterface $entityService;

    public function index(Request $request): LengthAwarePaginator
    {
        $per_page = $request->input('per_page', 10);
        $page = $request->input('page', 1);
        return $this->entityService->index($page, $per_page);
    }

    public function show(int $id): Model
    {
        return $this->entityService->show($id);
    }

    public function store(Request $request): Model
    {
        return $this->entityService->store($request);
    }

    public function update(Request $request, int $id): bool
    {
        return $this->entityService->update($request, $id);
    }

    public function destroy(int $id): JsonResponse
    {
        $this->entityService->destroy($id);
        return response()->json([], 204);
    }
}
