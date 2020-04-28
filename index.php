<?php


use theRealCooller\ProxyChecker;
require __DIR__ . '/vendor/autoload.php';

$urlResponse = new ProxyChecker\UrlResponse('https://www.csfd.cz/', new ProxyChecker\RandomUserAgent(), 3);
$textFileOutput = new ProxyChecker\TextFileOutput('result.txt');
$massOutput = new ProxyChecker\MassOutput($textFileOutput, new ProxyChecker\StdOutput());


$proxy = new ProxyChecker\ProxyCheck('/var/www/ProxyChecker/proxy', $massOutput, $urlResponse);
$proxy->check();
