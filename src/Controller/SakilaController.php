<?php

namespace App\Controller;

use App\Entity\Sakila\Film;
use App\Repository\Sakila\FilmRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class SakilaController extends AbstractController
{
    /**
     * @Route("/sakila/test", name="sakila_test")
     */
    public function test(ManagerRegistry $managerRegistry, NormalizerInterface $normalizer)
    {
        /** @var FilmRepository $repository */
        $repository = $managerRegistry->getRepository(Film::class, 'sakila');

        $data = $normalizer->normalize($repository->findByExampleField(), null, ['groups' => ['film']]);

        return new JsonResponse($data);
    }
}
