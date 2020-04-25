<?php

require __DIR__ . '/vendor/autoload.php';
require ('ProxyList.php');
require ('RandomUserAgent.php');
require ('UrlResponse.php');


$proxyList = new ProxyList('/var/www/ProxyChecker/proxys', new \Klapuch\Lock\SemaphoreFactory());
$randomUserAgent = new RandomUserAgent();
$urlResponse = new UrlResponse('https://www.csfd.cz/', $randomUserAgent, 3);


while (($proxy = $proxyList->use()) !== '') {
    if ($urlResponse->isOk($proxy))
        echo $proxy;
    else {
        echo "not OK" . PHP_EOL;
    }
    }
