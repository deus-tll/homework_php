<?php

namespace App\Services\Photos;

use App\Models\Photo\Photo;
use App\Services\Interfaces\JobServiceInterface;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Imagick\Driver;

class OptimizeUploadPhotoService implements JobServiceInterface
{
    public function __construct(private readonly int $photo_id){}

    public function handle(): void
    {
        try {
            $photo = Photo::query()->find($this->photo_id);
            $quality = 80;

            $fileDir = '/user_id_' . $photo->user_id . '/photo_id_' . $photo->id  . '/';

            $fileContent = Storage::get($fileDir . $photo->id . '.original.jpg');
            $manager = new ImageManager(new Driver());
            $image = $manager->read($fileContent);

            $image->scale(200);

            $fileThumbPath = $fileDir . $photo->id . '.thumb.webp';
            Storage::put($fileThumbPath, $image->toWebp($quality));

            $photo->thumb_url = url(Storage::url($fileThumbPath));
            $photo->save();
        }
        catch (\Exception $e)
        {
            Log::error(__CLASS__ . '::' . __METHOD__, (array)$e->getMessage());
        }
    }
}
