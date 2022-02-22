<?php

namespace App\DataFixtures\Providers;

class ListTravelImages
{
    public function getImages()
    {
        $list = [];

        $photoDir = dirname(__DIR__ ,3) . "/public/assets/images/";

        $images = glob($photoDir . '/*');

        foreach ($images as $image) {
            $list[] = explode($photoDir . '/', $image)[1];
        };

        return $list;
    }
}
