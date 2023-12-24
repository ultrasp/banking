<?php
class AccountManager
{
    private $baseCurrency = 'CHF';
    private $connection;
    public function __construct()
    {
        $this->connection = getConnection();
    }

    public function getAccountQuery()
    {
        return 'select 
                a.id, 
                a.account, 
                c.symbol,
                a.start_balance,
                (select sum(amount) from transactions t where t.account_id = a.id ) end_balance
            from accounts a 
                join currencies c on c.id = a.currency_id
            ';
    }
    public function getList()
    {
        $accounts = $this->connection->rawQuery($this->getAccountQuery());
        return json_encode(['data' => $accounts]);
    }

    public function getDateRange($startDate, $endDate)
    {
        $startDate = new DateTime($startDate);
        $endDate = new DateTime($endDate);

        $interval = new DateInterval('P1D'); // P1D represents a period of 1 day

        $dateRange = new DatePeriod($startDate, $interval, $endDate);

        $periods = [];
        foreach ($dateRange as $date) {
            $periods[] = $date->format('Y-m-d') . PHP_EOL;
        }
        return $periods;
    }


    public function getGraphicData()
    {
        $groupedTransactions = $this->connection->rawQuery('
        select 
            t.account_id, 
            date(t.operation_date) operation_date, 
            sum(amount) amount
        from transactions t 
            group by t.account_id, date(t.operation_date)
            order by date(t.operation_date)
        ');

        $dbAccounts = $this->connection->get('accounts');
        $accounts = [];
        foreach ($dbAccounts as $acc) {
            $accounts[$acc['id']] = $acc['account'];
        }

        $dataPoints = [];
        $totals = [];
        foreach ($groupedTransactions as $transaction) {
            if (!isset($dataPoints[$transaction['account_id']])) {
                $dataPoints[$transaction['account_id']] = [];
            }
            // $currentDateTime = new DateTime();

            $dataPoints[$transaction['account_id']][] = [
                $transaction['operation_date'], floatval($transaction['amount'])
            ];

            $totals[$transaction['operation_date']] = (isset($totals[$transaction['operation_date']]) ? $totals[$transaction['operation_date']] : 0) + $transaction['amount'];
        }


        $allData = [];
        foreach ($dataPoints as $accountid => $data) {
            $allData[] = [
                'name' => $accounts[$accountid],
                'data' => $data
            ];
        }

        $totalData = [];
        foreach ($totals as $date => $val) {
            $totalData[] = [
                $date, floatval($val)
            ];
        }
        $allData[] = [
            'name' => 'Totals',
            'data' => $totalData
        ];

        return json_encode($allData);
    }



    public function storeAccountParam()
    {
        $data = $_POST['data'];
        $id = array_keys($data)[0];
        $column = array_keys($data[$id])[0];
        $newVal = $data[$id][$column];

        $data = array(
            $column => $newVal,
        );
        $this->connection->where('id', $id);
        $this->connection->update('accounts', $data);
        $account = $this->connection->rawQueryOne($this->getAccountQuery() . ' where a.id = ? ', [$id]);
        return json_encode(['data' => [$account]]);

    }


}
?>