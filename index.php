<?php
declare(strict_types=1);

use theRealCooller\ProxyChecker;
require __DIR__ . '/vendor/autoload.php';

//change these as you see fit:
$resource = '/var/www/ProxyChecker/proxyz';
$urlToTest = 'https://www.csfd.cz/';
$positiveResultFileName = 'positive-result.txt';
$negativeResultFileName = 'negative-results.txt';


$urlResponse = new ProxyChecker\UrlResponse($urlToTest, new ProxyChecker\RandomUserAgent(), 3);
$textFilePositiveOutput = new ProxyChecker\TextFileOutput($positiveResultFileName);
$massOutput = new ProxyChecker\MassOutput($textFilePositiveOutput, new ProxyChecker\StdOutput());
$nullOutput = new ProxyChecker\DevNullOutput();
$textFileNegativeOutput = new ProxyChecker\TextFileOutput($negativeResultFileName);
$Results = new ProxyChecker\FinalProgress($positiveResultFileName, $negativeResultFileName, $resource);

$proxy = new ProxyChecker\ProxyCheck($resource, $massOutput, $nullOutput, $urlResponse, $Results);
$proxy->check();
