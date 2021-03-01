<?php

namespace App\Controller\Api\V1;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\TravelRepository;
use Symfony\Component\Serializer\SerializerInterface;

#[Route('/api/v1/travels', name: 'api_v1_travel_')]
class TravelController extends AbstractController
{

    #[Route('/', name: 'browse', methods:['GET'])]
    public function browse(TravelRepository $travelRepository,SerializerInterface $serializer): Response
    {
        $travels=$travelRepository->findAll();

        $arrayTravels=$serializer->normalize($travels,null,['groups'=>'travel_browse']);
        
        /*return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/Api/V1/TravelController.php',
        ]);*/

        return $this->json($arrayTravels);
    }
}
