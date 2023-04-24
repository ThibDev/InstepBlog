<?php

namespace App\tests\src\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class HomepageControllerTest extends WebTestCase
{
    private function requestHomepage(){

        /**
         * Permet d'effectuer une requete en get sur /
         * @return void
         */
        $client = static::createClient();
        return $client->request('GET', '/');
    }

    public function testHomepage()
    {

        /**
         * Permet de vérifier que lorsque l'on tape / on obtient une réponse 200
         * @return void
         */
        $this->requestHomepage();
        self::assertResponseStatusCodeSame(Response::HTTP_OK);
    }

    public function testMainTitleOnHomepage()
    {

        /**
         * Permet de tester la présence d'un h1 sur l'accueil
         * @return void
         */
        $this->requestHomepage();
        self::assertSelectorTextContains('h1', 'Bienvenue sur Instep-Blog');
    }
}
