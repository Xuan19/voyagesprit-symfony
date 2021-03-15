<?php

namespace App\Controller\Api\V1;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Component\Serializer\SerializerInterface;

class UserController extends AbstractController
{
    #[Route('/api/v1/register', name: 'api_v1_register',methods:['POST'])]
    public function index(Request $request,SerializerInterface $serializer): Response
    {
        $jsonData=json_decode($request->getContent());

        $user=new User();

        $user->setEmail($jsonData->email);
        $user->setFirstName($jsonData->firstName);
        $user->setLastName($jsonData->lastName);
        $user->setPassword($jsonData->password);

        $em=$this->getDoctrine()->getManager();
        $em->persist($user);
        $em->flush();

        return $this->json(  
            $serializer->normalize(
                $user,
                null,
                ['groups'=>'api_v1_register']),
               201);
    }
}
