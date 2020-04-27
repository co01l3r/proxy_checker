<?php

require __DIR__ . '/vendor/autoload.php';
require ('UserAgent.php');
require ('Response.php');
require ('ProxyList.php');
require ('RandomUserAgent.php');
require ('UrlResponse.php');
require ('TextFileOutput.php');
require ('StdOutput.php');
require ('MassOutput.php');
require ('ProxyCheck.php');


$urlResponse = new UrlResponse('https://www.csfd.cz/', new RandomUserAgent(), 3);
$textFileOutput = new TextFileOutput('result.txt');
$massOutput = new MassOutput($textFileOutput, new StdOutput());


$proxy = new ProxyCheck('/var/www/ProxyChecker/proxy', $massOutput, $urlResponse);
$proxy->check();
