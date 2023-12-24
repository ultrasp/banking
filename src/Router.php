<?php
class Router
{

    const LOAD_RATES = 'loadCurrencies';
    const LOAD_ACCOUNTS = 'accounts';
    const LOAD_GRAPHIC = 'graphic';
    const LOAD_TRANSACTIONS = 'transactions';
    const STORE_TABLE_PARAM = 'post-param';
    const EXPORT_PDF = 'export-pdf';
    const EXPORT_EXCEL = 'export-excel';
    const UPLOAD_CSV = 'upload';

    public function proccess()
    {
        if (isset($_GET[self::UPLOAD_CSV])) {
            $loader = (new TransactionsLoader())->uploadData();
// $loader->load($filePath);
            exit;
        }
        if (isset($_GET[self::LOAD_RATES])) {
            $rates = (new CurrencyRates())->getRates();
            echo $rates;
            exit;
        }

        if (isset($_GET[self::LOAD_ACCOUNTS])) {
            $accounts = (new AccountManager())->getList();
            echo $accounts;
            exit;
        }
        if (isset($_GET[self::LOAD_GRAPHIC])) {
            $graphicData = (new AccountManager())->getGraphicData();
            echo $graphicData;
            exit;
        }

        if (isset($_GET[self::LOAD_TRANSACTIONS])) {
            $transactions = (new TransactionManager())->getTransactionData();
            echo $transactions;
            exit;
        }
        if($_GET[self::STORE_TABLE_PARAM] == 'account'){
            $accountUpdated =(new AccountManager())->storeAccountParam();
            echo $accountUpdated;
            exit;
        }
        if($_GET[self::STORE_TABLE_PARAM] == 'transaction'){
            $transactionUpdated =(new TransactionManager())->storeTransactionParam();
            echo $transactionUpdated;
            exit;
        }
        if (isset($_GET[self::EXPORT_PDF])) {
            (new TransactionManager())->exportPdf();
            exit;
        }
        if (isset($_GET[self::EXPORT_EXCEL])) {
            (new TransactionManager())->exportExcel();
            exit;
        }
        include(__ROOT__.'/pages/main.php');

    }

    
}