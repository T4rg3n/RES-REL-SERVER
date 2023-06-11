<?php

namespace App\Services\V1;

use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\Utilisateur;

class MediaService
{
    protected $thumbnailSize = 125;

    /**
     * Resize an image to a given quality in percent
     * 
     * @param int $quality
     * @param string $typePj
     * @param string $path
     * @return string Resized image or video path
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
    }

    /**
     * Get thumbnail of image or video
     * 
     * @param string $typePj
     * @param string $path
     * @return string Thumbnail path
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
    }

    /**
     * Save file (binary encoded)
     * 
     * @param Request $request
     * @param int $id
     * @return string File path
     */
    public function saveFile($request, $id)
    {
        $file = $request->file('file');
        $filePath = $this->getFilePath($file, $request->input('type'), $request->input('idUtilisateur'), $id);

        Storage::put($filePath . '.' . $file->extension(), file_get_contents($file));
    }

    /**
     * Get file path
     * 
     * @param string $encodedFile
     * @param string $typePj
     * @param int $userId
     * @param int $attachmentId
     * @return string File path
     */
    private function getFilePath($encodedFile, $typePj, $userId, $attachmentId)
    {
        //user_files/1/1_123456789012345.jpg
        $filePath = 'user_files/' . $userId . '/' . $typePj . '/' . $attachmentId . '_' . Str::random(15);

        return $filePath;
    }

    /**
     * Save profile picture
     * 
     * @param Request $request
     * @param int $id
     * @return string File name
     */
    public function saveProfilePicture($request, $id)
    {
        $file = $request->file('photoProfil');
        $fileExtension = $file->getClientOriginalExtension();
        $filePath = 'user_profiles/' . $id . '/profile_picture.' . $fileExtension;

        Storage::disk('public')->put($filePath, file_get_contents($file));
        return "profile_picture." . $fileExtension;
    }

    /**
     * Get profile picture path
     * 
     * @param int $id
     * @param bool $default (optional)
     * @return string File path
     */
    public function getProfilePicturePath($id, $default = false)
    {
        if ($default) {
            $filePath = Storage::disk('public')->path('default/default-profile-picture.png');
            return $filePath;
        }

        $utilisateur = Utilisateur::findOrFail($id);
        $filePath = Storage::disk('public')->path('user_profiles/' . $id . '/' . $utilisateur->photo_uti);
        return $filePath;
    }
}
