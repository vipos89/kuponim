<?php

    namespace App\Controller;

    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\HttpFoundation\JsonResponse;
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\Routing\Annotation\Route;

    class HelloController extends AbstractController
    {
        private array $messages = [
            ['message' => 'Hello', 'created' => '2023/05/12'],
            ['message' => 'Hi', 'created' => '2023/04/12'],
            ['message' => 'Bye!', 'created' => '2021/05/12']
        ];

        #[Route('/messages', name: 'app_index')]
        public function index($limit= 3): Response
        {
            return $this->render('hello/index.html.twig', [
                'messages' => $this->messages,
                'limit' => $limit
            ]);
            // return new Response();

        }

        #[Route('/messages/{id<\d+>?1}', name: 'app_show_one')]
        public function showOne(int $id)
        {
            return $this->render('hello/show_one.html.twig', [
                'message' => $this->messages[$id]
            ]);
            return new Response($this->messages[$id]);
        }
    }
