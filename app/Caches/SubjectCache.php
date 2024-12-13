<?php

namespace App\Caches;

use App\Models\Subject;
use Illuminate\Support\Facades\Cache;

class SubjectCache
{
    public static function get()
    {
        return Cache::remember(self::getKey(), 3600, function () {
            return Subject::paginate();
        });
    }

    public static function getKey(){
        return 'subjects';
    }

    public static function invalidate(){
        Cache::forget(self::getKey());
    }
}