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
        $encodedFile = $request->input('base64File');
        $cleanBase64 = preg_replace('#^data:image/[^;]+;base64,#', '', $encodedFile);
        $decodedFile = base64_decode($cleanBase64);

        $filePath = $this->getFilePath($encodedFile, $request->input('type'), $request->input('idUtilisateur'), $id);
        Storage::put($filePath, $decodedFile);
    }

    /**
     * Save file (binary encoded)
     * 
     * @param Request $request
     * @param int $id
     */
    public function saveFile($request, $id)
    {
        $file = $request->file('file');
        $filePath = $this->getFilePath($file, $request->input('type'), $request->input('idUtilisateur'), $id);
        
        Storage::put($filePath, file_get_contents($file));
    }

    /**
     * Get file path
     * 
     * @param string $fileName
     * @return string
     */
    public function getFilePath($encodedFile, $typePj, $userId, $attachmentId)
    {
        //user_files/1/1_123456789012345.jpg
        $filePath = 'user_files/' . $userId . '/' . $typePj . '/' . $attachmentId . '_' . Str::random(15);
        $fileExtension = explode('/', explode(':', substr($encodedFile, 0, strpos($encodedFile, ';')))[1])[1];

        return $filePath . '.' . $fileExtension;
    }

    /**
     * Save base64 profile picture
     * 
     * @param Request $request
     * @param int $id
     */
    public function saveBase64ProfilePicture($request, $id)
    {
        $encodedFile = $request->input('photoProfilBase64');
        $fileExtension = explode('/', explode(':', substr($encodedFile, 0, strpos($encodedFile, ';')))[1])[1];
        $cleanBase64 = preg_replace('#^data:image/[^;]+;base64,#', '', $encodedFile);
        $decodedFile = base64_decode($cleanBase64);

        //Storage::put('user-profiles/' . $id . '/profile_picture' . $fileExtension, $decodedFile);
        //save to public folder
        Storage::disk('public')->put('user_profiles/' . $id . '/profile_picture' . $fileExtension, $decodedFile);
    }

    /**
     * Save profile picture
     * 
     * @param Request $request
     * @param int $id
     */
    public function saveProfilePicture($request, $id)
    {
        $file = $request->file('photoProfil');
        $fileExtension = $file->getClientOriginalExtension();
        $filePath = 'user_profiles/' . $id . '/profile_picture.' . $fileExtension;

        //Storage::put($filePath, file_get_contents($file));
        Storage::disk('public')->put($filePath, file_get_contents($file));
    }
}
