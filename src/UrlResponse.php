<?php

namespace theRealCooller\ProxyChecker;

class UrlResponse implements Response
{
    private string $url;
    private RandomUserAgent $randomUserAgent;
    private int $attempts;

    public function __construct(string $url, RandomUserAgent $randomUserAgent, int $attempts = 0)
    {
        $this->attempts = $attempts;
        $this->url = $url;
        $this->randomUserAgent = $randomUserAgent;
    }

    private function firstConnectionAttempt(string $proxy): bool {
        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_TIMEOUT => 2,
            CURLOPT_CONNECTTIMEOUT => 4,
            CURLOPT_URL => $this->url,
            CURLOPT_USERAGENT => $this->randomUserAgent->choose(),
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_PROXY => $proxy,
        ]);

        try {
            curl_exec($curl);
            if (curl_errno($curl) === 0) {
                return true;
            } else {
                return false;
            }
        } finally {
            curl_close($curl);
        }
    }

    public function isOk(string $proxy): bool
    {
        $attempts = $this->attempts;

        do {
            if ($this->firstConnectionAttempt($proxy) === true) {
                return true;
            }
        } while (--$attempts === 0);
        return false;
    }


}
