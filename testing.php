<?php

    $file = '/var/www/ProxyChecker/proxys';
    $x = filemtime($file);




$format = "m.d.j - H:i:s";
$y = date($format, $x);



echo $y;







































/*





$userAgent = 'Mozilla/5.0 (Windows NT 6.1; Win64; x64; rv:60.0) Gecko/20100101 Firefox/60.0';






private function doubleCheck(bool $bool): void {
    $bool = checkUrl($t);
}




















$curl = curl_init();

curl_setopt_array($curl, [
    CURLOPT_RETURNTRANSFER => 1,  // vraci string misto vypsani
    CURLOPT_TIMEOUT => 2,
    CURLOPT_CONNECTTIMEOUT => 4, // urči jak dlouho se zkouši připojit
    CURLOPT_URL => "google.com",
// CURLOPT_URL => "store.steampowered.com",
    CURLOPT_USERAGENT => 'Mozilla/5.0 (Windows NT 6.1; Win64; x64; rv:60.0) Gecko/20100101 Firefox/60.0',
]);

$result = curl_exec($curl);
if (curl_errno($curl) === 0) {
    echo "ok";
}
var_dump($curl);
curl_close($curl);

// echo $result;
*/
