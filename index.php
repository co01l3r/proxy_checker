<?php

require __DIR__ . '/vendor/autoload.php';
require ('ProxyList.php');
require ('RandomUserAgent.php');
require ('UrlResponse.php');
require ('TextFileOutput.php');


$proxyList = new ProxyList('/var/www/ProxyChecker/proxy', new \Klapuch\Lock\SemaphoreFactory());
$randomUserAgent = new RandomUserAgent();
$urlResponse = new UrlResponse('https://www.csfd.cz/', $randomUserAgent, 3);
$textFileOutput = new TextFileOutput('newFile.txt');


while (($proxy = $proxyList->use()) !== '') {
    if ($urlResponse->isOk($proxy))
        $textFileOutput->write($proxy);
    else {
        echo "not OK" . PHP_EOL;
    }
    }
