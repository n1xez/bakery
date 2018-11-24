<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;

/**
 * Class CsvManager
 * @package App\Services\Documents
 */
class CsvManager
{

    /**
     * Converting input csv to array by mapping and delimiter
     * @param UploadedFile|null $file - input file
     * @param array $mapping - array where it is indicated which fields to save
     * @param string $delimiter - Set the field delimiter (one character only).
     * @return array|null
     */
    public function convertCsvToArray(?UploadedFile $file, array  $mapping, string $delimiter)
    {
        return $file && $this->isCsv($file)
            ? $this->readCsvAndWriteToArray($file, $mapping, $delimiter)
            : null;
    }

    /**
     * Check file extension, return true is file csv
     * @param UploadedFile $file
     * @return bool
     */
    private function isCsv(UploadedFile $file)
    {
        return $file->getClientOriginalExtension() === 'csv';
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
    public function readCsvAndWriteToArray(string $path, array $mapping, string $delimiter, int $startRow = 1, int $length = 1000)
    {
        $result = [];

        $handle = fopen($path, 'r');

        if ($handle !== FALSE) {

            $data = true;
            for ($row = $startRow; $data !== FALSE; $row++) {
                $data = fgetcsv($handle, $length, $delimiter);

                foreach ($mapping as $numberColumn => $column) {
                    $result[$row][$column] = $data[$numberColumn];
                }
            }

            fclose($handle);
        }

        return collect($result);
    }
}
