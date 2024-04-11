<?php

namespace App\Tests\Application\Service;

use App\Application\Service\FizzBuzzService;
use App\Domain\Entity\FizzBuzz;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class FizzBuzzServiceIntegrationTest extends KernelTestCase
{
    private $entityManager;
    private $fizzBuzzRepository;
    private $fizzBuzzService;

    protected function setUp(): void
    {
        $kernel = self::bootKernel();

        $this->entityManager = $kernel->getContainer()
            ->get('doctrine')
            ->getManager();

        $this->fizzBuzzRepository = $this->entityManager->getRepository(FizzBuzz::class);
        $this->fizzBuzzService = new FizzBuzzService($this->fizzBuzzRepository);
    }

    public function testGenerateAndSaveFizzBuzz()
    {
        $fizzBuzz = new FizzBuzz();
        $fizzBuzz->setNumberStart(1);
        $fizzBuzz->setNumberEnd(15);

        $this->fizzBuzzService->generateAndSaveFizzBuzz($fizzBuzz);

        $lastFizzBuzzGenerated = $this->fizzBuzzService->getLastFizzBuzzGenerated();

        $this->assertEquals('1, 2, Fizz, 4, Buzz, Fizz, 7, 8, Fizz, Buzz, 11, Fizz, 13, 14, FizzBuzz', $lastFizzBuzzGenerated);
    }

    protected function tearDown(): void
    {
        $fizzBuzzEntities = $this->fizzBuzzRepository->findAll();

        foreach ($fizzBuzzEntities as $fizzBuzz) {
            $this->entityManager->remove($fizzBuzz);
        }

        $this->entityManager->flush();

        parent::tearDown();

        $this->entityManager->close();
        $this->entityManager = null;
    }

}