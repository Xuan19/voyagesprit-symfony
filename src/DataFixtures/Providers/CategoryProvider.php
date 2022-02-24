<?php

namespace App\DataFixtures\Providers;

use Faker\Provider\Base as BaseProvider;

class CategoryProvider extends BaseProvider
{
    protected static $categories = [
        'Ski',
        'Croisière',
        'Circuit',
        'Séjour',
   
    ];

    public static function category()
    {
        return static::randomElement(static::$categories);
    }
}
