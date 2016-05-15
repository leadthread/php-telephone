<?php

namespace Zenapply\DataTypes\Tests;

use Zenapply\DataTypes\Telephone;

class TelephoneTest extends TestCase
{
    public function testItCreatesAnInstanceOfHttpRequest(){
        $r = new Telephone("13852017374");
        $this->assertInstanceOf(Telephone::class,$r);
        var_dump($r);
    }
}
