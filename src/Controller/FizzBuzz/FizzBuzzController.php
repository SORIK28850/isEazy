<?php

namespace App\Controller\FizzBuzz;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Application\Service\FizzBuzzService;
use App\Application\Forms\FizzBuzzType;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

/**
 * Class FizzBuzzController
 * @package App\Controller\FizzBuzz
 */
class FizzBuzzController extends AbstractController
{
    private $fizzBuzzService;

    /**
     * FizzBuzzController constructor.
     * @param FizzBuzzService $fizzBuzzService
     */
    public function __construct(FizzBuzzService $fizzBuzzService)
    {
        $this->fizzBuzzService = $fizzBuzzService;
        
    }

    /**
     * @param Request $request
     * 
     * @return Response
     */
    #[Route('/', name: 'home')]
    public function index(Request $request): Response
    {
        $form = $this->createForm(FizzBuzzType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $formData = $form->getData();
            $this->fizzBuzzService->generateAndSaveFizzBuzz($formData);

            return $this->redirectToRoute('fizzBuzz');

        }

        $errors = $form->getErrors(true);
        $errorMessages = [];

        foreach ($errors as $error) {
            $errorMessages[] = $error->getMessage();

        }

        return $this->render('FizzBuzz/index.html.twig', [
            'form' => $form->createView(),
            'errors' => $errorMessages,

        ]);

    }

    /**
     * @param Request $request
     * 
     * @return Response
     */
    #[Route('/desafio/fizz/buzz', name: 'fizzBuzz')]
    public function fizzBuzz(Request $request): Response
    {
        if (!$request->headers->has('referer')) {
            throw new AccessDeniedHttpException();

        }

        $fizzBuzzGenerated = $this->fizzBuzzService->getLastFizzBuzzGenerated();

        return $this->render('FizzBuzzResult/index.html.twig', [
            'fizzBuzzGenerated' => $fizzBuzzGenerated,

        ]);

    }

}