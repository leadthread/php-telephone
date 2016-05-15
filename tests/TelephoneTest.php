<?php

namespace Zenapply\DataTypes\Tests;

use Zenapply\DataTypes\Telephone;

class TelephoneTest extends TestCase
{
    public function testItCreatesAnInstanceOfHttpRequest(){
        $r = new Telephone("13852011234");
        $this->assertInstanceOf(Telephone::class,$r);
    }

    public function testProperFormats()
    {
        $phone = new Telephone('+1 (385) 201-1234', 'US');

        $this->assertEquals($phone,'+13852011234');
        $this->assertEquals($phone->getE164(),'+13852011234');
        $this->assertEquals($phone->getRFC3966(),'tel:+1-385-201-1234');
        $this->assertEquals($phone->getNational(),'(385) 201-1234');
        $this->assertEquals($phone->getInternational(),'+1 385-201-1234');
        $this->assertEquals($phone->getOriginal(),'+1 (385) 201-1234');
        $this->assertEquals($phone->getAreaCode(),'385');
        $this->assertEquals($phone->getCountryCode(),'1');
        $this->assertEquals($phone->getSubscriberCode(),'2011234');
        $this->assertEquals($phone->getType(),'FIXED_LINE_OR_MOBILE');
        $this->assertEquals($phone->isValid(),true);
    }
}
