<?php

namespace App\Services;

class Decoder
{
    /**
     * @var CsvManager
     */
    private $csvManager;

    private $path = 'C:\openServer\OSPanel\domains\bakery\input.csv';
    private $pathInvItem = 'C:\openServer\OSPanel\domains\bakery\productItems.csv';
    private $pathSaleItem = 'C:\openServer\OSPanel\domains\bakery\saleItems.csv';

    private $mapping = [
        0 => 'id',
        1 => 'is_deleted',
        4 => 'type',
        5 => 'xml',
    ];

    public function __construct(CsvManager $csvManager)
    {
        $this->csvManager = $csvManager;
    }

    public function handle()
    {
        /*dd($this->getStore());*/

        $dishes = $this->getDishes('Product');
        $items = $this->getItems($dishes);
        dd($dishes->take(5));


        dd($dishes);
    }

    private function getItems($dishes)
    {
        $mapping = [
            1 => "amount",
            3 => "product",
        ];

        $resultProduct = $this->csvManager->readCsvAndWriteToArray($this->pathInvItem, $mapping, ';', 2);
        $resultSale = $this->csvManager->readCsvAndWriteToArray($this->pathSaleItem, $mapping, ';', 2);
        
        $resultProduct = $resultProduct->groupBy('product');
        $resultSale = $resultSale->groupBy('product');

        $result = collect();
        foreach ($dishes as $dish) {
            $rowsProducts = $resultProduct->get($dish['id']);
            $sumProducts = $rowsProducts ? $rowsProducts->sum('amount') : 0;
            $rowsSale =  $resultSale->get($dish['id']);
            $sumSale = $rowsSale ? $rowsSale->sum('amount') : 0;

            $result->put($dish['name'], $sumProducts - $sumSale);
        }
        dd($result);

        return $result;
    }

    private function getDishes($type)
    {
        $result = $this->csvManager->readCsvAndWriteToArray($this->path, $this->mapping, ';', 1, 100000);

        $result = $result
            ->where('is_deleted', 0)
            ->groupBy('type')
            ->get($type);

        $result = $result->map(function ($row) {
            $row['xml'] = $this->convertXmlToArray($row['xml']);
            $row['name'] = $row['xml']['name']['customValue'];
            $row['product_type'] = $row['xml']['type'];
            return $row;
        });

        return $result->where('product_type', 'DISH');
    }

    public function getStore()
    {
        $result = $this->csvManager->readCsvAndWriteToArray($this->path, $this->mapping, ';', 1, 100000);

        $result = $result
            ->where('is_deleted', 0)
            ->groupBy('type')
            ->get('Store');

        $result = $result->map(function ($row) {
            $row['xml'] = $this->convertXmlToArray($row['xml']);
            $row['name'] = $row['xml']['name']['customValue'];
            return $row;
        });

        return $result;
    }

    public function convertXmlToArray($xml)
    {
        $xml = simplexml_load_string($xml, "SimpleXMLElement", LIBXML_NOCDATA);
        $json = json_encode($xml);
        return json_decode($json,TRUE);
    }

    /**
     * Reads csv and gets lines from file pointer fields and write to array
     * @param string $path
     * @param array $mapping
     * @param string $delimiter
     * @param int $startRow
     * @param int $length
     * @return array
     */
    public function readCsvAndWriteToArray(string $path, array $mapping, string $delimiter, int $startRow = 1, int $length = 100000)
    {
        $result = [];
        $handle = fopen($path, 'r');

        if ($handle !== FALSE) {

            $data = true;
            for ($row = $startRow; $data !== FALSE; $row++) {
                $data = fgetcsv($handle, $length, $delimiter);

                foreach ($data as $number => $column) {
                    $result[$row][$column] = $data[$number];
                }
            }

            fclose($handle);
        }

        return collect($result);
    }
}