<?php

class TransactionsLoader
{
    private $connection;
    private $accounts = [];
    private $currencies = [];

    private $targetDir = 'uploads/';
    public function uploadData()
    {
        if (empty($_FILES["fileInput"])) {
            return;
        }
        $targetFile = __ROOT__ . "/" . $this->targetDir . basename($_FILES["fileInput"]["name"]);
        // var_dump($targetFile);
        move_uploaded_file($_FILES["fileInput"]["tmp_name"], $targetFile);
        $this->load($targetFile);
    }
    public function load($filename)
    {
        $this->connection = getConnection();
        $reader = new CsvReader();
        $reader->readFile($filename);

        if (empty($reader->error)) {
            $this->clearOldData();
            $this->storeTransactions($reader->transactions);
        }
    }

    public function clearOldData()
    {
        $this->connection->delete('accounts');
        $this->connection->delete('currencies');
        $this->connection->delete('transactions');
    }

    public function storeTransactions($transactions)
    {
        foreach ($transactions as $transaction) {

            if ($this->getCurrency($transaction->currency)) {
                $currencyId = $this->getCurrency($transaction->currency);
            } else {
                $currencyId = $this->storeCurrencies($transaction->currency);
            }


            if ($this->getAccount($transaction)) {
                $accountId = $this->getAccount($transaction);
            } else {
                $accountId = $this->storeAcccount($transaction);
            }


            $this->storeTransaction($transaction, $accountId, $currencyId);
        }
    }

    public function getCurrency($currency)
    {
        return isset($this->currencies[$currency]) ? $this->currencies[$currency] : null;

    }

    public function getAccount($transaction)
    {
        return isset($this->accounts[$transaction->account . '_' . $transaction->currency]) ? $this->accounts[$transaction->account . '_' . $transaction->currency] : null;

    }
    public function storeAcccount($transaction)
    {
        $data = array("account" => $transaction->account, 'currency_id' => $this->currencies[$transaction->currency]);
        $id = $this->connection->insert('accounts', $data);
        $this->accounts[$transaction->account . '_' . $transaction->currency] = $id;
        return $id;
    }


    public function storeCurrencies($currency)
    {
        $data = array("symbol" => $currency);
        $id = $this->connection->insert('currencies', $data);
        $this->currencies[$currency] = $id;
        return $id;
    }

    public function storeTransaction($transaction, $accountId, $currencyId)
    {
        $data = array("account_id" => $accountId,
            'transaction_no' => $transaction->transNumber,
            'amount' => $transaction->amount,
            'currency_id' => $currencyId,
            'operation_date' => $transaction->date
        );
        $id = $this->connection->insert('transactions', $data);
        return $id;
    }

}