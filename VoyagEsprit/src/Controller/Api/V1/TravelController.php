<?php

namespace App\Controller\Api\V1;

use App\Entity\Travel;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\TravelRepository;
use Symfony\Component\Serializer\SerializerInterface;

#[Route('/api/v1', name: 'api_v1_travel_')]
class TravelController extends AbstractController
{

    #[Route('/travels', name: 'browse', methods:['GET'])]
    public function browse(TravelRepository $travelRepository,SerializerInterface $serializer): Response
    {
        $travels=$travelRepository->findAll();

        $arrayTravels=$serializer->normalize($travels,null,['groups'=>'travel_browse']);
        
        return $this->json($arrayTravels);
    }

    #[Route('/travel/{id}', name: 'read', methods:['GET'])]
    public function read(Travel $travel,SerializerInterface $serializer): Response
    {

        $arrayTravels=$serializer->normalize($travel,null,['groups'=>'travel_browse']);
        
        return $this->json($arrayTravels);
    }

}
