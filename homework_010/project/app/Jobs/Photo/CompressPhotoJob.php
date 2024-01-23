<?php

namespace App\Jobs\Photo;

use App\Models\Photo\Photo;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Imagick\Driver;

class CompressPhotoJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected int $photoId;
    protected string $originalFilePath;

    /**
     * Create a new job instance.
     *
     * @param int $photoId
     * @param string $originalFilePath
     */
    public function __construct(int $photoId, string $originalFilePath)
    {
        $this->photoId = $photoId;
        $this->originalFilePath = $originalFilePath;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(): void
    {
        $compressedFilePath = $this->getCompressedFilePath($this->originalFilePath);

        $this->compressImage($this->originalFilePath, $compressedFilePath);

        $this->updatePhotoModel($compressedFilePath);
    }

    /**
     * Generate the path for the compressed version of the photo.
     *
     * @param string $originalFilePath
     * @return string
     */
    protected function getCompressedFilePath(string $originalFilePath): string
    {
        $pathInfo = pathinfo($originalFilePath);
        $compressedFileName = $pathInfo['filename'] . '_compressed.' . $pathInfo['extension'];

        return 'public/photos/compressed/' .$compressedFileName;
    }

    /**
     * Compress the image using Intervention Image.
     *
     * @param string $originalFilePath
     * @param string $compressedFilePath
     * @return void
     */
    protected function compressImage(string $originalFilePath, string $compressedFilePath): void
    {
        $manager = new ImageManager(new Driver());
        $quality = 80;

        $image = $manager->read(storage_path('app/' . $originalFilePath));
        $image->scale(height: 300);

        $image->save(storage_path('app/' . $compressedFilePath), $quality);
    }

    /**
     * Update the photo model with the compressed file path.
     *
     * @param string $compressedFilePath
     * @return void
     */
    protected function updatePhotoModel(string $compressedFilePath): void
    {
        $photo = Photo::query()->findOrFail($this->photoId);

        $photo->compressed_url = url(Storage::url($compressedFilePath));

        $photo->save();
    }
}
