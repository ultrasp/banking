<?php
class CurrencyRates
{

    private $connection;
    public function __construct() {
        $this->connection = getConnection();
    }

    private $baseCurrency = 'CHF';
    private $accessKey = '5f1ae8f4c8a05df931145e32';
    public function getRates()
    {
        $targetCurrencies = $this->connection->rawQuery('select * from currencies c where c.symbol != ? ', [$this->baseCurrency]);
        $rates = [];
        foreach ($targetCurrencies as $targetCurrency) {
            $rate = $this->getRate($targetCurrency['symbol']);
            $rates[] = [
                'symbol' => $targetCurrency['symbol'],
                'rate' => $rate
            ];
        }
        return json_encode($rates);
    }

    public function getRate($targetCurrency)
    {
        // Make a request to the ExchangeRatesAPI
        $apiEndpoint = "https://open.er-api.com/v6/latest/{$this->baseCurrency}?apikey={$this->accessKey}";
        $response = file_get_contents($apiEndpoint);

        // Check if the request was successful
        if ($response !== false) {
            $data = json_decode($response, true);

            // Get the exchange rate for CNY
            if (isset($data['rates'][$targetCurrency])) {
                $exchangeRate = $data['rates'][$targetCurrency];
                return $exchangeRate;
            }
        }
        return '';
    }
}