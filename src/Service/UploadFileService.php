<?php 

namespace App\Service;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

class UploadFileService extends AbstractController
{
    private $slugger;

    public function __construct(SluggerInterface $slugger)
    {
        $this->slugger = $slugger;
    }

    /**
     * Convert an uploaded file, secure it to avoid errors and return valid filename  
     *
     * @param [type] $pictureFile the uploaded picture from the user
     * @return string
     */
    public function uploadFile($pictureFile, $file)
    {
        // Get filename 
        $originalFilename = pathinfo($pictureFile->getClientOriginalName(), PATHINFO_FILENAME);
        
        // transform filename to avoid errors
        $safeFileName = $this->slugger->slug($originalFilename);
        
        if ($file === 'character') {
            // create the new filename with slugified filename and extension based on original uploaded file 
            $newFilename = $safeFileName.'.'.$pictureFile->guessExtension();
        } else {
            // create the new filename with slugified filename, a unique id (to avoid same filename), and extension based on original uploaded file 
            $newFilename = $safeFileName.'-'.uniqid().'.'.$pictureFile->guessExtension();
        }
        
        try {
            $pictureFile->move(
                $this->getParameter($file.'_image_directory'),
                $newFilename
            );
        } catch (FileException $e) {
            throw $this->json('erreur lors de l\'upload de l\'image', Response::HTTP_UNSUPPORTED_MEDIA_TYPE);
        }

        return $newFilename;
    }
}