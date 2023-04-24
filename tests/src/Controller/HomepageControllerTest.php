<?php

namespace App\tests\src\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class HomepageControllerTest extends WebTestCase{

    /**
     * Permet de vérifier que lorsque l'on tape / on obtient une réponse 200
     * @return void
     */

    public function testHomepage(){

        $client = static::createClient();
        $crawler = $client->request('GET', '/');
        self::assertResponseStatusCodeSame(Response::HTTP_OK);

    }
}