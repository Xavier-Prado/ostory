<?php

namespace App\Serializer;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

/**
 * Entity normalizer
 */
class EntityDenormalizer implements DenormalizerInterface
{
    /** @var EntityManagerInterface **/
    protected $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * Cette méthode permet de vérifier si le denormalizer s'applique sur la donnée
     * $data -> ID du genre
     * $type -> La classe vers laquelle dénormaliser $data
     * 
     * @inheritDoc
     */
    public function supportsDenormalization($data, $type, $format = null)
    {
        return strpos($type, 'App\\Entity\\') === 0 && (is_numeric($data));
    }

    /**
     * @inheritDoc
     */
    public function denormalize($data, $class, $format = null, array $context = [])
    {
        $entity = $this->em->find($class, $data);
        if(is_null($entity)) {
            // erreur
            // TODO gestion erreur quand on envoi une entité qui n'existe pas !
            //throw new NotFoundHttpException($class . ' invalid !');
            $json = new JsonResponse();
            $json->setContent($class . ' invalid !');
            //$json->prepare();
            $json->send();
        }
        return $entity;
        // EntityManagerInterface::find() fonctionne comme les find() des repos
    }
}