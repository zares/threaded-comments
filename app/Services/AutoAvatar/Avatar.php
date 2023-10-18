<?php

namespace App\Services\AutoAvatar;

use Illuminate\Support\Facades\Storage;
use App\Services\AutoAvatar\Lib\Multiavatar;

class Avatar
{
    /**
     * Get avatar url with multicultural avatar generator.
     * @param  string  $email Email address
     * @return string         Url string
     */
    public static function make(string $email): string
    {
        $basename = md5($email);
        $filename = $basename .'.svg';
        $subpath  = 'public/avatars/'. $filename;

        if (Storage::disk('local')->missing($subpath)) {
            $multiavatar = new Multiavatar();
            $avatar = $multiavatar($basename, null, null);
            Storage::disk('local')->put($subpath, $avatar);
        }

        return url('storage/avatars/'. $filename);
    }

}
