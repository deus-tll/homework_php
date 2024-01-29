<?php

namespace App\Services;

use App\Services\Interfaces\EntityServiceInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Cache;

class CacheService implements EntityServiceInterface
{
    /**
     * Creating caching decorator
     * Gets service for work with entity and names for cache
     * @param EntityServiceInterface $entityService
     * @param string $cachePrefixMany
     * @param string $cachePrefixById
     * @param int $cacheManyTTL
     * @param int $cacheByIdTTL
     */
    public function __construct(
        private readonly EntityServiceInterface $entityService,
        private readonly string                 $cachePrefixMany,
        private readonly string                 $cachePrefixById,
        private readonly int                    $cacheManyTTL = 30,
        private readonly int                    $cacheByIdTTL = 30
    )
    {
    }

    function index(int $page, int $per_page): LengthAwarePaginator
    {
        return Cache::remember($this->cachePrefixMany . '_' . $page . 'per_page' . $per_page,
            $this->cacheManyTTL,
            function () use ($per_page, $page) {
                return $this->entityService->index($page, $per_page);
            });
    }

    function show(int $id): Model
    {
        return Cache::remember($this->cachePrefixById . '_' . $id,
            $this->cacheByIdTTL,
            function () use ($id) {
                return $this->entityService->show($id);
            });
    }

    function store(Request $request): Model
    {
        return $this->entityService->store($request);
    }

    public function update(Request $request, int $id): bool
    {
        Cache::forget($this->cachePrefixById . $id);
        return $this->entityService->update($request, $id);
    }

    public function destroy(int $id): void
    {
        Cache::forget($this->cachePrefixById . $id);
        $this->entityService->destroy($id);
    }
}
