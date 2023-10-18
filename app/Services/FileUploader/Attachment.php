<?php

namespace App\Services\FileUploader;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use App\Services\FileUploader\Lib\Image;

class Attachment
{
    /**
     * Allowed image mime types.
     * @var array
     */
    private static $imageMimeTypes = [
        'image/jpeg',
        'image/jpg',
        'image/png',
        'image/gif',
    ];

    /**
     * Image store subpath.
     * @var string
     */
    private static $imageStore = 'public/images';

    /**
     * Save uploaded file
     * @param  UploadedFile $file
     * @return array|null
     */
    public static function save(UploadedFile $file)
    {
        // Get file name
        $originalName = $file->getClientOriginalName();
        // Get file extension
        $extension = $file->clientExtension();
        // Get mime type
        $mimeType = $file->getClientMimeType();

        // New file name
        $fileName = md5(uniqid('', true)) .'.'. $extension;

        // If file is image
        if (in_array($mimeType, static::$imageMimeTypes)) {
            $realPath = $file->getRealPath();

            // Check image dimensions and resise if need
            $resized = static::resizeImage($realPath, $fileName);

            // If the resize with saving return error
            if ($resized === null) {
                return;
            }

            // If not need to resize
            if ($resized === false) {
                // Save original
                $file->storePubliclyAs('images', $fileName, 'public');
            }

        // File is a text file
        } elseif ($mimeType == 'text/plain') {
            $file->storePubliclyAs('files', $fileName, 'public');

        // Invalid file type
        } else {
            return;
        }

        return [
            'original_name' => $originalName,
            'file_name'     => $fileName,
        ];
    }

    /**
     * Remove saved file.
     * @param  array  $data
     * @return void
     */
    public static function remove(array $data)
    {
        $fileName = $data['file_name'];

        if (Storage::exists("public/images/{$fileName}")) {
            Storage::delete("public/images/{$fileName}");
        } elseif (Storage::exists("public/files/{$fileName}")) {
            Storage::delete("public/files/{$fileName}");
        }
    }

    /**
     * Resize uploaded image.
     * @param  string $realPath
     * @param  string $fileName
     * @return boolean
     */
    private static function resizeImage(string $realPath, string $fileName)
    {
        // We need to get the image dimensions
        $size = getimagesize($realPath);

        // If the dimension exceed the limit value
        if (($size[0] ?? 0) > 350 || ($size[1] ?? 0) > 250) {
            // Make images directory if not exists
            // ZebraImage will not create a new directory!
            if (! Storage::exists(static::$imageStore)) {
                Storage::makeDirectory(static::$imageStore);
            }

            $image = new Image;

            // Image configuration
            $image->jpeg_quality = 90;
            $image->preserve_time = true;
            $image->preserve_aspect_ratio = true;
            $image->handle_exif_orientation_tag = true;
            $image->source_path = $realPath;
            $filePath = 'app/'. static::$imageStore .'/'. $fileName;
            $image->target_path = storage_path($filePath);

            // Try resizing and saving
            if (! $image->resize(350, 250, IMAGE_NOT_BOXED)) {
                switch ($image->error) {
                    case 1:
                        logger('Source file could not be found');
                        break;
                    case 2:
                        logger('Source file is not readable');
                        break;
                    case 3:
                        logger('Could not write target file');
                        break;
                    case 4:
                        logger('Unsupported source file type');
                        break;
                    case 5:
                        logger('Unsupported target file type');
                        break;
                    case 6:
                        logger('GD library version does not support target file format');
                        break;
                    case 7:
                        logger('GD library is not installed');
                        break;
                    case 8:
                        logger('"chmod" command is disabled via configuration');
                        break;
                    case 9:
                        logger('"exif_read_data" function is not available');
                        break;
                }
                return null;
            }
            return true;
        }
        return false;
    }

}
