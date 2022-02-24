<?php

namespace App\DataFixtures;

use App\DataFixtures\VoyagEspritNativeLoader;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
//use Faker;


class AppFixtures extends Fixture
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $em)
    {
        $loader = new VoyagEspritNativeLoader();

        $entities = $loader->loadFile(__DIR__ . '/fixtures.yaml')->getObjects();

        //empile la liste d'objet à enregistrer en BDD
        foreach ($entities as $entity) {

            // On encode le mot de passe que si on a affaire à un People
            if ($entity instanceof User) {

                $entity->setPassword($this->passwordEncoder->encodePassword($entity,'Travel'));

                //$encodedPassword = $this->passwordEncoder->encodePassword($entity, 'Travel');
                //$entity->setPassword($encodedPassword);
            }

            $em->persist($entity);
        };

        $em->flush();
    }
}
