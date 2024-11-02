<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\SimpleNumber;

class SimpleNumberController extends AbstractController  
{
    private SimpleNumber $simpleNumber;

    public function __construct(SimpleNumber $simpleNumber)
    {
        $this->simpleNumber = $simpleNumber;
    }

    #[Route('/check/{number}', methods: ['GET'])]
    public function check(int $number): Response
    {
        $isPrime = $this->simpleNumber->isPrime($number);
        $result = $isPrime ? "простое" : "составное";

        return new Response(
            "<html><body>Число $number $result.</body></html>"
        );
    }
}
