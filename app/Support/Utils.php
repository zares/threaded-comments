<?php

namespace App\Support;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;

class Utils
{
    /**
     * Get ulid token.
     * @param int $id
     */
    public static function getToken(int $id): string
    {
        $token = (string) Str::ulid();
        Session::put("entry_token_{$id}", $token);

        return $token;
    }

    /**
     * Verify ulid token.
     * @param  int    $id
     * @param  string $token
     * @return boolean
     */
    public static function verifyToken(int $id, string $token)
    {
        $key = "entry_token_{$id}";

        if (($entryToken = Session::get($key))
            && $token == $entryToken) {
                return true;
        }

        return false;
    }

}
