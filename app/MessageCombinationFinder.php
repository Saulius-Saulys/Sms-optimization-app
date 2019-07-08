<?php

namespace App\Sms;


class MessageCombinationFinder
{
    function fillDataFromJsonToObjectArray($json): array
    {
        $smsList = array();
        $i = 0;
        foreach ($json["sms_list"] as $value) {
            $smsList[$i] = new Sms($value["price"], $value["income"]);
            $i++;
        }
        return $smsList;
    }

    function readFromJsonFile($argv): array
    {
        $jsonData = file_get_contents($argv[1]);
        return json_decode($jsonData, true);
    }

    function insertion_Sort($smsList): array
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

    function findArrayOfValuesThatAreClosestToRequired($index, $smsList, $required, $sum, $values): array
    {
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

    function findCheapestPrice($smsList): float
    {
        $min = INF;
        foreach ($smsList as $object) {

            if ($object->getIncome() < $min) {
                $min = $object->getPrice();
            }
        }
        return $min;
    }

    function printResult($test, $smsList): void
    {
        echo "[";
        foreach ($test as $value) {
            if ($value != $this->findCheapestPrice($smsList)) {
                echo $value . ", ";
            } else {
                echo $value;
            }
        }
        echo "]\n";
    }
}
