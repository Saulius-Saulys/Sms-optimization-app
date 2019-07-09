<?php

namespace App\Sms;


class MessageCombinationFinder
{
    function fillDataFromJsonToObjectArray(array $json): array
    {
        $smsList = array();
        $i = 0;
        foreach ($json["sms_list"] as $value) {
            $smsList[$i] = new Sms($value["price"], $value["income"]);
            $i++;
        }
        return $smsList;
    }

    function readFromJsonFile(array $argv): array
    {
        $jsonData = file_get_contents($argv[1]);
        return json_decode($jsonData, true);
    }

    function insertionSort(array $smsList): array
    {
        for ($i = 0; $i < count($smsList); $i++) {
            $val = $smsList[$i];
            $j = $i - 1;
            while ($j >= 0 && $smsList[$j]->getRate() > $val->getRate()) {
                $smsList[$j + 1] = $smsList[$j];
                $j--;
            }
            $smsList[$j + 1] = $val;
        }
        return $smsList;
    }

    function findArrayOfValuesThatAreClosestToRequired(
        int $index,
        array $smsList,
        float $required,
        float $sum,
        array $values
    ): array {
        if (isset($smsList[$index])) {

            while ($sum + $smsList[$index]->getPrice() <= $required) {
                array_push($values, $smsList[$index]->getPrice());
                $sum = $sum + $smsList[$index]->getIncome();
            }
        }

        if ($sum <= $required && $index <= sizeof($smsList) - 1) {
            $index++;
            return $this->findArrayOfValuesThatAreClosestToRequired($index, $smsList, 11, $sum, $values);
        }

        return $values;
    }

    function findCheapestPrice(array $smsList): float
    {
        $min = INF;
        foreach ($smsList as $object) {

            if ($object->getIncome() < $min) {
                $min = $object->getPrice();
            }
        }
        return $min;
    }

}
