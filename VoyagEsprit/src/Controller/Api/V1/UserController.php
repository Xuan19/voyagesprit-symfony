<?php

namespace App\Controller\Api\V1;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserController extends AbstractController
{
    #[Route('/api/v1/public/register', name: 'api_v1_register',methods:['POST'])]
    public function addUser(Request $request,SerializerInterface $serializer,UserPasswordEncoderInterface $passwordEncoder): Response
    {
        $jsonData=json_decode($request->getContent());

        $user=new User();

        $user->setEmail($jsonData->email);
        $user->setFirstName($jsonData->firstName);
        $user->setLastName($jsonData->lastName);
        $user->setPassword($passwordEncoder->encodePassword($user,$jsonData->password));

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

    #[Route('/api/v1/profile', name: 'api_v1_profile', methods:['GET'])]
    public function readUser(): Response
    {
        //  dd($this->getUser());
        return $this->json(
            $this->getUser(),
            200,
            [],
            ['groups' => 'api_v1_profile']
        );
    }

    #[Route('/api/v1/profile', name: 'api_v1_profile_edit', methods:['POST'])]
    public function editUser(Request $request,SerializerInterface $serializer): Response
    {
        $jsonData=json_decode($request->getContent());

        $user=$this->getUser();

        $date= new \DateTime($jsonData->birthday);

        $user->setEmail($jsonData->email);
        $user->setFirstName($jsonData->firstName);
        $user->setLastName($jsonData->lastName);
        $user->setPhoneNumber($jsonData->phoneNumber);
        $user->setBirthday($date);

        $em=$this->getDoctrine()->getManager();
        $em->flush();

        return $this->json(
            $this->getUser(),
            200,
            [],
            ['groups' => 'api_v1_profile']
        );}
}
