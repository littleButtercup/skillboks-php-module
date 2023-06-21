<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends BaseFixterus
{
    /**
     * @var UserPasswordEncoderInterface
     */
    private $passwordEncoder;

    function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    /**
     * @param ObjectManager $manager
     * @return void
     */
    public function loadData(ObjectManager $manager): void
    {
        $this->createMany(User::class, 10, function (User $user) {
            $user
                ->setEmail($this->faker->email)
                ->setFirstName($this->faker->firstName)
                ->setIsActive($this->faker->numberBetween(0, 10) <= 3)
                ->setPassword($this->passwordEncoder->encodePassword($user, '123456'));
        });

        $this->create(User::class, function (User $user){
            $user
                ->setEmail('admin@symfony.skillbox')
                ->setFirstName($this->faker->firstName)
                ->setIsActive(true)
                ->setPassword($this->passwordEncoder->encodePassword($user, 'qwerty'));
            $this->manager->flush();
        });
    }
}
