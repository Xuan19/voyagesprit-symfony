<?php
namespace App\DataFixtures\Providers;

class ListTravelImages 
{    
   public function getImages()
    {
        $list=[];

        $photoDir="C:\Users\XUAN\Desktop\o'clock\ProjetPerso\VoyagEsprit-Symfony\VoyagEsprit\public\assets\images";

        $images=glob($photoDir.'/*');
    
        foreach($images as $image)
        {
            $list[] = explode($photoDir.'/',$image)[1];
        };

        return $list;
    }
}
