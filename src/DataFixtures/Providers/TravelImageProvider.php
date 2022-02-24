<?php
namespace App\DataFixtures\Providers;
use Faker\Provider\Base as BaseProvider;
use App\DataFixtures\Providers\ListTravelImages;
use Faker\Generator;


class TravelImageProvider extends BaseProvider
{    
    protected static $listImages;

    public function __construct(Generator $generator,ListTravelImages $listTravelImages)
    {
        parent::__construct($generator);
        
        static::$listImages = $listTravelImages->getImages();
    }
  
    public static function travelImage()
    {  
        return static::randomElement(static::$listImages);
    }
}
