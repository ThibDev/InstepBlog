<?php

namespace App\tests;

use PHPUnit\Framework\TestCase;

use function PHPUnit\Framework\equalTo;

class AppTest extends TestCase{

    /**
     * permet de tester que l'application et que les tests fonctionnent
     * @return void
     */

    public function testTestAreWorking(){

        $this->assertEquals(2, 1+1);

    }
}