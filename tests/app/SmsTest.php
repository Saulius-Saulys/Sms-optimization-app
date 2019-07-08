<?php

namespace App\Sms;

use PHPUnit\Framework\TestCase;

class SmsTest extends TestCase
{
    public function test_insertion_sort()
    {
        $smsArray[] = [
            new Sms(0.5, 0.41),
            new Sms(1, 0.96),
            new Sms(2, 1.91),
            new Sms(3, 2.9)
        ];

        $correctlySortedArray[] = [
            new Sms(3, 2.9),
            new Sms(1, 0.96),
            new Sms(2, 1.91),
            new Sms(0.5, 0.41)
        ];

        $messageCombinationFinder = new MessageCombinationFinder();

        $sortedArray = $messageCombinationFinder->insertion_Sort($smsArray);

        $this->assertEquals($sortedArray, $sortedArray);
    }

    public function test_find_cheapest_price()
    {
        $smsArray[0] = new Sms(0.5, 0.41);
        $smsArray[1] = new Sms(1, 0.96);
        $smsArray[3] = new Sms(2, 1.91);
        $smsArray[4] = new Sms(3, 2.9);

        $messageCombinationFinder = new MessageCombinationFinder();

        $cheapestPrice = $messageCombinationFinder->findCheapestPrice($smsArray);

        $this->assertEquals($cheapestPrice, 0.5);
    }

    public function test_find_array_of_values_that_are_closest_to_required()
    {
        $smsArray[0] = new Sms(3, 2.9);
        $smsArray[1] = new Sms(1, 0.96);
        $smsArray[3] = new Sms(2, 1.91);
        $smsArray[4] = new Sms(0.5, 0.41);

        $messageCombinationFinder = new MessageCombinationFinder();
        $values = array();
        $smsArray = $messageCombinationFinder->findArrayOfValuesThatAreClosestToRequired(0, $smsArray, 11, 0, $values);

        $this->assertEquals($smsArray, [3, 3, 3, 1, 1]);

    }
}