<?php


namespace App\Service;


use App\Service\Csv;
use App\Service\Verification;
use League\Csv\CannotInsertRecord;
use League\Csv\Exception;
use League\Csv\Reader;
use League\Csv\Writer;

class Invalid
{
    private $csv;

    private $invalidCsv;

    private $insert;

    /**
     * @param $csvDescriptor
     * @throws CannotInsertRecord
     * @throws Exception
     */
    public function __construct($csvDescriptor){
        $this->csv =  Reader::createFromPath($csvDescriptor)->setHeaderOffset(0);
        $this->invalidCsv = Writer::createFromFileObject(new \SplTempFileObject());
        $this->invalidCsv->insertOne(Reader::createFromPath($csvDescriptor)->setHeaderOffset(0)->getHeader());
        $this->insert = 0;
    }

    /**
     * @throws CannotInsertRecord
     */
    private function insertIntoInvalidCsv(){
        foreach ($this->csv->getRecords() as $data) {
            $data = array_change_key_case($data, CASE_LOWER);
            if ("notMajor"){
                if(!Verification::isMajor($data["birthday"])) {
                    $this->invalidCsv->insertOne($data);
                    $this->insert = 1;
                }
            }
            if ("isValidSize"){
                if(!Verification::isValidSize($data["feetinches"], $data["centimeters"])) {
                    $this->invalidCsv->insertOne($data);
                    $this->insert = 1;
                }
            }
            if ("invalidCcNumber"){
                if(in_array($data["ccnumber"],  Csv::getDuplicateValueInArray(Csv::getArrayOfCsvCcNumber($this->csv->getRecords())))) {
                    $this->invalidCsv->insertOne($data);
                    $this->insert = 1;
                }
            }
        }
    }

    /**
     * @return bool
     * @throws CannotInsertRecord
     */
    public function notMajor(): bool
    {
        $this->insertIntoInvalidCsv();
        return $this->insert === 1;
    }

    /**
     * @return bool
     * @throws CannotInsertRecord
     */
    public function invalidSize(): bool
    {
        $this->insertIntoInvalidCsv();
        return $this->insert === 1;
    }

    /**
     * @return bool
     * @throws CannotInsertRecord
     */
    public function invalidCcNumber(): bool
    {
        $this->insertIntoInvalidCsv();
        return $this->insert === 1;
    }

    /**
     * @param string $csvName
     * @return int
     */
    public function downloadCsv(string $csvName = "invalid.csv"){
        return $this->invalidCsv->output($csvName);
    }

    /**
     * @return Writer
     */
    public function getInvalidCsv(): Writer
    {
        return $this->invalidCsv;
    }

}
