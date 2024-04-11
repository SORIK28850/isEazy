<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class FizzBuzzControllerTest extends WebTestCase
{
    public function testFormSubmission(): void
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/');

        $this->assertResponseIsSuccessful();

        $form = $crawler->selectButton('Generar FizzBuzz')->form();

        $form['fizz_buzz[numberStart]']->setValue(1);
        $form['fizz_buzz[numberEnd]']->setValue(15);

        $client->submit($form);

        $this->assertResponseRedirects('/desafio/fizz/buzz');

        $crawler = $client->followRedirect();

        $this->assertStringContainsString('1, 2, Fizz, 4, Buzz, Fizz, 7, 8, Fizz, Buzz, 11, Fizz, 13, 14, FizzBuzz', $crawler->filter('body')->text());
   
    }

    public function testFormSubmissionWithInvalidData(): void
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/');

        $this->assertResponseIsSuccessful();

        $form = $crawler->selectButton('Generar FizzBuzz')->form();

        $form['fizz_buzz[numberStart]']->setValue(1);
        $form['fizz_buzz[numberEnd]']->setValue(100);

        $client->submit($form);

        $this->assertStringContainsString('La diferencia no puede ser mayor de 50 o igual entre los dos parámetros', $client->getResponse()->getContent());
   
    }
    
}