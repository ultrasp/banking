<?php

class CsvReader
{
    public $error = '';

    public $transactions = [];

    public function readFile($filename)
    {
        if (!file_exists($filename)) {
            $this->error = "File not found.";
            return;
        }

        // Open the file for reading
        $file = fopen($filename, 'r');
        if ($file === false) {
            $this->error = "Error opening file.";
            return;
        }

        $num = 0;
        while (($row = fgetcsv($file)) !== false) {
            $num++;
            if ($num == 1) {
                continue;
            }
            $this->transactions[] = new CsvDto($row[0], $row[1], $row[2], $row[3], $row[4]);
        }

        // Close the file
        fclose($file);
    }
}