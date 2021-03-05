<?php

namespace App\DataFixtures\Providers;

use Faker\Provider\Base as BaseProvider;

class TravelImageProvider extends BaseProvider
{
    protected static $TravelImages = [
        'action-adventure-alps-conifers-238622.jpg',
        'action-adventure-beach-dawn-390051.jpg',
        'action-ball-field-game-274506.jpg',
        'action-daylight-daytime-outdoors-1637451.jpg',
        'adventure-alpine-alps-clouds-544067.jpg',
        'adventure-athlete-athletic-daylight-235922.jpg',
        'aerial-alpine-ceresole-reale-desktop-backgrounds-1562.jpg',
        'aerial-photo-of-seaport-1287216.jpg',
        'aerial-photography-of-city-3016350.jpg',
        'aerial-view-of-a-beach-4253928.jpg',
        'alps-barn-clouds-country-358532.jpg',
        'alps-blue-sky-clouds-countryside-568245.jpg',
        'ball-court-design-game-209977.jpg',
        'bicyclist-passing-the-road-near-the-river-163407.jpg',
        'body-of-water-with-rock-formation-2308893.jpg',
        'brown-houses-beside-mountain-under-blue-sky-1719722.jpg',
        'cityscape-and-body-of-water-during-sunset-3016353.jpg',
        'close-up-photo-of-person-holding-tennis-racket-and-ball-1432039.jpg',
        'clouds-daylight-forest-grass-371589.jpg',
        'clouds-daylight-environment-forest-518485.jpg',
        'curvy-road-in-valley-1536029.jpg',
        'green-fields-near-brown-mountain-210243.jpg',
        'green-grass-field-318414.jpg',
        'green-grass-field-and-trees-under-blue-sky-3996362.jpg',
        'green-mountain-under-blue-sky-1536074.jpg',
        'green-tennis-ball-on-court-1405355.jpg',
        'group-people-hiking-on-hill-1194233.jpg',
        'houses-near-with-sea-with-sailboats-and-lighthouse-during-161098.jpg',
        'kevin-et-laurianne-langlais-0MGo3nl5iF4-unsplash.jpg',
        'landscape-mountains-nature-water-143574.jpg',
        'low-angle-view-of-woman-relaxing-on-beach-against-blue-sky-317157.jpg',
        'man-standing-on-a-rock-1271619.jpg',
        'person-swimming-on-body-of-water-863988.jpg',
        'photo-of-mountain-alps-near-lake-301391.jpg',
        'photo-of-mountain-alps-near-lake-301391.jpg',
        'rope-jumping-ropes-human-training-28080.jpg',
        'scenic-photo-of-lake-across-trees-and-mountains-3146777.jpg',
        'scenic-view-of-lake-in-forest-247600.jpg',
        'scenic-view-of-mountain-1666021.jpg',
        'scenic-view-of-snow-capped-mountains-2774415.jpg',
        'silhouette-of-person-standing-near-camping-tent-2398220.jpg',
        'snow-covered-mountain-during-sunrise-618833.jpg',
        'velo Chamarel.JPG',
        'woman-girl-silhouette-jogger-40751.jpg',
    ];

    public static function travelImage()
    {
        return static::randomElement(static::$TravelImages);
    }
}
