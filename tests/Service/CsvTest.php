<?php


namespace App\Tests\Service;

use App\Service\Csv;
use App\Service\Merge;
use PHPUnit\Framework\TestCase;

class CsvTest extends TestCase
{

    protected $frenchDataCsv;

    protected $germanDataCsv;

    protected $invalidHeader;

    protected function setUp(): void
    {
        $this->frenchDataCsv = __DIR__."tests/../csvFiles/small-french-data.csv";
        $this->germanDataCsv = __DIR__."tests/../csvFiles/small-german-data.csv";
        $this->invalidHeader = __DIR__."tests/../csvFiles/invalid-header.csv";
    }

    public function testGetColumns(){
        $columns = Csv::getSpecificColumns();
        $this->assertEquals($columns[0], "Gender");
        $this->assertEquals($columns[\count($columns) - 1], "Longitude");
    }

    public function testGetCsvHeader(){
        $csvHeader = Csv::getCsvHeader($this->frenchDataCsv);
        $this->assertEquals($csvHeader[0], "Number");
        $this->assertEquals($csvHeader[2], "NameSet");
    }

    public function testIsValidCsvHeader(){
        $csvHeader = Csv::getCsvHeader($this->germanDataCsv );
        $this->assertTrue(Csv::isValidCsvHeader($csvHeader));

        $csvHeader = Csv::getCsvHeader($this->invalidHeader);
        $this->assertFalse(Csv::isValidCsvHeader($csvHeader));
    }

    public function testGetValidCsvName(){
        $this->assertEquals(Csv::getValidCsvName("a z²e\\r+t=y?u]i¤"), "a-z-e-r-t-y-u-i-.csv");
    }

    public function testGetArrayOfCsvCcNumber(){
        $merge = new Merge($this->frenchDataCsv, $this->germanDataCsv );
        $arrayOfCsvCcNumber = Csv::getArrayOfCsvCcNumber($merge->getCsv1()->getRecords());
        $this->assertEquals($arrayOfCsvCcNumber[0], 4532650833355085);
        $this->assertEquals($arrayOfCsvCcNumber[1], 5315456661983356);
        $this->assertEquals($arrayOfCsvCcNumber[24], 5509320230651074);

        $arrayOfCsvCcNumber = Csv::getArrayOfCsvCcNumber($merge->getCsv1()->getRecords(), $merge->getCsv2()->getRecords());
        $this->assertEquals($arrayOfCsvCcNumber[0], 4532650833355085);
        $this->assertEquals($arrayOfCsvCcNumber[24], 5509320230651074);
        $this->assertEquals($arrayOfCsvCcNumber[47], 4532676462184603);
        $this->assertEquals($arrayOfCsvCcNumber[48], 5241552114891102);
    }

    public function testDuplicateValueInArray(){
        // with duplication
        $tab = [123,142,123,222,243,222];
        $this->assertEquals([123,222], Csv::getDuplicateValueInArray($tab));

        // Without duplication
        $tab = [000,888,565,989];
        $this->assertEquals([], Csv::getDuplicateValueInArray($tab));
    }
}