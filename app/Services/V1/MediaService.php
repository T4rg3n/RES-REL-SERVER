<?php

namespace App\Services\V1;

use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class MediaService
{
    protected $thumbnailSize = 125;

    /**
     * Resize image or video to a given quality in percent
     * 
     * @param int $quality
     * @param string $typePj
     * @param string $path
     */
    public function resize($quality, $typePj, $path)
    {
        if ($typePj == 'IMAGE') {
            $img = Image::make($path);
            $width = $img->width() * ($quality / 100);
            $height = $img->height() * ($quality / 100);
            $img->resize($width, $height);
            $img->encode('jpg', $quality); // Adjust the format as needed
            $path = tempnam(sys_get_temp_dir(), 'image') . '.jpg';
            $img->save($path);

            return $path;
        } else {
            return $path;
        }
        // if ($typePj == 'VIDEO') {
        //     $ffmpeg = FFMpeg::create();
        //     $video = $ffmpeg->open($path);
        //     $path = tempnam(sys_get_temp_dir(), 'video') . '.mp4'; // Adjust the format as needed
        //     $video->filters()->resize(new \FFMpeg\Coordinate\Dimension(320, 240))->synchronize(); // Adjust the dimensions as needed
        //     $video->save(new \FFMpeg\Format\Video\X264('libmp3lame', 'libx264'), $path);
        // }
    }

    /**
     * Get thumbnail of image or video
     * 
     * @param string $typePj
     * @param string $path
     */
    public function getThumbnail($typePj, $path)
    {
        if ($typePj == 'IMAGE') {
            $img = Image::make($path);
            $img->resize(null, $this->thumbnailSize, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });

            $thumbPath = tempnam(sys_get_temp_dir(), 'thumb') . '.jpg';
            $img->save($thumbPath);

            return $thumbPath;
        } else {
            return $path;
        }
        // if ($typePj == 'VIDEO') {
        //     $ffmpeg = FFMpeg::create();
        //     $video = $ffmpeg->open($path);

        //     $path = tempnam(sys_get_temp_dir(), 'video') . '.jpg'; // Adjust the format as needed
        //     $video->frame(\FFMpeg\Coordinate\TimeCode::fromSeconds(10))->save($path);
        // }
        return $path;
    }


    /**
     * Save base64 file
     * 
     * @param Request $request
     * @param int $id
     */
    public function saveBase64File($request, $id)
    {
        $type = $request->input('type_pj');
        $file = $request->input('base64File');

        $filePath = $this->getFilePath($request->input('name'), $type, $id);
        Storage::put('user-files/' . $filePath, $file);
    }

    /**
     * Get file path
     * 
     * @param string $fileName
     * @return string
     */
    public function getFilePath($typePj, $userId, $attachmentId)
    {
        // user-files/1/1_123456789012345.jpg
        $filePath = 'user-files/' . $userId . '/' . $attachmentId . '_' . Str::random(15);
        
        switch($typePj) {
            case 'IMAGE':
                $fileExtension = '.jpg';
                break;
            case 'VIDEO':
                $fileExtension = '.mp4';
                break;
            case 'PDF':
                $fileExtension = '.pdf';
                break;
            default:
                break;
        }

        return $filePath . $fileExtension;
    }
}
