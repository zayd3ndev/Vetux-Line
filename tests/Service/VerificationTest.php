<?php

namespace App\Tests\Service;

use App\Service\Verification;
use PHPUnit\Framework\TestCase;

class VerificationTest extends TestCase
{
    public function testValidDate(){
        // Format m/d/Y
        // valid
        $this->assertTrue(Verification::isValidDate("08/12/2001"));
        $this->assertTrue(Verification::isValidDate("12/12/2001"));

        // invalid
        $this->assertFalse(Verification::isValidDate("78/72/1990"));
        $this->assertFalse(Verification::isValidDate("02/30/1990"));
    }

    public function testIsMajorWithValidDateFormat()
    {
        // Major
        $this->assertTrue(Verification::isMajor("08/12/2001"));

        // Minor
        $this->assertFalse(Verification::isMajor("05/11/2005"));
    }

    public function testIsMajorWithInvalidDateFormat()
    {
        $this->assertFalse(Verification::isMajor("03/09/20062"));
        $this->assertFalse(Verification::isMajor("dalil"));
        $this->assertFalse(Verification::isMajor("03/09/20"));
        $this->assertFalse(Verification::isMajor("03/az09d/2020"));
    }

    public function testValidSize(){
        // Valid
        $this->assertTrue(Verification::isValidSize("5' 7\"", 171));

        // invalid
        $this->assertFalse(Verification::isValidSize("9' 7\"", 11));
    }

}
