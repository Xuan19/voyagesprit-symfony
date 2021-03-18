<?php

namespace App\Controller\Api\V1;
use App\Entity\Travel;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\TravelRepository;
use Symfony\Component\Serializer\SerializerInterface;


#[Route('/api/v1/public', name: 'api_v1_travel_')]
class TravelController extends AbstractController
{

    #[Route('/travels', name: 'browse', methods:['GET'])]
    public function browse(TravelRepository $travelRepository): Response
    {
        $travels=$travelRepository->getTravelsWithRelations();

        // $arrayTravels=$serializer->normalize($travels,null,['groups'=>'travel_browse']);
        
        // return $this->json($arrayTravels);

        return $this->json(
        $travels,
        200,
        [],
        ['groups' => 'travel_browse']);
    }

    #[Route('/travel/{id}', name: 'read', methods:['GET'])]

    public function read(int $id,TravelRepository $travelRepository,SerializerInterface $serializer): Response
    {
        
        $travel=$travelRepository->getTravelWithRelations($id);


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
