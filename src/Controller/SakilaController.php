<?php

namespace App\Controller;

use App\Entity\Sakila\Film;
use App\Entity\Task;
use App\Repository\BoardRepository;
use App\Repository\Sakila\FilmRepository;
use App\Repository\TaskRepository;
use Doctrine\Persistence\ManagerRegistry;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Cache\Adapter\AdapterInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Contracts\Cache\CacheInterface;

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

    /**
     * @Route("/tasks/{task}/", name="task")
     */
    public function task(Task $task)
    {
        return new Response($task->getName());
    }

    /**
     * @Route("/boards", name="board")
     */
    public function board(Request $request, BoardRepository $repository, LoggerInterface $logger)
    {
        $board = $repository->findByName('TestBoard');
        $logger->debug('tesssssssssssst', [$board]);

        if ($board) {
            $tasks = $board->getTasks()->toArray();
        }

        return $this->render('product/index.html.twig', ['board' => $board->getName(), 'tasks' => $tasks]);
    }

    /**
     * @Route("/boards/test", name="boardTest")
     */
    public function boardTest(Request $request, BoardRepository $repository)
    {
        $board = $repository->findByJoin('TestBoard');

        return $this->render('product/index.html.twig', ['board' => $board[0]['board_name']]);
    }

    /**
     * @Route("/tasks-labels", name="taskLabels")
     */
    public function taskLabel(TaskRepository $repository, AdapterInterface $cache)
    {
        $item = $cache->getItem('tasks');

        if (!$item->isHit()) {
            $tasks = $repository->findByJoin('test2');
            $item->set($tasks);
            $cache->save($item);
        }

        $tasks = $item->get();

        return $this->render('product/index.html.twig', ['board' => $tasks[0][0]->getName()]);
    }
}
