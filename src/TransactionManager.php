<?php
class TransactionManager
{
    private $connection;
    public function __construct()
    {
        $this->connection = getConnection();
    }

    public function getTransactionQuery()
    {
        return '        select 
        t.id,
        a.account,
        t.transaction_no,
        t.amount amount,
        c.symbol symbol,
        t.operation_date operation_date
    from transactions t 
        join accounts a on a.id = t.account_id
        join currencies c on c.id = t.currency_id
';
    }

    public function getTransactionData()
    {
        $perPage = $_GET['length'];
        $offset = $_GET['start']; // $perPage * ($page - 1);
        $total = $this->connection->rawQueryOne('select count(0) as count from transactions');
        $transactions = $this->connection->rawQuery($this->getTransactionQuery() . '
            limit ' . $offset . ', ' . $perPage . '
        ');
        return json_encode([
            'data' => $transactions,
            'draw' => $_GET['draw'],
            'recordsTotal' => $total['count'],
            'recordsFiltered' => $total['count'],
        ]);

    }

    public function storeTransactionParam()
    {
        $data = $_POST['data'];
        $id = array_keys($data)[0];
        if ($_POST['action'] == 'edit') {
            $column = array_keys($data[$id])[0];
            $newVal = $data[$id][$column];

            $data = array(
                $column => $newVal,
            );
            $this->connection->where('id', $id);
            $this->connection->update('transactions', $data);
            $transaction = $this->connection->rawQueryOne($this->getTransactionQuery() . ' where t.id = ? ', [$id]);
            return json_encode(['data' => [$transaction]]);
        }
        if ($_POST['action'] == 'remove') {
            $this->connection->where('id', $id);
            $this->connection->delete('transactions');
            return json_encode(['data' => []]);
        }

    }

    public function getExportHeader()
    {
        return [
            ['label' => 'Account', 'param' => 'account', 'w' => 23],
            ['label' => 'Transacion No', 'param' => 'transaction_no', 'w' => 85],
            ['label' => 'Amount', 'param' => 'amount', 'w' => 20],
            ['label' => 'Currency', 'param' => 'symbol', 'w' => 25],
            ['label' => 'Date', 'param' => 'operation_date', 'w' => 45]
        ];
    }

    public function exportPdf()
    {
        $pdf = new PdfExporter(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $pdf->AddPage();
        // $pdf->SetFont('Arial','',12);

        $header = $this->getExportHeader();
        $transactions = $this->connection->rawQuery($this->getTransactionQuery());

        $pdf->makeTable($header, $transactions);
        $pdf->Output();
    }

    public function exportExcel()
    {
        $excel = new ExcelExporter();
        $transactions = $this->connection->rawQuery($this->getTransactionQuery());
        $header = $this->getExportHeader();
        $data = [];
        $row = array_column($header, 'label');
        $data[] = $row;
        foreach ($transactions as $key => $transaction) {
            $row = [];
            foreach ($header as $th) {
                $row[] = $transaction[$th['param']];
            }
            $data[] = $row;
        }
        $excel->makeTable($data);
    }

}
?>