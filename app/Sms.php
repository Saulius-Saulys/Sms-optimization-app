<?php

namespace App\Sms;

class Sms
{
    private $price;

    private $income;

    private $rate;

    function __construct($price, $income)
    {
        $this->price = $price;
        $this->income = $income;
        $this->rate = $price / $income;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function getIncome(): float
    {
        return $this->income;
    }

    public function getRate(): float
    {
        return $this->rate;
    }

}
