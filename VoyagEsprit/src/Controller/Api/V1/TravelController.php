<?php

namespace App\Controller\Api\V1;

use App\Entity\Travel;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\TravelRepository;
use App\Repository\CategoryRepository;
use App\Repository\CityRepository;
use App\Repository\CountryRepository;
use Symfony\Component\Serializer\SerializerInterface;
use App\ImageOptimizer;
use App\DataFixtures\Providers\ListTravelImages;

#[Route('/api/v1/public', name: 'api_v1_travel_')]
class TravelController extends AbstractController
{

    #[Route('/main_travels_form_info', name: 'travel_browse', methods: ['GET'])]
    public function browseMainFormInfo(
        TravelRepository $travelRepository,
        CategoryRepository $categoryRepository,
        CityRepository $cityRepository,
        ImageOptimizer $imageOptimizer,
        string $photoDir,
    ): Response {
        $listCategories = $categoryRepository->getCategoriesName();
        $listDestinations = $cityRepository->getCitiesWithCountry();
        $formInfo = ['categories' => $listCategories, 'destinations' => $listDestinations];

        $travels = $travelRepository->getMainTravels();

        $travelInfo = ['mainTravels' => $travels, 'formInfo' => $formInfo];

        foreach ($travels as $t) {
            foreach ($t->getImage() as $img)
                $imageOptimizer->resize($photoDir . '/' . $img);
                //$imageOptimizer->resize('C:\Users\User\Desktop\VoyagEsprit-Symfony\VoyagEsprit/public/assets/images/');
        }

        return $this->json(
            $travelInfo,
            200,
            [],
            ['groups' => 'travel_browse']
        );
    }

    #[Route('/travels', name: 'browse_filter', methods: ['POST'])]
    public function browseFilter(
        Request $request,
        SerializerInterface $serializer,
        TravelRepository $travelRepository,
    ): Response {
        $jsonData = json_decode($request->getContent());

        // dd($jsonData);
        $startDate = new \DateTime($jsonData->startDate);
        $destination = $jsonData->destination;
        $category = $jsonData->category;

        $travels = $travelRepository->getTravels($startDate, $destination, $category);

        // $arrayTravels=$serializer->normalize($travels,null,['groups'=>'travel_browse']);

        // return $this->json($arrayTravels);

        return $this->json(
            $travels,
            200,
            [],
            ['groups' => 'travel_browse']
        );
    }

    #[Route('/test', name: 'formInfo', methods: ['GET'])]
    public function getImages(SerializerInterface $serializer, ListTravelImages $listTravelImages)
    {
        // $list=[];

        // $images=glob($photoDir.'/*');

        // foreach($images as $image)
        // {
        //     $list[] = explode($photoDir.'/',$image)[1];
        // };
        // $list1=$serializer->normalize($list,null);
        // return $serializer->serialize($listTravelImages->getImages(),'json'); 
        // return $listTravelImages->getImages($photoDir);
        // $listTravelImages=new ListTravelImages($photoDir);
        // $photoDir="C:\Users\XUAN\Desktop\o'clock\ProjetPerso\VoyagEsprit-Symfony\VoyagEsprit\public\assets\images";

        // return $this->json(
        //     $listTravelImages->getImages(),
        //    );  
        // return $this->json(
        //     $list,
        //    );  
        // $categories = [
        //     'Ski',
        //     'Croisière',
        //     'Circuit',
        //     'Séjour',

        // ];

        // return $categories;

        // $package = new Package(new EmptyVersionStrategy());
        // $photoDir= $package->getBasePath('/');
        // $photoDir= \dirname(__DIR__);

        //     dd($photoDir);
        // return $photoDir;
    }

    #[Route('/travel/{id}', name: 'read', methods: ['GET'])]

    public function read(int $id, TravelRepository $travelRepository, SerializerInterface $serializer): Response
    {

        $travel = $travelRepository->getTravel($id);


        return $this->json(
            $travel,
            200,
            [],
            ['groups' => 'travel_read']
        );

        // return $this->json(
        //     $serializer->normalize(
        //         $travel,
        //         null,
        //         ['groups'=>'travel_read']),
        //        200);

    }
}
