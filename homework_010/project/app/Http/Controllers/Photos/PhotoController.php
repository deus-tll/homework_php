<?php

namespace App\Http\Controllers\Photos;

use App\Http\Controllers\Base\BaseResourceController;
use App\Services\CacheService;
use App\Services\Photos\PhotoService;

class PhotoController extends BaseResourceController
{
    public function __construct(PhotoService $photoService)
    {
        parent::__construct();
        $this->entityService = new CacheService($photoService,
            'photo_pages', 'photo_id',
            env('CACHE_PHOTO_ALL_TTL', 30), env('CACHE_PHOTO_ID', 30));
    }
}
