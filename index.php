<?php

require __DIR__ . '/vendor/autoload.php';
require ('ProxyList.php');
require ('RandomUserAgent.php');
require ('UrlResponse.php');
require ('TextFileOutput.php');
require ('StdOutput.php');
require ('MassOutput.php');


$proxyList = new ProxyList('/var/www/ProxyChecker/proxy', new \Klapuch\Lock\SemaphoreFactory());
$randomUserAgent = new RandomUserAgent();
$urlResponse = new UrlResponse('https://www.csfd.cz/', $randomUserAgent, 3);
$textFileOutput = new TextFileOutput('newFile.txt');
$massOutput = new MassOutput($textFileOutput, new StdOutput());


while (($proxy = $proxyList->use()) !== '') {
    if ($urlResponse->isOk($proxy))
        $massOutput->write($proxy);
    else {
        echo "not OK" . PHP_EOL;
    }
    }
