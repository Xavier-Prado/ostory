<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Page;
use App\Entity\User;
use App\Entity\Story;
use App\Entity\Choice;
use App\Repository\PageRepository;
use App\Repository\StoryRepository;
use App\Repository\ChoiceRepository;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private $passwordHasher;
    private $slugger;
    private $pageRepository;
    private $choiceRepository;
    private $storyRepository;

    public function __construct(UserPasswordHasherInterface $passwordHasher, SluggerInterface $sluggerInterface, PageRepository $pageRepository, ChoiceRepository $choiceRepository, StoryRepository $storyRepository)
    {
        $this->slugger = $sluggerInterface;
        $this->passwordHasher = $passwordHasher;
        $this->pageRepository = $pageRepository;
        $this->choiceRepository = $choiceRepository;
        $this->storyRepository = $storyRepository;
    }

    public function load(ObjectManager $manager)
    {


        // Instantiate Faker
            $faker = Factory::create('fr_FR');
            
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

            // empty array to store stories
            $storyArray=[];

            // create 4 "stories"
            for ($i=1; $i<5; $i++) {
                $story = new Story();
                $story->setTitle($faker->realText(rand(10, 30)));
                $story->setContent($faker->realText(rand(10,250)));
                $story->setImage('https://media.istockphoto.com/vectors/cute-facial-expression-icon-of-the-raccoon-vector-id1402078709?s=612x612');
                $story->setSlug(strtolower($this->slugger->slug($story->getTitle() . " test slugger")));

                $manager->persist($story);

                // add the newly created story to the array
                $storyArray[]= $story;
            }

            $pagesArray=[];

            // add pages to random story
            for ($j=1; $j<20; $j++) {
                $page = new Page();
                $page->setTitle($faker->realText(rand(10, 127)));
                $page->setImage('http://cdn.shopify.com/s/files/1/0005/0384/0825/products/shopifykitsune_1200x1200.jpg?v=1616508512');
                $page->setContent($faker->realText(rand(10, 200)));
                
                // Randomise the start page (not unique)
                $page->setStart(false);
                // Randomise the output of the page (0 => continue story, 1 => end with win, 2 => end with lost)
                $page->setPageEnd(rand(0, 2));
                $page->setStory($storyArray[rand(0, (count($storyArray)-1) )]);

                $manager->persist($page);
                $pagesArray[] = $page;
            }

            foreach ($pagesArray as $entry) {
                for ($k=1; $k<=2; $k++) {
                    $choice = new Choice;
                    $choice->setName($faker->realText(rand(10, 50)));
                    $choice->setDescription($faker->realText(rand(10, 200)));
                    $choice->setPages($entry);
                    $choice->setPageToRedirect(1);
                    $manager->persist($choice);
                }
            }

            $manager->flush();

            
            // Select all the stories
            $storyList = $this->storyRepository->findAll();
            // Select all pages related to one story
            foreach ($storyList as $story) {
                $pagesList = $this->pageRepository->findBy(['story' => $story->getId()]);

                // If one story have at least one page, select one random page 
                if(!empty($pagesList)) {
                    $randomKey = array_rand($pagesList);
                    $pagesList[$randomKey]->setStart(true);
                }
                    // Select all choices related to one page
                    foreach ($pagesList as $page) {
                        $choiceList = $this->choiceRepository->findBy(['pages' => $page->getId()]);
                        foreach ($choiceList as $entry) {
                            // Chose a random number between 0 and the last index of the array
                            // This number correspond to the index which holds redirection page
                            $randomEntry = array_rand($pagesList);
                            // If this is the page we are currently on, select another number
                           
                            $entry->setPageToRedirect($pagesList[$randomEntry]->getId());
                        }
                    }
                }
            $manager->flush();
    }
}




