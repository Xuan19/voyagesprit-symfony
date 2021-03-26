<?php

namespace App\DataFixtures;

use App\DataFixtures\Providers\CategoryProvider;
use App\DataFixtures\Providers\TravelImageProvider;
use Faker\Factory;
use Faker\Generator;
use Nelmio\Alice\Faker\Provider\AliceProvider;
use Nelmio\Alice\Loader\NativeLoader;
use App\DataFixtures\Providers\ListTravelImages;
use Symfony\Component\Asset\Package;
use Symfony\Component\Asset\VersionStrategy\EmptyVersionStrategy;


class VoyagEspritNativeLoader extends NativeLoader
{
    /**
     * Comme on étend une classe existante, on peut écraser ces méthodes avec les notres
     * Il faut s'assurer que cette méthode retourne le même type d'objet
     * D'origine, createFakerGenerator fournit un objet de la classe Faker\Generator
     */

    protected function createFakerGenerator(): Generator
    {
        // Comme on crée le generateur nous même, on peut choisir la langue !
        $generator = Factory::create('fr_FR');

        // On a créé un générateur ordinaire de Faker, mais il faut lui ajouter le provider de Alice
        $generator->addProvider(new AliceProvider());
      
        $listTravelImages=new ListTravelImages();
        // On ajoute ensuite notre propre provider
        $generator->addProvider(new CategoryProvider($generator));
        $generator->addProvider(new TravelImageProvider($generator,$listTravelImages));

        return $generator;
    }
}