<?php

namespace App\Http\Controllers\Photos;

use App\Http\Controllers\Base\BaseResourceController;
use App\Services\CacheService;
use App\Services\Photos\PhotoTagService;

class PhotoTagController extends BaseResourceController
{
    public function __construct(PhotoTagService $photoService)
    {
        parent::__construct();
        $this->entityService = new CacheService($photoService,
            'photo_tag_pages', 'photo_tag_id',
            env('CACHE_PHOTO_TAG_ALL_TTL', 30), env('CACHE_PHOTO_TAG_ID', 30));
    }
}
