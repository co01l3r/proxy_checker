<?php
declare(strict_types=1);


use theRealCooller\ProxyChecker;

require __DIR__ . '/vendor/autoload.php';

$urlResponse = new ProxyChecker\UrlResponse('https://www.csfd.cz/', new ProxyChecker\RandomUserAgent(), 3);
$textFilePositiveOutput = new ProxyChecker\TextFileOutput('positive-results.txt');
$massOutput = new ProxyChecker\MassOutput($textFilePositiveOutput, new ProxyChecker\StdOutput());
$nullOutput = new ProxyChecker\DevNullOutput();
$textFileNegativeOutput = new ProxyChecker\TextFileOutput('negative-results.txt');
$Results = new ProxyChecker\FinalProgress('positive-results.txt', 'negative-results.txt', '/var/www/ProxyChecker/proxyxy');

$proxy = new ProxyChecker\ProxyCheck('/var/www/ProxyChecker/proxyxy', $massOutput, $nullOutput, $urlResponse, $Results);
$proxy->check();

