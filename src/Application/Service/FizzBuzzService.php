<?php

namespace App\Application\Service;
use App\Domain\Repository\FizzBuzzRepository;
use DateTime;

/**
 * Class FizzBuzzService
 * @package App\Application\Service
 */
class FizzBuzzService
{
    private $fizzBuzzRepository;

    /**
     * FizzBuzzService constructor.
     * @param FizzBuzzRepository $fizzBuzzRepository
     */
    public function __construct(FizzBuzzRepository $fizzBuzzRepository)
    {
        $this->fizzBuzzRepository = $fizzBuzzRepository;
    }

    /**
     * @param int $numberStart
     * @param int $numberEnd
     * 
     * @return string
     */
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

    /**
     * @param object $formData
     * 
     * @return void
     */
    public function generateAndSaveFizzBuzz($formData): void
    {
        $fizzBuzzGenerated = $this->generateFizzBuzz($formData->getNumberStart(), $formData->getNumberEnd());

        $formData->setFizzBuzzGenerated($fizzBuzzGenerated);
        $formData->setCreatedAt(new DateTime());

        $this->save($formData);

    }

    /**
     * @param object $entity
     * 
     * @return void
     */
    public function save($entity): void
    {
        $this->fizzBuzzRepository->save($entity);

    }

    /**
     * @return string|null
     */
    public function getLastFizzBuzzGenerated(): ?string
    {
        return $this->fizzBuzzRepository->getLastFizzBuzzGenerated();
        
    }

}