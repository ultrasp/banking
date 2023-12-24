<?php
class CsvDto
{

    public $account;
    public $transNumber;
    public $amount;
    public $currency;
    public $date;
    public function __construct($account, $transNumber, $amount, $currency, $date)
    {
        $this->account = $account;
        $this->transNumber = $transNumber;
        $this->amount = $amount;
        $this->currency = $currency;
        $this->date = $date;
    }
}