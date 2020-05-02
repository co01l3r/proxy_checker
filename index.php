<?php


use theRealCooller\ProxyChecker;
require __DIR__ . '/vendor/autoload.php';

$urlResponse = new ProxyChecker\UrlResponse('https://www.csfd.cz/', new ProxyChecker\RandomUserAgent(), 3);
$textFilePositiveOutput = new ProxyChecker\TextFileOutput('positive-results.txt');
$massOutput = new ProxyChecker\MassOutput($textFilePositiveOutput, new ProxyChecker\StdOutput());
$nullOutput = new ProxyChecker\DevNullOutput();
$textFileNegativeOutput = new ProxyChecker\TextFileOutput('negative-results.txt');

$proxy = new ProxyChecker\ProxyCheck('/var/www/ProxyChecker/proxy', $massOutput, $nullOutput, $urlResponse);
$proxy->check();
