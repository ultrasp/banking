<?php
// require(__ROOT__ . '/libs/FPDF/fpdf.php');
require_once(__ROOT__ . '/libs/tcpdf/TCPDF-main/examples/tcpdf_include.php');

class PdfExporter extends TCPDF
{

    public function makeTable($header, $data)
    {
        foreach ($header as $col)
            $this->Cell($col['w'], 7, $col['label'], 1);
        $this->Ln(); // Data
        foreach ($data as $row) {
            foreach ($header as $col)
                $this->Cell($col['w'], 6, $row[$col['param']], 1);
            $this->Ln();
        }
    }

}
?>