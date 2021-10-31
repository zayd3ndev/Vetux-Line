<?php

namespace App\Tests\Service;

use App\Service\Csv;
use App\Service\Merge;
use PHPUnit\Framework\TestCase;

class MergeTest extends TestCase
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

    public function testGetColumns(){
        $merge = new Merge($this->frenchDataCsv, $this->germanDataCsv);
        $this->assertEquals($merge->getColumns(),  array_map('strtolower', Csv::getSpecificColumns()));
        $this->assertTrue($merge->getColumns()[4] ===  array_map('strtolower', Csv::getSpecificColumns())[4]);
    }

    public function testGetMergeCsv(){
        $merge = new Merge($this->frenchDataCsv, $this->germanDataCsv);
        $this->assertEquals($merge->getMergeCsv()->getPathname(), "php://temp");
    }

    public function testGetMergeCsvName(){
        $merge = new Merge($this->frenchDataCsv, $this->germanDataCsv,"small-german-french");
        $this->assertEquals($merge->getMergeCsvName(), "small-german-french");
    }

    public function testGetArrayOfCsvCcNumber(){
        $merge = new Merge($this->germanDataCsv, $this->frenchDataCsv);
        $this->assertEquals($merge->getArrayOfCsvCcNumber()[0], 4539448007296299);
        $this->assertEquals($merge->getArrayOfCsvCcNumber()[17], 5226880624178234);
        $this->assertEquals($merge->getArrayOfCsvCcNumber()[48], 5509320230651074);
    }

    public function testSequentialWithEmptyCsv(){
        $merge = new Merge( $this->emptyCsv,  $this->emptyCsv);
        $this->assertFalse($merge->sequential());
    }

    public function testSequentialWithSameCsv(){
        $merge = new Merge($this->frenchDataCsv, $this->frenchDataCsv);
        $this->assertFalse($merge->sequential()); // False car les cc number seront en doublons donc on ne passe pas les vérifications.
    }

    public function testSequentialWithDifferentCsv(){
        $merge = new Merge($this->frenchDataCsv, $this->germanDataCsv);
        $this->assertTrue($merge->sequential());

        $content = explode(',', $merge->getMergeCsv()->getContent());
        $this->assertEquals( $content[1], "Title");
        $this->assertEquals( $content[8], "CCNumber");
        $this->assertEquals( $content[12], "City");
        $this->assertEquals( $content[33], "France");
        $this->assertEquals( $content[52], "France");
        $this->assertEquals( $content[71], "France");
        $this->assertEquals( $content[90], "Germany");
        $this->assertEquals( $content[109], "Germany");

        $merge = new Merge($this->germanDataCsv, $this->frenchDataCsv);
        $this->assertTrue($merge->sequential());

        $content = explode(',', $merge->getMergeCsv()->getContent());
        $this->assertEquals( $content[33], "Germany");
        $this->assertEquals( $content[52], "Germany");
        $this->assertEquals( $content[71], "France");
        $this->assertEquals( $content[90], "France");
        $this->assertEquals( $content[109], "France");
    }

    public function testInterlacedWithEmptyCsv(){
        $merge = new Merge($this->emptyCsv, $this->emptyCsv);
        $this->assertFalse($merge->interlaced());
    }

    public function testInterlacedWithSameCsv(){
        $merge = new Merge($this->germanDataCsv, $this->germanDataCsv);
        $this->assertFalse($merge->interlaced());
    }

    public function testInterlacedWithDifferentCsv(){
        $merge = new Merge($this->germanDataCsv, $this->frenchDataCsv);
        $this->assertTrue($merge->interlaced());

        $content = explode(',', $merge->getMergeCsv()->getContent());
        $this->assertEquals( $content[0], "Gender");
        $this->assertEquals( $content[16], "Kilograms");
        $this->assertEquals( $content[33], "Germany");
        $this->assertEquals( $content[52], "France");
        $this->assertEquals( $content[71], "Germany");
        $this->assertEquals( $content[90], "France");
        $this->assertEquals( $content[109], "France");
    }

}
