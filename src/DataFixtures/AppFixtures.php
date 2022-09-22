<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }
    public function load(ObjectManager $manager)
    {

        // Create new user with ROLE_USER for testing purpose
            $user = new User();
            $user->setNickname('user');
            $user->setEmail('user@user.com');
            $user->setPassword('$2y$13$qqr7mZlJfTiRbJV3djPwCO2Y.nUET93AJVqdrJsAG0k..dZTGkZwy');
            $user->setRoles(['ROLE_USER']);
            $manager->persist($user);
            
            $user = new User();
            $user->setNickname('manager');
            $user->setEmail('manager@manager.com');
            $user->setPassword('$2y$13$QAGGpcC70IoLQ9mmR7fB8.YOkLg5EIcXC1IMpkeYXFbfh5Eccvp7C');
            $user->setRoles(['ROLE_MANAGER']);
            $manager->persist($user);
            
            $user = new User();
            $user->setNickname('admin');
            $user->setEmail('admin@admin.com');
            $user->setPassword('$2y$13$jazC3eNbpUWrOI/dp5PVzOmakO9ZQrl47eIG7XlP2X7Lj/U8sSDQ.');
            $user->setRoles(['ROLE_ADMIN']);
            $manager->persist($user);
            // dd($this->passwordHasher->isPasswordValid($user, ''));

        $manager->flush();
    }

}


