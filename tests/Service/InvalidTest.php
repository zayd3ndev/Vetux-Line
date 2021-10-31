<?php

namespace App\Tests\Service;

use App\Service\Invalid;
use PHPUnit\Framework\TestCase;

class InvalidTest extends TestCase
{

    protected $frenchDataCsv;

    protected $germanDataCsv;

    protected $emptyCsv;

    protected function setUp()
    {
        $this->frenchDataCsv = __DIR__."tests/../csvFiles/small-french-data.csv";
        $this->germanDataCsv = __DIR__."tests/../csvFiles/small-german-data.csv";
        $this->emptyCsv = __DIR__."tests/../csvFiles/empty-data.csv";
    }

    public function testNotMajorWithEmptyCsv(){
        $invalid = new Invalid($this->emptyCsv);
        $this->assertFalse($invalid->notMajor("notMajor"));
    }

    public function testNotMajorWithFilledCsv(){
        $invalid = new Invalid($this->frenchDataCsv);
        $this->assertTrue($invalid->notMajor("notMajor"));

        $content = explode(',',  $invalid->getInvalidCsv()->getContent());
        $this->assertEquals( $content[0], "Number");
        $this->assertEquals( $content[37], "Pounds");
        $this->assertEquals( $content[43], "female");
        $this->assertEquals( $content[64], "8/30/2018");
        $this->assertEquals( $content[107], "8/30/2018");
    }

    public function testInvalidSizeWithEmptyCsv(){
        $invalid = new Invalid($this->emptyCsv);
        $this->assertFalse($invalid->notMajor("invalidSize"));
    }

    public function testInvalidSizeWithFilledCsv(){
        $invalid = new Invalid($this->germanDataCsv);
        $this->assertTrue($invalid->notMajor("invalidSize"));

        $content = explode(',',  $invalid->getInvalidCsv()->getContent());
        $this->assertEquals( $content[6], "Surname");
        $this->assertEquals( $content[81], "76.5");
        $this->assertEquals( $content[82], "\"6' 0\"\"\"");
    }

    public function testInvalidCcNumberWithEmptyCsv(){
        $invalid = new Invalid($this->emptyCsv);
        $this->assertFalse($invalid->notMajor("invalidCcNumber"));
    }

    public function testInvalidCcNumberWithFilledCsv(){
        $invalid = new Invalid($this->germanDataCsv);
        $this->assertTrue($invalid->notMajor("invalidCcNumber"));

        $content = explode(',',  $invalid->getInvalidCsv()->getContent());
        $this->assertEquals( $content[67], "4539448007296299");
        $this->assertEquals( $content[110], "4539448007296299");
    }

}