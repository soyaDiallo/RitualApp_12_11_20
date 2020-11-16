<?php

namespace App\DataFixtures;

use App\Entity\Consommateur;
use App\Entity\Restaurant;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    /**
     * AppFixtures constructor.
     * @param UserPasswordEncoderInterface $encoder
     */
    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }
    
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create();

        $user = new Consommateur();
            $user->setEmail("t.elhadj42@gmail.com")
                ->setPassword($this->encoder->encodePassword($user, "Password"))
                ->setNom($faker->title)
                ->setPhotoUrl("media/users/blank.png")
                ->setTelephone($faker->phoneNumber)
                ->setDateCreation(new \DateTime())
                ->setRoles(["ROLE_CONSOMMATEUR"]);

            $manager->persist($user);

        for ($u = 0; $u < 15; $u++) {
            $user = new Restaurant();
            $user->setEmail($faker->email)
                ->setPassword($this->encoder->encodePassword($user, "Password"))
                ->setNom("Restaurant_" . $u)
                ->setPhotoUrl("media/stock-600x400/img-7.jpg")
                ->setTelephone($faker->phoneNumber)
                ->setDateCreation(new \DateTime())
                ->setRoles(["ROLE_RESTAURANT"]);

            $manager->persist($user);
        }

        $manager->flush();
    }
}
