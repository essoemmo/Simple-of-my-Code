<?php

namespace App\Services;

use App\Jobs\ProcessUploadedVideo;
use App\Traits\ResponseTrait;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Drivers\Imagick\Driver;
use Intervention\Image\ImageManager;
use Pion\Laravel\ChunkUpload\Handler\HandlerFactory;
use Pion\Laravel\ChunkUpload\Receiver\FileReceiver;

/**
 * To Use This service u must add the following to config/filesustem.php
 *
 *   'public_uploads' => [
 *           'driver' => 'local',
 *           'root' => public_path('uploads'),
 *    ],
 *
 *  And Install  Intervention\Image\Facades\Image Package
 */
class AttachmentService
{
    use ResponseTrait;

    // to upload image with resize
    public static function deleteFile($folder, $file): void
    {
        Storage::disk('public_uploads')->delete('/'.$folder.'/'.$file);
    }

    // to upload image without resize

    public function imageUploaderWithResize(
        UploadedFile $file,
        string $folder = '',
        ?string $oldFile = null,
        int $width = 300,
        int $height = 300
    ): string {
        $storageDisk = Storage::disk('public_uploads');

        // Delete the old file if it exists
        if ($oldFile) {
            $storageDisk->delete($oldFile);
        }

        // Define the upload path
        $path = 'uploads/'.$folder;
        $fileName = $file->hashName();

        // Ensure the directory exists
        if (! file_exists($path)) {
            mkdir($path, 0777, true);
        }

        $manager = new ImageManager(new Driver());
        $image = $manager->imagick()->read($file);
        $image->resize($width, $height);
        $image->save(public_path($path.'/'.$fileName));

        // Return the relative path to the saved image
        return $folder.'/'.$fileName;
    }

    //to delete any file

    public function imageUploaderWithoutResize($file, $folder = '', $oldFile = null): string
    {
        if ($oldFile) {
            Storage::disk('public_uploads')->delete($oldFile);
        }

        $path = 'uploads/'.$folder;
        $fileName = $file->hashName();

        if (! file_exists($path)) {
            mkdir($path, 0777, true);
        }

        $file->storeAs($folder, $fileName, 'public_uploads');

        return $folder.'/'.$fileName;
    }

    // to upload file depend on your validation

    public function fileUploader($file, $folder = '/', $oldFile = null): string
    {
        if ($oldFile) {
            Storage::disk('public_uploads')->delete($oldFile);
        }

        return Storage::disk('public_uploads')->putFile($folder, $file);
    }

    public function videoUploader($file, string $folder = '', ?string $oldFile = null): string
    {
        $path = 'uploads/'.$folder;
        $fileName = $file->hashName();
        $receiver = new FileReceiver('file', $file, HandlerFactory::classFromRequest($file));

        if ($receiver->isUploaded() === false) {
            self::failResponse(500, 'Upload Failed');
        }

        $save = $receiver->receive();

        if ($save->isFinished()) {
            $file = $save->getFile(); // UploadedFile object
            ProcessUploadedVideo::dispatch($file, $path, $fileName);
        }

        return $folder.'/'.$fileName;
    }
}
