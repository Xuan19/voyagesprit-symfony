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


#[Route('/api/v1/public', name: 'api_v1_travel_')]
class TravelController extends AbstractController
{

    #[Route('/main_travels_form_info', name: 'travel_browse', methods:['GET'])]
    public function browseMainFormInfo(
        TravelRepository $travelRepository,
        CategoryRepository $categoryRepository,
        CityRepository $cityRepository,
        ): Response
    {
       $listCategories=$categoryRepository->getCategoriesName();
       $listDestinations=$cityRepository->getCitiesWithCountry();
       $formInfo=['categories'=>$listCategories,'destinations'=>$listDestinations];
        
        $travels=$travelRepository->getMainTravels();

        $travelInfo=['mainTravels'=>$travels,'formInfo'=>$formInfo];

        return $this->json(
        $travelInfo,
        200,
        [],
        ['groups' => 'travel_browse']);
    }

    #[Route('/travels', name: 'browse_filter', methods:['POST'])]
    public function browseFilter(
        Request $request,
        SerializerInterface $serializer,
        TravelRepository $travelRepository,
        ): Response
    {
        $jsonData=json_decode($request->getContent());

        // dd($jsonData);
        $startDate=new \DateTime($jsonData->startDate);
        $destination=$jsonData->destination;
        $category=$jsonData->category;
        
        $travels=$travelRepository->getTravels($startDate,$destination,$category);

        // $arrayTravels=$serializer->normalize($travels,null,['groups'=>'travel_browse']);
        
        // return $this->json($arrayTravels);

        return $this->json(
        $travels,
        200,
        [],
        ['groups' => 'travel_browse']);
    }

    // #[Route('/form_info', name: 'formInfo', methods:['GET'])]
    // public function formInfo(CategoryRepository $categoryRepository,CityRepository $cityRepository): Response
    // {
    //    $listCategories=$categoryRepository->getCategoriesName();
    //    $listDestinations=$cityRepository->getCitiesWithCountry();
    // //    dd($listDestinations);
    // //    dd($listCategories);
    //     $formInfo=['categories'=>$listCategories,'destinations'=>$listDestinations];

    //     return $this->json(
    //     $formInfo,
    //     200,
    //     );
    // }

    #[Route('/travel/{id}', name: 'read', methods:['GET'])]

    public function read(int $id,TravelRepository $travelRepository,SerializerInterface $serializer): Response
    {
        
        $travel=$travelRepository->getTravel($id);


        return $this->json(
            $travel,
            200,
            [],
            ['groups' => 'travel_read']);

            // return $this->json(
            //     $serializer->normalize(
            //         $travel,
            //         null,
            //         ['groups'=>'travel_read']),
            //        200);

    }

}
