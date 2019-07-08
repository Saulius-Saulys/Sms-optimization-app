<?php

namespace App\Sms;

require_once('../vendor/autoload.php');
$messageCombinationFinder = new MessageCombinationFinder();
$json = $messageCombinationFinder->readFromJsonFile($argv);
$smsList = $messageCombinationFinder->fillDataFromJsonToObjectArray($json);

$objectArray = $messageCombinationFinder->insertion_Sort($smsList);
$values = array();
$result = $messageCombinationFinder->findArrayOfValuesThatAreClosestToRequired(0, $objectArray, 11, 0, $values);
array_push($result, $messageCombinationFinder->findCheapestPrice($smsList));

$messageCombinationFinder->printResult($result, $smsList);
