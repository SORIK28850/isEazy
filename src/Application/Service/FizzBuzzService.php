<?php

namespace App\Application\Service;
use App\Domain\Repository\FizzBuzzRepository;
use DateTime;

class FizzBuzzService
{
    private $fizzBuzzRepository;

    public function __construct(FizzBuzzRepository $fizzBuzzRepository)
    {
        $this->fizzBuzzRepository = $fizzBuzzRepository;
    }

    public function generateFizzBuzz($numberStart, $numberEnd): string
    {
        $result = '';

        for ($cont = $numberStart; $cont <= $numberEnd; $cont++) {

            if ($cont % 3 == 0 && $cont % 5 == 0) {
                $result .= 'FizzBuzz';

            } elseif ($cont % 3 == 0) {
                $result .= 'Fizz';

            } elseif ($cont % 5 == 0) {
                $result .= 'Buzz';

            } else {
                $result .= $cont;

            }

            $result .= ', ';
        }

        return rtrim($result, ', ');
    }

    public function generateAndSaveFizzBuzz($formData)
    {
        $fizzBuzzGenerated = $this->generateFizzBuzz($formData->getNumberStart(), $formData->getNumberEnd());

        $formData->setFizzBuzzGenerated($fizzBuzzGenerated);
        $formData->setCreatedAt(new DateTime());

        $this->save($formData);
    }

    public function save($entity)
    {
        $this->fizzBuzzRepository->save($entity);
    }

    public function getLastFizzBuzzGenerated()
    {
        return $this->fizzBuzzRepository->getLastFizzBuzzGenerated();
    }

}