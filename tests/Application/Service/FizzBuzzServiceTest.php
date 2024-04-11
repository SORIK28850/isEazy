<?php

namespace App\Tests\Application\Service;

use App\Application\Service\FizzBuzzService;
use App\Domain\Repository\FizzBuzzRepository;
use PHPUnit\Framework\TestCase;

class FizzBuzzServiceTest extends TestCase
{
    private $fizzBuzzService;
    private $fizzBuzzRepository;

    protected function setUp(): void
    {
        $this->fizzBuzzRepository = $this->createMock(FizzBuzzRepository::class);
        $this->fizzBuzzService = new FizzBuzzService($this->fizzBuzzRepository);
    }

    public function testGenerateFizzBuzz()
    {
        $numberStart = 30;
        $numberEnd = 67;
        $expectedResult = 'FizzBuzz, 31, 32, Fizz, 34, Buzz, Fizz, 37, 38, Fizz, Buzz, 41, Fizz, 43, 44, FizzBuzz, 46, 47, Fizz, 49, Buzz, Fizz, 52, 53, Fizz, Buzz, 56, Fizz, 58, 59, FizzBuzz, 61, 62, Fizz, 64, Buzz, Fizz, 67';

        $result = $this->fizzBuzzService->generateFizzBuzz($numberStart, $numberEnd);

        $this->assertEquals($expectedResult, $result);
    }
}