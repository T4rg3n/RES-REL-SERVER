<?php
namespace App\Services\V1;

use Intervention\Image\Facades\Image;

class MediaService
{
    protected $thumbnailSize = 125;

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

}
    