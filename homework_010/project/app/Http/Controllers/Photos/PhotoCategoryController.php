<?php

namespace App\Http\Controllers\Photos;

use App\Http\Controllers\Base\BaseResourceController;
use App\Services\CacheService;
use App\Services\Photos\PhotoCategoryService;

class PhotoCategoryController  extends BaseResourceController
{
    public function __construct(PhotoCategoryService $photoService)
    {
        parent::__construct();
        $this->entityService = new CacheService($photoService,
            'photo_category_pages', 'photo_category_id',
            env('CACHE_PHOTO_CATEGORY_ALL_TTL', 30), env('CACHE_PHOTO_CATEGORY_ID', 30));
    }
}
