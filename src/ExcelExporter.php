<?php
use SimpleExcel\SimpleExcel;

require_once(__ROOT__ . '/libs/SimpleExcel/simple-excel-php-master/src/SimpleExcel/SimpleExcel.php');

class ExcelExporter
{

    public function makeTable($data)
    {
        $excel = new SimpleExcel('csv');                    // instantiate new object (will automatically construct the parser & writer type as CSV)

        $excel->writer->setData(
            $data
        );                                                  // add some data to the writer
        $excel->writer->saveFile('Transaction');                // save the file with specified name (example.csv) 

    }

}
?>