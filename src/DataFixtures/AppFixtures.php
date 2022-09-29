<?php

namespace App\DataFixtures;

use App\Entity\Choice;
use App\Entity\Page;
use App\Entity\User;
use App\Entity\Story;
use App\Repository\ChoiceRepository;
use App\Repository\PageRepository;
use App\Repository\StoryRepository;
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

            // create 3 "stories"
            for ($i=1; $i<4; $i++) {
                $story = new Story();
                $story->setTitle('Story'.$i);
                $story->setContent('Story '. $i .' content : C’est une tarte aux myrtilles. Pourquoi elle vous revient pas? Ouais… Ouais je me suis gouré… N’empêche que j’suis une légende! Et on peut savoir depuis quand vous arpentez la Bretagne en racontant à tout le monde que vous vous appelez Provençal le Gaulois? Ben attendez, je vais vous rendre la vôtre.');
                $story->setImage('https://media.istockphoto.com/vectors/cute-facial-expression-icon-of-the-raccoon-vector-id1402078709?s=612x612');
                $story->setSlug(strtolower($this->slugger->slug($story->getTitle() . " test slugger")));

                $manager->persist($story);

                // add the newly created story to the array
                $storyArray[]= $story;
            }

            $pagesArray=[];

            // add pages to random story
            for ($j=1; $j<8; $j++) {
                $page = new Page();
                $page->setTitle('Page '.$j);
                $page->setImage('http://cdn.shopify.com/s/files/1/0005/0384/0825/products/shopifykitsune_1200x1200.jpg?v=1616508512');
                $page->setContent('Page ' . $j.' content : Mais arrêtez avec votre chevalier gaulois! Je vous dis que c’est des conneries! Qu’est ce que j’ai dit? Une connerie? On pourrait foutre le feu à la forêt pour les obliger à sortir. Allez-y mollo avec la joie! N’empêche que tout le monde parle de moi! C’est quand même un signe!');
                
                // Randomise the start page (not unique)
                $page->setStart(false);
                // Randomise the output of the page (0 => continue story, 1 => end with win, 2 => end with lost)
                $page->setPageEnd([rand(0, 2)]);
                $page->setStory($storyArray[rand(0, (count($storyArray)-1) )]);

                $manager->persist($page);
                $pagesArray[] = $page;
            }

            foreach ($pagesArray as $entry) {
                for ($k=1; $k<=2; $k++) {
                    $choice = new Choice;
                    $choice->setName('Choice' .$k);
                    $choice->setDescription("Choice $k description : A genoux, pas à genoux c’est une chose... Enfin en attendant je vous donne pas tout notre or. Ils sont encore là, ces cons! Merde j'ai plus de pierres qu'est-ce qu'on fait?");
                    $choice->setPages($entry);
                    $choice->setPage_to_redirect(1);
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
                           
                            $entry->setPage_to_redirect($pagesList[$randomEntry]->getId());
                        }
                    }
                }
            $manager->flush();
    }
}




